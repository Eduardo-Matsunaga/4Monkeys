<?php

use App\Models\Software;
use Illuminate\Foundation\Testing\RefreshDatabase;

it('Rota getChartData retorna o total de softwares e seus IDs em formato JSON', function () {
    // Cria 5 softwares para teste
    $softwares = Software::factory()->count(5)->create();

    // Envia uma requisição GET para a rota de dados do gráfico
    $response = $this->getJson('/api/charts-data');

    // Verifica se a resposta está correta (200 OK)
    $response->assertStatus(200);

    // Verifica se a resposta contém o total correto de softwares
    $response->assertJson([
        'total_softwares' => 5,
    ]);

    // Verifica se a resposta contém todos os IDs dos softwares criados
    $softwareIds = $softwares->pluck('id')->toArray();
    $response->assertJson([
        'software_ids' => $softwareIds,
    ]);
});

it('Rota getChartData retorna total de softwares como zero quando não há softwares', function () {
    // Certifica-se de que não há softwares no banco de dados
    Software::query()->delete();

    // Envia uma requisição GET para a rota de dados do gráfico
    $response = $this->getJson('/api/charts-data');

    // Verifica se a resposta está correta (200 OK)
    $response->assertStatus(200);

    // Verifica se o total de softwares é zero
    $response->assertJson([
        'total_softwares' => 0,
        'software_ids' => [],
    ]);
});
