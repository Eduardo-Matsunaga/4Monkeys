<?php

use App\Models\Admin;
use App\Models\CustomLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;

it('Rota index carrega a view de logs com dados paginados', function () {
    // Cria 15 logs para verificar a paginação e conteúdo da view
    CustomLog::factory()->count(15)->create();

    // Autentica um usuário administrador para acessar a rota
    $this->actingAs(Admin::factory()->create(), 'admin');

    // Envia uma requisição GET para a rota de logs
    $response = $this->get(route('auth.admin.logs'));

    // Verifica se a resposta está correta (200 OK)
    $response->assertStatus(200);

    // Verifica se a view correta foi carregada
    $response->assertViewIs('admin.logs');

    // Verifica se os logs estão presentes na view e são paginados (10 por página)
    $response->assertViewHas('custom_log', function ($viewLogs) {
        return $viewLogs->count() === 10; // Confirma que a primeira página contém 10 logs
    });
});





