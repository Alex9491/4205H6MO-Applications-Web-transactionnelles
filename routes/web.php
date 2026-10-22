<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecetteController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('recettes', RecetteController::class);
