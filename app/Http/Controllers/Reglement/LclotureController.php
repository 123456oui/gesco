<?php

namespace App\Http\Controllers\Reglement;
use App\Http\Controllers\Controller;
use App\Models\Action;
use App\Models\Actionmenu;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;

class LclotureController extends Controller
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
        $annee=session('annee');
        $classes=DB::table('classes')->where('Annee',$annee)->get();
        $niveaux=DB::table('niveaux')->where('annee',$annee)->get();
        return view('lcloture.index')->with(['controler'=>$this,'rub'=>$rub,'srub'=>$srub,'classes'=>$classes,'niveaux'=>$niveaux]);
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
        return view('lcloture.create')->with(['parents'=>$menuParent,'actions'=>$actions,"rub"=>$rub,"srub"=>$srub]);
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
        return redirect('lcloture/'.$request->input('rub').'/'.$request->input('srub'))->with(['success'=>$this->operation]);
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
        $classe = $request->input('classe');
        $niveau = $request->input('niveau');
        $annee = session('annee');
        $rub = $request->input('rub');
        $srub = $request->input('srub');
    
        // 🔍 Récupérer les élèves ayant un enregistrement dans NOEL
        $elevesNoel = DB::table('CLOTURE')
            ->join('eleves', 'CLOTURE.matricule', '=', 'eleves.Matricule')
            ->join('inscriptions', function($join) use ($annee, $classe) {
                $join->on('inscriptions.Matricule', '=', 'eleves.Matricule')
                     ->where('inscriptions.idanneescolaire', '=', $annee)
                     ->where('inscriptions.idclasse', '=', $classe)
;            })
            ->select(
                'eleves.Matricule',
                'eleves.Nom',
                'eleves.Prenom',
                'CLOTURE.montant as montant_noel'
            )
            ->where('CLOTURE.annee', $annee)
            ->orderBy('eleves.Matricule')
            ->get();
        // 💰 Récupérer les règlements par matricule
        $reglementsParMatricule = DB::table('reglements')
            ->select('id_eleve', DB::raw('SUM(montant) as total'))
            ->where('annee', $annee)
            ->groupBy('id_eleve')
            ->get()
            ->keyBy('id_eleve'); // Pour accès rapide par matricule
    
        // 🧩 Fusionner les données
        $elevesAvecReglements = $elevesNoel->map(function ($eleve) use ($reglementsParMatricule) {
            $matricule = $eleve->Matricule;
            $eleve->total_reglement = $reglementsParMatricule[$matricule]->total ?? 0;
            return $eleve;
        });
    
        return view('lcloture.edit')->with([
            'reglementsParMatricule' => $elevesAvecReglements,
            'rub' => $rub,
            'srub' => $srub,
            'classe' => $classe,
            'niveau' => $niveau,
        ]);
    
    }


    public function imprimer(Request $request)
    {
        $annee = session('annee');
        $niveau = $request->input('niveau');
        $classe = $request->input('classe');
        $classes=DB::table('classes')->where('Annee',$annee)->where('id',$classe)->first();
        $rub = $request->input('rub');
        $srub = $request->input('srub');
        $total = $request->input('total');
        $eleves = json_decode($request->input('eleves_json'));
        $eleves = collect(json_decode($request->input('eleves_json')));
        // Tu peux aussi retrouver le nom de la classe pour affichage
    
        return view('lcloture.create', [
            'eleves' => $eleves,
            'niveau' => $niveau,
            'classe' => $classes->libelleclasse,
            'rub' => $rub,
            'srub' => $srub,
            'total' => $total,
        ]);
    
    }
    public function getClasses($niveau)
{
    $classes = DB::table('classes')
        ->where('idniveau', $niveau)
        ->orderBy('libelleclasse')
        ->get();

    return response()->json($classes);
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
        

        return redirect('ape/'.$request->input('rub').'/'.$request->input('srub'))->with(['success'=>$this->operation]);
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
