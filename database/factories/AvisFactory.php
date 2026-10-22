<?php

namespace Database\Factories;

use App\Models\Avis;
use App\Models\Recette;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Avis>
 */
class AvisFactory extends Factory
{
    public function definition(): array
    {
        return [
            'idutilisateur' => User::factory(),
            'idrecette' => Recette::factory(),
            'note' => fake()->numberBetween(1, 5),
            'dateavis' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }

    public function sansUtilisateur(): static
    {
        return $this->state(fn () => [
            'idutilisateur' => null,
        ]);
    }
}
