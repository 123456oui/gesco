<?php

namespace App\Http\Controllers\Params;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Retenuepers;
class RetenueController extends Controller
{
    private $msgerror='Impossible de supprimer cet élément car il est utilisé!';
    private $operation='Opération effectuée avec succès';
    private $donneeexiste='Donneés déjà existant';
    /**
    /**
     * Display a listing of the resource.
     */
    public function index($rub = null, $srub=null)
    {
        $retenuepers=Retenuepers::orderby('created_at','desc')->get();
        return view('paramretenue.index')->with(['retenuepers'=>$retenuepers,'controler'=>$this,"rub"=>$rub,"srub"=>$srub]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($rub, $srub)
    {
               return view('paramretenue.create')->with(["rub"=>$rub,"srub"=>$srub]);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $retenuepers = new Retenuepers();
       $retenuepers->libellepers=$request->input('retenue');
        $retenuepers->montant=$request->input('Montantretenue');
       $retenuepers->save();
     return redirect('paramretenue/'.$request->input('rub').'/'.$request->input('srub'))->with(['success'=>$this->operation]);
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
         $retenuepers=Retenuepers::find($id);
        return view('paramretenue.edit')->with(['retenuepers'=>$retenuepers,"rub"=>$rub,"srub"=>$srub]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $retenuepers = retenuepers::find($id);
        $retenuepers->libellepers=$request->input('retenue');
        $retenuepers->montant=$request->input('Montantretenue');
        $retenuepers->save();

        return redirect('paramretenue/'.$request->input('rub').'/'.$request->input('srub'))->with(['success'=>$this->operation]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $retenuepers=Retenuepers::find($id);
        $retenuepers->delete();
        return back();
    }
}
