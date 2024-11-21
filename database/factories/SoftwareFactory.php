<?php

namespace Database\Factories;

use App\Models\RequisitoSoftware;
use App\Models\Software;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Software>
 */
class SoftwareFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tipo' => $this->faker->randomElement([1, 2, 3]),
            'nome' => $this->faker->word,
            'descricao' => $this->faker->randomElement(['XXX', 'YYY', 'ZZZ']),
            'peso' => $this->faker->randomFloat(1, 1, 3),
        ];
    }

    public function withRequisitos()
    {
        return $this->has(RequisitoSoftware::factory()->count(3), 'requisitos');
    }
}
