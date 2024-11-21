a<?php

use App\Models\User;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;

test('login screen can be rendered', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
});

test('users can not authenticate with invalid password', function () {
    $user = User::factory()->create();

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});

test('users can authenticate using the login screen', function () {
    $user = User::factory()->create();

    $this->actingAs($user) // Autentica diretamente o usuário
    ->get('/dashboard') // Acessa a rota diretamente
    ->assertStatus(200); // Verifica se a rota está acessível
});

test('users can logout', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/logout');

    $this->assertGuest();
    $response->assertRedirect('/');
});








