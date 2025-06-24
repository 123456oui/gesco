<?php

namespace App\Http\Controllers\Params;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Avoirpers;
class AvoirController extends Controller
{

    private $msgerror='Impossible de supprimer cet élément car il est utilisé!';
    private $operation='Opération effectuée avec succès';
    private $donneeexiste='Donneés déjà existant';
    /**
     * Display a listing of the resource.
     */
    public function index($rub = null, $srub=null)
    {
        $avoirs=Avoirpers::orderby('created_at','desc')->get();
        return view('paramavoir.index')->with(['avoirs'=>$avoirs,'controler'=>$this,"rub"=>$rub,"srub"=>$srub]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($rub, $srub)
    {
               return view('paramavoir.create')->with(["rub"=>$rub,"srub"=>$srub]);

        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $avoirpers = new Avoirpers();
       $avoirpers->libellepers=$request->input('avoir');
        $avoirpers->montant=$request->input('Montantavoir');
       $avoirpers->save();
     return redirect('paramavoir/'.$request->input('rub').'/'.$request->input('srub'))->with(['success'=>$this->operation]);
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
        $avoir=Avoirpers::find($id);
        return view('paramavoir.edit')->with(['avoir'=>$avoir,"rub"=>$rub,"srub"=>$srub]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $avoir = Avoirpers::find($id);
        $avoir->libellepers=$request->input('avoir');
        $avoir->montant=$request->input('Montantavoir');
        $avoir->save();

        return redirect('paramavoir/'.$request->input('rub').'/'.$request->input('srub'))->with(['success'=>$this->operation]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $avoirpers=Avoirpers::find($id);
        $avoirpers->delete();
        return back();
    }
}
