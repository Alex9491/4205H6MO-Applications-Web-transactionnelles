<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\RecetteResource;
use App\Models\Recette;
use App\Http\Requests\EnregistrerRecetteApiRequest;
use Illuminate\Support\Facades\Storage;
use Throwable;

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
    public function store(EnregistrerRecetteApiRequest $request)
    {
    $data = $request->safe()->except('image');
    $path = $request->file('image')?->store('recettes', 'public');

    try {
        $recette = $request->user()->recettes()->create([
            ...$data,
            'image_path' => $path,
        ]);
    } catch (Throwable $exception) {
        if ($path) {
            Storage::disk('public')->delete($path);
        }

        throw $exception;
    }

    return (new RecetteResource(
        $recette->load([
            'user:idUtilisateurs,nom',
            'categorie:idcategorie,nom',
        ])
    ))
        ->response()
        ->setStatusCode(201);
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
