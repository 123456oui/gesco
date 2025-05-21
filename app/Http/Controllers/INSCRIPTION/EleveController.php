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
use Illuminate\Support\Facades\Storage;



class EleveController extends Controller
{
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
        return view('Inscription.index', [
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
        $annee = session('annee');
        $cycles=Cycle::orderby('created_at','desc')->get();

// Classes de l'année en cours
        $classes = Classe::where('Annee', $annee)
        ->orderBy('created_at', 'desc')
        ->get();
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
            'acte_naissance' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'photo_identite' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
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
            if ($request->hasFile('acte_naissance')) {
                $neweleve->acte_naissance = $request->file('acte_naissance')->store('eleves', 'public');
            }
            if ($request->hasFile('photo_identite')) {
                $neweleve->billetin = $request->file('photo_identite')->store('eleves', 'public');
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
    public function edit(string $id,$rub, $srub)
    {
        $annee=session('annee');
        $pcharges=Pcharge::all();
        $classes=Classe::where('Annee','=', $annee)->get();
        $cycles= Cycle::all();
        $niveaux= Niveau::where('annee','=',$annee )->get();
        $eleve = Eleve::where('Matricule', $id)->first();
        $eleve->acte_naissance = !empty($eleve->acte_naissance) ? asset('storage/' . $eleve->acte_naissance) : '';
        $eleve->billetin = !empty($eleve-> billetin ) ? asset('storage/' . $eleve->billetin ) : '';
        $eleve->Photo = !empty($eleve->Photo) ? asset('storage/' . $eleve->Photo) : '';
        $totalInscriptions = DB::table('inscriptions')
        ->where('idanneescolaire', $annee)
        ->where('Matricule', $id)->first();
        $montantScolarite = null;
        $montantsub = null;
        if ($totalInscriptions) {
            $niveau = DB::table('niveaux')
                ->where('annee', $annee)
                ->where('id', $totalInscriptions->idniveau)
                ->first();
            $subvention=DB::table('pcharges')
                ->where('id', $totalInscriptions->idpcharge)
                ->first();
            $montantsub=$subvention ? $subvention->pmontant : null;
            $montantScolarite = $niveau ? $niveau->Montantscolarite : null;
        }

        return view('Inscription.edit')->with([ 'montantsub' => $montantsub,'montantScolarite' => $montantScolarite,'cycles' => $cycles,'classes' => $classes,'pcharges' => $pcharges,
        'niveaux' => $niveaux,'eleve'=>$eleve,'totalInscriptions'=>$totalInscriptions,'controler'=>$this,"rub"=>$rub,"srub"=>$srub]); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id )
    {        //
        $annee = session('annee');
        $eleve = Eleve::where('Matricule', $id)->first();
        $nom = $request->input('nom');
        $prenom = $request->input('prenom');
        $matricule = $request->input('matricule');
        $numbActNaiss = $request->input('numbactnaiss');
        $dateNaiss = $request->input('datenais');
        $lieuNaiss = $request->input('lieunais');
        $sante = $request->input('sante');
        $nomMere = $request->input('nom_mere');
        $telMere = $request->input('NumtelM');
        $nomPere = $request->input('nom_pere');
        $telPere = $request->input('NumtelP');
        $etabOrigine = $request->input('etablissement_origine');

        $cycleId = $request->input('cycle');
        $niveauId = $request->input('niveau');
        $classeId = $request->input('classe');

        $subventionId = $request->input('subvention_id');
        $montant = $request->input('montant');
        $subventionMontant = $request->input('subvention_montant');
        $netPayer = $request->input('net_payer');

        $photo = $request->input('photo'); // ou gérer un upload de fichier
        $photoActuelle = $request->input('photo_actuelle');
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('eleves', 'public');
            $eleve->Photo = $path;
        }
        if ($request->hasFile('extraits')) {
            // Supprimer l'ancien fichier s'il existe
            if ($eleve->acte_naissance && Storage::disk('public')->exists($eleve->acte_naissance)) {
                Storage::disk('public')->delete($eleve->acte_naissance);
            }
            // Enregistrer le nouveau fichier
            $path = $request->file('extraits')->store('eleves', 'public');
            $eleve->acte_naissance = $path;
        }
        if ($request->hasFile('bulletinnotes')) {
            // Supprimer l'ancien fichier s'il existe
            if ($eleve->billetin && Storage::disk('public')->exists($eleve->billetin)) {
                Storage::disk('public')->delete($eleve->billetin);
            }
            // Enregistrer le nouveau fichier
            $path = $request->file('bulletinnotes')->store('eleves', 'public');
            $eleve->billetin = $path;
        }
        $classe=$request->input('niveau');
        $niveau = Niveau::where('id', $classe)
                ->where('annee', $annee)
                ->first();
        $userid= session('user')->id;
        $scobrute=$niveau->Montantscolarite;
        if ($request->filled('subvention_montant')) {
            $subString = $request->input('subvention_montant');
            $sub = preg_replace('/[^0-9,.]/', '', $subString);
            $sub = str_replace(',', '.', $sub);
            $sub = floatval($sub);
            $sco=$scobrute-$sub;
            DB::table('inscriptions')
                ->where('idanneescolaire', $annee)
                ->where('Matricule', $id)
                ->update([
            'idcycle' => $request->input('cycle'),
            'idniveau' => $request->input('niveau'),
            'idclasse' => $request->input('classe'),
            'montantscolariteE'=> $sco,
            'idpcharge' => $subventionId,
            'iduser' => $userid,
            'updated_at' => now()
        ]);
        }
        else{
            DB::table('inscriptions')
                ->where('idanneescolaire', $annee)
                ->where('Matricule', $id)
                ->update([
            'idcycle' => $request->input('cycle'),
            'idniveau' => $request->input('niveau'),
            'idclasse' => $request->input('classe'),
            'iduser' => $userid,
            'updated_at' => now()
        ]);
        }
        $eleve->Nom= $nom;
        $eleve->Prenom =$prenom;
        $eleve->Nomp =$nomPere;
        $eleve->Nomm =$nomMere;
        $eleve->NumtelM =$telMere;
        $eleve->NumtelP =$telPere ;
        $eleve->datenais  = $dateNaiss;
        $eleve->lieunais  =$lieuNaiss;
        $eleve->Sante  =$sante ;
        $eleve->numbactnaiss  =$numbActNaiss;
        $eleve->save();
        return redirect('Eleve/'.$request->input('rub').'/'.$request->input('srub'));
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
public function niveauxParCycle($id)
{
    $niveaux = Niveau::where('idcycle', $id)->get();
    return response()->json($niveaux);
}

public function classesParNiveau($id)
{
    $classes = Classe::where('idniveau', $id)->get();
    return response()->json($classes);
}


}
