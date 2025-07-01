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



class EController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $rub, $srub)
    {
        $annee = session('annee');
        $classes = Classe::where('Annee', $annee)
            ->orderBy('created_at', 'desc')
            ->get();
        $eleves = Eleve::all();

            foreach ($eleves as $eleve) {
                $eleve->Photo = !empty($eleve->Photo) ? asset('storage/' . $eleve->Photo) : '';
            }        
        return view('resinscipte.index', [
            'eleves' => $eleves,
            'classes' => $classes,
            'rub' => $rub,
            'srub' => $srub,
            'controler' => $this, // ici tu passes le contrôleur
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

        $annee = session('annee');
        $existe = DB::table('anneecloture')
        ->where('libelle', $annee)
        ->exists();
        if ($existe) {
            $message = "<div style='font-size:18px; color:#d35400; font-weight:bold; margin-bottom:10px;'>⚠️ L'année scolaire est déjà clôturée. Aucune reinscription n'est possible en cette année $annee.</div>";
            return redirect()->back()->with('swal', $message);
        }


        $matricule = $request->input('Matricule');
        $class = $request->input('classe');
        $classe=DB::table('classes')
            ->where('id', $class)->first();
        $niveau =DB::table('niveaux')
            ->where('id', $classe->idniveau)
            ->first();
        $cycle = DB::table('cycles')
            ->where('id', $niveau->idcycle)
            ->first();
         $inscriptions = DB::table('vue_inscription_reglements')
        ->where('matricule', $matricule) // inclure ou non selon ton besoin
        ->get();

        $inscription = DB::table('inscriptions')
        ->where('matricule', $matricule)
        ->where('idanneescolaire', $annee)
        ->first();
        if ($inscription) {
            $message = "<div style='font-size:18px; color:#d35400; font-weight:bold; margin-bottom:10px;'>⚠️ Cet élève est déjà inscrit pour l'année scolaire en cours.</div>";
            return redirect()->back()->with('swal', $message);
        }
        if ($inscriptions->isNotEmpty()) {
            $message = "<div style='font-size:18px; color:#d35400; font-weight:bold; margin-bottom:10px;'>⚠️ Cet élève est a un retard de scolarite  pour au moins une  année. Détails :</div>";

            foreach ($inscriptions as $i) {
                $classe = DB::table('classes')
                    ->where('id', $i->idclasse)
                    ->first();
                $reste = $i->montantscolariteE - $i->montant_total;

                $message .= "
                    <div style='
                        background: #f9f6f2;
                        border: 1px solid #e67e22;
                        border-radius: 10px;
                        margin-bottom: 12px;
                        padding: 15px 18px;
                        box-shadow: 0 2px 8px rgba(230, 126, 34, 0.07);
                    '>
                        <div style='font-weight:bold; color:#2980b9; margin-bottom:6px;'>Classe : {$classe->libelleclasse}</div>
                        <div><span style='font-weight:bold;'>Année :</span> {$i->idanneescolaire}</div>
                        <div><span style='font-weight:bold;'>Montant de la scolarité :</span> <span style='color:#16a085;'>{$i->montantscolariteE} FCFA</span></div>
                        <div><span style='font-weight:bold;'>Montant versé :</span> <span style='color:#27ae60;'>{$i->montant_total} FCFA</span></div>
                        <div><span style='font-weight:bold;'>Reste à verser :</span> <span style='color:#c0392b;'>{$reste} FCFA</span></div>
                    </div>
                ";
            }
            return redirect()->back()->with('swal_message', $message);
        }
        
        $inscriptionactuelle = DB::table('inscriptions')
        ->where('matricule', $matricule)
        ->orderBy('created_at', 'desc')
        ->first();
        if ($inscriptionactuelle) {
            // Préparer les données pour la nouvelle inscription
            $nouvelleInscription = [
                'Matricule'        => $inscriptionactuelle->Matricule,
                'idanneescolaire'  => $annee,
                'idclasse'         => $class,
                'idcycle'          => $cycle->id,
                'idniveau'         => $niveau->id,
                'montantscolariteE'=> $inscriptionactuelle->montantscolariteE, // ou recalculer si besoin
                'idpcharge'        => $inscriptionactuelle->idpcharge,
                'iduser'           => session('user')->id ?? null,
            ];

            // Insérer la nouvelle inscription
            DB::table('inscriptions')->insert($nouvelleInscription);

            $editUrl = url('Eleve/' . $inscriptionactuelle->Matricule . '/edit/' . $request->input('rub') . '/' . $request->input('srub'));
            $message = "
                <div style='background:#f9f6f2; border:1px solid #27ae60; border-radius:10px; padding:20px; box-shadow:0 2px 8px rgba(39, 174, 96, 0.07); margin-bottom:10px;'>
                    <div style='font-size:20px; color:#27ae60; font-weight:bold; margin-bottom:10px;'>
                        ✅ Nouvelle inscription enregistrée avec succès !
                    </div>
                    <div style='margin-bottom:8px;'><span style='font-weight:bold;'>Matricule :</span> {$nouvelleInscription['Matricule']}</div>
                    <div style='margin-bottom:8px;'><span style='font-weight:bold;'>Année scolaire :</span> {$nouvelleInscription['idanneescolaire']}</div>
                    <div style='margin-bottom:8px;'><span style='font-weight:bold;'>Classe :</span> {$classe->libelleclasse}</div>
                    <div style='margin-bottom:8px;'><span style='font-weight:bold;'>Cycle :</span> {$cycle->libellecycle}</div>
                    <div style='margin-bottom:8px;'><span style='font-weight:bold;'>Niveau :</span> {$niveau->libelleniveau}</div>
                    <div style='margin-bottom:8px;'><span style='font-weight:bold;'>Montant scolarité :</span> <span style='color:#16a085;'>{$nouvelleInscription['montantscolariteE']} FCFA</span></div>
                    <div style='text-align:center; margin-top:18px;'>
                        <a href='{$editUrl}' style='display:inline-block; padding:10px 22px; background:#2980b9; color:#fff; border-radius:6px; text-decoration:none; font-weight:bold;'>
                            Modifier cette inscription
                        </a>
                    </div>
                </div>
            ";
            return redirect()->back()->with('successs', $message);
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
        $annee = session('annee');
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
