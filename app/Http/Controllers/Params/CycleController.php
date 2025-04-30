<?php

namespace App\Http\Controllers\Params;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests\Params\CycleRequest;
use App\Models\Cycle;
use App\Models\Niveau;
class CycleController extends Controller
{
    private $msgerror='Impossible de supprimer cet élément car il est utilisé!';
    private $operation='Opération effectuée avec succès';
       /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth');
        
    }
    /**
     * Display a listing of the resource.
     */
    public function index($rub = null, $srub=null)
    {
        //
        //dd(session('menus'));
        $cycles=Cycle::orderby('created_at','desc')->get();
        return view('cycle.index')->with(['cycles'=>$cycles,'controler'=>$this,"rub"=>$rub,"srub"=>$srub]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($rub, $srub)
    {
        //
        return view('cycle.create')->with(["rub"=>$rub,"srub"=>$srub]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CycleRequest  $request)
    {
        
       $request->validated();

       $cycle = new Cycle();
       $cycle->libellecycle=$request->input('libellecycle');
       $cycle->save();
     return redirect('cycle/'.$request->input('rub').'/'.$request->input('srub'))->with(['success'=>$this->operation]);

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
        //
        $cycle=Cycle::find($id);
        return view('cycle.edit')->with(['cycle'=>$cycle,"rub"=>$rub,"srub"=>$srub]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( Request $request, $id)

    {
        //CycleRequest $request,
       //dd($id);
        //$request->validated();
        $cycle = Cycle::find($id);
        $cycle->libellecycle=$request->input('cycle');
        $cycle->save();

        return redirect('cycle/'.$request->input('rub').'/'.$request->input('srub'))->with(['success'=>$this->operation]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

       
        $cycle=Cycle::find($id);
        $cycle->delete();
        return back();
        //
    }

    public function cycleniveau(Request $request,$rub, $srub)
    {
      $cycleId=$request->get( 'cycleId');
      
       if ($cycleId) {
        $niveaux=Niveau::where('idcycle', $cycleId)->get();
        return response()->json(["success"  =>true,"niveaux"=>$niveaux ]);
    }

}
}