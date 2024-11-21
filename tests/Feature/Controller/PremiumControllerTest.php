<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);
beforeEach(function () {
    // Cria e autentica um administrador para passar pelo middleware
    $this->admin = Admin::factory()->create();
    $this->actingAs($this->admin, 'admin');
});

//index
it('Rota index retorna a lista de usuários premium e responde com 200', function () {
    // Cria e autentica um administrador para passar pelo middleware
    $admin = Admin::factory()->create();
    $this->actingAs($admin, 'admin'); // Autentica o administrador no guard 'admin'

    // Cria 15 usuários premium (mais do que o limite de 10 por página)
    User::factory()->count(15)->create(['situacao' => 'premium']);

    // Envia uma requisição GET para a rota de index de usuários premium
    $response = $this->get('/usuario-premium');

    // Verifica se a resposta está correta (200 OK)
    $response->assertStatus(200);

    // Verifica se a view correta foi carregada
    $response->assertViewIs('premium.index');

    // Verifica se os usuários premium paginados estão presentes na view
    $response->assertViewHas('usuarios', function ($viewUsuarios) {
        return $viewUsuarios->count() === 10; // Verifica se a paginação está correta (10 por página)
    });

    // Verifica se os primeiros 10 usuários premium aparecem na view
    $usuariosPaginados = User::where('situacao', 'premium')->paginate(10);
    foreach ($usuariosPaginados as $usuario) {
        $response->assertSee($usuario->name); // Verifica se o nome dos usuários aparece na view
    }
});

it('carrega a rota index e exibe a view correta', function () {
    // Faz uma requisição GET para a rota index
    $response = $this->get('/usuario-premium');

    // Verifica se a resposta é 200 (OK)
    $response->assertStatus(200);

    // Verifica se a view correta é carregada
    $response->assertViewIs('premium.index');
});

it('retorna a lista de usuários premium paginada na view', function () {
    // Cria 15 usuários premium, mais que o limite de 10 por página
    User::factory()->count(15)->create(['situacao' => 'premium']);

    // Faz uma requisição GET para a rota index
    $response = $this->get('/usuario-premium');

    // Verifica se a view contém a variável `usuarios`
    $response->assertViewHas('usuarios');

    // Confirma que a variável `usuarios` na view contém 10 itens (página 1)
    $response->assertViewHas('usuarios', function ($viewUsuarios) {
        return $viewUsuarios->count() === 10;
    });
});

it('exibe os usuários premium na view da rota index', function () {
    // Cria alguns usuários para verificar na view
    $users = User::factory()->count(3)->create(['situacao' => 'premium']);

    // Faz uma requisição GET para a rota index
    $response = $this->get('/usuario-premium');

    // Verifica que os nomes dos usuários estão na view
    foreach ($users as $user) {
        $response->assertSee($user->name);
    }
});

it('retorna view sem usuários quando o banco está vazio', function () {
    // Certifica-se de que não há usuários criados
    User::query()->delete();

    // Faz uma requisição GET para a rota index
    $response = $this->get('/usuario-premium');

    // Verifica que a view contém a variável `usuarios`, mas está vazia
    $response->assertViewHas('usuarios', function ($viewUsuarios) {
        return $viewUsuarios->isEmpty();
    });
});

it('verifica que a rota index está protegida pelo middleware AdminAuthenticated', function () {
    // Desloga qualquer usuário logado
    auth()->logout();

    // Faz uma requisição GET para a rota index sem autenticação de admin
    $response = $this->get('/usuario-premium');

    // Verifica o redirecionamento para a página de login
    $response->assertRedirect('/login-admin');
});

//create
it('carrega a rota create e exibe a view correta', function () {
    // Faz uma requisição GET para a rota create
    $response = $this->get('/usuario-premium/create');

    // Verifica se a resposta é 200 (OK)
    $response->assertStatus(200);

    // Verifica se a view correta é carregada
    $response->assertViewIs('premium.createPremium');
});

it('exibe o formulário de criação de usuário premium', function () {
    // Faz uma requisição GET para a rota create
    $response = $this->get('/usuario-premium/create');

    // Verifica a presença de elementos específicos de um formulário
    $response->assertSee('<form', false);
    $response->assertSee('name="nome"', false);
    $response->assertSee('name="email"', false);
    $response->assertSee('name="password"', false);
    $response->assertSee('name="situacao"', false);
    $response->assertSee('type="submit"', false);
});

it('verifica que a rota create está protegida pelo middleware AdminAuthenticated', function () {
    // Desloga qualquer usuário logado
    auth()->logout();

    // Faz uma requisição GET para a rota create sem autenticação de admin
    $response = $this->get('/usuario-premium/create');

    // Verifica o redirecionamento para a página de login
    $response->assertRedirect('/login-admin');
});

//store
it('cadastra um novo usuário premium com dados válidos e responde com 302', function () {
    $userData = [
        'nome' => 'Usuário Teste',
        'email' => 'usuarioteste@example.com',
        'situacao' => 'premium',
        'password' => 'password123',
    ];

    // Envia uma requisição POST para a rota store
    $response = $this->post('/usuario-premium', $userData);

    // Verifica o redirecionamento para a rota correta
    $response->assertStatus(302);
    $response->assertRedirect(route('usuario-premium.index'));

    // Verifica se o usuário foi salvo no banco de dados
    $this->assertDatabaseHas('users', [
        'name' => 'Usuário Teste',
        'email' => 'usuarioteste@example.com',
        'situacao' => 'premium',
    ]);

    // Verifica se a senha foi criptografada corretamente
    $user = User::where('email', 'usuarioteste@example.com')->first();
    expect(Hash::check('password123', $user->password))->toBeTrue();

    // Verifica se a sessão contém a mensagem de sucesso
    $response->assertSessionHas('success', 'Usuário criado com sucesso!');
});

it('falha ao cadastrar usuário com email duplicado e exibe erro de validação', function () {
    // Cria um usuário com um email específico
    User::factory()->create(['email' => 'duplicado@example.com']);

    $userData = [
        'nome' => 'Usuário Duplicado',
        'email' => 'duplicado@example.com', // Email duplicado
        'situacao' => 'premium',
        'password' => 'password123',
    ];

    // Envia uma requisição POST para a rota store
    $response = $this->post('/usuario-premium', $userData);

    // Verifica se o redirecionamento para a página de criação ocorreu
    $response->assertStatus(302);
    $response->assertSessionHasErrors(['email' => 'O email informado já está em uso. Por favor, escolha outro.']);
});

it('falha ao cadastrar usuário quando campo obrigatório está ausente', function () {
    $userData = [
        // Nome ausente
        'email' => 'usuariosemnome@example.com',
        'situacao' => 'premium',
        'password' => 'password123',
    ];

    // Envia uma requisição POST para a rota store
    $response = $this->post('/usuario-premium', $userData);

    // Verifica se o redirecionamento para a página de criação ocorreu
    $response->assertStatus(302);

    // Verifica se os erros de validação estão presentes na sessão
    $response->assertSessionHasErrors(['nome']);
});

it('falha ao cadastrar usuário com senha curta', function () {
    $userData = [
        'nome' => 'Usuário Teste',
        'email' => 'senhacurta@example.com',
        'situacao' => 'premium',
        'password' => '123', // Senha curta
    ];

    // Envia uma requisição POST para a rota store
    $response = $this->post('/usuario-premium', $userData);

    // Verifica se o redirecionamento para a página de criação ocorreu
    $response->assertStatus(302);

    // Verifica se os erros de validação estão presentes na sessão
    $response->assertSessionHasErrors(['password']);
});

it('verifica que a rota store está protegida pelo middleware AdminAuthenticated', function () {
    // Desloga qualquer usuário logado
    auth()->logout();

    $userData = [
        'nome' => 'Usuário Teste',
        'email' => 'usuarioteste@example.com',
        'situacao' => 'premium',
        'password' => 'password123',
    ];

    // Envia uma requisição POST para a rota store sem autenticação de admin
    $response = $this->post('/usuario-premium', $userData);

    // Verifica o redirecionamento para a página de login
    $response->assertRedirect('/login-admin');
});

//show
it('exibe resultados de busca por nome', function () {
    // Cria usuários com nomes específicos
    $user1 = User::factory()->create(['name' => 'Premium User']);
    $user2 = User::factory()->create(['name' => 'Regular User']);

    // Faz uma requisição GET para buscar "Premium"
    $response = $this->get('/usuario-premium/search?search=Premium');

    // Verifica se a view correta foi carregada
    $response->assertStatus(200);
    $response->assertViewIs('premium.searchPremium');

    // Verifica se o usuário correspondente está na view
    $response->assertViewHas('results', function ($results) use ($user1) {
        return $results->contains('id', $user1->id);
    });

    // Verifica que o nome "Regular User" não aparece na busca
    $response->assertDontSee($user2->name);
});

it('exibe resultados de busca por ID', function () {
    $user = User::factory()->create();

    // Faz uma requisição GET para buscar o ID do usuário
    $response = $this->get('/usuario-premium/search?search=' . $user->id);

    // Verifica se o usuário aparece nos resultados
    $response->assertStatus(200);
    $response->assertViewIs('premium.searchPremium');
    $response->assertViewHas('results', function ($results) use ($user) {
        return $results->contains('id', $user->id);
    });
});

it('exibe resultados de busca por situação', function () {
    // Cria usuários com diferentes situações
    $premiumUser = User::factory()->create(['situacao' => 'premium']);
    $regularUser = User::factory()->create(['situacao' => 'regular']);

    // Faz uma requisição GET para buscar pela situação "premium"
    $response = $this->get('/usuario-premium/search?search=premium');

    // Verifica se o usuário "premium" está nos resultados
    $response->assertStatus(200);
    $response->assertViewHas('results', function ($results) use ($premiumUser) {
        return $results->contains('id', $premiumUser->id);
    });

    // Verifica que o usuário "regular" não aparece na busca
    $response->assertDontSee($regularUser->name);
});

it('exibe resultados de busca por e-mail', function () {
    $user = User::factory()->create(['email' => 'testuser@example.com']);

    // Faz uma requisição GET para buscar pelo e-mail
    $response = $this->get('/usuario-premium/search?search=testuser@example.com');

    // Verifica se o usuário aparece nos resultados
    $response->assertStatus(200);
    $response->assertViewHas('results', function ($results) use ($user) {
        return $results->contains('id', $user->id);
    });
});

it('exibe resultados de busca paginados', function () {
    // Cria 15 usuários premium para preencher mais de uma página
    User::factory()->count(15)->create(['situacao' => 'premium']);

    // Faz uma requisição GET para buscar todos os usuários com situação "premium" e vai para a segunda página
    $response = $this->get('/usuario-premium/search?search=premium&page=2');

    // Verifica se a view contém a variável `results`
    $response->assertStatus(200);
    $response->assertViewIs('premium.searchPremium');

    // Verifica se a segunda página de resultados contém 5 usuários
    $response->assertViewHas('results', function ($results) {
        return $results->count() === 5;
    });
});

it('verifica que a rota show está protegida pelo middleware AdminAuthenticated', function () {
    // Desloga qualquer usuário logado
    auth()->logout();

    // Faz uma requisição GET para a rota show sem autenticação de admin
    $response = $this->get('/usuario-premium/search?search=teste');

    // Verifica o redirecionamento para a página de login
    $response->assertRedirect('/login-admin');
});

//edit
it('carrega o formulário de edição para um usuário existente e responde com 200', function () {
    // Cria um usuário para edição
    $user = User::factory()->create();

    // Faz uma requisição GET para a rota edit do usuário
    $response = $this->get("/usuario-premium/{$user->id}/edit");

    // Verifica se a resposta é 200 (OK)
    $response->assertStatus(200);

    // Verifica se a view correta foi carregada
    $response->assertViewIs('premium.editPremium');

    // Verifica se o usuário é passado para a view
    $response->assertViewHas('usuarios', function ($viewUser) use ($user) {
        return $viewUser->id === $user->id;
    });

    // Verifica se o nome e email do usuário estão visíveis na página de edição
    $response->assertSee($user->name);
    $response->assertSee($user->email);
});

it('retorna 500 quando o usuário não existe', function () {
    // ID de usuário inexistente
    $nonExistentId = 999;

    // Faz uma requisição GET para a rota edit com um ID inexistente
    $response = $this->get("/usuario-premium/{$nonExistentId}/edit");

    $response->assertStatus(500);
});

it('exibe o formulário de edição com os campos corretos', function () {
    $user = User::factory()->create();

    // Faz uma requisição GET para a rota edit
    $response = $this->get("/usuario-premium/{$user->id}/edit");

    // Verifica a presença de elementos de formulário
    $response->assertSee('<form', false); // Verifica o formulário
    $response->assertSee('name="nome"', false); // Campo de nome
    $response->assertSee('name="email"', false); // Campo de email
    $response->assertSee('name="situacao"', false); // Campo de situação
    $response->assertSee('type="submit"', false); // Botão de envio
});

it('verifica que a rota edit está protegida pelo middleware AdminAuthenticated', function () {
    // Desloga qualquer usuário logado
    auth()->logout();

    // Faz uma requisição GET para a rota edit sem autenticação de admin
    $response = $this->get('/usuario-premium/1/edit');

    // Verifica o redirecionamento para a página de login
    $response->assertRedirect('/login-admin');
});

//update
it('atualiza um usuário existente com dados válidos e responde com 302', function () {
    $user = User::factory()->create([
        'name' => 'User Antigo',
        'email' => 'userantigo@example.com',
        'situacao' => 'regular'
    ]);

    // Dados de atualização
    $updatedData = [
        'nome' => 'User Atualizado',
        'email' => 'useratualizado@example.com',
        'situacao' => 'premium',
        'password' => 'newpassword123', // Nova senha
    ];

    // Envia uma requisição PUT para a rota update
    $response = $this->put("/usuario-premium/{$user->id}", $updatedData);

    // Verifica se o redirecionamento para a rota correta foi feito
    $response->assertStatus(302);
    $response->assertRedirect(route('usuario-premium.index'));

    // Verifica se o usuário foi atualizado no banco de dados
    $this->assertDatabaseHas('users', [
        'id' => $user->id,
        'name' => 'User Atualizado',
        'email' => 'useratualizado@example.com',
        'situacao' => 'premium',
    ]);

    // Verifica se a senha foi atualizada corretamente
    $this->assertTrue(Hash::check('newpassword123', $user->fresh()->password));

    // Verifica se a sessão contém a mensagem de sucesso
    $response->assertSessionHas('success', 'Usuário atualizado com sucesso!');
});

it('atualiza um usuário sem modificar a senha quando o campo de senha está vazio', function () {
    $user = User::factory()->create([
        'name' => 'User Original',
        'email' => 'useroriginal@example.com',
        'situacao' => 'premium',
        'password' => Hash::make('originalpassword')
    ]);

    // Dados de atualização (sem senha)
    $updatedData = [
        'nome' => 'User Atualizado',
        'email' => 'useratualizado@example.com',
        'situacao' => 'regular',
        'password' => null, // Campo de senha vazio
    ];

    // Envia uma requisição PUT para a rota update
    $response = $this->put("/usuario-premium/{$user->id}", $updatedData);

    // Verifica se a senha não foi alterada
    $this->assertTrue(Hash::check('originalpassword', $user->fresh()->password));
});

it('falha ao atualizar usuário com email já existente', function () {
    $user1 = User::factory()->create(['email' => 'user1@example.com']);
    $user2 = User::factory()->create(['email' => 'user2@example.com']);

    // Dados de atualização com email duplicado
    $updatedData = [
        'nome' => 'Usuário Atualizado',
        'email' => 'user1@example.com', // Email de outro usuário
        'situacao' => 'premium',
    ];

    // Envia uma requisição PUT para a rota update
    $response = $this->from("/usuario-premium/{$user2->id}/edit")
        ->put("/usuario-premium/{$user2->id}", $updatedData);

    // Verifica se o redirecionamento ocorreu para a página de edição
    $response->assertStatus(302);
    $response->assertSessionHasErrors(['email']);
});

it('falha ao atualizar usuário com senha curta', function () {
    $user = User::factory()->create();

    // Dados de atualização com senha curta
    $updatedData = [
        'nome' => 'Usuário Atualizado',
        'email' => 'useratualizado@example.com',
        'situacao' => 'premium',
        'password' => '123', // Senha muito curta
    ];

    // Envia uma requisição PUT para a rota update
    $response = $this->put("/usuario-premium/{$user->id}", $updatedData);

    // Verifica se o redirecionamento ocorreu para a página de edição
    $response->assertStatus(302);
    $response->assertSessionHasErrors(['password']);
});

it('falha ao atualizar usuário quando um campo obrigatório está ausente', function () {
    $user = User::factory()->create();

    // Dados de atualização com campo ausente
    $updatedData = [
        'nome' => '', // Nome ausente
        'email' => 'useratualizado@example.com',
        'situacao' => 'premium',
    ];

    // Envia uma requisição PUT para a rota update
    $response = $this->put("/usuario-premium/{$user->id}", $updatedData);

    // Verifica se os erros de validação estão presentes na sessão
    $response->assertStatus(302);
    $response->assertSessionHasErrors(['nome']);
});

it('verifica que a rota update está protegida pelo middleware AdminAuthenticated', function () {
    // Desloga qualquer usuário logado
    auth()->logout();

    // Dados de atualização válidos
    $updatedData = [
        'nome' => 'Usuário Atualizado',
        'email' => 'useratualizado@example.com',
        'situacao' => 'premium',
        'password' => 'newpassword123',
    ];

    // Faz uma requisição PUT para a rota update sem autenticação de admin
    $response = $this->put('/usuario-premium/1', $updatedData);

    // Verifica o redirecionamento para a página de login
    $response->assertRedirect('/login-admin');
});

//destroy
it('exclui um usuário com sucesso e redireciona', function () {
    $user = User::factory()->create();

    // Envia a requisição DELETE para a rota destroy com o token CSRF
    $response = $this->delete("/usuario-premium/{$user->id}", [
        '_token' => csrf_token(),
    ]);

    // Verifica o redirecionamento após a exclusão
    $response->assertStatus(302);
    $response->assertRedirect(route('usuario-premium.index'));

    // Verifica se o usuário foi removido do banco de dados
    $this->assertDatabaseMissing('users', ['id' => $user->id]);
});

it('redireciona sem excluir o usuário quando o token CSRF está ausente', function () {
    $user = User::factory()->create();

    // Envia a requisição DELETE para a rota destroy sem o token CSRF
    $response = $this->delete("/usuario-premium/{$user->id}");

    // Verifica o redirecionamento após a falha de exclusão
    $response->assertStatus(302);
    $response->assertRedirect(route('usuario-premium.index'));

    // Verifica se o usuário ainda existe no banco de dados (não foi excluído)
    $this->assertDatabaseHas('users', ['id' => $user->id]);
});

it('retorna 404 ao tentar excluir um usuário inexistente', function () {
    $nonExistentId = 999; // ID de usuário inexistente

    // Envia a requisição DELETE para a rota destroy com um ID inexistente
    $response = $this->delete("/usuario-premium/{$nonExistentId}", [
        '_token' => csrf_token(),
    ]);

    // Verifica se a resposta é 404 (Não Encontrado)
    $response->assertStatus(404);
});

it('verifica que a rota destroy está protegida pelo middleware AdminAuthenticated', function () {
    // Desloga qualquer usuário logado
    auth()->logout();

    // Envia uma requisição DELETE para a rota destroy sem autenticação de admin
    $response = $this->delete('/usuario-premium/1', [
        '_token' => csrf_token(),
    ]);

    // Verifica o redirecionamento para a página de login
    $response->assertRedirect('/login-admin');
});
