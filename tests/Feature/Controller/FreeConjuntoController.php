<?php

use App\Models\Software;
use App\Models\RequisitoSoftware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;

it('falha na validação quando menos de 1 ou mais de 3 softwares são selecionados', function () {
    // Teste com nenhum software selecionado
    $response = $this->postJson(route('free.selecionar'), [
        'softwares' => [],
    ]);

    $response->assertStatus(422); // Erro de validação
    $response->assertJsonValidationErrors('softwares');

    // Teste com 4 softwares selecionados
    $softwareIds = Software::factory()->count(4)->create()->pluck('id')->toArray();
    $response = $this->postJson(route('free.selecionar'), [
        'softwares' => $softwareIds,
    ]);

    $response->assertStatus(422); // Erro de validação
    $response->assertJsonValidationErrors('softwares');
});

it('falha quando um software selecionado não existe', function () {
    // Cria 2 softwares e tenta enviar um ID inexistente
    $softwareIds = Software::factory()->count(2)->create()->pluck('id')->toArray();
    $softwareIds[] = 999; // ID inexistente

    $response = $this->postJson(route('free.selecionar'), [
        'softwares' => $softwareIds,
    ]);

    $response->assertStatus(422); // Erro de validação
    $response->assertJsonValidationErrors('softwares.2');
});

it('retorna corretamente o software mais pesado e seus requisitos', function () {
    // Cria 3 softwares com pesos variados
    $software1 = Software::factory()->create(['peso' => 100]);
    $software2 = Software::factory()->create(['peso' => 200]); // Mais pesado
    $software3 = Software::factory()->create(['peso' => 150]);

    // Cria requisitos para o software mais pesado
    RequisitoSoftware::factory()->create([
        'software_id' => $software2->id,
        'requisito_nivel' => 'Minimo',
        'cpu' => 'Intel i3',
        'gpu' => 'GTX 1050',
        'ram' => '8GB',
        'placa_mae' => 'Asus B350',
        'ssd' => '256GB',
        'cooler' => 'Cooler A',
        'fonte' => '500W',
    ]);

    RequisitoSoftware::factory()->create([
        'software_id' => $software2->id,
        'requisito_nivel' => 'Medio',
        'cpu' => 'Intel i5',
        'gpu' => 'GTX 1060',
        'ram' => '16GB',
        'placa_mae' => 'Asus B450',
        'ssd' => '512GB',
        'cooler' => 'Cooler B',
        'fonte' => '600W',
    ]);

    RequisitoSoftware::factory()->create([
        'software_id' => $software2->id,
        'requisito_nivel' => 'Recomendado',
        'cpu' => 'Intel i7',
        'gpu' => 'GTX 1070',
        'ram' => '32GB',
        'placa_mae' => 'Asus B550',
        'ssd' => '1TB',
        'cooler' => 'Cooler C',
        'fonte' => '750W',
    ]);

    // Envia a requisição com os IDs dos softwares
    $response = $this->postJson(route('free.selecionar'), [
        'softwares' => [$software1->id, $software2->id, $software3->id],
    ]);

    // Verifica se a resposta está correta (200 OK)
    $response->assertStatus(200);

    // Verifica se o software mais pesado é o esperado
    $response->assertJson([
        'software_mais_pesado' => [
            'id' => $software2->id,
            'peso' => $software2->peso,
        ],
    ]);

    // Verifica se os requisitos são retornados corretamente e agrupados por nível
    $response->assertJsonStructure([
        'requisitos' => [
            'Minimo' => [
                '*' => ['cpu', 'gpu', 'ram', 'placa_mae', 'ssd', 'cooler', 'fonte'],
            ],
            'Medio' => [
                '*' => ['cpu', 'gpu', 'ram', 'placa_mae', 'ssd', 'cooler', 'fonte'],
            ],
            'Recomendado' => [
                '*' => ['cpu', 'gpu', 'ram', 'placa_mae', 'ssd', 'cooler', 'fonte'],
            ],
        ],
    ]);

    // Confirma que os requisitos mínimos, médios e recomendados estão corretos
    $response->assertJsonFragment([
        'cpu' => 'Intel i3',
        'gpu' => 'GTX 1050',
        'ram' => '8GB',
        'placa_mae' => 'Asus B350',
    ]);
    $response->assertJsonFragment([
        'cpu' => 'Intel i5',
        'gpu' => 'GTX 1060',
        'ram' => '16GB',
        'placa_mae' => 'Asus B450',
    ]);
    $response->assertJsonFragment([
        'cpu' => 'Intel i7',
        'gpu' => 'GTX 1070',
        'ram' => '32GB',
        'placa_mae' => 'Asus B550',
    ]);
});

it('retorna 404 se nenhum software é encontrado com os IDs fornecidos', function () {
    // Envia uma requisição com IDs de softwares que não existem
    $response = $this->postJson(route('free.selecionar'), [
        'softwares' => [999, 998, 997],
    ]);

    // Verifica se a resposta está correta (404 Not Found)
    $response->assertStatus(422);

    // Verifica a mensagem de erro
    $response->assertJson([
        'message' => 'The selected softwares.0 is invalid. (and 2 more errors)',
    ]);
});

