<?php

namespace App\Http\Controllers\Params;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pcharge;

class PchargeController extends Controller
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
        $pcharges=Pcharge::orderby('created_at','desc')->get();
        return view('pcharge.index')->with(['pcharges'=>$pcharges,'controler'=>$this,"rub"=>$rub,"srub"=>$srub]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($rub, $srub)
    {
        //
        
        return view('pcharge.create')->with(["rub"=>$rub,"srub"=>$srub]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pcharge = new Pcharge();
        $pcharge->libellepcharge=$request->input('structure');
        $pcharge->pmontant=$request->input('pmontant');
        $pcharge->save();
      return redirect('pcharge/'.$request->input('rub').'/'.$request->input('srub'))->with(['success'=>$this->operation]);
        
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
    public function edit( $id, $rub = null, $srub=null)
    {
         $pcharge=Pcharge::find($id);
        return view('pcharge.edit')->with(['pcharge'=>$pcharge,"rub"=>$rub,"srub"=>$srub]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pcharge = Pcharge::find($id);
        $pcharge->libellepcharge=$request->input('structure');
        $pcharge->pmontant=$request->input('pmontant');
        $pcharge->save();
        return redirect('pcharge/'.$request->input('rub').'/'.$request->input('srub'))->with(['success'=>$this->operation]);
  
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
