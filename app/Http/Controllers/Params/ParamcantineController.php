<?php

namespace App\Http\Controllers\Params;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cantineanne;

class ParamcantineController extends Controller
{
    private $msgerror='Impossible de supprimer cet élément car il est utilisé!';
    private $operation='Opération effectuée avec succès';
    
    
    /**
     * Display a listing of the resource.
     */

     public function index($rub = null, $srub=null)
    {
        //
        //dd(session('menus'));
        $cantineannes=Cantineanne::orderby('created_at','desc')->Where('Annee','=' ,session('annee'))->get();
        return view('paramcantine.index')->with(['cantineannes'=>$cantineannes,'controler'=>$this,"rub"=>$rub,"srub"=>$srub]);
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
   
    public function edit($id,$rub = null, $srub=null)
    {
          $cantineannes=Cantineanne::find($id);
        return view('paramcantine.edit')->with(['cantineannes'=>$cantineannes,'controler'=>$this,"rub"=>$rub,"srub"=>$srub]);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $cantineanne=Cantineanne::find($id);

        $cantineanne->montant_mois=$request->input('Montant');
        $cantineanne->save();

        return redirect('paramcantine/'.$request->input('rub').'/'.$request->input('srub'))->with(['success'=>$this->operation]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
