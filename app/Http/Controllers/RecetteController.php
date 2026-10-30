<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnregistrerRecetteRequest;
use App\Models\Categorie;
use App\Models\Recette;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;

class RecetteController extends Controller
{
    public function index(): View
    {
        $recettes = Recette::query()
            ->with([
                'user:idUtilisateurs,nom',
                'categorie:idcategorie,nom',
            ])
            ->orderBy('nom')
            ->paginate(10);

        return view('recettes.index', compact('recettes'));
    }

    public function create(): View
    {
        $categories = Categorie::query()->orderBy('nom')->get();

        return view('recettes.create', compact('categories'));
    }


    public function store(EnregistrerRecetteRequest $request): RedirectResponse
    {
    $user = User::query()->firstOrFail();

    $nouvelId = (Recette::query()->max('idrecette') ?? 0) + 1;

    $data = $request->safe()->except('image');

    $path = $request->file('image')?->store('recettes', 'public');

    try {
        $recette = Recette::create([
            ...$data,
            'idrecette' => $nouvelId,
            'idutilisateur' => $user->idUtilisateurs,
            'image_path' => $path,
        ]);
    } catch (Throwable $exception) {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
        throw $exception;
    }

    return redirect()->route('recettes.show', $recette)
        ->with('status', 'Recette créée avec succès.');
    }


    public function show(Recette $recette): View
    {
        return view('recettes.show', [
            'recette' => $recette->load([
                'user',
                'categorie',
                'avis.user',
            ]),
        ]);
    }

    public function edit(Recette $recette): View
    {
        $categories = Categorie::query()->orderBy('nom')->get();

        return view('recettes.edit', compact('recette', 'categories'));
    }

    public function update(
        EnregistrerRecetteRequest $request,
        Recette $recette
    ): RedirectResponse {
    $data = $request->safe()->except('image');
    $newPath = $request->file('image')?->store('recettes', 'public');
    $oldPath = $recette->image_path;

    try {
        $recette->update([
            ...$data,
            ...($newPath ? ['image_path' => $newPath] : []),
        ]);
    } catch (Throwable $exception) {
        if ($newPath) {
            Storage::disk('public')->delete($newPath);
        }
        throw $exception;
    }

    if ($newPath && $oldPath) {
        Storage::disk('public')->delete($oldPath);
    }

    return redirect()->route('recettes.show', $recette)
        ->with('status', 'Recette modifiée avec succès.');
    }


    public function destroyImage(Recette $recette): RedirectResponse
    {
    $imagePath = $recette->image_path;

    if (!$imagePath) {
        return back()->with('status', 'Aucune image à supprimer.');
    }

    $recette->update([
        'image_path' => null,
    ]);

    Storage::disk('public')->delete($imagePath);

    return back()->with('status', 'Image supprimée avec succès.');
    }


    public function destroy(Recette $recette): RedirectResponse
    {
    $imagePath = $recette->image_path;

    DB::transaction(function () use ($recette) {
        $recette->avis()->delete();
        $recette->delete();
    });

    if ($imagePath) {
        Storage::disk('public')->delete($imagePath);
    }

    return redirect()->route('recettes.index')
        ->with('status', 'Recette supprimée avec succès.');
    }
}
