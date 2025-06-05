<?php

namespace App\Http\Controllers\Reglement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classe;
use Illuminate\Support\Facades\DB;
use NumberToWords\NumberToWords;


class CantineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($rub, $srub)
    {
        $annee = session('annee');
        $classes=Classe::orderby('created_at','desc') ->where('annee', $annee)->get();
        $mois= DB::table('mois')->get();
        $inscriptions = DB::table('inscriptions')->where('idanneescolaire', $annee)->get();
        return view('Cantine.create')->with(["classes"=>$classes,"inscriptions"=>$inscriptions,"mois"=>$mois,"rub"=>$rub,"srub"=>$srub]);
        //
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
    public function recu($matricule , $rub, $srub,Request $request)
{
    $moisNoms = json_decode($request->query('mois'), true);

    // Récupérer les IDs des mois à partir des noms
    $moisIds = DB::table('mois')
        ->whereIn('nom_mois', $moisNoms)
        ->pluck('id');

    $annee = session('annee'); // ou une autre logique

    // Vérifier si l'élève existe
    $inscription = DB::table('inscriptions')
    ->join('eleves', 'eleves.Matricule', '=', 'inscriptions.Matricule')
    ->join('classes', 'classes.id', '=', 'inscriptions.idclasse')
    ->join('niveaux', 'niveaux.id', '=', 'inscriptions.idniveau')
    ->join('cycles', 'cycles.id', '=', 'inscriptions.idcycle')
    ->where('inscriptions.Matricule', $matricule)
    ->where('inscriptions.idanneescolaire', $annee)
    ->select(
        'inscriptions.*',
        'eleves.*',
        'classes.*',
        'niveaux.*',
        'cycles.*'
    )
    ->first();
    // Parcourir chaque mois et insérer une cantine si elle n'existe pas déjà
    foreach ($moisIds as $moisId) {
        $existe = DB::table('cantines')
            ->where('Matricule', $matricule)
            ->where('mois_id', $moisId)
            ->where('annee', $annee)
            ->exists();

        if (!$existe) {
            DB::table('cantines')->insert([
                'Matricule' => $matricule,
                'mois_id' => $moisId,
                'annee' => $annee, // ou une valeur réelle si disponible
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
    $cantinesome= DB::table('cantineannes')->where('annee', $annee)->first();
    $montant= $cantinesome->montant_mois;
    $total = $montant * count($moisIds);
    $lettres=$this->afficher( $total);
    // Maintenant on récupère les cantines pour affichage
    $cantines = DB::table('cantines')
        ->where('Matricule', $matricule)
        ->whereIn('mois_id', $moisIds)
        ->where('annee', $annee)
        ->get();
    $autresCantines = DB::table('cantines')
    ->join('mois', 'cantines.mois_id', '=', 'mois.id')
    ->where('cantines.Matricule', $matricule)
    ->whereNotIn('cantines.mois_id', $moisIds)
    ->where('cantines.annee', $annee)
    ->select('cantines.*', 'mois.nom_mois') // On sélectionne toutes les colonnes de cantines + nom du mois
    ->get();
    return view('Cantine.recu', compact('cantines','autresCantines' ,'annee','total', 'moisNoms', 'rub', 'srub', 'inscription','lettres'));
}

  public function afficher(  $nombre)
    {
        $numberToWords = new NumberToWords();
        $transformer = $numberToWords->getNumberTransformer('fr');
        $lettres = $transformer->toWords($nombre);

        return $lettres;
    }

}
