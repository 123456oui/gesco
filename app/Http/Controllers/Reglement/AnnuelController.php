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
        $classe= DB::table('classes')->where('annee', $annee)->first();
        if (!$classe) {
            $message = "<div style='font-size:18px; color:#d35400; font-weight:bold; margin-bottom:10px;'>⚠️ Aucune classe trouvée pour l\'année scolaire sélectionnée.</div>";
            return redirect()->back()->with('mil', $message);
        }
        $classes=Classe::orderby('created_at','desc')->get();
        $mois= DB::table('mois')->get();
        $inscriptions = DB::table('inscriptions')->where('idanneescolaire', $annee)->get();
        return view('annuel.index')->with(["classes"=>$classes,"inscriptions"=>$inscriptions,"mois"=>$mois,"rub"=>$rub,"srub"=>$srub]);
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


}
