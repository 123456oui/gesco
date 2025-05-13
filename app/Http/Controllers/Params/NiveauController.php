<?php

namespace App\Http\Controllers\Params;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Params\NiveauformRequest;
use App\Models\Niveau;
use App\Models\Cycle;
use App\Models\Classe;
class NiveauController extends Controller
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
        $niveaus=Niveau::orderby('created_at','desc')->Where('annee','=' ,session('annee'))->get();
        return view('niveau.index')->with(['niveaus'=>$niveaus,'controler'=>$this,"rub"=>$rub,"srub"=>$srub]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($rub, $srub)
    {
        //
        $cycles = Cycle::orderby('created_at','desc')->get();
        return view('niveau.create')->with(["cycles"=>$cycles,"rub"=>$rub,"srub"=>$srub]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $this->validate($request,[
            'niveau'=>['required','min:2'],
            'Montantscolarite'=>['required','numeric'],
        ]);
        //$valeurtest=Niveau::find($request->input('Annee'),$request->input('niveau'));
        $valeurtest=Niveau::where('annee', '=',session('annee'))->where('libelleniveau','=',$request->input('niveau'))->get();
        if($valeurtest->isNotEmpty())
        {
         //dd( $valeurtest);
         return redirect('niveau/'.$request->input('rub').'/'.$request->input('srub'))->with(['success'=>$this->donneeexiste]);
        }else{
        // dd( $valeurtest);
        $niveau = new Niveau();
        $niveau->annee=session('annee');
        $niveau->libelleniveau=$request->input('niveau');
        $niveau->Montantscolarite=$request->input('Montantscolarite');
        $niveau->idcycle=$request->input('cycle');
        $niveau->save(); 
        
        return redirect('niveau/'.$request->input('rub').'/'.$request->input('srub'))->with(['success'=>$this->operation]);
        }  


        //
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
        $niveau=Niveau::find($id);
        $cycles = Cycle::orderby('created_at','desc')->get();
        return view('niveau.edit')->with(['cycles'=>$cycles,'niveau'=>$niveau,"rub"=>$rub,"srub"=>$srub]);
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
    public function destroy( $id)
    {
        //
        $niveau=Niveau::find($id);
        $niveau->delete();
        return back();
    }

public function niveauclasse(Request $request, $rub,$srub){
    $niveauId=$request->get( 'niveauId') ;

      
       if ($niveauId) {
         $niveau = Niveau::find($niveauId);
        $scolarite=$niveau->Montantscolarite; 
       
        
        $classes=Classe::where('idniveau', $niveauId)->get();
        return response()->json(["success"  =>true,"classes"=>$classes  ,"scolarite"=>$scolarite]);
    }

}
   
}
