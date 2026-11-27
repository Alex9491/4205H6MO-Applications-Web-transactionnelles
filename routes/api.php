<?php

use App\Http\Controllers\Api\RecetteController;
use App\Http\Controllers\Api\SessionTokenController;
use Illuminate\Support\Facades\Route;

Route::post('login', [SessionTokenController::class, 'store'])
    ->middleware('throttle:6,1');

Route::post('logout', [SessionTokenController::class, 'destroy'])
    ->middleware('auth:sanctum');

Route::middleware('throttle:60,1')->group(function () {
    Route::apiResource('recettes', RecetteController::class)
        ->names('api.recettes')
        ->only(['index', 'show']);
});

Route::middleware(['auth:sanctum', 'throttle:60,1'])->group(function () {
    Route::apiResource('recettes', RecetteController::class)
        ->names('api.recettes')
        ->only(['store', 'update', 'destroy']);
});