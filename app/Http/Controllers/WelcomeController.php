<?php

namespace App\Http\Controllers;

use App\Models\TypeBourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function welcome(){

        $rub = 2;
        $srub = 3;
        return view('auth.login')->with(["rub"=>$rub,"srub"=>$srub]);
    }
}
