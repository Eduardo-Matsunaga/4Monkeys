<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categoria::create([
           'nome' => 'bronze',
           'tipo'=> '1',
        ]);

        Categoria::create([
            'nome' => 'silver',
            'tipo'=> '2',
        ]);

        Categoria::create([
            'nome' => 'gold',
            'tipo'=> '3',
        ]);
    }
}
