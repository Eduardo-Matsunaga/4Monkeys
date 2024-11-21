<?php
namespace Database\Factories;
use App\Models\Conjunto;
use App\Models\User;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produto>
 */
class ConjuntoFactory extends Factory
{
    // Define o nome do model associado à factory
    protected $model = Conjunto::class;

    // Define os atributos padrão para a factory
    public function definition(): array
    {
        return [
            'nome' => $this->faker->word, // Gera um nome aleatório para o conjunto
            'categoria_id' => Categoria::factory(), // Associa um categoria existente (usando outra factory)
            'user_id' => User::factory(), // Associa um usuário existente (usando outra factory)
        ];
    }
}
