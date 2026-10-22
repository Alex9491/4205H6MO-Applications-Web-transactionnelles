<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecetteController;

Route::get('/', function () {
    return redirect()->route('recettes.index');
});

Route::resource('recettes', RecetteController::class);

Route::get('/recits', function () {
    return view('recits');
})->name('recits');
