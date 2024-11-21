<?php

namespace Database\Factories;

use App\Models\CustomLog;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomLogFactory extends Factory
{
    protected $model = CustomLog::class;

    public function definition()
    {
        return [
            'descricao' => $this->faker->sentence,
            'operacao' => $this->faker->randomElement(['index', 'create', 'update', 'delete']),
            'admin_id' => Admin::factory(),
        ];
    }
}
