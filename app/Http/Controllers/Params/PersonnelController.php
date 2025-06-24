<?php

namespace App\Http\Controllers\Params;
use App\Http\Controllers\Controller;
use App\Models\Action;
use App\Models\Actionmenu;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;

class PersonnelController extends Controller
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
    public function index(Request $request, $rub, $srub)
    {
        $genres=DB::table('genrepers')->get();
        $types=DB::table('typepersonnels')->get();
        //dd($ListeMenus);
        $query = DB::table('personnels')
        ->leftJoin('genrepers', 'personnels.genre', '=', 'genrepers.id')
        ->leftJoin('typepersonnels', 'personnels.type', '=', 'typepersonnels.id')
        ->select('personnels.*', 'genrepers.libellepers as genre_libelle', 'typepersonnels.libellepers as type_libelle');

    if ($request->filled('genre_personnel')) {
        $query->where('personnels.genre', $request->genre_personnel);
    }
    if ($request->filled('type_personnel')) {
        $query->where('personnels.type', $request->type_personnel);
    }

    $personnels = $query->get();
        return view('personnel.index')->with(['personnels'=>$personnels,'genres'=>$genres,'types'=>$types,'controler'=>$this,'rub'=>$rub,'srub'=>$srub]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($rub, $srub)
    {
        $genres=DB::table('genrepers')->get();
        $types=DB::table('typepersonnels')->get();
        return view('personnel.create')->with(['genres'=>$genres,'types'=>$types,"rub"=>$rub,"srub"=>$srub]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
            $request->validate([
                'nom'       => 'required|string|max:255',
                'prenom'    => 'required|string|max:255',
                'niveau'    => 'nullable|string|max:100',
                'matricule' => 'nullable|string|max:100',
                'telephone'    => 'nullable|string|max:100',
                'mail' => 'nullable|string|max:100',
                'genre'     => 'required|exists:genrepers,id',
                'type'      => 'required|exists:typepersonnels,id',
            ]);

            // 2. Insertion dans la table personnels
            $personnelId = DB::table('personnels')->insertGetId([
                'nom'       => $request->nom,
                'prenom'    => $request->prenom,
                'niveau'    => $request->niveau,
                'matricule' => $request->matricule,
                'genre'     => $request->genre,
                'type'      => $request->type,
                'telephone'   => $request->telephone,
                'email'      => $request->mail,
            ]);
        return redirect('personnel/'.$request->input('rub').'/'.$request->input('srub'))->with(['success'=>$this->operation]);
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
    public function edit($id,$rub=null,$srub=null)
    {
        $menuParent=Menu::all();//where('parent_id',Null)->get();
        $actions=Action::all();
        $menuConcerne=Menu::find($id);
        $tabAction=$menuConcerne->menuActions; 
        $genres=DB::table('genrepers')->get();
        $types=DB::table('typepersonnels')->get();
        $personnel= DB ::table('personnels')
        ->leftJoin('genrepers', 'personnels.genre', '=', 'genrepers.id')
        ->leftJoin('typepersonnels', 'personnels.type', '=', 'typepersonnels.id')
        ->select('personnels.*', 'genrepers.libellepers as genre_libelle', 'typepersonnels.libellepers as type_libelle')
        ->where('personnels.id', $id)
        ->first();

        //dd($actions);
        return view('personnel.edit')->with(['genres'=>$genres,'types'=>$types,
        'personnel'=>$personnel,'tabAction'=>$tabAction,"rub"=>$rub,"srub"=>$srub]);
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
            $request->validate([
            'nom'       => 'required|string|max:255',
            'prenom'    => 'required|string|max:255',
            'niveau'    => 'nullable|string|max:100',
            'matricule' => 'nullable|string|max:100',
            'telephone' => 'nullable|string|max:100',
            'mail'      => 'nullable|string|max:100',
            'genre'     => 'required|exists:genrepers,id',
            'type'      => 'required|exists:typepersonnels,id',
        ]);

        // 2. Mise à jour dans la table personnels
        DB::table('personnels')
            ->where('id', $id)
            ->update([
                'nom'       => $request->nom,
                'prenom'    => $request->prenom,
                'niveau'    => $request->niveau,
                'matricule' => $request->matricule,
                'genre'     => $request->genre,
                'type'      => $request->type,
                'telephone' => $request->telephone,
                'email'     => $request->mail,
            ]);

        return redirect('personnel/'.$request->input('rub').'/'.$request->input('srub'))->with(['success'=>$this->operation]);
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
