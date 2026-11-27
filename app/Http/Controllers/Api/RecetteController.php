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
        $nouvelId = (Recette::query()->max('idrecette') ?? 0) + 1;
        $data = $request->safe()->except('image');
        $path = $request->file('image')?->store('recettes', 'public');

        try {
            $recette = $request->user()->recettes()->create([
                ...$data,
                'idrecette' => $nouvelId,
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
    public function update(EnregistrerRecetteApiRequest $request, int $id): RecetteResource
    {
    $recette = Recette::query()->findOrFail($id);

    $data = $request->safe()->except('image');
    $newPath = $request->file('image')?->store('recettes', 'public');
    $oldPath = $recette->image_path;

    if ($newPath) {
        $data['image_path'] = $newPath;
    }

    try {
        $recette->update($data);
    } catch (Throwable $exception) {
        if ($newPath) {
            Storage::disk('public')->delete($newPath);
        }

        throw $exception;
    }

    if ($newPath && $oldPath) {
        Storage::disk('public')->delete($oldPath);
    }

    return new RecetteResource(
        $recette->load([
            'user:idUtilisateurs,nom',
            'categorie:idcategorie,nom',
        ])
    );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
    $recette = Recette::query()->findOrFail($id);

    Gate::authorize('delete', $recette);

    $oldPath = $recette->image_path;

    $recette->delete();

    if ($oldPath) {
        Storage::disk('public')->delete($oldPath);
    }

    return response()->noContent();
    }
}
