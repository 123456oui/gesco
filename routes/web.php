<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\INSCRIPTION\EleveController;
use App\Http\Controllers\INSCRIPTION\EController;
use App\Http\Controllers\Params\ProfilController;
use App\Http\Controllers\Params\ActionController;
use App\Http\Controllers\Params\MenuController;
use App\Http\Controllers\Params\PersonnelController;
use App\Http\Controllers\Params\AnneeController;
use App\Http\Controllers\Reglement\ImpayeController;
use App\Http\Controllers\Params\UserController;
use App\Http\Controllers\Params\CycleController;
use App\Http\Controllers\Params\NiveauController;
use App\Http\Controllers\Params\ClasseController;
use App\Http\Controllers\Params\BanqueController;
use App\Http\Controllers\Params\PchargeController;
use App\Http\Controllers\Params\ParamcantineController;
use App\Http\Controllers\Params\AvoirController;
use App\Http\Controllers\Params\GenrepersoController;
use App\Http\Controllers\Params\RetenueController;
use App\Http\Controllers\Params\TypepersoController;
use App\Http\Controllers\Reglement\ScolariteController;
use App\Http\Controllers\Reglement\ApeController;
use App\Http\Controllers\Reglement\LnoelController;
use App\Http\Controllers\Reglement\LclotureController;
use App\Http\Controllers\Reglement\CantanneController;
use App\Http\Controllers\Reglement\IntendanceController;
use App\Http\Controllers\Reglement\StateControler;
use App\Http\Controllers\Reglement\CantineController;
use App\Http\Controllers\Reglement\AnnuelController;
use App\Http\Controllers\Reglement\EleveclasseController;
use App\Http\Controllers\BVERSEMENT\VbanqueController;
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
    if (session()->has('annee')) {
       $annee=session('annee');
        $eleves=DB::table('eleves')->get()->count();
        $inscription=DB::table('inscriptions')->where('idanneescolaire',$annee)->get()->count();
        $classes=DB::table('classes')->where('annee',$annee)->get()->count();
        $profils=DB::table('profils')->get()->count();
        $Utilisateurs= DB::table('users')->get()->count();
        return view('dashboard')->with([
            'eleves' => $eleves,
            'inscription' => $inscription,
            'classes' => $classes,
            'profils' => $profils,
            'Utilisateurs' => $Utilisateurs
        ]);
    }
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

Route::resource('ape',ApeController::class);
Route::post('ape',[ApeController::class,'store'])->name('ape.store');
Route::get('ape/{rub}/{srub}',[ApeController::class,'index']);
Route::post('/ape/imprimer', [ApeController::class, 'imprimer'])->name('ape.imprimer');
Route::get('ape/create/{rub}/{srub}',[ApeController::class,'create']);
Route::get('ape/edit/{rub}/{srub}', [ApeController::class, 'edit'])->name('ape.edit');

Route::resource('lnoel',LnoelController::class);
Route::post('lnoel',[LnoelController::class,'store'])->name('lnoel.store');
Route::get('lnoel/{rub}/{srub}',[LnoelController::class,'index']);
Route::post('/lnoel/imprimer', [LnoelController::class, 'imprimer'])->name('lnoel.imprimer');
Route::get('lnoel/create/{rub}/{srub}',[LnoelController::class,'create']);
Route::get('lnoel/edit/{rub}/{srub}', [LnoelController::class, 'edit'])->name('lnoel.edit');

Route::resource('lcloture',LclotureController::class);
Route::post('lcloture',[LclotureController::class,'store'])->name('lcloture.store');
Route::get('lcloture/{rub}/{srub}',[LclotureController::class,'index']);
Route::post('/lcloture/imprimer', [LclotureController::class, 'imprimer'])->name('lcloture.imprimer');
Route::get('lcloture/create/{rub}/{srub}',[LclotureController::class,'create']);
Route::get('lcloture/edit/{rub}/{srub}', [LclotureController::class, 'edit'])->name('lcloture.edit');

Route::resource('cantanne',CantanneController::class);
Route::post('cantanne',[CantanneController::class,'store'])->name('cantanne.store');
Route::get('cantanne/{rub}/{srub}',[CantanneController::class,'index']);
Route::post('/cantanne/imprimer', [CantanneController::class, 'imprimer'])->name('cantanne.imprimer');
Route::get('cantanne/create/{rub}/{srub}',[CantanneController::class,'create']);
Route::get('cantanne/edit/{rub}/{srub}', [CantanneController::class, 'edit'])->name('cantanne.edit');



Route::resource('personnel',PersonnelController::class);
Route::post('personnel',[PersonnelController::class,'store'])->name('personnel.store');
Route::get('personnel/{rub}/{srub}',[PersonnelController::class,'index']);
Route::get('personnel/create/{rub}/{srub}',[PersonnelController::class,'create']);
Route::get('personnel/{id}/edit/{rub}/{srub}',[PersonnelController::class,'edit']);

Route::resource('Eleve',EleveController::class);
Route::post('Eleve/store/{rub}/{srub}',[EleveController::class,'store'])->name('Eleve.store');
Route::get('Eleve/{rub}/{srub}',[EleveController::class,'index']);
Route::get('Eleve/create/{rub}/{srub}',[EleveController::class,'create']);
Route::get('Eleve/{id}/edit/{rub}/{srub}',[EleveController::class,'edit']);

Route::resource('resinscipte',EController::class);
Route::post('resinscipte/store/{rub}/{srub}',[EController::class,'store'])->name('resinscipte.store');
Route::get('resinscipte/{rub}/{srub}',[EController::class,'index']);
Route::get('resinscipte/create/{rub}/{srub}',[EController::class,'create']);
Route::get('resinscipte/{id}/edit/{rub}/{srub}',[EController::class,'edit']);

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
Route::get('cyclebyId/',[CycleController::class,'cycleniveauzango']);


Route::resource('niveau',NiveauController::class);
Route::get('niveau/{rub}/{srub}',[NiveauController::class,'index']);
Route::get('niveau/create/{rub}/{srub}',[NiveauController::class,'create']);
Route::get('niveau/{id}/edit/{rub}/{srub}',[NiveauController::class,'edit']);
Route::get('niveaubyid/{rub}/{srub}',[NiveauController::class,'niveauclasse']);
Route::get('niveaubyid/',[NiveauController::class,'niveauclassezango']);



Route::resource('paramcantine',ParamcantineController::class);
Route::post('paramcantine',[ParamcantineController::class,'store'])->name('paramcantine.store');
Route::get('paramcantine/{rub}/{srub}',[ParamcantineController::class,'index']);
Route::get('paramcantine/create/{rub}/{srub}',[ParamcantineController::class,'create']);
Route::get('paramcantine/{id}/edit/{rub}/{srub}',[ParamcantineController::class,'edit']);


Route::resource('paramavoir',AvoirController::class);
Route::post('paramavoir',[AvoirController::class,'store'])->name('paramavoir.store');
Route::get('paramavoir/{rub}/{srub}',[AvoirController::class,'index']);
Route::get('paramavoir/create/{rub}/{srub}',[AvoirController::class,'create']);
Route::get('paramavoir/{id}/edit/{rub}/{srub}',[AvoirController::class,'edit']);

Route::resource('genreperso',GenrepersoController::class);
Route::post('genreperso',[GenrepersoController::class,'store'])->name('genreperso.store');
Route::get('genreperso/{rub}/{srub}',[GenrepersoController::class,'index']);
Route::get('genreperso/create/{rub}/{srub}',[GenrepersoController::class,'create']);
Route::get('genreperso/{id}/edit/{rub}/{srub}',[GenrepersoController::class,'edit']);

Route::resource('paramretenue',RetenueController::class);
Route::post('paramretenue',[RetenueController::class,'store'])->name('paramretenue.store');
Route::get('paramretenue/{rub}/{srub}',[RetenueController::class,'index']);
Route::get('paramretenue/create/{rub}/{srub}',[RetenueController::class,'create']);
Route::get('paramretenue/{id}/edit/{rub}/{srub}',[RetenueController::class,'edit']);

Route::resource('typeperso',TypepersoController::class);
Route::post('typeperso',[TypepersoController::class,'store'])->name('typeperso.store');
Route::get('typeperso/{rub}/{srub}',[TypepersoController::class,'index']);
Route::get('typeperso/create/{rub}/{srub}',[TypepersoController::class,'create']);
Route::get('typeperso/{id}/edit/{rub}/{srub}',[TypepersoController::class,'edit']);


Route::resource('banque',BanqueController::class);
Route::get('banque/{rub}/{srub}',[BanqueController::class,'index']);
Route::get('banque/create/{rub}/{srub}',[BanqueController::class,'create']);
Route::get('banque/{id}/edit/{rub}/{srub}',[BanqueController::class,'edit']);

Route::resource('annuel',AnnuelController::class);
Route::get('annuel/{rub}/{srub}',[AnnuelController::class,'index']);


Route::resource('impaye',ImpayeController::class);
Route::get('impaye/{rub}/{srub}',[ImpayeController::class,'index']);
Route::post('/impaye/rechercher', [ImpayeController::class, 'rechercher'])->name('impaye.rechercher');
Route::post('/impayes/imprimer', [ImpayeController::class, 'imprimer'])->name('impayes.imprimer');



Route::resource('bversement',VbanqueController::class);
Route::get('bversement/{rub}/{srub}',[VbanqueController::class,'index']);
Route::get('bversement/create/{rub}/{srub}',[VbanqueController::class,'create']);
Route::get('bversement/{id}/edit/{rub}/{srub}',[VbanqueController::class,'edit']);
Route::get('/bversement/{rub}/{srub}/bilan', [VbanqueController::class, 'bverserment'])->name('bversement.bilan');


Route::resource('pcharge',PchargeController::class);
Route::post('pcharge',[PchargeController::class,'store'])->name('pcharge.store');
Route::get('pcharge/{rub}/{srub}',[PchargeController::class,'index']);
Route::get('pcharge/create/{rub}/{srub}',[PchargeController::class,'create']);
Route::get('pcharge/{id}/edit/{rub}/{srub}',[PchargeController::class,'edit']);

Route::resource('state',StateControler::class);
Route::post('state',[StateControler::class,'store'])->name('state.store');
Route::get('state/{rub}/{srub}',[StateControler::class,'index']);
Route::get('state/create/{rub}/{srub}',[StateControler::class,'create']);
Route::get('state/{id}/edit/{rub}/{srub}',[StateControler::class,'edit']);
Route::post('/state/impression/analyse', [StateControler::class, 'analyseImpression'])->name('state.impression.analyse');

Route::resource('eleveclasse',EleveclasseController::class);
Route::get('eleveclasse/{rub}/{srub}',[EleveclasseController::class,'index']);
Route::get('eleveclasse/create/{rub}/{srub}',[EleveclasseController::class,'create']);
Route::get('eleveclasse/{id}/edit/{rub}/{srub}',[EleveclasseController::class,'edit']);
Route::get('/eleveclasse/{rub}/{srub}/edition', [EleveclasseController::class, 'editclasse'])->name('editclasse.editclasse');







Route::resource('classe',ClasseController::class);
Route::post('classe',[ClasseController::class,'store'])->name('classe.store');
Route::get('classe/{rub}/{srub}',[ClasseController::class,'index']);
Route::get('classe/create/{rub}/{srub}',[ClasseController::class,'create']);
Route::get('classe/{id}/edit/{rub}/{srub}',[ClasseController::class,'edit']);

Route::resource('Scolarite',ScolariteController::class);
Route::post('Scolarite',[ScolariteController::class,'store'])->name('scolarite.store');
Route::post('Noel',[ScolariteController::class,'noelstore'])->name('scolarite.storenoel');
Route::post('Cloture',[ScolariteController::class,'cloturestore'])->name('scolarite.storecloture');
Route::get('Scolarite/{rub}/{srub}',[ScolariteController::class,'index']);
Route::get('Scolarite/create/{rub}/{srub}',[ScolariteController::class,'create']);
Route::get('Scolarite/{id}/edit/{rub}/{srub}',[ScolariteController::class,'edit'])->name('scolarite.edit');
Route::get('Scolarite/{id}/noel/{rub}/{srub}',[ScolariteController::class,'noel'])->name('scolarite.noel');
Route::get('Scolarite/{id}/cloture/{rub}/{srub}',[ScolariteController::class,'cloture'])->name('scolarite.cloture');
Route::get('/scolarite/arecu/{matricule}/{type}', [ScolariteController::class, 'arecu'])->name('scolarite.arecu');


Route::resource('intendance',IntendanceController::class);
Route::get('intendance/{rub}/{srub}',[IntendanceController::class,'index']);
Route::post('intendance',[IntendanceController::class,'store'])->name('intendance.store');


Route::resource('cantine',CantineController::class);
Route::post('cantine',[CantineController::class,'store'])->name('cantine.store');
Route::get('cantine/{rub}/{srub}',[CantineController::class,'index']);
Route::get('cantine/create/{rub}/{srub}',[CantineController::class,'create']);
Route::get('cantine/{id}/edit/{rub}/{srub}',[CantineController::class,'edit']);
Route::get('cantine/recu/{matricule}/{rub}/{srub}', [CantineController::class, 'recu'])->name('cantine.recu');

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
    $cantinesome= DB::table('cantineannes')->where('annee', $annee)->first();
    $montant= $cantinesome->montant_mois;
    session(['cantinesome' => $montant]);
    return response()->json(['message' => 'Année enregistrée', 'annee' => session('annee')]);
});
Route::get('/matricule/{niveau_id}', [EleveController::class, 'matricule']);
Route::get('/max/{id}', [ClasseController::class, 'getClasse']);



Route::get('/niveaux-par-cycle/{id}', [EleveController::class, 'niveauxParCycle']);
Route::get('/classes-par-niveau/{id}', [EleveController::class, 'classesParNiveau']);
Route::get('/get-eleve/{matricule}', [ScolariteController::class, 'getEleve']);
Route::get('/reglements/recu/{id}', [ScolariteController::class, 'recu'])->name('Scolarite.recu');
Route::get('/reglement/recu/{id}', [IntendanceController::class, 'recu'])->name('intendance.recu');

