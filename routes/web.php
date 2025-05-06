<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\INSCRIPTION\EleveController;
use App\Http\Controllers\Params\ProfilController;
use App\Http\Controllers\Params\ActionController;
use App\Http\Controllers\Params\MenuController;
use App\Http\Controllers\Params\AnneeController;
use App\Http\Controllers\Params\UserController;
use App\Http\Controllers\Params\CycleController;
use App\Http\Controllers\Params\NiveauController;
use App\Http\Controllers\Params\ClasseController;
use App\Http\Controllers\Params\BanqueController;
use App\Http\Controllers\Params\PchargeController;
use App\Http\Controllers\Reglement\ScolariteController;
use App\Http\Controllers\Reglement\CantineController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});
Route::get('/',[WelcomeController::class,'welcome']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('action',ActionController::class);
Route::get('action/{rub}/{srub}',[ActionController::class,'index']);
Route::get('action/create/{rub}/{srub}',[ActionController::class,'create']);
Route::get('action/{id}/edit/{rub}/{srub}',[ActionController::class,'edit']);


Route::resource('profil',ProfilController::class);
Route::get('profil/{rub}/{srub}',[ProfilController::class,'index']);
Route::get('profil/create/{rub}/{srub}',[ProfilController::class,'create']);
Route::get('profil/{id}/edit/{rub}/{srub}',[ProfilController::class,'edit']);

Route::resource('user',UserController::class);

Route::resource('menu',MenuController::class);
Route::post('menu',[MenuController::class,'store'])->name('menu.store');
Route::get('menu/{rub}/{srub}',[MenuController::class,'index']);
Route::get('menu/create/{rub}/{srub}',[MenuController::class,'create']);
Route::get('menu/{id}/edit/{rub}/{srub}',[MenuController::class,'edit']);


Route::resource('Eleve',EleveController::class);
Route::post('Eleve/store/{rub}/{srub}',[EleveController::class,'store'])->name('Eleve.store');
Route::get('Eleve/{rub}/{srub}',[EleveController::class,'index']);
Route::get('Eleve/create/{rub}/{srub}',[EleveController::class,'create']);
Route::get('Eleve/{id}/edit/{rub}/{srub}',[EleveController::class,'edit']);

Route::resource('annee',AnneeController::class);
Route::post('annee',[AnneeController::class,'store'])->name('annee.store');
Route::get('annee/{rub}/{srub}',[AnneeController::class,'index']);
Route::get('annee/create/{rub}/{srub}',[AnneeController::class,'create']);
Route::get('annee/{id}/edit/{rub}/{srub}',[AnneeController::class,'edit']);

Route::resource('cycle',CycleController::class);
Route::get('cycle/{rub}/{srub}',[CycleController::class,'index']);
Route::get('cycle/create/{rub}/{srub}',[CycleController::class,'create']);
Route::get('cycle/{id}/edit/{rub}/{srub}',[CycleController::class,'edit']);
Route::get('cyclebyId/{rub}/{srub}',[CycleController::class,'cycleniveau']);


Route::resource('niveau',NiveauController::class);
Route::get('niveau/{rub}/{srub}',[NiveauController::class,'index']);
Route::get('niveau/create/{rub}/{srub}',[NiveauController::class,'create']);
Route::get('niveau/{id}/edit/{rub}/{srub}',[NiveauController::class,'edit']);
Route::get('niveaubyid/{rub}/{srub}',[NiveauController::class,'niveauclasse']);

Route::resource('banque',BanqueController::class);
Route::get('banque/{rub}/{srub}',[BanqueController::class,'index']);
Route::get('banque/create/{rub}/{srub}',[BanqueController::class,'create']);
Route::get('banque/{id}/edit/{rub}/{srub}',[BanqueController::class,'edit']);

Route::resource('pcharge',PchargeController::class);
Route::post('pcharge',[PchargeController::class,'store'])->name('pcharge.store');
Route::get('pcharge/{rub}/{srub}',[PchargeController::class,'index']);
Route::get('pcharge/create/{rub}/{srub}',[PchargeController::class,'create']);
Route::get('pcharge/{id}/edit/{rub}/{srub}',[PchargeController::class,'edit']);


Route::resource('classe',ClasseController::class);
Route::post('classe',[ClasseController::class,'store'])->name('classe.store');
Route::get('classe/{rub}/{srub}',[ClasseController::class,'index']);
Route::get('classe/create/{rub}/{srub}',[ClasseController::class,'create']);
Route::get('classe/{id}/edit/{rub}/{srub}',[ClasseController::class,'edit']);

Route::resource('scolarite',ScolariteController::class);
Route::post('scolarite',[ScolariteController::class,'store'])->name('scolarite.store');
Route::get('scolarite/{rub}/{srub}',[ScolariteController::class,'index']);
Route::get('scolarite/create/{rub}/{srub}',[ScolariteController::class,'create']);
Route::get('scolarite/{id}/edit/{rub}/{srub}',[ScolariteController::class,'edit']);

Route::resource('cantine',ClasseController::class);
Route::post('cantine',[CantineController::class,'store'])->name('cantine.store');
Route::get('cantine/{rub}/{srub}',[CantineController::class,'index']);
Route::get('cantine/create/{rub}/{srub}',[CantineController::class,'create']);
Route::get('cantine/{id}/edit/{rub}/{srub}',[CantineController::class,'edit']);


Route::resource('user',UserController::class);
Route::get('user/{rub}/{srub}',[UserController::class,'index']);
Route::get('user/create/{rub}/{srub}',[UserController::class,'create']);
Route::get('user/{id}/edit/{rub}/{srub}',[UserController::class,'edit']);
Route::post('changerEtatCompte/{id}', [UserController::class,'changerEtatCompte']);
Route::get('comptenonactif/{rub}/{srub}', [UserController::class,'compteNonValide']);
Route::get('comptenonactif', [UserController::class,'comptenonactif'])->name('comptenonactif');
require __DIR__.'/auth.php';

Route::post('/set-annee-session', function (Request $request) {
    $annee = $request->input('annee'); // Correct !
    session(['annee' => $request->annee]);
    return response()->json(['message' => 'Année enregistrée', 'annee' => session('annee')]);
});
Route::get('/matricule/{niveau_id}', [EleveController::class, 'matricule']);
Route::get('/max/{id}', [ClasseController::class, 'getClasse']);



Route::get('/niveaux-par-cycle/{id}', [EleveController::class, 'niveauxParCycle']);
Route::get('/classes-par-niveau/{id}', [EleveController::class, 'classesParNiveau']);
