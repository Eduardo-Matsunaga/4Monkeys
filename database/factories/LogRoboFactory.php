<?php

namespace Database\Factories;

use App\Models\LogRobo;
use Illuminate\Database\Eloquent\Factories\Factory;

class LogRoboFactory extends Factory
{
    protected $model = LogRobo::class;

    public function definition()
    {
        return [
            'url' => $this->faker->url,
            'pagina' => $this->faker->numberBetween(1, 100),
            'mensagem' => $this->faker->sentence,
        ];
    }
}
