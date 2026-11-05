<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecetteController;
use App\Http\Controllers\RechercheRecetteController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

Route::get('/', function () {
    return redirect()->route('recettes.index');
});

Route::get('/recherche/recettes', RechercheRecetteController::class)
    ->name('recherche.recettes');

Route::resource('recettes', RecetteController::class);

Route::get('/inscription', [InscriptionController::class, 'create'])
    ->middleware('guest')->name('register');

Route::post('/inscription', [InscriptionController::class, 'store'])
    ->middleware('guest')->name('register.store');

Route::get('/connexion', [AuthController::class, 'create'])
    ->middleware('guest')->name('login');

Route::post('/connexion', [AuthController::class, 'login'])
    ->middleware(['guest', 'throttle:6,1'])->name('login.store');

Route::post('/deconnexion', [AuthController::class, 'logout'])
    ->middleware('auth')->name('logout');

Route::delete('/recettes/{recette}/image', [RecetteController::class, 'destroyImage'])
    ->name('recettes.image.destroy');

Route::get('/recits', function () {
    return view('recits');
})->name('recits');


Route::post('/langue', function (Request $request) {
    $data = $request->validate([
        'locale' => ['required', Rule::in(['fr', 'en'])],
    ]);

    $request->session()->put('locale', $data['locale']);

    return back();
})->name('locale.update');
