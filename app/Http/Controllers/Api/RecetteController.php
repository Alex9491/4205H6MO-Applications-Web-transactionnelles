<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\RecetteResource;
use App\Models\Recette;

class RecetteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recettes = Recette::query()
            ->with([
                'user:idUtilisateurs,nom',
                'categorie:idcategorie,nom',
            ])
            ->orderBy('nom')
            ->paginate(10);

        return RecetteResource::collection($recettes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $recette = Recette::query()
            ->with([
                'user:idUtilisateurs,nom',
                'categorie:idcategorie,nom',
            ])
            ->findOrFail($id);

        return new RecetteResource($recette);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
