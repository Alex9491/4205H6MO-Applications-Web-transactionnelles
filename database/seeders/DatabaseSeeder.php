<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Categorie;
use App\Models\Recette;
use App\Models\Avis;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $utilisateur = User::firstOrCreate(
        ['courriel' => 'gestionnaire@example.test'],
        ['nom' => 'Gestionnaire des recettes',
        'motdepasse' => 'password',
        'role' => 'user',
        ]
        );

        $categorie = Categorie::factory()->create();

        $recettes = Recette::factory()
            ->count(12)
            ->create([
                'idutilisateur' => $utilisateur->idUtilisateurs,
                'idcategorie' => $categorie->idcategorie,
            ]);

        foreach ($recettes as $recette) {
            Avis::factory()
                ->count(2)
                ->create([
                    'idutilisateur' => $utilisateur->idUtilisateurs,
                    'idrecette' => $recette->idrecette,
                ]);
        }

        Avis::factory()->sansUtilisateur()->create([
            'idrecette' => $recettes->first()->idrecette,
        ]);
    }
}
