<?php

namespace App\Http\Controllers\Reglement;
use App\Http\Controllers\Controller;
use App\Models\Action;
use App\Models\Actionmenu;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;

class CantanneController extends Controller
{
    private $msgerror='Impossible de supprimer cet élément car il est utilisé!';
    private $operation='Opération effectuée avec succès';
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($rub , $srub)
    {
        $mois=DB::table('mois')->orderBy('id')->get();
        return view('cantanne.index')->with(['controler'=>$this,'rub'=>$rub,'srub'=>$srub,'mois'=>$mois]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($rub, $srub)
    {
        $menuParent=Menu::all();//where('parent_id',Null)->get();
        $actions=Action::all();
        return view('cantanne.create')->with(['parents'=>$menuParent,'actions'=>$actions,"rub"=>$rub,"srub"=>$srub]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'menu' => ['required', 'string'],
        ]);

        $menu = new Menu();
        $menu->parent_id=$request->input('parent');
        $menu->nomMenu=$request->input('menu');
        $menu->lien=$request->input('lien');
        $menu->icon=$request->input('icone');
        $menu->ordre=$request->input('ordre');
        $menu->interface=$request->input('interface');
        $menu->save();
        $this->saveMenuAction($menu->id,$request);
        //dd($this);
        return redirect('cantanne/'.$request->input('rub').'/'.$request->input('srub'))->with(['success'=>$this->operation]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($rub, $srub, Request $request)
{
    $somme = 0;
    $anne= session('annee');
    $moisDebutId = $request->input('moisdebut');
    $moisFinId = $request->input('moisfin');

    // Récupérer les libellés des mois si besoin
    $moisDebutNom = DB::table('mois')->where('id', $moisDebutId)->value('nom_mois');
    $moisFinNom = DB::table('mois')->where('id', $moisFinId)->value('nom_mois');

    // Si tu veux filtrer sur les enregistrements ayant un mois_id entre les deux
    $cantines = DB::table('cantines')
        ->join('eleves', 'cantines.matricule', '=', 'eleves.matricule')
        ->select(
            'cantines.matricule',
            'eleves.nom',
            'eleves.prenom',
            DB::raw('COUNT(*) as nombre_fois')
        )->where('cantines.annee', $anne)
        ->whereBetween('cantines.mois_id', [$moisDebutId, $moisFinId])
        ->groupBy('cantines.matricule', 'eleves.nom', 'eleves.prenom')
        ->get();

        


// Total général
        
        // Ajouter le montant pour chaque élève
        foreach ($cantines as $cantine) {
            $inscription= DB::table('inscriptions')->where('Matricule', $cantine->matricule)
            ->where('idanneescolaire', $anne)->first();
            $montant=DB::table('cantineparame')->where('annee', $anne)->where('idniveau', $inscription->idniveau)->first()->montant;
            
            $cantine->montant = $cantine->nombre_fois * $montant;
            $somme+=$cantine->montant;
        }

        return view('cantanne.edit')->with([
            'cantines' => $cantines,
            'rub' => $rub,
            'srub' => $srub,
            'moisDebutNom' => $moisDebutNom,
            'moisFinNom' => $moisFinNom,
            'somme' => $somme
        ]);
    }

public function imprimer(Request $request)
{
    $dateDebut = $request->input('moisdebut');
    $dateFin = $request->input('moisfin');
    $rub = $request->input('rub');
    $srub = $request->input('srub');
    $total = $request->input('total');
    $eleves = json_decode($request->input('eleves_json'));
    // Tu peux aussi retrouver le nom de la classe pour affichage

    return view('cantanne.create', [
        'eleves' => $eleves,
        'dateDebut' => $dateDebut,
        'dateFin' => $dateFin,
        'rub' => $rub,
        'srub' => $srub,
        'total' => $total,
    ]);

}
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'menu' => ['required', 'string'],
            //'lien' => ['required', 'string'],
        ]);

        $menu = Menu::find($id);
        $menu->parent_id=$request->input('parent'); 
        $menu->nomMenu=$request->input('menu');
        $menu->lien=$request->input('lien');
        $menu->icon=$request->input('icone');
        $menu->ordre=$request->input('ordre');
        $menu->interface=$request->input('interface');
        //$menu->profondeur=$request->input('collap');
        try {
            $menu->save();
            $actionMenu=$menu->menuActions;
            DB::delete('delete from profilmenuactions where menu_id=?',[$id]);
            DB::delete('delete from profilmenus where menu_id=?',[$id]);
            DB::delete('delete from actionmenus where menu_id=?',[$id]);
            $this->saveMenuAction($id,$request);
            return redirect('menu/'.$request->input('rub').'/'.$request->input('srub'))->with(['success'=>$this->operation,'error'=>'Les profils liés à ce menu ont été désactivés Veuillez les reconfigurés!']);
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with(['error'=>$th->getMessage()]);
        }
        

        return redirect('cantanne/'.$request->input('rub').'/'.$request->input('srub'))->with(['success'=>$this->operation]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::find($id);
        $menu->delete();
        return back()->with(['success'=>$this->operation]);

    }


    public function saveMenuAction($idMenu,$request){
        $tabId=$request->input('action');
        
        if(!empty($tabId)){
            //dd($tabId);
            foreach($tabId as $idAction){
                $actionMenu= new Actionmenu();
                $actionMenu->menu_id=$idMenu;
                $actionMenu->action_id=$idAction;
                $actionMenu->save();
            }
        }
    }
}
