<?php

namespace App\Http\Controllers\Params;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banque;
class BanqueController extends Controller
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
        $banques=Banque::orderby('created_at','desc')->get();
        return view('banque.index')->with(['banques'=>$banques,'controler'=>$this,"rub"=>$rub,"srub"=>$srub]);
    }

    /**
     * Show the form for creating a new resource.
     */public function create($rub, $srub)
    {
        return view('banque.create')->with(["rub"=>$rub,"srub"=>$srub]);
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
   
       $banque = new Banque();
       $banque->libellebanque=$request->input('banque');
       $banque->save();
     return redirect('banque/'.$request->input('rub').'/'.$request->input('srub'))->with(['success'=>$this->operation]);
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
        //
        $banque=Banque::find($id);
        return view('banque.edit')->with(['banque'=>$banque,"rub"=>$rub,"srub"=>$srub]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $banque = Banque::find($id);
        $banque->libellebanque=$request->input('banque');
        $banque->save();

        return redirect('banque/'.$request->input('rub').'/'.$request->input('srub'))->with(['success'=>$this->operation]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $banque=Banque::find($id);
        $banque->delete();
        return back();
    }
}
