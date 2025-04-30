<?php

namespace App\Http\Controllers\Params;

use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\Niveau;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClasseController extends Controller
{
    private $msgerror='Impossible de supprimer cet élément car il est utilisé!';
    private $operation='Opération effectuée avec succès';
    private $donneeexiste='Donneés déjà existant';
    /**
     * Display a listing of the resource.
     */
    public function index($rub = null, $srub=null)
    {
        //
        $classesp=Classe::orderby('created_at','desc')->get();
        return view('classe.index')->with(['classesp'=>$classesp,'controler'=>$this,"rub"=>$rub,"srub"=>$srub]);
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($rub, $srub)
    {
        $niveaux = NIVEAU::orderby('created_at','desc')->get();
        return view('classe.create')->with(["niveaux"=>$niveaux,"rub"=>$rub,"srub"=>$srub]);
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
               'Annee'=>['required','min:4'], 
               'classe'=>['required','min:2'], 
        ]);
        //$valeurtest=Niveau::find($request->input('Annee'),$request->input('niveau'));
        $valeurtest=Classe::where('Annee', '=',$request->input('Annee'))->where('libelleclasse','=',$request->input('classe'))->get();
        if($valeurtest->isNotEmpty())
        {
         //dd( $valeurtest);
         return redirect('classe/'.$request->input('rub').'/'.$request->input('srub'))->with(['success'=>$this->donneeexiste]);
        }else{

        $classe  = new Classe();
        $classe->annee=$request->input('Annee');
        $classe->libelleclasse=$request->input('classe');
        $classe->idniveau=$request->input('niveau');
        $classe->save(); 
        
        return redirect('classe/'.$request->input('rub').'/'.$request->input('srub'))->with(['success'=>$this->operation]);
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
    public function edit($id,$rub = null, $srub=null)
    {
        $classe=Classe::find($id);
        $niveaux = Niveau::orderby('created_at','desc')->get();
        return view('classe.edit')->with(['niveaux'=>$niveaux,'classe'=>$classe,"rub"=>$rub,"srub"=>$srub]);
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
    public function destroy($id)
    {
        $classe=Classe::find($id);
        $classe->delete();
        return back();
    }

    public function getClasse($id)
{
    $classe = Classe::find($id);
    $annee=session('annee');
    $niveau_id=$classe->id;
    $max=$classe->max;
    $totalInscriptions = DB::table('inscriptions')
        ->where('idanneescolaire', $annee)
        ->where('idclasse', $classe->id)
        ->count();
    $rest=$max-$totalInscriptions;
    return response()->json([
        'classe' => $rest,
        
    ]);
}
}
