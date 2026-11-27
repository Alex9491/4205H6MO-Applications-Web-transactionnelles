<?php

use App\Http\Controllers\Api\RecetteController;
use Illuminate\Support\Facades\Route;

Route::apiResource('recettes', RecetteController::class)
    ->names('api.recettes')
    ->only(['index', 'show']);