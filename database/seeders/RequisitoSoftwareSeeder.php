<?php

namespace Database\Seeders;

use App\Models\RequisitoSoftware;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RequisitoSoftwareSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RequisitoSoftware::create([
            'software_id' => 1,
            'requisito_nivel'  => 'Minimo',
            'cpu' => 'Intel Core i3-4150 / AMD Ryzen 3 1200',
            'gpu' => 'Intel HD 3000 / AMD Radeon R5 200',
            'ram' => '4 GB',
            'placa_mae' => 'Compativel com o processador',
            'ssd' => 'SSD de 128 GB (mínimo)',
            'cooler' => 'Cooler padrão e compativel',
            'fonte' => 'Fonte de 400W',
        ]);

        RequisitoSoftware::create([
            'software_id' => 1,
            'requisito_nivel'  => 'Medio',
            'cpu' => 'Intel Core i5-4460 / AMD Ryzen 5 1400',
            'gpu' => 'NVIDIA GeForce GTX 1050 Ti / AMD Radeon RX 570',
            'ram' => '8 GB',
            'placa_mae' => 'Compativel com o processador',
            'ssd' => 'SSD de 256 GB',
            'cooler' => 'Cooler compativel com refrigeração aprimorada',
            'fonte' => 'Fonte de 500W',
        ]);

        RequisitoSoftware::create([
            'software_id' => 1,
            'requisito_nivel'  => 'Recomendado',
            'cpu' => 'Intel Core i7-8700K / AMD Ryzen 7 3700X',
            'gpu' => 'NVIDIA GeForce RTX 2070 Super / AMD Radeon RX 5700 XT',
            'ram' => '16 GB',
            'placa_mae' => 'Compativel com o processador',
            'ssd' => 'SSD de 512 GB',
            'cooler' => 'Cooler compativel avançado ou sistema de refrigeração líquida',
            'fonte' => 'Fonte de 600W',
        ]);

        RequisitoSoftware::create([
            'software_id' => 2,
            'requisito_nivel'  => 'Minimo',
            'cpu' => 'Intel Core i5-4430 / AMD FX-6300',
            'gpu' => 'NVIDIA GeForce GTX 960 2GB / AMD Radeon R7 370 2GB',
            'ram' => '8 GB',
            'placa_mae' => 'Compativel com o processador',
            'ssd' => 'SSD de 256 GB (mínimo)',
            'cooler' => 'Cooler padrão e compativel',
            'fonte' => 'Fonte de 500W',
        ]);

        RequisitoSoftware::create([
            'software_id' => 2,
            'requisito_nivel'  => 'Medio',
            'cpu' => 'Intel Core i5-6600K / AMD Ryzen 5 1600',
            'gpu' => 'NVIDIA GeForce GTX 1060 3GB / AMD Radeon RX 580 4GB',
            'ram' => '16 GB',
            'placa_mae' => 'Compativel com o processador',
            'ssd' => 'SSD de 512 GB',
            'cooler' => 'Cooler compativel com refrigeração aprimorada',
            'fonte' => 'Fonte de 600W',
        ]);

        RequisitoSoftware::create([
            'software_id' => 2,
            'requisito_nivel'  => 'Recomendado',
            'cpu' => 'Intel Core i7-8700K / AMD Ryzen 7 2700X',
            'gpu' => 'NVIDIA GeForce GTX 1080 Ti 4GB / AMD Radeon RX Vega 64 4GB',
            'ram' => '16 GB',
            'placa_mae' => 'Compativel com o processador',
            'ssd' => 'SSD de 512 GB',
            'cooler' => 'Sistema de refrigeração líquida ou cooler de alto desempenho e compatível',
            'fonte' => 'Fonte de 650W',
        ]);

        RequisitoSoftware::create([
            'software_id' => 3,
            'requisito_nivel'  => 'Minimo',
            'cpu' => 'Intel Core i5-8400 / AMD Ryzen 3 3300X',
            'gpu' => 'NVIDIA GeForce GTX 1060 3GB / AMD Radeon RX 580 4GB',
            'ram' => '12 GB',
            'placa_mae' => 'Compatível com o processador',
            'ssd' => 'SSD de 256 GB (mínimo)',
            'cooler' => 'Cooler padrão compatível',
            'fonte' => 'Fonte de 550W',
        ]);

        RequisitoSoftware::create([
            'software_id' => 3,
            'requisito_nivel'  => 'Medio',
            'cpu' => 'Intel Core i5-9600K / AMD Ryzen 5 3600',
            'gpu' => 'NVIDIA GeForce GTX 1070 8GB / AMD Radeon RX Vega 56',
            'ram' => '16 GB',
            'placa_mae' => 'Compatível com o processador',
            'ssd' => 'SSD de 512 GB',
            'cooler' => 'Cooler compatível com refrigeração aprimorada',
            'fonte' => 'Fonte de 600W',
        ]);

        RequisitoSoftware::create([
            'software_id' => 3,
            'requisito_nivel'  => 'Recomendado',
            'cpu' => 'Intel Core i7-8700K / AMD Ryzen 7 3700X',
            'gpu' => 'NVIDIA GeForce RTX 2080 / AMD Radeon RX 5700 XT',
            'ram' => '16 GB',
            'placa_mae' => 'Compatível com o processador',
            'ssd' => 'SSD de 512 GB',
            'cooler' => 'Sistema de refrigeração líquida ou cooler de alto desempenho e compatível',
            'fonte' => 'Fonte de 650W',
        ]);

        RequisitoSoftware::create([
            'software_id' => 4,
            'requisito_nivel'  => 'Minimo',
            'cpu' => 'Intel Core i5-4430 / AMD FX-6300',
            'gpu' => 'NVIDIA GeForce GTX 660 2GB / AMD Radeon HD 7870 2GB',
            'ram' => '8 GB',
            'placa_mae' => 'Compatível com o processador',
            'ssd' => 'SSD de 256 GB',
            'cooler' => 'Cooler padrão compatível',
            'fonte' => 'Fonte de 500W',
        ]);

        RequisitoSoftware::create([
            'software_id' => 4,
            'requisito_nivel'  => 'Medio',
            'cpu' => 'Intel Core i5-3470 / AMD Ryzen 5 1600',
            'gpu' => 'NVIDIA GeForce GTX 1050 Ti 4GB / AMD Radeon RX 570 4GB',
            'ram' => '16 GB',
            'placa_mae' => 'Compatível com o processador',
            'ssd' => 'SSD de 512 GB',
            'cooler' => 'Cooler com refrigeração aprimorada e compatível',
            'fonte' => 'Fonte de 600W',
        ]);

        RequisitoSoftware::create([
            'software_id' => 4,
            'requisito_nivel'  => 'Recomendado',
            'cpu' => 'Intel Core i7-8700K / AMD Ryzen 7 2700X',
            'gpu' => 'NVIDIA GeForce GTX 1080 / AMD Radeon RX Vega 64',
            'ram' => '16 GB',
            'placa_mae' => 'Compatível com o processador',
            'ssd' => 'SSD de 512 GB',
            'cooler' => 'Sistema de refrigeração líquida ou cooler de alto desempenho e compatível',
            'fonte' => 'Fonte de 650W',
        ]);

        RequisitoSoftware::create([
            'software_id' => 5,
            'requisito_nivel'  => 'Minimo',
            'cpu' => 'Intel Core i3-2100 / AMD A6-3620',
            'gpu' => 'Intel HD Graphics 3000 / AMD Radeon HD 6450',
            'ram' => '4 GB',
            'placa_mae' => 'Compatível com o processador',
            'ssd' => 'HD de 250 GB ou SSD de 128 GB',
            'cooler' => 'Cooler padrão e compatível',
            'fonte' => 'Fonte de 400W',
        ]);

        RequisitoSoftware::create([
            'software_id' => 5,
            'requisito_nivel'  => 'Medio',
            'cpu' => 'Intel Core i5-2500K / AMD FX-6300',
            'gpu' => 'Intel HD Graphics 4000 / AMD Radeon R7 250',
            'ram' => '8 GB',
            'placa_mae' => 'Compatível com o processador',
            'ssd' => 'SSD de 256 GB',
            'cooler' => 'Cooler com refrigeração aprimorada e compatível',
            'fonte' => 'Fonte de 450W',
        ]);

        RequisitoSoftware::create([
            'software_id' => 5,
            'requisito_nivel'  => 'Recomendado',
            'cpu' => 'Intel Core i7-3770 / AMD Ryzen 5 1600',
            'gpu' => 'NVIDIA GeForce GTX 1050 Ti / AMD Radeon RX 560',
            'ram' => '16 GB',
            'placa_mae' => 'Compatível com o processador',
            'ssd' => 'SSD de 512 GB',
            'cooler' => 'Cooler de alto desempenho e compatível',
            'fonte' => 'Fonte de 500W',
        ]);

        RequisitoSoftware::create([
            'software_id' => 6,
            'requisito_nivel'  => 'Minimo',
            'cpu' => 'Intel Core i5-2500K / AMD FX-4300',
            'gpu' => 'NVIDIA GeForce GTX 960 / AMD Radeon R7 370',
            'ram' => '8 GB',
            'placa_mae' => 'Compatível com o processador',
            'ssd' => 'SSD de 256 GB ou HD de 500 GB',
            'cooler' => 'Cooler padrão e compatível',
            'fonte' => 'Fonte de 500W',
        ]);

        RequisitoSoftware::create([
            'software_id' => 6,
            'requisito_nivel'  => 'Medio',
            'cpu' => 'Intel Core i5-6600K / AMD Ryzen 5 1600',
            'gpu' => 'NVIDIA GeForce GTX 1060 / AMD Radeon RX 580',
            'ram' => '16 GB',
            'placa_mae' => 'Compatível com o processador',
            'ssd' => 'SSD de 512 GB',
            'cooler' => 'Cooler com refrigeração aprimorada e compatível',
            'fonte' => 'Fonte de 550W',
        ]);

        RequisitoSoftware::create([
            'software_id' => 6,
            'requisito_nivel'  => 'Recomendado',
            'cpu' => 'Intel Core i7-8700K / AMD Ryzen 7 2700X',
            'gpu' => 'NVIDIA GeForce GTX 1080 Ti / AMD Radeon RX Vega 64',
            'ram' => '16 GB',
            'placa_mae' => 'Compatível com o processador',
            'ssd' => 'SSD de 512 GB',
            'cooler' => 'Sistema de refrigeração líquida ou cooler de alto desempenho e compatível',
            'fonte' => 'Fonte de 650W',
        ]);

        RequisitoSoftware::create([
            'software_id' => 7,
            'requisito_nivel'  => 'Minimo',
            'cpu' => 'Intel Core i5-4460 / AMD FX-8120',
            'gpu' => 'NVIDIA GeForce GTX 1050 / AMD Radeon R7 250X',
            'ram' => '8 GB',
            'placa_mae' => 'Compatível com o processador',
            'ssd' => 'SSD de 256 GB (mínimo)',
            'cooler' => 'Cooler padrão e compatível',
            'fonte' => 'Fonte de 500W',
        ]);

        RequisitoSoftware::create([
            'software_id' => 7,
            'requisito_nivel'  => 'Medio',
            'cpu' => 'Intel Core i7-8700 / AMD Ryzen 5 3600',
            'gpu' => 'NVIDIA GeForce GTX 1660 / AMD Radeon RX 580',
            'ram' => '16 GB',
            'placa_mae' => 'Compatível com o processador',
            'ssd' => 'SSD de 512 GB',
            'cooler' => 'Cooler compatível com refrigeração aprimorada e compatível',
            'fonte' => 'Fonte de 600W',
        ]);

        RequisitoSoftware::create([
            'software_id' => 7,
            'requisito_nivel'  => 'Recomendado',
            'cpu' => 'Intel Core i9-9900K / AMD Ryzen 7 3700X',
            'gpu' => 'NVIDIA GeForce RTX 2070 / AMD Radeon RX 5700 XT',
            'ram' => '32 GB',
            'placa_mae' => 'Compatível com o processador',
            'ssd' => 'SSD de 1 TB',
            'cooler' => 'Sistema de refrigeração líquida ou cooler de alto desempenho e compatível',
            'fonte' => 'Fonte de 750W',
        ]);

        RequisitoSoftware::create([
            'software_id' => 8,
            'requisito_nivel'  => 'Minimo',
            'cpu' => 'Intel Core i3-3210 / AMD A8-7600 APU',
            'gpu' => 'Intel HD Graphics 4000 / AMD Radeon R5',
            'ram' => '4 GB',
            'placa_mae' => 'Compatível com o processador',
            'ssd' => 'SSD de 128 GB (mínimo)',
            'cooler' => 'Cooler padrão e compatível',
            'fonte' => 'Fonte de 300W',
        ]);

        RequisitoSoftware::create([
            'software_id' => 8,
            'requisito_nivel'  => 'Medio',
            'cpu' => 'Intel Core i5-4690 / AMD A10-7800 APU',
            'gpu' => 'NVIDIA GeForce 700 Series / AMD Radeon RX 200 Series',
            'ram' => '8 GB',
            'placa_mae' => 'Compatível com o processador',
            'ssd' => 'SSD de 256 GB',
            'cooler' => 'Cooler padrão e compatível',
            'fonte' => 'Fonte de 500W',
        ]);

        RequisitoSoftware::create([
            'software_id' => 8,
            'requisito_nivel'  => 'Recomendado',
            'cpu' => 'Intel Core i7-8700K / AMD Ryzen 7 2700X',
            'gpu' => 'NVIDIA GeForce GTX 1070 / AMD Radeon RX Vega 56',
            'ram' => '16 GB',
            'placa_mae' => 'Compatível com o processador',
            'ssd' => 'SSD de 512 GB',
            'cooler' => 'Cooler de alto desempenho e compatível',
            'fonte' => 'Fonte de 600W',
        ]);

        RequisitoSoftware::create([
            'software_id' => 9,
            'requisito_nivel'  => 'Minimo',
            'cpu' => 'Intel Core i3-2100 / AMD FX-4100',
            'gpu' => 'Integrada (Intel HD Graphics 4000 / AMD Radeon HD 6450)',
            'ram' => '4 GB',
            'placa_mae' => 'Compatível com o processador',
            'ssd' => 'SSD de 256 GB (mínimo)',
            'cooler' => 'Cooler padrão e compatível',
            'fonte' => 'Fonte de 300W',
        ]);

        RequisitoSoftware::create([
            'software_id' => 9,
            'requisito_nivel'  => 'Medio',
            'cpu' => 'Intel Core i5-6500 / AMD Ryzen 5 1500X',
            'gpu' => 'Integrada (Intel HD Graphics 530 / AMD Radeon R7)',
            'ram' => '8 GB',
            'placa_mae' => 'Compatível com o processador',
            'ssd' => 'SSD de 512 GB',
            'cooler' => 'Cooler padrão e compatível',
            'fonte' => 'Fonte de 500W',
        ]);

        RequisitoSoftware::create([
            'software_id' => 9,
            'requisito_nivel'  => 'Recomendado',
            'cpu' => 'Intel Core i7-8700 / AMD Ryzen 7 2700X',
            'gpu' => 'NVIDIA GeForce GTX 1050 / AMD Radeon RX 560',
            'ram' => '16 GB',
            'placa_mae' => 'Compatível com o processador',
            'ssd' => 'SSD de 512 GB',
            'cooler' => 'Cooler de alto desempenho e compatível',
            'fonte' => 'Fonte de 600W',
        ]);


        RequisitoSoftware::create([
            'software_id' => 10,
            'requisito_nivel'  => 'Minimo',
            'cpu' => 'Intel Core i3-2100 / AMD FX-4100',
            'gpu' => 'Integrada (Intel HD Graphics 4000 / AMD Radeon HD 6450)',
            'ram' => '4 GB',
            'placa_mae' => 'Compatível com o processador',
            'ssd' => 'SSD de 256 GB (mínimo)',
            'cooler' => 'Cooler padrão e compatível',
            'fonte' => 'Fonte de 300W',
        ]);

        RequisitoSoftware::create([
            'software_id' => 10,
            'requisito_nivel'  => 'Medio',
            'cpu' => 'Intel Core i5-6500 / AMD Ryzen 5 1500X',
            'gpu' => 'Integrada (Intel HD Graphics 530 / AMD Radeon R7)',
            'ram' => '8 GB',
            'placa_mae' => 'Compatível com o processador',
            'ssd' => 'SSD de 512 GB',
            'cooler' => 'Cooler padrão e compatível',
            'fonte' => 'Fonte de 500W',
        ]);

        RequisitoSoftware::create([
            'software_id' => 10,
            'requisito_nivel'  => 'Recomendado',
            'cpu' => 'Intel Core i7-8700 / AMD Ryzen 7 2700X',
            'gpu' => 'NVIDIA GeForce GTX 1050 / AMD Radeon RX 560',
            'ram' => '16 GB',
            'placa_mae' => 'Compatível com o processador',
            'ssd' => 'SSD de 512 GB',
            'cooler' => 'Cooler de alto desempenho e compatível',
            'fonte' => 'Fonte de 600W',
        ]);

        RequisitoSoftware::create([
            'software_id' => 11,
            'requisito_nivel' => 'Minimo',
            'cpu' => 'Intel Core i3-2100 / AMD FX-4100',
            'gpu' => 'Integrada (Intel HD Graphics 4000 / AMD Radeon HD 6450)',
            'ram' => '4 GB',
            'placa_mae' => 'Compatível com o processador',
            'ssd' => 'SSD de 256 GB (mínimo)',
            'cooler' => 'Cooler padrão e compatível',
            'fonte' => 'Fonte de 300W',
        ]);

        RequisitoSoftware::create([
            'software_id' => 11,
            'requisito_nivel' => 'Medio',
            'cpu' => 'Intel Core i5-6500 / AMD Ryzen 5 1500X',
            'gpu' => 'Integrada (Intel HD Graphics 530 / AMD Radeon R7)',
            'ram' => '8 GB',
            'placa_mae' => 'Compatível com o processador',
            'ssd' => 'SSD de 512 GB',
            'cooler' => 'Cooler padrão e compatível',
            'fonte' => 'Fonte de 500W',
        ]);

        RequisitoSoftware::create([
            'software_id' => 11,
            'requisito_nivel' => 'Recomendado',
            'cpu' => 'Intel Core i7-8700 / AMD Ryzen 7 2700X',
            'gpu' => 'NVIDIA GeForce GTX 1050 / AMD Radeon RX 560',
            'ram' => '16 GB',
            'placa_mae' => 'Compatível com o processador',
            'ssd' => 'SSD de 512 GB',
            'cooler' => 'Cooler de alto desempenho e compatível',
            'fonte' => 'Fonte de 600W',
        ]);

        RequisitoSoftware::create([
            'software_id' => 12,
            'requisito_nivel' => 'Minimo',
            'cpu' => 'Intel Pentium 4 / AMD Athlon 64',
            'gpu' => 'Integrada (Intel HD Graphics 3000 / AMD Radeon HD 5450)',
            'ram' => '2 GB',
            'placa_mae' => 'Compatível com o processador',
            'ssd' => 'HDD de 256 GB (mínimo) ou SSD',
            'cooler' => 'Cooler padrão e compatível',
            'fonte' => 'Fonte de 300W',
        ]);

        RequisitoSoftware::create([
            'software_id' => 12,
            'requisito_nivel' => 'Medio',
            'cpu' => 'Intel Core i3-3220 / AMD FX-4100',
            'gpu' => 'Integrada (Intel HD Graphics 4000 / AMD Radeon R5)',
            'ram' => '4 GB',
            'placa_mae' => 'Compatível com o processador',
            'ssd' => 'SSD de 256 GB',
            'cooler' => 'Cooler padrão e compatível',
            'fonte' => 'Fonte de 400W',
        ]);

        RequisitoSoftware::create([
            'software_id' => 12,
            'requisito_nivel' => 'Recomendado',
            'cpu' => 'Intel Core i5-6500 / AMD Ryzen 5 1400',
            'gpu' => 'NVIDIA GeForce GT 710 / AMD Radeon R7 250',
            'ram' => '8 GB',
            'placa_mae' => 'Compatível com o processador',
            'ssd' => 'SSD de 512 GB',
            'cooler' => 'Cooler de alto desempenho e compatível',
            'fonte' => 'Fonte de 500W',
        ]);

        RequisitoSoftware::create([
            'software_id' => 13,
            'requisito_nivel' => 'Minimo',
            'cpu' => 'Intel Pentium 4 / AMD Athlon 64',
            'gpu' => 'Integrada (Intel HD Graphics 3000 / AMD Radeon HD 5450)',
            'ram' => '1 GB',
            'placa_mae' => 'Compatível com o processador',
            'ssd' => 'HDD de 256 GB ou SSD',
            'cooler' => 'Cooler padrão e compatível',
            'fonte' => 'Fonte de 300W',
        ]);

        RequisitoSoftware::create([
            'software_id' => 13,
            'requisito_nivel' => 'Medio',
            'cpu' => 'Intel Core i3-2100 / AMD FX-4100',
            'gpu' => 'Integrada (Intel HD Graphics 4000 / AMD Radeon R5)',
            'ram' => '2 GB',
            'placa_mae' => 'Compatível com o processador',
            'ssd' => 'SSD de 256 GB',
            'cooler' => 'Cooler padrão e compatível',
            'fonte' => 'Fonte de 400W',
        ]);

        RequisitoSoftware::create([
            'software_id' => 13,
            'requisito_nivel' => 'Recomendado',
            'cpu' => 'Intel Core i5-6500 / AMD Ryzen 5 1400',
            'gpu' => 'NVIDIA GeForce GT 710 / AMD Radeon R7 240',
            'ram' => '4 GB',
            'placa_mae' => 'Compatível com o processador',
            'ssd' => 'SSD de 512 GB',
            'cooler' => 'Cooler de alto desempenho e compatível',
            'fonte' => 'Fonte de 500W',
        ]);

        RequisitoSoftware::create([
            'software_id' => 14,
            'requisito_nivel' => 'Minimo',
            'cpu' => 'Intel Core 2 Duo / AMD Athlon 64 X2',
            'gpu' => 'Integrada (Intel HD Graphics 3000 / AMD Radeon HD 5450)',
            'ram' => '4 GB',
            'placa_mae' => 'Compatível com o processador',
            'ssd' => 'HDD de 5 GB de espaço livre ou SSD',
            'cooler' => 'Cooler padrão e compatível',
            'fonte' => 'Fonte de 300W',
        ]);

        RequisitoSoftware::create([
            'software_id' => 14,
            'requisito_nivel' => 'Medio',
            'cpu' => 'Intel Core i3-2100 / AMD FX-4100',
            'gpu' => 'Integrada (Intel HD Graphics 4000 / AMD Radeon R5)',
            'ram' => '8 GB',
            'placa_mae' => 'Compatível com o processador',
            'ssd' => 'SSD de 256 GB com pelo menos 10 GB livres',
            'cooler' => 'Cooler padrão e compatível',
            'fonte' => 'Fonte de 400W',
        ]);

        RequisitoSoftware::create([
            'software_id' => 14,
            'requisito_nivel' => 'Recomendado',
            'cpu' => 'Intel Core i5-6500 / AMD Ryzen 5 1600',
            'gpu' => 'NVIDIA GeForce GTX 1050 / AMD Radeon RX 560',
            'ram' => '16 GB',
            'placa_mae' => 'Compatível com o processador',
            'ssd' => 'SSD de 512 GB com pelo menos 20 GB livres',
            'cooler' => 'Cooler de alto desempenho e compatível',
            'fonte' => 'Fonte de 500W',
        ]);

        RequisitoSoftware::create([
            'software_id' => 15,
            'requisito_nivel' => 'Minimo',
            'cpu' => 'Intel Core 2 Duo / AMD Athlon 64',
            'gpu' => 'Integrada (Intel HD Graphics 3000 / AMD Radeon HD 5450)',
            'ram' => '2 GB',
            'placa_mae' => 'Compatível com o processador',
            'ssd' => 'HDD de 256 GB ou SSD',
            'cooler' => 'Cooler padrão e compatível',
            'fonte' => 'Fonte de 300W',
        ]);

        RequisitoSoftware::create([
            'software_id' => 15,
            'requisito_nivel' => 'Medio',
            'cpu' => 'Intel Core i3-2100 / AMD FX-4100',
            'gpu' => 'Integrada (Intel HD Graphics 4000 / AMD Radeon R5)',
            'ram' => '4 GB',
            'placa_mae' => 'Compatível com o processador',
            'ssd' => 'SSD de 256 GB',
            'cooler' => 'Cooler padrão e compatível',
            'fonte' => 'Fonte de 400W',
        ]);

        RequisitoSoftware::create([
            'software_id' => 15,
            'requisito_nivel' => 'Recomendado',
            'cpu' => 'Intel Core i5-6500 / AMD Ryzen 5 1400',
            'gpu' => 'NVIDIA GeForce GTX 1050 / AMD Radeon RX 560',
            'ram' => '8 GB',
            'placa_mae' => 'Compatível com o processador',
            'ssd' => 'SSD de 512 GB',
            'cooler' => 'Cooler de alto desempenho e compatível',
            'fonte' => 'Fonte de 500W',
        ]);
    }
}
