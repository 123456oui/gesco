<?php

namespace App\Http\Controllers\Reglement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classe;
use App\Models\Reglement;
use App\Models\Eleve;
use Illuminate\Support\Facades\DB;
use NumberToWords\NumberToWords;



class ScolariteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request, $rub, $srub)
    {
        $annee = session('annee'); // année scolaire en cours stockée en session
    
        // Sous-requête : total cumulé par élève pour l’année en cours
        $reglements = DB::table('reglements')
            ->select('id_eleve', DB::raw('SUM(montant) as total_paye'))
            ->where('annee', $annee)
            ->groupBy('id_eleve');
    
        // Requête principale : élèves inscrits pour l'année
        $query = DB::table('eleves')
            ->join('inscriptions', 'eleves.Matricule', '=', 'inscriptions.Matricule')
            ->leftJoinSub($reglements, 'reglements_total', function ($join) {
                $join->on('eleves.Matricule', '=', 'reglements_total.id_eleve');
            })
            ->where('inscriptions.idanneescolaire', $annee);
    
        // Filtres dynamiques
        if ($request->filled('cycle')) {
            $query->where('inscriptions.idcycle', $request->cycle);
        }
    
        if ($request->filled('niveau')) {
            $query->where('inscriptions.idniveau', $request->niveau);
        }
    
        if ($request->filled('classe')) {
            $query->where('inscriptions.idclasse', $request->classe);
        }
    
        // Filtre sur l'état de paiement (optionnel : à jour ou impayé)
        if ($request->filled('etat')) {
            if ($request->etat === 'ajour') {
                $query->whereColumn('inscriptions.montantscolariteE', '=', DB::raw('IFNULL(reglements_total.total_paye, 0)'));
            } elseif ($request->etat === 'impaye') {
                $query->whereColumn('inscriptions.montantscolariteE', '>', DB::raw('IFNULL(reglements_total.total_paye, 0)'));
            }
        }
    
        // Récupération des élèves avec photo complète
        $eleves = $query->select('eleves.*')->orderBy('eleves.created_at', 'desc')->get();
    
        foreach ($eleves as &$eleve) {
            $eleve->Photo = !empty($eleve->Photo) ? asset('storage/' . $eleve->Photo) : '';
        }
    
        // Chargement des données de filtres
        $cycles = DB::table('cycles')->get();
        $niveaux = DB::table('niveaux')->where('annee','=',$annee)->get();
        $classes = DB::table('classes')->where('Annee','=',$annee)->get();
    
        return view('Scolarite.index', [
            'eleves' => $eleves,
            'rub' => $rub,
            'srub' => $srub,
            'controler' => $this,
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
    $annee = session('annee');

    $cycles = DB::table('cycles')->get();
    $niveaux = DB::table('niveaux')->get();
    $classes = DB::table('classes')->get();
    $inscriptions = DB::table('inscriptions')->where('idanneescolaire', $annee)->get();
    $banques = DB::table('banques')->get(); // ou nom exact de la table des banques
    return view('Scolarite.create', compact('rub', 'srub','cycles', 'niveaux', 'classes', 'inscriptions', 'banques'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'matricule' => 'required|string|exists:eleves,Matricule',
            'banque' => 'required|exists:banques,id',
            'versement' => 'required|numeric|min:1',
            'ticketbanque' => 'nullable|file|mimes:pdf|max:4096', // max 2MB
        ]);
        $rub = $request->input('rub');
        $srub = $request->input('srub');
        $annee = session('annee'); 
        $matricule = $request->input('matricule');
        $reglements = Reglement::where('id_eleve', $request->input('matricule'))
            ->where('annee', $annee)
            ->get();
        if ($reglements->isEmpty()) {
            $vers = $request->input('versement');
            if($vers < 5000){
                return redirect()->back()->with('error', 'Veillez entrer une somme superieur ou egal a 5000 franc cfa a raison de l APE au premier versement  ');
            }
        }

        // 4. Somme des montants réglés
        $total_regle = $reglements->sum('montant')+ $request->input('versement');
        $totalInscriptions = DB::table('inscriptions')
        ->where('idanneescolaire', $annee)
        ->where('Matricule', $request->input('matricule'))->first();
        if($request->input('cumul')< $totalInscriptions->montantscolariteE){
            if($totalInscriptions->montantscolariteE- $total_regle >=0 ){
                $request->validate([
                    'matricule' => 'required|string|exists:eleves,Matricule',
                    'banque' => 'required|exists:banques,id',
                    'versement' => 'required|numeric|min:1',
                    'ticketbanque' => 'nullable|file|mimes:pdf|max:4096', // max 2MB
                ]);
                $ticketPath = null;
                if ($request->hasFile('banques')) {
                    $ticketPath = $request->file('banques')->store('tickets', 'public');// stocké dans storage/app/public/tickets
                    $reglement = Reglement::create([
                        'id_eleve' => $request->input('matricule'),
                        'id_banque' => $request->input('banque'),
                        'montant' => $request->input('versement'),
                        'cumule' => $request->input('cumul'), // ou calculer le nouveau cumul
                        'annee' => $annee,
                        'ticketbanque' => $ticketPath,
                    ]);
                    
                    if ($reglements->isEmpty()) {
                        //crrer l ape .
                        \DB::table('APE')->insert([
                        'matricule' => $matricule,
                        'montant' => 5000,
                        'annee' => $annee
                    ]);
                    }
                    //$reglement ->save();
                    //
                    return redirect()->route('Scolarite.recu', ['id' => $reglement->id,
                    'rub' => $rub,
                    'srub' => $srub,]);
                    //return redirect('Scolarite/'.$request->input('rub').'/'.$request->input('srub'));
                }
                else{
                    return redirect()->back()->with('error', 'Veillez joindre une piece comptable  ');
                }
                
                
            }else{
                return redirect()->back()->with('error', 'votre montant est supperieur au montant attendu ');
            }  
        }
        else{
            return redirect()->back()->with('error', 'vous etes deja a jours pour cette annee');

        }
        //dd($totalInscriptions->montantscolariteE);

        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

       public function noel(string $id, string $rub, string $srub)
    {
        //
        $annee = session('annee');
        $noel= DB::table('NOEL')
        ->where('matricule', $id)
        ->where('annee', $annee)
        ->first();
        if (!$noel) {
           return view('Scolarite.noel', compact( 'rub', 'srub','id'));
        }
        else {
            return redirect()->back()->with('error', 'cette eleve a deja regler sa facture de noel pour cette annee');
        }
    }

        public function cloture(string $id, string $rub, string $srub)
    {
        //
        $annee = session('annee');
        $cloture= DB::table('CLOTURE')
        ->where('matricule', $id)
        ->where('annee', $annee)
        ->first();
        if (!$cloture) {
           return view('Scolarite.cloture', compact( 'rub', 'srub','id'));
        }
        else {
            return redirect()->back()->with('error', 'cette eleve a deja regler sa facture de cloture pour cette annee');
        }
    }

    public function noelstore( Request $request) {
        $annee=session('annee');
        $matricule=$request->input('matricule');
        $rub=$request->input('rub');
        $srub=$request->input('srub');
        $montant=$request->input('montant');
        \DB::table('NOEL')->insert([
                        'matricule' => $matricule,
                        'montant' => $montant,
                        'annee' => $annee
                    ]);
        return redirect()->route('scolarite.edit', [
        'id' => $matricule,
        'rub' => $rub,
        'srub' => $srub
    ])->with('success', 'Montant Noël enregistré avec succès.');
    }
     public function cloturestore( Request $request) {
        $annee=session('annee');
        $matricule=$request->input('matricule');
        $rub=$request->input('rub');
        $srub=$request->input('srub');
        $montant=$request->input('montant');
        \DB::table('CLOTURE')->insert([
                        'matricule' => $matricule,
                        'montant' => $montant,
                        'annee' => $annee
                    ]);
        return redirect()->route('scolarite.edit', [
        'id' => $matricule,
        'rub' => $rub,
        'srub' => $srub
    ])->with('success', 'Montant Cloture enregistré avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id,string $rub, string $srub)
    {
        //
        $annee = session('annee'); 
        $eleve = Eleve::where('Matricule', $id)->firstOrFail();
        $eleve->Photo = !empty($eleve->Photo) ? asset('storage/' . $eleve->Photo) : '';

        // 2. Récupération de son inscription pour l'année en cours
        $inscription = DB::table('inscriptions')
        ->where('Matricule', $id)
        ->where('idanneescolaire', $annee)
        ->first();

        // Si pas d’inscription, on peut retourner un message d’erreur
        if (!$inscription) {
            return back()->with('error', 'Aucune inscription trouvée pour cet élève en ' . $annee);
        }

        // 3. Récupération des règlements
        $reglements = Reglement::where('id_eleve', $id)
            ->where('annee', $annee)
            ->get();

        // 4. Somme des montants réglés
        $total_regle = $reglements->sum('montant');

        // 5. Reste à payer
        $montant_total = $inscription->montantscolariteE;
        $reste = $montant_total - $total_regle;
        

        return view('Scolarite.edit', compact('eleve', 'inscription', 'reglements', 'total_regle', 'reste', 'rub', 'srub'));

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
    public function getEleve($matricule)
{
    $annee = session('annee');

    // Récupération de l'élève
    $eleve = DB::table('eleves')->where('Matricule', $matricule)->first();

    if (!$eleve) {
        return response()->json(['error' => 'Élève non trouvé'], 404);
    }

    // Récupération de l'inscription de l'année en cours
    $inscription = DB::table('inscriptions')
        ->where('Matricule', $matricule)
        ->where('idanneescolaire', $annee)
        ->first();

    // Récupération des règlements de l'année en cours
    $reglements = DB::table('reglements')
        ->where('id_eleve', $matricule)
        ->where('annee', $annee)
        ->get();

    // Calcul du total payé
    $total_regle = $reglements->sum('montant');

    // Récupération du montant à payer (scolarité)
    $montant_scolarite = $inscription ? $inscription->montantscolariteE : 0;

    // Calcul du reste à payer
    $reste = $montant_scolarite - $total_regle;

    return response()->json([
        'eleve' => $eleve,
        'inscription' => $inscription,
        'reglements' => $reglements,
        'total_regle' => $total_regle,
        'reste' => $reste,
    ]);
}

public function recu (Request $request,$id)
{
    $annee = session('annee');
    $rub = $request->input('rub');
    $srub = $request->input('srub');
    $reglement = Reglement::with('eleve', 'banque')->findOrFail($id);
    $reglement->eleve->Photo=!empty($reglement->eleve->Photo) ? asset('storage/' . $reglement->eleve->Photo) : '';
    $inscription = DB::table('inscriptions')
    ->where('idanneescolaire', $annee)
    ->where('Matricule', $reglement->eleve->Matricule)
    ->first();
    $classe = DB::table('classes')
    ->where('Annee', $annee)
    ->where('id', $inscription->idclasse)
    ->first();
    $autresReglements = Reglement::where('annee', $annee)
    ->where('id', '!=', $id)
    ->where('id_eleve', $reglement->eleve->Matricule)
    ->with('eleve', 'banque')
    ->get();

    $montantTotalAutres = $autresReglements->sum('montant')+$reglement->montant ;
    $rest=$inscription->montantscolariteE - $montantTotalAutres;
    $lettres=$this->afficher($reglement->montant);
    $ape=$reglement->montant-5000;
    $apelettre=$this->afficher($ape);
    return view('Scolarite.recu', compact('reglement', 'rub', 'srub','classe','autresReglements','montantTotalAutres','rest','lettres','ape', 'apelettre'));
}
public function afficher(  $nombre)
    {
        $numberToWords = new NumberToWords();
        $transformer = $numberToWords->getNumberTransformer('fr');
        $lettres = $transformer->toWords($nombre);
        return $lettres;
    }

}
