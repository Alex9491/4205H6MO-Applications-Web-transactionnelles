<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecetteController;
use App\Http\Controllers\RechercheRecetteController;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

Route::get('/', function () {
    return redirect()->route('recettes.index');
});

Route::get('/recherche/recettes', RechercheRecetteController::class)
    ->name('recherche.recettes');

Route::resource('recettes', RecetteController::class);

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
