<?php

namespace Database\Factories;

use App\Models\Categorie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Categorie>
 */
class CategorieFactory extends Factory
{
    public function definition(): array
    {
        return [
            'idcategorie' => fake()->unique()->numberBetween(1, 999999),
            'nom' => fake()->unique()->words(2, true),
        ];
    }
}
