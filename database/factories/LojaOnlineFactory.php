<?php

namespace Database\Factories;

use App\Models\LojaOnline;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Marca>
 */
class LojaOnlineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = LojaOnline::class;
    public function definition(): array
    {

        return [
            'urlLoja' => $this->faker->randomElement(['ZZZ', 'XXXX', 'YYYY']),
            'valor'=> $this->faker->randomFloat(2, 10, 100),
            'moeda'=> $this->faker->randomElement(['BRL', 'USD']),
        ];
    }
}
