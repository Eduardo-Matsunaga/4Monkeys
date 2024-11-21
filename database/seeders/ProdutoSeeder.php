<?php

namespace Database\Seeders;


use App\Models\Produto;
use App\Models\Especificacoes;
use App\Models\Marca;
use App\Models\Preco;
use App\Models\LojaOnline;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       /* Produto::create([
            'nome' => 'CPU',
            'marca_id' => 1,
            'especificacoes_id' => 1,
            'preco_id' => 1,
            'loja_online_id' => 1,
        ]);

        Produto::create([
            'nome' => 'COOLER',
            'marca_id' => 2,
            'especificacoes_id' => 2,
            'preco_id' => 2,
            'loja_online_id' => 2,
        ]);

        Produto::create([
            'nome' => 'GPU',
            'marca_id' => 3,
            'especificacoes_id' => 3,
            'preco_id' => 3,
            'loja_online_id' => 3,
        ]);

        Produto::create([
            'nome' => 'MOTHERBOARD',
            'marca_id' => 4,
            'especificacoes_id' => 4,
            'preco_id' => 4,
            'loja_online_id' => 4,
        ]);

        Produto::create([
            'nome' => 'RAM',
            'marca_id' => 5,
            'especificacoes_id' => 5,
            'preco_id' => 5,
            'loja_online_id' => 5,
        ]);

        Produto::create([
            'nome' => 'HDD',
            'marca_id' => 6,
            'especificacoes_id' => 6,
            'preco_id' => 6,
            'loja_online_id' => 6,
        ]);

        Produto::create([
            'nome' => 'CABINET',
            'marca_id' => 7,
            'especificacoes_id' => 7,
            'preco_id' => 7,
            'loja_online_id' => 7,
        ]);

        Produto::create([
            'nome' => 'SOURCE',
            'marca_id' => 8,
            'especificacoes_id' => 8,
            'preco_id' => 8,
            'loja_online_id' => 8,
        ]);

        Produto::create([
            'nome' => 'CPU',
            'marca_id' => 9,
            'especificacoes_id' => 9,
            'preco_id' => 9,
            'loja_online_id' => 9,
        ]);

        Produto::create([
            'nome' => 'COOLER',
            'marca_id' => 10,
            'especificacoes_id' => 10,
            'preco_id' => 10,
            'loja_online_id' => 10,
        ]);

        Produto::create([
            'nome' => 'GPU',
            'marca_id' => 11,
            'especificacoes_id' => 11,
            'preco_id' => 11,
            'loja_online_id' => 11,
        ]);

        Produto::create([
            'nome' => 'MOTHERBOARD',
            'marca_id' => 12,
            'especificacoes_id' => 12,
            'preco_id' => 12,
            'loja_online_id' => 12,
        ]);

        Produto::create([
            'nome' => 'RAM',
            'marca_id' => 13,
            'especificacoes_id' => 13,
            'preco_id' => 13,
            'loja_online_id' => 13,
        ]);

        Produto::create([
            'nome' => 'HDD',
            'marca_id' => 14,
            'especificacoes_id' => 14,
            'preco_id' => 14,
            'loja_online_id' => 14,
        ]);

        Produto::create([
            'nome' => 'CABINET',
            'marca_id' => 15,
            'especificacoes_id' => 15,
            'preco_id' => 15,
            'loja_online_id' => 15,
        ]);

        Produto::create([
            'nome' => 'SOURCE',
            'marca_id' => 16,
            'especificacoes_id' => 16,
            'preco_id' => 16,
            'loja_online_id' => 16,
        ]);

        Produto::create([
            'nome' => 'CPU',
            'marca_id' => 17,
            'especificacoes_id' => 17,
            'preco_id' => 17,
            'loja_online_id' => 17,
        ]);

        Produto::create([
            'nome' => 'COOLER',
            'marca_id' => 18,
            'especificacoes_id' => 18,
            'preco_id' => 18,
            'loja_online_id' => 18,
        ]);

        Produto::create([
            'nome' => 'GPU',
            'marca_id' => 19,
            'especificacoes_id' => 19,
            'preco_id' => 19,
            'loja_online_id' => 19,
        ]);

        Produto::create([
            'nome' => 'MOTHERBOARD',
            'marca_id' => 20,
            'especificacoes_id' => 20,
            'preco_id' => 20,
            'loja_online_id' => 20,
        ]);

        Produto::create([
            'nome' => 'RAM',
            'marca_id' => 21,
            'especificacoes_id' => 21,
            'preco_id' => 21,
            'loja_online_id' => 21,
        ]);

        Produto::create([
            'nome' => 'HDD',
            'marca_id' => 22,
            'especificacoes_id' => 22,
            'preco_id' => 22,
            'loja_online_id' => 22,
        ]);

        Produto::create([
            'nome' => 'CABINET',
            'marca_id' => 23,
            'especificacoes_id' => 23,
            'preco_id' => 23,
            'loja_online_id' => 23,
        ]);

        Produto::create([
            'nome' => 'SOURCE',
            'marca_id' => 24,
            'especificacoes_id' => 24,
            'preco_id' => 24,
            'loja_online_id' => 24,
        ]);

        Produto::create([
            'nome' => 'CPU',
            'marca_id' => 25,
            'especificacoes_id' => 25,
            'preco_id' => 25,
            'loja_online_id' => 25,
        ]);

        Produto::create([
            'nome' => 'COOLER',
            'marca_id' => 26,
            'especificacoes_id' => 26,
            'preco_id' => 26,
            'loja_online_id' => 26,
        ]);

        Produto::create([
            'nome' => 'GPU',
            'marca_id' => 27,
            'especificacoes_id' => 27,
            'preco_id' => 27,
            'loja_online_id' => 27,
        ]);

        Produto::create([
            'nome' => 'MOTHERBOARD',
            'marca_id' => 28,
            'especificacoes_id' => 28,
            'preco_id' => 28,
            'loja_online_id' => 28,
        ]);

        Produto::create([
            'nome' => 'RAM',
            'marca_id' => 29,
            'especificacoes_id' => 29,
            'preco_id' => 29,
            'loja_online_id' => 29,
        ]);

        Produto::create([
            'nome' => 'HDD',
            'marca_id' => 30,
            'especificacoes_id' => 30,
            'preco_id' => 30,
            'loja_online_id' => 30,
        ]);

        Produto::create([
            'nome' => 'CABINET',
            'marca_id' => 31,
            'especificacoes_id' => 31,
            'preco_id' => 31,
            'loja_online_id' => 31,
        ]);

        Produto::create([
            'nome' => 'SOURCE',
            'marca_id' => 32,
            'especificacoes_id' => 32,
            'preco_id' => 32,
            'loja_online_id' => 32,
        ]);

        Produto::create([
            'nome' => 'CPU',
            'marca_id' => 33,
            'especificacoes_id' => 33,
            'preco_id' => 33,
            'loja_online_id' => 33,
        ]);

        Produto::create([
            'nome' => 'COOLER',
            'marca_id' => 34,
            'especificacoes_id' => 34,
            'preco_id' => 34,
            'loja_online_id' => 34,
        ]);

        Produto::create([
            'nome' => 'GPU',
            'marca_id' => 35,
            'especificacoes_id' => 35,
            'preco_id' => 35,
            'loja_online_id' => 35,
        ]);

        Produto::create([
            'nome' => 'MOTHERBOARD',
            'marca_id' => 36,
            'especificacoes_id' => 36,
            'preco_id' => 36,
            'loja_online_id' => 36,
        ]);

        Produto::create([
            'nome' => 'RAM',
            'marca_id' => 37,
            'especificacoes_id' => 37,
            'preco_id' => 37,
            'loja_online_id' => 37,
        ]);

        Produto::create([
            'nome' => 'HDD',
            'marca_id' => 38,
            'especificacoes_id' => 38,
            'preco_id' => 38,
            'loja_online_id' => 38,
        ]);

        Produto::create([
            'nome' => 'CABINET',
            'marca_id' => 39,
            'especificacoes_id' => 39,
            'preco_id' => 39,
            'loja_online_id' => 39,
        ]);

        Produto::create([
            'nome' => 'SOURCE',
            'marca_id' => 40,
            'especificacoes_id' => 40,
            'preco_id' => 40,
            'loja_online_id' => 40,
        ]);

        Produto::create([
            'nome' => 'CPU',
            'marca_id' => 41,
            'especificacoes_id' => 41,
            'preco_id' => 41,
            'loja_online_id' => 41,
        ]);

        Produto::create([
            'nome' => 'CPU',
            'marca_id' => 42,
            'especificacoes_id' => 42,
            'preco_id' => 42,
            'loja_online_id' => 42,
        ]);

        Produto::create([
            'nome' => 'CPU',
            'marca_id' => 43,
            'especificacoes_id' => 43,
            'preco_id' => 43,
            'loja_online_id' => 43,
        ]);

        Produto::create([
            'nome' => 'CPU',
            'marca_id' => 44,
            'especificacoes_id' => 44,
            'preco_id' => 44,
            'loja_online_id' => 44,
        ]);

        Produto::create([
            'nome' => 'CPU',
            'marca_id' => 45,
            'especificacoes_id' => 45,
            'preco_id' => 45,
            'loja_online_id' => 45,
        ]);

        Produto::create([
            'nome' => 'CPU',
            'marca_id' => 46,
            'especificacoes_id' => 46,
            'preco_id' => 46,
            'loja_online_id' => 46,
        ]);

        Produto::create([
            'nome' => 'CPU',
            'marca_id' => 47,
            'especificacoes_id' => 47,
            'preco_id' => 47,
            'loja_online_id' => 47,
        ]);

        Produto::create([
            'nome' => 'CPU',
            'marca_id' => 48,
            'especificacoes_id' => 48,
            'preco_id' => 48,
            'loja_online_id' => 48,
        ]);

        Produto::create([
            'nome' => 'CPU',
            'marca_id' => 49,
            'especificacoes_id' => 49,
            'preco_id' => 49,
            'loja_online_id' => 49,
        ]);

        Produto::create([
            'nome' => 'CPU',
            'marca_id' => 50,
            'especificacoes_id' => 50,
            'preco_id' => 50,
            'loja_online_id' => 50,
        ]);

        Produto::create([
            'nome' => 'CPU',
            'marca_id' => 51,
            'especificacoes_id' => 51,
            'preco_id' => 51,
            'loja_online_id' => 51,
        ]);

        Produto::create([
            'nome' => 'CPU',
            'marca_id' => 52,
            'especificacoes_id' => 52,
            'preco_id' => 52,
            'loja_online_id' => 52,
        ]);

        Produto::create([
            'nome' => 'CPU',
            'marca_id' => 53,
            'especificacoes_id' => 53,
            'preco_id' => 53,
            'loja_online_id' => 53,
        ]);

        Produto::create([
            'nome' => 'CPU',
            'marca_id' => 54,
            'especificacoes_id' => 54,
            'preco_id' => 54,
            'loja_online_id' => 54,
        ]);

        Produto::create([
            'nome' => 'CPU',
            'marca_id' => 55,
            'especificacoes_id' => 55,
            'preco_id' => 55,
            'loja_online_id' => 55,
        ]);

        Produto::create([
            'nome' => 'RAM',
            'marca_id' => 56,
            'especificacoes_id' => 56,
            'preco_id' => 56,
            'loja_online_id' => 56,
        ]);

        Produto::create([
            'nome' => 'RAM',
            'marca_id' => 57,
            'especificacoes_id' => 57,
            'preco_id' => 57,
            'loja_online_id' => 57,
        ]);

        Produto::create([
            'nome' => 'RAM',
            'marca_id' => 58,
            'especificacoes_id' => 58,
            'preco_id' => 58,
            'loja_online_id' => 58,
        ]);

        Produto::create([
            'nome' => 'RAM',
            'marca_id' => 59,
            'especificacoes_id' => 59,
            'preco_id' => 59,
            'loja_online_id' => 59,
        ]);

        Produto::create([
            'nome' => 'RAM',
            'marca_id' => 60,
            'especificacoes_id' => 60,
            'preco_id' => 60,
            'loja_online_id' => 60,
        ]);

        Produto::create([
            'nome' => 'RAM',
            'marca_id' => 61,
            'especificacoes_id' => 61,
            'preco_id' => 61,
            'loja_online_id' => 61,
        ]);

        Produto::create([
            'nome' => 'RAM',
            'marca_id' => 62,
            'especificacoes_id' => 62,
            'preco_id' => 62,
            'loja_online_id' => 62,
        ]);

        Produto::create([
            'nome' => 'RAM',
            'marca_id' => 63,
            'especificacoes_id' => 63,
            'preco_id' => 63,
            'loja_online_id' => 63,
        ]);

        Produto::create([
            'nome' => 'RAM',
            'marca_id' => 64,
            'especificacoes_id' => 64,
            'preco_id' => 64,
            'loja_online_id' => 64,
        ]);

        Produto::create([
            'nome' => 'RAM',
            'marca_id' => 65,
            'especificacoes_id' => 65,
            'preco_id' => 65,
            'loja_online_id' => 65,
        ]);

        Produto::create([
            'nome' => 'COOLER',
            'marca_id' => 66,
            'especificacoes_id' => 66,
            'preco_id' => 66,
            'loja_online_id' => 66,
        ]);

        Produto::create([
            'nome' => 'COOLER',
            'marca_id' => 67,
            'especificacoes_id' => 67,
            'preco_id' => 67,
            'loja_online_id' => 67,
        ]);

        Produto::create([
            'nome' => 'COOLER',
            'marca_id' => 68,
            'especificacoes_id' => 68,
            'preco_id' => 68,
            'loja_online_id' => 68,
        ]);

        Produto::create([
            'nome' => 'COOLER',
            'marca_id' => 69,
            'especificacoes_id' => 69,
            'preco_id' => 69,
            'loja_online_id' => 69,
        ]);

        Produto::create([
            'nome' => 'COOLER',
            'marca_id' => 70,
            'especificacoes_id' => 70,
            'preco_id' => 70,
            'loja_online_id' => 70,
        ]);

        Produto::create([
            'nome' => 'COOLER',
            'marca_id' => 71,
            'especificacoes_id' => 71,
            'preco_id' => 71,
            'loja_online_id' => 71,
        ]);

        Produto::create([
            'nome' => 'MOTHERBOARD',
            'marca_id' => 72,
            'especificacoes_id' => 72,
            'preco_id' => 72,
            'loja_online_id' => 72,
        ]);

        Produto::create([
            'nome' => 'MOTHERBOARD',
            'marca_id' => 73,
            'especificacoes_id' => 73,
            'preco_id' => 73,
            'loja_online_id' => 73,
        ]);

        Produto::create([
            'nome' => 'MOTHERBOARD',
            'marca_id' => 74,
            'especificacoes_id' => 74,
            'preco_id' => 74,
            'loja_online_id' => 74,
        ]);

        Produto::create([
            'nome' => 'MOTHERBOARD',
            'marca_id' => 75,
            'especificacoes_id' => 75,
            'preco_id' => 75,
            'loja_online_id' => 75,
        ]);

        Produto::create([
            'nome' => 'MOTHERBOARD',
            'marca_id' => 76,
            'especificacoes_id' => 76,
            'preco_id' => 76,
            'loja_online_id' => 76,
        ]);

        Produto::create([
            'nome' => 'MOTHERBOARD',
            'marca_id' => 77,
            'especificacoes_id' => 77,
            'preco_id' => 77,
            'loja_online_id' => 77,
        ]);

        Produto::create([
            'nome' => 'MOTHERBOARD',
            'marca_id' => 78,
            'especificacoes_id' => 78,
            'preco_id' => 78,
            'loja_online_id' => 78,
        ]);

        Produto::create([
            'nome' => 'MOTHERBOARD',
            'marca_id' => 79,
            'especificacoes_id' => 79,
            'preco_id' => 79,
            'loja_online_id' => 79,
        ]);

        Produto::create([
            'nome' => 'GPU',
            'marca_id' => 80,
            'especificacoes_id' => 80,
            'preco_id' => 80,
            'loja_online_id' => 80,
        ]);

        Produto::create([
            'nome' => 'GPU',
            'marca_id' => 81,
            'especificacoes_id' => 81,
            'preco_id' => 81,
            'loja_online_id' => 81,
        ]);

        Produto::create([
            'nome' => 'GPU',
            'marca_id' => 82,
            'especificacoes_id' => 82,
            'preco_id' => 82,
            'loja_online_id' => 82,
        ]);

        Produto::create([
            'nome' => 'GPU',
            'marca_id' => 83,
            'especificacoes_id' => 83,
            'preco_id' => 83,
            'loja_online_id' => 83,
        ]);

        Produto::create([
            'nome' => 'GPU',
            'marca_id' => 84,
            'especificacoes_id' => 84,
            'preco_id' => 84,
            'loja_online_id' => 84,
        ]);

        Produto::create([
            'nome' => 'GPU',
            'marca_id' => 85,
            'especificacoes_id' => 85,
            'preco_id' => 85,
            'loja_online_id' => 85,
        ]);

        Produto::create([
            'nome' => 'GPU',
            'marca_id' => 86,
            'especificacoes_id' => 86,
            'preco_id' => 86,
            'loja_online_id' => 86,
        ]);

        Produto::create([
            'nome' => 'GPU',
            'marca_id' => 87,
            'especificacoes_id' => 87,
            'preco_id' => 87,
            'loja_online_id' => 87,
        ]);

        Produto::create([
            'nome' => 'GPU',
            'marca_id' => 88,
            'especificacoes_id' => 88,
            'preco_id' => 88,
            'loja_online_id' => 88,
        ]);

        Produto::create([
            'nome' => 'GPU',
            'marca_id' => 89,
            'especificacoes_id' => 89,
            'preco_id' => 89,
            'loja_online_id' => 89,
        ]);

        Produto::create([
            'nome' => 'GPU',
            'marca_id' => 90,
            'especificacoes_id' => 90,
            'preco_id' => 90,
            'loja_online_id' => 90,
        ]);

        Produto::create([
            'nome' => 'HDD',
            'marca_id' => 91,
            'especificacoes_id' => 91,
            'preco_id' => 91,
            'loja_online_id' => 91,
        ]);

        Produto::create([
            'nome' => 'HDD',
            'marca_id' => 92,
            'especificacoes_id' => 92,
            'preco_id' => 92,
            'loja_online_id' => 92,
        ]);

        Produto::create([
            'nome' => 'HDD',
            'marca_id' => 93,
            'especificacoes_id' => 93,
            'preco_id' => 93,
            'loja_online_id' => 93,
        ]);

        Produto::create([
            'nome' => 'HDD',
            'marca_id' => 94,
            'especificacoes_id' => 94,
            'preco_id' => 94,
            'loja_online_id' => 94,
        ]);

        Produto::create([
            'nome' => 'HDD',
            'marca_id' => 95,
            'especificacoes_id' => 95,
            'preco_id' => 95,
            'loja_online_id' => 95,
        ]);

        Produto::create([
            'nome' => 'HDD',
            'marca_id' => 96,
            'especificacoes_id' => 96,
            'preco_id' => 96,
            'loja_online_id' => 96,
        ]);

        Produto::create([
            'nome' => 'HDD',
            'marca_id' => 97,
            'especificacoes_id' => 97,
            'preco_id' => 97,
            'loja_online_id' => 97,
        ]);

        Produto::create([
            'nome' => 'CPU',
            'marca_id' => 98,
            'especificacoes_id' => 98,
            'preco_id' => 98,
            'loja_online_id' => 98,
        ]);

        Produto::create([
            'nome' => 'CPU',
            'marca_id' => 99,
            'especificacoes_id' => 99,
            'preco_id' => 99,
            'loja_online_id' => 99,
        ]);

        Produto::create([
            'nome' => 'SOURCE',
            'marca_id' => 100,
            'especificacoes_id' => 100,
            'preco_id' => 100,
            'loja_online_id' => 100,
        ]);
*/


    }
}
