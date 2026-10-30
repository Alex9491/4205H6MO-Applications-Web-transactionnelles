<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RechercheRecetteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): JsonResponse
    {
        $data = $request->validate([
            'q' => ['required', 'string', 'min:2', 'max:50'],
        ]);

        $recettes = Recette::query()
            ->where('nom', 'like', '%'.$data['q'].'%')
            ->orderBy('nom')
            ->limit(8)
            ->get(['idrecette', 'nom']);

        return response()->json([
            'data' => $recettes->map(fn (Recette $recette) => [
                'id' => $recette->idrecette,
                'label' => $recette->nom,
                'url' => route('recettes.show', $recette),
            ]),
        ]);
    }
}
