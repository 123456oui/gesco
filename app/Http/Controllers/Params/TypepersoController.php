<?php

namespace App\Http\Controllers\Params;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Typepersonnel;

class TypepersoController extends Controller
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
        //dd(session('menus'));
        $typepersonnels=Typepersonnel::orderby('created_at','desc')->get();
        return view('paramtypeperso.index')->with(['typepersonnels'=>$typepersonnels,'controler'=>$this,"rub"=>$rub,"srub"=>$srub]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create($rub, $srub)
    {
                return view('paramtypeperso.create')->with(["rub"=>$rub,"srub"=>$srub]);
     
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $typpersonnel = new Typepersonnel();
       $typpersonnel->libellepers=$request->input('libelletyperso');
       $typpersonnel->save();
     return redirect('typeperso/'.$request->input('rub').'/'.$request->input('srub'))->with(['success'=>$this->operation]);
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
