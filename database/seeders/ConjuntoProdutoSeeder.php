<?php

namespace Database\Seeders;

use App\Models\ConjuntoProduto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConjuntoProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       /* ConjuntoProduto::create([
            'conjunto_id' => '1',
            'produto_id'  => '37',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '1',
            'produto_id'  => '12',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '1',
            'produto_id'  => '52',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '1',
            'produto_id'  => '114',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '1',
            'produto_id'  => '43',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '1',
            'produto_id'  => '90',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '1',
            'produto_id'  => '63',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '2',
            'produto_id'  => '16',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '2',
            'produto_id'  => '11',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '2',
            'produto_id'  => '53',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '2',
            'produto_id'  => '632',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '2',
            'produto_id'  => '39',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '2',
            'produto_id'  => '92',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '2',
            'produto_id'  => '65',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '3',
            'produto_id'  => '21',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '3',
            'produto_id'  => '10',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '3',
            'produto_id'  => '56',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '3',
            'produto_id'  => '635',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '3',
            'produto_id'  => '41',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '3',
            'produto_id'  => '95',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '3',
            'produto_id'  => '64',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '4',
            'produto_id'  => '31',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '4',
            'produto_id'  => '11',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '4',
            'produto_id'  => '52',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '4',
            'produto_id'  => '114',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '4',
            'produto_id'  => '39',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '4',
            'produto_id'  => '90',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '4',
            'produto_id'  => '63',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '5',
            'produto_id'  => '16',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '5',
            'produto_id'  => '2',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '5',
            'produto_id'  => '53',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '5',
            'produto_id'  => '112',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '5',
            'produto_id'  => '39',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '5',
            'produto_id'  => '92',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '5',
            'produto_id'  => '65',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '6',
            'produto_id'  => '21',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '6',
            'produto_id'  => '10',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '6',
            'produto_id'  => '56',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '6',
            'produto_id'  => '635',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '6',
            'produto_id'  => '41',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '6',
            'produto_id'  => '95',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '6',
            'produto_id'  => '64',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '7',
            'produto_id'  => '15',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '7',
            'produto_id'  => '11',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '7',
            'produto_id'  => '55',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '7',
            'produto_id'  => '114',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '7',
            'produto_id'  => '43',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '7',
            'produto_id'  => '90',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '7',
            'produto_id'  => '63',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '8',
            'produto_id'  => '21',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '8',
            'produto_id'  => '2',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '8',
            'produto_id'  => '53',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '8',
            'produto_id'  => '112',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '8',
            'produto_id'  => '47',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '8',
            'produto_id'  => '92',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '8',
            'produto_id'  => '65',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '9',
            'produto_id'  => '19',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '9',
            'produto_id'  => '10',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '9',
            'produto_id'  => '56',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '9',
            'produto_id'  => '635',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '9',
            'produto_id'  => '41',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '9',
            'produto_id'  => '95',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '9',
            'produto_id'  => '64',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '10',
            'produto_id'  => '15',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '10',
            'produto_id'  => '11',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '10',
            'produto_id'  => '55',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '10',
            'produto_id'  => '114',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '10',
            'produto_id'  => '43',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '10',
            'produto_id'  => '90',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '10',
            'produto_id'  => '63',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '11',
            'produto_id'  => '21',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '11',
            'produto_id'  => '2',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '11',
            'produto_id'  => '53',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '11',
            'produto_id'  => '112',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '11',
            'produto_id'  => '47',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '11',
            'produto_id'  => '92',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '11',
            'produto_id'  => '65',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '12',
            'produto_id'  => '19',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '12',
            'produto_id'  => '10',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '12',
            'produto_id'  => '56',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '12',
            'produto_id'  => '635',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '12',
            'produto_id'  => '41',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '12',
            'produto_id'  => '95',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '12',
            'produto_id'  => '64',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '13',
            'produto_id'  => '31',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '13',
            'produto_id'  => '14',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '13',
            'produto_id'  => '58',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '13',
            'produto_id'  => '114',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '13',
            'produto_id'  => '39',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '13',
            'produto_id'  => '90',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '13',
            'produto_id'  => '63',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '14',
            'produto_id'  => '37',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '14',
            'produto_id'  => '12',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '14',
            'produto_id'  => '50',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '14',
            'produto_id'  => '112',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '14',
            'produto_id'  => '43',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '14',
            'produto_id'  => '90',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '14',
            'produto_id'  => '65',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '15',
            'produto_id'  => '20',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '15',
            'produto_id'  => '11',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '15',
            'produto_id'  => '52',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '15',
            'produto_id'  => '110',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '15',
            'produto_id'  => '41',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '15',
            'produto_id'  => '95',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '15',
            'produto_id'  => '64',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '16',
            'produto_id'  => '36',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '16',
            'produto_id'  => '11',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '16',
            'produto_id'  => '50',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '16',
            'produto_id'  => '114',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '16',
            'produto_id'  => '39',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '16',
            'produto_id'  => '90',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '16',
            'produto_id'  => '63',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '17',
            'produto_id'  => '21',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '17',
            'produto_id'  => '2',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '17',
            'produto_id'  => '52',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '17',
            'produto_id'  => '110',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '17',
            'produto_id'  => '47',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '17',
            'produto_id'  => '94',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '17',
            'produto_id'  => '65',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '18',
            'produto_id'  => '19',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '18',
            'produto_id'  => '9',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '18',
            'produto_id'  => '785',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '18',
            'produto_id'  => '110',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '18',
            'produto_id'  => '41',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '18',
            'produto_id'  => '95',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '18',
            'produto_id'  => '64',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '19',
            'produto_id'  => '36',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '19',
            'produto_id'  => '11',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '19',
            'produto_id'  => '50',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '19',
            'produto_id'  => '114',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '19',
            'produto_id'  => '39',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '19',
            'produto_id'  => '90',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '19',
            'produto_id'  => '63',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '20',
            'produto_id'  => '21',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '20',
            'produto_id'  => '2',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '20',
            'produto_id'  => '52',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '20',
            'produto_id'  => '110',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '20',
            'produto_id'  => '47',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '20',
            'produto_id'  => '94',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '20',
            'produto_id'  => '65',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '21',
            'produto_id'  => '19',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '21',
            'produto_id'  => '9',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '21',
            'produto_id'  => '785',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '21',
            'produto_id'  => '110',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '21',
            'produto_id'  => '41',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '21',
            'produto_id'  => '95',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '21',
            'produto_id'  => '64',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '22',
            'produto_id'  => '34',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '22',
            'produto_id'  => '12',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '22',
            'produto_id'  => '58',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '22',
            'produto_id'  => '114',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '22',
            'produto_id'  => '48',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '22',
            'produto_id'  => '90',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '22',
            'produto_id'  => '63',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '23',
            'produto_id'  => '31',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '23',
            'produto_id'  => '11',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '23',
            'produto_id'  => '50',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '23',
            'produto_id'  => '110',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '23',
            'produto_id'  => '39',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '23',
            'produto_id'  => '94',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '23',
            'produto_id'  => '62',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '24',
            'produto_id'  => '21',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '24',
            'produto_id'  => '2',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '24',
            'produto_id'  => '53',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '24',
            'produto_id'  => '110',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '24',
            'produto_id'  => '47',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '24',
            'produto_id'  => '95',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '24',
            'produto_id'  => '65',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '25',
            'produto_id'  => '34',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '25',
            'produto_id'  => '12',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '25',
            'produto_id'  => '58',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '25',
            'produto_id'  => '114',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '25',
            'produto_id'  => '48',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '25',
            'produto_id'  => '90',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '25',
            'produto_id'  => '63',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '26',
            'produto_id'  => '31',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '26',
            'produto_id'  => '11',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '26',
            'produto_id'  => '50',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '26',
            'produto_id'  => '110',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '26',
            'produto_id'  => '39',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '26',
            'produto_id'  => '94',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '26',
            'produto_id'  => '62',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '27',
            'produto_id'  => '21',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '27',
            'produto_id'  => '2',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '27',
            'produto_id'  => '53',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '27',
            'produto_id'  => '110',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '27',
            'produto_id'  => '47',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '27',
            'produto_id'  => '95',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '27',
            'produto_id'  => '65',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '28',
            'produto_id'  => '31',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '28',
            'produto_id'  => '12',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '28',
            'produto_id'  => '58',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '28',
            'produto_id'  => '114',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '28',
            'produto_id'  => '39',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '28',
            'produto_id'  => '90',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '28',
            'produto_id'  => '63',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '29',
            'produto_id'  => '16',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '29',
            'produto_id'  => '11',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '29',
            'produto_id'  => '50',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '29',
            'produto_id'  => '110',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '29',
            'produto_id'  => '47',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '29',
            'produto_id'  => '94',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '29',
            'produto_id'  => '62',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '30',
            'produto_id'  => '21',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '30',
            'produto_id'  => '2',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '30',
            'produto_id'  => '53',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '30',
            'produto_id'  => '110',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '30',
            'produto_id'  => '47',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '30',
            'produto_id'  => '95',
        ]);
        ConjuntoProduto::create([
            'conjunto_id' => '30',
            'produto_id'  => '65',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '31',
            'produto_id'  => '31',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '31',
            'produto_id'  => '12',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '31',
            'produto_id'  => '58',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '31',
            'produto_id'  => '114',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '31',
            'produto_id'  => '39',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '31',
            'produto_id'  => '90',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '31',
            'produto_id'  => '63',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '32',
            'produto_id'  => '16',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '32',
            'produto_id'  => '11',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '32',
            'produto_id'  => '50',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '32',
            'produto_id'  => '110',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '32',
            'produto_id'  => '47',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '32',
            'produto_id'  => '94',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '32',
            'produto_id'  => '62',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '33',
            'produto_id'  => '21',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '33',
            'produto_id'  => '2',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '33',
            'produto_id'  => '53',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '33',
            'produto_id'  => '110',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '33',
            'produto_id'  => '47',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '33',
            'produto_id'  => '95',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '33',
            'produto_id'  => '65',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '34',
            'produto_id'  => '31',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '34',
            'produto_id'  => '14',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '34',
            'produto_id'  => '58',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '34',
            'produto_id'  => '114',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '34',
            'produto_id'  => '39',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '34',
            'produto_id'  => '90',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '34',
            'produto_id'  => '63',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '35',
            'produto_id'  => '16',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '35',
            'produto_id'  => '12',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '35',
            'produto_id'  => '50',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '35',
            'produto_id'  => '110',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '35',
            'produto_id'  => '47',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '35',
            'produto_id'  => '94',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '35',
            'produto_id'  => '62',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '36',
            'produto_id'  => '21',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '36',
            'produto_id'  => '2',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '36',
            'produto_id'  => '53',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '36',
            'produto_id'  => '110',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '36',
            'produto_id'  => '47',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '36',
            'produto_id'  => '95',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '36',
            'produto_id'  => '65',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '37',
            'produto_id'  => '35',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '37',
            'produto_id'  => '14',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '37',
            'produto_id'  => '58',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '37',
            'produto_id'  => '114',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '37',
            'produto_id'  => '39',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '37',
            'produto_id'  => '90',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '37',
            'produto_id'  => '63',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '38',
            'produto_id'  => '16',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '38',
            'produto_id'  => '12',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '38',
            'produto_id'  => '50',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '38',
            'produto_id'  => '110',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '38',
            'produto_id'  => '47',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '38',
            'produto_id'  => '94',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '38',
            'produto_id'  => '62',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '39',
            'produto_id'  => '21',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '39',
            'produto_id'  => '2',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '39',
            'produto_id'  => '53',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '39',
            'produto_id'  => '110',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '39',
            'produto_id'  => '47',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '39',
            'produto_id'  => '95',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '39',
            'produto_id'  => '65',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '40',
            'produto_id'  => '31',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '40',
            'produto_id'  => '11',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '40',
            'produto_id'  => '50',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '40',
            'produto_id'  => '114',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '40',
            'produto_id'  => '39',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '40',
            'produto_id'  => '90',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '40',
            'produto_id'  => '62',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '41',
            'produto_id'  => '16',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '41',
            'produto_id'  => '2',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '41',
            'produto_id'  => '53',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '41',
            'produto_id'  => '110',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '41',
            'produto_id'  => '47',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '41',
            'produto_id'  => '94',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '41',
            'produto_id'  => '65',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '42',
            'produto_id'  => '21',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '42',
            'produto_id'  => '1',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '42',
            'produto_id'  => '53',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '42',
            'produto_id'  => '110',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '42',
            'produto_id'  => '47',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '42',
            'produto_id'  => '95',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '42',
            'produto_id'  => '66',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '43',
            'produto_id'  => '31',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '43',
            'produto_id'  => '11',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '43',
            'produto_id'  => '50',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '43',
            'produto_id'  => '114',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '43',
            'produto_id'  => '39',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '43',
            'produto_id'  => '90',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '43',
            'produto_id'  => '62',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '44',
            'produto_id'  => '16',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '44',
            'produto_id'  => '2',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '44',
            'produto_id'  => '53',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '44',
            'produto_id'  => '110',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '44',
            'produto_id'  => '47',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '44',
            'produto_id'  => '94',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '44',
            'produto_id'  => '65',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '45',
            'produto_id'  => '21',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '45',
            'produto_id'  => '1',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '45',
            'produto_id'  => '53',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '45',
            'produto_id'  => '110',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '45',
            'produto_id'  => '47',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '45',
            'produto_id'  => '95',
        ]);

        ConjuntoProduto::create([
            'conjunto_id' => '45',
            'produto_id'  => '65',
        ]);
*/
    }
}
