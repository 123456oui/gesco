<?php

namespace App\Http\Controllers\INSCRIPTION;

use App\Http\Controllers\Controller;
use App\Models\Eleve;
use App\Models\Cycle;
use App\Models\Classe;
use App\Models\Niveau;
use Illuminate\Http\Request;
use App\Models\Pcharge;
use Illuminate\Support\Facades\DB;


class EleveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($rub , $srub)
    {
     
        $eleves=Eleve::orderby('created_at','desc')->get();
        foreach ($eleves as &$pratique) {
            $pratique->Photo = !empty($pratique->Photo) ? asset('storage/' . $pratique->Photo) : '';
        }
        return view('Inscription.index')->with(['eleves'=>$eleves,'controler'=>$this,"rub"=>$rub,"srub"=>$srub]); 


        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($rub, $srub)
    {
        $cycles=Cycle::orderby('created_at','desc')->get();
        $classes=Classe::orderby('created_at','desc')->get();
        $subventions = Pcharge::all();
        return view('Inscription.create')->with(["classes"=>$classes,"subventions"=>$subventions,"cycles"=>$cycles,"rub"=>$rub,"srub"=>$srub]);
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Etaorigine' => 'nullable',
            'numactenais' => 'required|string|max:255',
            'cycle' => 'required|integer',
            'niveau' => 'required|integer',
            'classe' => 'required|integer',
            'matriculeE' => 'required|string|max:255',
            'nomE' => 'required|string|max:255',
            'prenomE' => 'required|string|max:255',
            'datenaisE' => 'required|date',
            'lieunaisE' => 'required|string|max:255',
            'nomPE' => 'required|string|max:255',
            'nomME' => 'required|string|max:255',
            'numtelPE' => 'nullable|string|max:20',
            'numtelME' => 'nullable|string|max:20',
            'sante' => 'required|string',
            'typeSubvention' => 'nullable|integer',
            'commentaireSubvention' => 'nullable|string',
            'logo' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $classe=$request->input('niveau');
        $annee = session('annee');
        $userid= session('user')->id;
        $niveau = Niveau::where('id', $classe)
                ->where('annee', $annee)
                ->first();
        $scobrute=$niveau->Montantscolarite;
        if ($request->filled('commentaireSubvention')) {
            $subString = $request->input('commentaireSubvention');
            $sub = preg_replace('/[^0-9,.]/', '', $subString);
            $sub = str_replace(',', '.', $sub);
            $sub = floatval($sub);
            $sco=$scobrute-$sub;
        }else{
            $sco=$scobrute;
        }
        
        $matricule=$request->input('numactenais');
        $eleve = Eleve::where('numbactnaiss', $matricule)->first();
        if($eleve){
            return redirect()->back()
            ->with('js_alert', 'Un élève avec ce matricule existe déjà. veuillez passer a le reinscrription');
        }
        else{
            $neweleve = new Eleve();
            //$eleve->etaorigine_id = $request->Etaorigine;
            $neweleve->numbactnaiss = $request->numactenais;
            $neweleve->matricule = $request->matriculeE;
            $neweleve->Nom = $request->nomE;
            $neweleve->Prenom = $request->prenomE;
            $neweleve->datenais = $request->datenaisE;
            $neweleve->lieunais = $request->lieunaisE;
            $neweleve->Nomp = $request->nomPE;
            $neweleve->Nomm = $request->nomME;
            $neweleve->NumtelP = $request->numtelPE;
            $neweleve->NumtelM = $request->numtelME;
            $neweleve->Sante = $request->sante;
            if ($request->hasFile('logo')) {
                $path = $request->file('logo')->store('eleves', 'public');
                $neweleve->photo = $path; // Stocke juste le chemin relatif
            }
            
            $neweleve->save();
            DB::table('inscriptions')->insert([
                'Matricule' => $neweleve->matricule,
                'idcycle' => $request->cycle,
                'idniveau' => $request->niveau,
                'idclasse' => $request->classe,
                'idanneescolaire' => $annee,
                'montantscolariteE' => $sco,
                'idpcharge' =>$request->typeSubvention,// Remplacer par la vraie valeur (parent à charge lié à l’élève)
                'iduser' => $userid,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return redirect('Eleve/'.$request->input('rub').'/'.$request->input('srub'));
        }
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function matricule($niveau_id)
{
    try {
        $niveau = Niveau::findOrFail($niveau_id);
        $totalEleves = Eleve::count() + 1;

        // Générer un matricule, ex: "6EME-001"
        $prefix = strtoupper(str_replace(' ', '', $niveau->libelleniveau));
        $numero = str_pad($totalEleves, 3, '0', STR_PAD_LEFT);
        $matricule = $prefix . '' . $numero;

        return response()->json([
            'matricule' => $matricule,
            'niveau' => $niveau,
            'total_eleves' => $totalEleves,
        ]);
    }catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

}
