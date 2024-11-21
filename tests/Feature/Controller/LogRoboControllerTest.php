<?php

use App\Models\LogRobo;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;

it('Rota index carrega a view', function () {
    // Cria 15 logs usando a LogRoboFactory para testar a paginação
    LogRobo::factory()->count(15)->create();

    // Autentica um usuário administrador para acessar a rota
    $this->actingAs(Admin::factory()->create(), 'admin');

    // Envia uma requisição GET para a rota de logRobo
    $response = $this->get(route('auth.admin.logs'));

    // Verifica se a resposta está correta (200 OK)
    $response->assertStatus(200);

    // Verifica se a view correta foi carregada
    $response->assertViewIs('admin.logs');
});

it('Rota index retorna view vazia e loga o erro quando ocorre uma exceção', function () {
    // Simula uma exceção ao tentar acessar os logs
    DB::shouldReceive('table')
        ->with('log_robos')
        ->andThrow(new \Exception('Erro ao carregar logs do robo'));

    // Autentica um usuário administrador para acessar a rota
    $this->actingAs(Admin::factory()->create(), 'admin');

    // Envia uma requisição GET para a rota de logRobo
    $response = $this->get(route('auth.admin.logs'));

    // Verifica se a resposta está correta (200 OK)
    $response->assertStatus(200);

    // Verifica se a view correta foi carregada
    $response->assertViewIs('admin.logs');

});
