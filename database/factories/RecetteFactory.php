<?php

namespace Database\Factories;

use App\Models\Recette;
use App\Models\User;
use App\Models\Categorie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Recette>
 */
class RecetteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'idrecette' => fake()->unique()->numberBetween(1, 999999),
            'idutilisateur' => User::factory(),
            'idcategorie' => Categorie::factory(),
            'nom' => fake()->words(3, true),
            'description' => fake()->paragraph(),
        ];
    }
}
