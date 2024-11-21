<?php

namespace Database\Factories;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;


class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Admin::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->text(10),
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'),
        ];
    }
}
