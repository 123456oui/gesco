<?php

namespace App\Http\Controllers\Reglement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pcharge;
use App\Models\Eleve;
use App\Models\Cycle;
use App\Models\Classe;
use App\Models\Niveau;
use App\Models\Reglement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StateControler extends Controller
{
    private $msgerror='Impossible de supprimer cet élément car il est utilisé!';
    private $operation='Opération effectuée avec succès';
    private $donneeexiste='Donneés déjà existant';
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request, $rub, $srub)
    {
        $annee = session('annee'); // tu peux stocker l'année scolaire en session
    
        $query = DB::table('eleves')
            ->join('inscriptions', 'eleves.Matricule', '=', 'inscriptions.Matricule')
            ->where('inscriptions.idanneescolaire', $annee);
    
        if ($request->filled('cycle')) {
            $query->where('inscriptions.idcycle', $request->cycle);
        }
    
        if ($request->filled('niveau')) {
            $query->where('inscriptions.idniveau', $request->niveau);
        }
    
        if ($request->filled('classe')) {
            $query->where('inscriptions.idclasse', $request->classe);
        }
    
        $eleves = $query->select('eleves.*')->orderBy('eleves.created_at', 'desc')->get();
    
        foreach ($eleves as &$eleve) {
            $eleve->Photo = !empty($eleve->Photo) ? asset('storage/' . $eleve->Photo) : '';
        }
    
        // Récupérer les listes pour les filtres
        $cycles = DB::table('cycles')->get();
        $niveaux = DB::table('niveaux')->where('annee','=',$annee)->get();
        $classes = DB::table('classes')->where('Annee','=',$annee)->get();
        return view('state.index', [
            'eleves' => $eleves,
            'rub' => $rub,
            'srub' => $srub,
            'controler' => $this, // ici tu passes le contrôleur
            'cycles' => $cycles,
            'niveaux' => $niveaux,
            'classes' => $classes,
        ]);
         }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create($rub, $srub)
    {
        //
        
        return view('state.create')->with(["rub"=>$rub,"srub"=>$srub]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pcharge = new Pcharge();
        $pcharge->libellepcharge=$request->input('structure');
        $pcharge->pmontant=$request->input('pmontant');
        $pcharge->save();
      return redirect('state/'.$request->input('rub').'/'.$request->input('srub'))->with(['success'=>$this->operation]);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id, $rub = null, $srub=null)
    {
        $annee=session('annee');
        $Inscriptions = DB::table('inscriptions')
        ->where('idanneescolaire', $annee)
        ->where('Matricule', $id)->first();
        $scolarite=$Inscriptions->montantscolariteE;
        $eleve = Eleve::where('Matricule', $id)->first();
        $eleve->Photo = !empty($eleve->Photo) ? asset('storage/' . $eleve->Photo) : '';
        $reglements = Reglement::where('id_eleve', $id)
            ->where('annee', $annee)
            ->get();
        $niveau = DB::table('niveaux')->where('id', $Inscriptions->idniveau)->first();
        $cycle= DB::table('cycles')->where('id', $Inscriptions->idcycle)->first();
        $total = $reglements->sum('montant');
        return view('state.edit')->with(['inscription'=>$Inscriptions,"rub"=>$rub,"srub"=>$srub,'scolarite'=>$scolarite,'total'=>$total,'eleve'=>$eleve,'niveau'=>$niveau,'cycle'=>$cycle]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pcharge = Pcharge::find($id);
        $pcharge->libellepcharge=$request->input('structure');
        $pcharge->pmontant=$request->input('pmontant');
        $pcharge->save();
        return redirect('state/'.$request->input('rub').'/'.$request->input('srub'))->with(['success'=>$this->operation]);
  
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
