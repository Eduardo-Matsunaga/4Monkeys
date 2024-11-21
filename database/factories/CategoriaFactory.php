<?php

namespace Database\Factories;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categoria>
 */
class CategoriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Categoria::class;
    public function definition(): array
    {
        return [
            'nome' => $this->faker->randomElement(['bronze','silver','gold']),  // Gera uma string de 4 letras
            'tipo' => $this->faker->randomElement([1, 2, 3]),  // Gera um número aleatório entre 1, 2, ou 3
        ];
    }
}
