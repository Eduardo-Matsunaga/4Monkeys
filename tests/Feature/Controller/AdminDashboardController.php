<?php

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;

beforeEach(function () {
$this->authenticatedAdmin = Admin::factory()->create();
$this->actingAs($this->authenticatedAdmin, 'admin'); // Autentica o administrador no guard 'admin'
});

it('Rota index carrega a view de dashboard com administradores paginados', function () {
// Criação de 15 administradores, mais do que o limite de uma página (10)
Admin::factory()->count(15)->create();

// Envia uma requisição GET para a rota de index do dashboard de administradores
$response = $this->get('/dashboard-admin');

// Verifica se a resposta está correta (200 OK)
$response->assertStatus(200);

// Verifica se a view correta foi carregada
$response->assertViewIs('admin.dashboard');

// Verifica se a view contém administradores paginados (10 por página)
$response->assertViewHas('admins', function ($viewAdmins) {
return $viewAdmins->count() === 10; // Confirma a paginação com 10 administradores na primeira página
});
});

it('Rota index exibe uma mensagem adequada se não houver administradores', function () {
// Limpa todos os administradores para simular a ausência de dados
Admin::query()->delete();

// Envia uma requisição GET para a rota de index do dashboard de administradores
$response = $this->get('/dashboard-admin');

// Verifica se a resposta está correta (200 OK)
$response->assertStatus(200);

// Verifica se a view correta foi carregada
$response->assertViewIs('admin.dashboard');

// Verifica se a view não contém administradores
$response->assertViewHas('admins', function ($viewAdmins) {
return $viewAdmins->isEmpty(); // Confirma que não há administradores
});
});
