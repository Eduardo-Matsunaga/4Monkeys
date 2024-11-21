<?php

namespace Database\Seeders;

use App\Models\Conjunto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConjuntoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*Conjunto::create([
            'nome' => 'bronze',
            'categoria_id'  => '1',
            'user_id' => 'null',

        ]);

        Conjunto::create([
            'nome' => 'silver',
            'categoria_id'  => '2',
            'user_id' => 'null',
        ]);

        Conjunto::create([
            'nome' => 'gold',
            'categoria_id'  => '3',
            'user_id' => 'null',

        ]);

        Conjunto::create([
            'nome' => 'bronze',
            'categoria_id'  => '1',
            'user_id' => 'null',

        ]);

        Conjunto::create([
            'nome' => 'silver',
            'categoria_id'  => '2',
            'user_id' => 'null',
        ]);

        Conjunto::create([
            'nome' => 'gold',
            'categoria_id'  => '3',
            'user_id' => 'null',

        ]);

        Conjunto::create([
            'nome' => 'bronze',
            'categoria_id'  => '1',
            'user_id' => 'null',

        ]);

        Conjunto::create([
            'nome' => 'silver',
            'categoria_id'  => '2',
            'user_id' => 'null',
        ]);

        Conjunto::create([
            'nome' => 'gold',
            'categoria_id'  => '3',
            'user_id' => 'null',

        ]);

        Conjunto::create([
            'nome' => 'bronze',
            'categoria_id'  => '1',
            'user_id' => 'null',

        ]);

        Conjunto::create([
            'nome' => 'silver',
            'categoria_id'  => '2',
            'user_id' => 'null',
        ]);

        Conjunto::create([
            'nome' => 'gold',
            'categoria_id'  => '3',
            'user_id' => 'null',

        ]);

        Conjunto::create([
            'nome' => 'bronze',
            'categoria_id'  => '1',
            'user_id' => 'null',

        ]);

        Conjunto::create([
            'nome' => 'silver',
            'categoria_id'  => '2',
            'user_id' => 'null',
        ]);

        Conjunto::create([
            'nome' => 'gold',
            'categoria_id'  => '3',
            'user_id' => 'null',

        ]);

        Conjunto::create([
            'nome' => 'bronze',
            'categoria_id'  => '1',
            'user_id' => 'null',

        ]);

        Conjunto::create([
            'nome' => 'silver',
            'categoria_id'  => '2',
            'user_id' => 'null',
        ]);

        Conjunto::create([
            'nome' => 'gold',
            'categoria_id'  => '3',
            'user_id' => 'null',

        ]);

        Conjunto::create([
            'nome' => 'bronze',
            'categoria_id'  => '1',
            'user_id' => 'null',

        ]);

        Conjunto::create([
            'nome' => 'silver',
            'categoria_id'  => '2',
            'user_id' => 'null',
        ]);

        Conjunto::create([
            'nome' => 'gold',
            'categoria_id'  => '3',
            'user_id' => 'null',

        ]);

        Conjunto::create([
            'nome' => 'bronze',
            'categoria_id'  => '1',
            'user_id' => 'null',

        ]);

        Conjunto::create([
            'nome' => 'silver',
            'categoria_id'  => '2',
            'user_id' => 'null',
        ]);

        Conjunto::create([
            'nome' => 'gold',
            'categoria_id'  => '3',
            'user_id' => 'null',

        ]);

        Conjunto::create([
            'nome' => 'bronze',
            'categoria_id'  => '1',
            'user_id' => 'null',

        ]);

        Conjunto::create([
            'nome' => 'silver',
            'categoria_id'  => '2',
            'user_id' => 'null',
        ]);

        Conjunto::create([
            'nome' => 'gold',
            'categoria_id'  => '3',
            'user_id' => 'null',

        ]);

        Conjunto::create([
            'nome' => 'bronze',
            'categoria_id'  => '1',
            'user_id' => 'null',

        ]);

        Conjunto::create([
            'nome' => 'silver',
            'categoria_id'  => '2',
            'user_id' => 'null',
        ]);

        Conjunto::create([
            'nome' => 'gold',
            'categoria_id'  => '3',
            'user_id' => 'null',

        ]);

        Conjunto::create([
            'nome' => 'bronze',
            'categoria_id'  => '1',
            'user_id' => 'null',

        ]);

        Conjunto::create([
            'nome' => 'silver',
            'categoria_id'  => '2',
            'user_id' => 'null',
        ]);

        Conjunto::create([
            'nome' => 'gold',
            'categoria_id'  => '3',
            'user_id' => 'null',

        ]);

        Conjunto::create([
            'nome' => 'bronze',
            'categoria_id'  => '1',
            'user_id' => 'null',

        ]);

        Conjunto::create([
            'nome' => 'silver',
            'categoria_id'  => '2',
            'user_id' => 'null',
        ]);

        Conjunto::create([
            'nome' => 'gold',
            'categoria_id'  => '3',
            'user_id' => 'null',

        ]);

        Conjunto::create([
            'nome' => 'bronze',
            'categoria_id'  => '1',
            'user_id' => 'null',

        ]);

        Conjunto::create([
            'nome' => 'silver',
            'categoria_id'  => '2',
            'user_id' => 'null',
        ]);

        Conjunto::create([
            'nome' => 'gold',
            'categoria_id'  => '3',
            'user_id' => 'null',

        ]);

        Conjunto::create([
            'nome' => 'bronze',
            'categoria_id'  => '1',
            'user_id' => 'null',

        ]);

        Conjunto::create([
            'nome' => 'silver',
            'categoria_id'  => '2',
            'user_id' => 'null',
        ]);

        Conjunto::create([
            'nome' => 'gold',
            'categoria_id'  => '3',
            'user_id' => 'null',

        ]);

        Conjunto::create([
            'nome' => 'bronze',
            'categoria_id'  => '1',
            'user_id' => 'null',

        ]);

        Conjunto::create([
            'nome' => 'silver',
            'categoria_id'  => '2',
            'user_id' => 'null',
        ]);

        Conjunto::create([
            'nome' => 'gold',
            'categoria_id'  => '3',
            'user_id' => 'null',

        ]);
*/
    }
}
