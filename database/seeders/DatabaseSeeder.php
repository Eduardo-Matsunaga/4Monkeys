<?php

namespace Database\Seeders;

use App\Models\ConjuntoProduto;
use App\Models\Produto;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
           /* MarcaSeeder::class,
            EspecificacoesSeeder::class,
            PrecoSeeder::class,
            LojaOnlineSeeder::class,
            ProdutoSeeder::class,*/
            SoftwareSeeder::class,
            CategoriaSeeder::class,
            RequisitoSoftwareSeeder::class,
            ConjuntoSeeder::class,
            ConjuntoProdutoSeeder::class,
        ]);
    }
}
