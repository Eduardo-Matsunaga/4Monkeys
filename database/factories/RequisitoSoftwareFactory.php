<?php

namespace Database\Factories;

use App\Models\Software;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RequisitoSoftwareFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'software_id' => Software::factory(), // Cria um software relacionado, se não for fornecido
            'requisito_nivel' => $this->faker->randomElement(['Minimo', 'Medio', 'Recomendado']),
            'cpu' => $this->faker->word,
            'gpu' => $this->faker->word,
            'ram' => $this->faker->word,
            'placa_mae' => $this->faker->word,
            'ssd' => $this->faker->word,
            'cooler' => $this->faker->word,
            'fonte' => $this->faker->word,
        ];
    }
}



