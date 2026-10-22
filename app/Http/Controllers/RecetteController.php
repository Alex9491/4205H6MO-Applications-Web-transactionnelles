<?php

namespace App\Http\Controllers;

use App\Models\Recette;
use Illuminate\Contracts\View\View;

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
}
