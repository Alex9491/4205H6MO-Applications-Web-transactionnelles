<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnregistrerRecetteRequest;
use App\Models\Categorie;
use App\Models\Recette;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

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

    $recette = Recette::create([
        ...$request->validated(),
        'idrecette' => $nouvelId,
        'idutilisateur' => $user->idUtilisateurs,
    ]);

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
        $recette->update($request->validated());

        return redirect()->route('recettes.show', $recette)
            ->with('status', 'Recette modifiée avec succès.');
    }

    public function destroy(Recette $recette): RedirectResponse
    {
        $recette->delete();

        return redirect()->route('recettes.index')
            ->with('status', 'Recette supprimée avec succès.');
    }
}
