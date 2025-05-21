<?php

namespace App\Http\Controllers\BVERSEMENT;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banque;
use App\Models\Reglement;

class VbanqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($rub = null, $srub=null)
    {
    $banques=Banque::orderby('created_at','desc')->get();
        return view('bversement.index')->with(['banques'=>$banques,'controler'=>$this,"rub"=>$rub,"srub"=>$srub]);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function bverserment(Request $request,$rub = null, $srub = null)
    {
        $debut=$request->input('datedebut');
        $fin=$request->input('datefin');
        $bversement= Reglement::where('id_banque',$request->input('banque'))->where('annee',session('annee'))->whereBetween('created_at', [$debut, $fin])->get();
        //dd($bversement);
     
        return view('bversement.bilan', ['bversement' => $bversement,
                    'rub' => $rub,
                    'srub' => $srub,]);

    }
    public function show(Request $request)
    {
        
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
