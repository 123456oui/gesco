<?php

namespace App\Http\Controllers\Reglement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classe;
use App\Models\Reglement;
use App\Models\Eleve;
use Illuminate\Support\Facades\DB;
use NumberToWords\NumberToWords;


class IntendanceController  extends Controller
{
    /**
     * Display a listing of the resource.
     */
      public function afficher(  $nombre)
    {
        $numberToWords = new NumberToWords();
        $transformer = $numberToWords->getNumberTransformer('fr');
        $lettres = $transformer->toWords($nombre);

        return $lettres;
    }
    public function index($rub, $srub)
    {
    $annee = session('annee');

    $cycles = DB::table('cycles')->get();
    $niveaux = DB::table('niveaux')->get();
    $classes = DB::table('classes')->get();
    $inscriptions = DB::table('inscriptions')->where('idanneescolaire', $annee)->get();
    $banques = DB::table('banques')->get(); // ou nom exact de la table des banques
    return view('intendance.index', compact('rub', 'srub','cycles', 'niveaux', 'classes', 'inscriptions', 'banques'));
    }
   
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
        $reglements = Reglement::where('id_eleve', $request->input('matricule'))
            ->where('annee', $annee)
            ->get();

        // 4. Somme des montants réglés
        $total_regle = $reglements->sum('montant')+ $request->input('versement');
        $totalInscriptions = DB::table('inscriptions')
        ->where('idanneescolaire', $annee)
        ->where('Matricule', $request->input('matricule'))->first();
        
        if($request->input('cumul')< $totalInscriptions->montantscolariteE){
            if($totalInscriptions->montantscolariteE- $total_regle >0 ){
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
                    //$reglement ->save();
                    //
                    return redirect()->route('intendance.recu', ['id' => $reglement->id,
                    'rub' => $rub,
                    'srub' => $srub,]);
                    //return redirect()->back()->with('success', 'Payement valider avec succes');
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
    public function recu(Request $request,$id)
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
    $lettres=$this->afficher($reglement->montant);
    $rest=$inscription->montantscolariteE - $montantTotalAutres;
    return view('intendance.recu', compact('reglement', 'rub', 'srub','classe','autresReglements','montantTotalAutres','rest','lettres' ));
}

}
