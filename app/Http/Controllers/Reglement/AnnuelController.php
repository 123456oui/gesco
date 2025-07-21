<?php

namespace App\Http\Controllers\Reglement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classe;
use Illuminate\Support\Facades\DB;
use NumberToWords\NumberToWords;


class AnnuelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($rub, $srub)
{
        $annee = session('annee');
        $classes = DB::table('classes')->where('annee', $annee)->get();
        $ape=DB::table('APE')->where('annee', $annee)->get()->sum('montant');
        if ($classes->isEmpty()) {
            $message = "<div style='font-size:18px; color:#d35400; font-weight:bold; margin-bottom:10px;'>⚠️ Aucune classe trouvée pour l'année scolaire sélectionnée.</div>";
            return redirect()->back()->with('mil', $message);
        }

        // Pour chaque classe, on récupère ses inscriptions et le total des versements pour chaque inscription
        $classesWithInscriptions = [];
        foreach ($classes as $classe) {
            $inscriptions = DB::table('inscriptions')
                ->where('idclasse', $classe->id)
                ->where('idanneescolaire', $annee)
                ->get();
             // --- 🎄 Traitement table NOEL
            $noelData = DB::table('NOEL')
                ->join('inscriptions', 'NOEL.matricule', '=', 'inscriptions.Matricule')
                ->where('inscriptions.idclasse', $classe->id)
                ->where('NOEL.annee', $annee)
                ->selectRaw('COUNT(*) as nombre, SUM(montant) as total')
                ->first();

            $classe->noel_nombre = $noelData->nombre ?? 0;
            $classe->noel_total = $noelData->total ?? 0;

            // --- 🏁 Traitement table CLOTURE
            $clotureData = DB::table('CLOTURE')
                ->join('inscriptions', 'CLOTURE.matricule', '=', 'inscriptions.Matricule')
                ->where('inscriptions.idclasse', $classe->id)
                ->where('CLOTURE.annee', $annee)
                ->selectRaw('COUNT(*) as nombre, SUM(montant) as total')
                ->first();

            $classe->cloture_nombre = $clotureData->nombre ?? 0;
            $classe->cloture_total = $clotureData->total ?? 0;
            // Initialisation des compteurs
            $classe->ajours = 0;
            $classe->nonajours = 0;
            $classe->tatalinscription = 0;
            $classe->totalverserr = 0;
            $classe->cantinemontantclasse =0;
            $classe->nombredinscription = $inscriptions->count(); 
            foreach ($inscriptions as $inscription) {
                // Calcule le total des versements pour cette inscription
                $inscription->total_versement = DB::table('reglements')
                    ->where('id_eleve', $inscription->Matricule)->where('annee', $annee)
                    ->sum('montant');

                // Comparaison et incrémentation
                if ($inscription->total_versement >= $inscription->montantscolariteE) {
                    $classe->ajours++;
                } else {
                    $classe->nonajours++;
                }

                // Calcul des totaux pour la classe
                $classe->tatalinscription += $inscription->montantscolariteE;
                $classe->totalverserr += $inscription->total_versement;
            }

            $classe->inscriptions = $inscriptions;
            $classesWithInscriptions[] = $classe;
        }
        $letotaldesinscription = 0;
        $letotaldesversement = 0;

        foreach ($classesWithInscriptions as $classe) {
            $letotaldesinscription += $classe->tatalinscription;
            $letotaldesversement += $classe->totalverserr;
        }

        $cantinesByClasse = [];

        foreach ($classesWithInscriptions as $classe) {
            $cantines = [];
            $classe->totalcantine = 0; // Initialisation du compteur
            $classe->nombredinscriptionavecantine = 0; // Nouveau compteur

            foreach ($classe->inscriptions as $inscription) {
                // Récupère toutes les cantines pour cette inscription
                $cantineEleve = DB::table('cantines')
                    ->where('Matricule', $inscription->Matricule)
                    ->where('annee', $annee)
                    ->get();

                // Ajoute le nombre de cantines pour cette inscription au total de la classe
                $classe->totalcantine += $cantineEleve->count();
                $montant= DB::table('cantineparame')->where('annee', $annee)->where('idniveau', $inscription->idniveau)->first()->montant;
                $classe->cantinemontantclasse += $montant * $cantineEleve->count();
                // Compte l'inscription si elle a au moins une cantine
                if ($cantineEleve->count() > 0) {
                    $classe->nombredinscriptionavecantine++;
                }

                // On ajoute la liste des cantines pour chaque inscription
                $inscription->cantines = $cantineEleve;
                $cantines[] = $cantineEleve;
            }
            // On ajoute la liste des cantines de la classe
            $classe->cantines = $cantines;
            $cantinesByClasse[] = $classe;
        }
        $cantinetotal=0;
        $montantcantinetotal =0;
        foreach ($cantinesByClasse as $classe) {
            $cantinetotal += $classe->totalcantine;
            $montantcantinetotal += $classe->cantinemontantclasse;
        }
        $total_noel = 0;
        $total_cloture = 0;

        foreach ($classesWithInscriptions as $classe) {
            $total_noel += $classe->noel_total;
            $total_cloture += $classe->cloture_total;
        }

        return view('annuel.index')->with([
            'cantinetotal' => $cantinetotal,
            'cantinetotalmontant' => $montantcantinetotal,
            "classesWithInscriptions" => $classesWithInscriptions,
            "cantinesByClasse" => $cantinesByClasse,
            "letotaldesinscription" => $letotaldesinscription,
            "letotaldesversement" => $letotaldesversement,
            'total_noel' => $total_noel,
            'total_cloture' => $total_cloture,
            "rub" => $rub,
            "srub" => $srub,
            'ape' => $ape,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
        'matriculeE' => 'required|string',
        'moiscant' => 'required|array',
        ]);
        $annee = session('annee'); // ou $request->annee si tu l'envoies depuis le formulaire
        $matricule = $request->matricule;
        $moisEnregistres = [];
        $mesmois =[];
        foreach ($request->moiscant as $mois_id) {
        // Vérifie si cette combinaison existe déjà
           $existe = DB::table('cantines')
                ->where('Matricule', $matricule)
                ->where('mois_id', $mois_id)
                ->where('annee', $annee)
                ->exists();

            if (!$existe) {
                $moisEnregistres[] = $mois_id;
            }
        }

        if (count($moisEnregistres) > 0) {
            foreach ($moisEnregistres as $mois_id) {
               $mois = DB::table('mois')->where('id', $mois_id)->first();
                $mesmois[] = $mois->nom_mois;
            }
            $srub = $request->input('srub');
            $rub = $request->input('rub');
            return redirect()->back()->with(['success' => 'Veillez joindre une piece comptable ','mesmois' => $mesmois,  'rub' =>$rub, 'srub' =>$srub ,'matricule' => $matricule])
                ->withInput();
        } else {
            return back()->with('error', 'Aucun enregistrement effectué. Ces mois existent déjà.');
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


}
