<?php

namespace App\Http\Controllers\Reglement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classe;
use Illuminate\Support\Facades\DB;
use NumberToWords\NumberToWords;


class ImpayeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($rub, $srub)
{
        $annee = session('annee');
        $classes = DB::table('classes')->where('annee', $annee)->get();
        $niveaux = DB::table('niveaux')->where('annee', $annee)->get();
        return view('impaye.index', compact('rub', 'srub', 'classes', 'niveaux'));
    }


    public function rechercher(Request $request)
{
    $request->validate([
        'classe_id' => 'required|exists:classes,id',
    ]);

    $annee = session('annee');
    $classe_id = $request->input('classe_id');
    $rub = $request->input('rub');
    $srub = $request->input('srub');
    $classe= Classe::findOrFail($classe_id);

    // Récupération des élèves inscrits à cette classe pour l’année en cours
    $eleves = DB::table('inscriptions')
        ->join('eleves', 'eleves.Matricule', '=', 'inscriptions.Matricule')
        ->where('inscriptions.idclasse', $classe_id)
        ->where('inscriptions.idanneescolaire', $annee)
        ->select('eleves.*', 'inscriptions.idclasse')
        ->get();

    // Filtrage des élèves impayés
    $eleves_impayes = $eleves->filter(function ($eleve) use ($annee) {
        $reglements = DB::table('reglements')
            ->where('id_eleve', $eleve->Matricule)
            ->where('annee', $annee)
            ->sum('montant');

        $montant_total = DB::table('inscriptions')
            ->where('Matricule', $eleve->Matricule)
            ->where('idanneescolaire', $annee)
            ->value('montantscolariteE');

        return $reglements < $montant_total;
    });

    return view('impaye.recu', [
        'eleves' => $eleves_impayes,
        'classe' => $classe,
        'annee' => $annee,
        'rub' => $rub,
        'srub' => $srub,
    ]);
}



public function imprimer(Request $request)
{
    $classe = $request->input('classe');
    $annee = $request->input('annee');
    $rub = $request->input('rub');
    $srub = $request->input('srub');
    $eleves = json_decode($request->input('eleves_json'));

    // Tu peux aussi retrouver le nom de la classe pour affichage

    return view('impaye.imprimer', [
        'eleves' => $eleves,
        'classe' => $classe,
        'annee' => $annee,
        'rub' => $rub,
        'srub' => $srub,
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
