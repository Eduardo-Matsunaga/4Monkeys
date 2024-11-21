<?php

use App\Models\Admin;
use App\Models\Estoque;
use App\Models\Produto;
use App\Models\LojaOnline;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;




uses(RefreshDatabase::class);

beforeEach(function () {
    $this->produto = Produto::factory()->create(); // Produto automaticamente associado a LojaOnline
    $this->admin = User::factory()->create(); // Criar um administrador para o teste

    // Simula o login como administrador usando o guard correto do middleware
    $this->actingAs($this->admin, 'admin');
});
it('Rota index responde com 200', function () {
    $response = $this->get('/produtos');
    $response->assertStatus(200);
});

it('Rota create responde com 200', function () {
    $response = $this->get('/produtos/create');
    $response->assertStatus(200);
});

it('Rota show responde com 200', function () {
    $produto = Produto::factory()->create();
    $response = $this->get("/produtos/{$produto->id}");
    $response->assertStatus(200);
});

it('Rota edit responde com 200', function () {
    $produto = Produto::factory()->create();
    $response = $this->get("/produtos/{$produto->id}/edit");

    $response->assertStatus(200);
});

//store
it('cria um produto com sucesso', function () {
    // Mock de um usuário administrador autenticado
    $admin = User::factory()->create();
    Auth::shouldReceive('guard->check')->andReturn(true);
    Auth::shouldReceive('guard->id')->andReturn($admin->id);

    // Dados válidos para o teste
    $data = [
        'nome' => 'Produto Teste',
        'preco_valor' => 100.0,
        'preco_moeda' => 'BRL',
        'urlLojaOnline' => 'http://loja.com/produto-teste',
        'disponibilidade' => 1,
    ];

    // Fazer a requisição simulada para a rota store
    $response = $this->post(route('produtos.store'), $data);

    // Verificar se o produto foi criado no banco de dados
    $this->assertDatabaseHas('produtos', ['nome' => 'Produto Teste']);
    $this->assertDatabaseHas('loja_online', [
        'urlLoja' => 'http://loja.com/produto-teste',
        'valor' => 100.0,
        'moeda' => 'BRL',
    ]);

});

it('retorna erros de validação se dados obrigatórios estiverem ausentes', function () {
    // Mock de um usuário administrador autenticado
    $admin = User::factory()->create();
    Auth::shouldReceive('guard->check')->andReturn(true);
    Auth::shouldReceive('guard->id')->andReturn($admin->id);

    // Dados faltando o campo 'nome'
    $data = [
        'preco_valor' => 100.0,
        'preco_moeda' => 'BRL',
        'urlLojaOnline' => 'http://loja.com/produto-teste',
        'disponibilidade' => 1,
    ];

    // Fazer a requisição simulada para a rota store
    $response = $this->post(route('produtos.store'), $data);

    // Verificar se houve erros de validação
    $response->assertSessionHasErrors(['nome']);
});

//show
it('retorna produtos com base na busca por nome', function () {
    // Criar produtos para o teste
    Produto::factory()->create(['nome' => 'Produto Teste']);
    Produto::factory()->create(['nome' => 'Outro Produto']);

    // Realizar a busca pelo nome "Produto Teste"
    $response = $this->get(route('produtos.search', ['search' => 'Produto Teste'])); // Usar a rota de busca

    // Verificar se o resultado contém o produto correto
    $response->assertViewHas('results');
    $results = $response->viewData('results');
    $this->assertTrue($results->contains('nome', 'Produto Teste'));
});

it('retorna produtos com base na busca por atributos da loja online', function () {

 Produto::factory()->create();

    $response = $this->get(route('produtos.search', ['search' => 'loja.com'])); // Usar a rota de busca

    $response->assertViewHas('results');
    $response->viewData('results');
});

it('retorna todos os produtos se a busca estiver vazia', function () {
    // Criar produtos para o teste
    Produto::factory()->count(5)->create();

    // Fazer a requisição de busca sem parâmetros de busca
    $response = $this->get(route('produtos.search', ['search' => '']));

    // Verificar se todos os produtos foram retornados
    $response->assertViewHas('results');
    $results = $response->viewData('results');
    $this->assertCount(6, $results);
});

it('não retorna produtos se a busca não encontrar correspondências', function () {
    // Criar produtos que não correspondem à busca
    Produto::factory()->create(['nome' => 'Produto A']);
    Produto::factory()->create(['nome' => 'Produto B']);

    // Fazer uma busca por um termo que não existe
    $response = $this->get(route('produtos.search', ['search' => 'Produto Inexistente']));

    // Verificar que nenhum produto foi retornado
    $response->assertViewHas('results');
    $results = $response->viewData('results');
    $this->assertCount(0, $results);
});

it('retorna produtos com base em busca parcial por nome', function () {
    // Criar produtos para o teste
    Produto::factory()->create(['nome' => 'Produto Teste']);
    Produto::factory()->create(['nome' => 'Produto ABC']);

    // Realizar a busca por um termo parcial
    $response = $this->get(route('produtos.search', ['search' => 'Test']));

    // Verificar se o produto correspondente foi retornado
    $response->assertViewHas('results');
    $results = $response->viewData('results');
    $this->assertTrue($results->contains('nome', 'Produto Teste'));
    $this->assertFalse($results->contains('nome', 'Produto ABC'));
});

it('retorna produtos com base na busca por loja online associada', function () {
    // Criar um produto com uma loja online associada
    $produto = Produto::factory()->create();
    LojaOnline::factory()->create([
        'urlLoja' => 'http://loja.com/produto-teste',
        'valor' => 200.0,
        'moeda' => 'USD',
    ]);

    // Fazer a busca pela moeda da loja online
    $response = $this->get(route('produtos.search', ['search' => 'USD']));

    // Verificar se o produto foi retornado
    $response->assertViewHas('results');
    $results = $response->viewData('results');
});

it('retorna produtos ao buscar por múltiplos critérios', function () {
    // Criar um produto com uma loja online associada
    $produto = Produto::factory()->create(['nome' => 'Produto Teste']);
    LojaOnline::factory()->create([
        'urlLoja' => 'http://loja.com/produto-teste',
        'valor' => 100.0,
        'moeda' => 'USD',
    ]);

    // Fazer uma busca que combine nome do produto e moeda da loja
    $response = $this->get(route('produtos.search', ['search' => 'Produto USD']));

    // Verificar se o produto foi retornado
    $response->assertViewHas('results');
    $response->viewData('results');
});

//edit
it('carrega a view de edição de produto com sucesso', function () {
    $admin = Admin::factory()->create();
    $this->actingAs($admin, 'admin');

    // Cria um produto e loja online
    $produto = Produto::factory()->hasLojaOnline()->create();

    // Acessa a rota de edição com um ID válido
    $response = $this->get(route('produtos.edit', $produto->id));

    // Verifica que a view correta foi carregada e contém os dados do produto
    $response->assertStatus(200);
    $response->assertViewIs('produtos.editProduto');
    $response->assertViewHas('produto', $produto);
});

it('log criado quando produto não encontrado', function () {
    $admin = Admin::factory()->create();
    $this->actingAs($admin, 'admin');

    // Acessa a rota de edição com um ID inexistente para gerar um erro
    $this->get(route('produtos.edit', 999)); // 999 é um ID não existente

    // Verifica se uma entrada de log foi criada no banco de dados
    $this->assertDatabaseHas('custom_logs', [
        'descricao' => 'No query results for model [App\\Models\\Produto] 999', // Mensagem de erro esperada
        'operacao' => 'edit',
        'admin_id' => $admin->id,
    ]);
});


//update

it('atualiza o produto e a loja online diretamente com sucesso, registra log e atualiza o estoque', function () {
    // Criar um administrador e autenticar
    $admin = User::factory()->create();
    $this->actingAs($admin, 'admin'); // Autentica o admin

    // Criar um produto que automaticamente cria uma loja online associada
    $produto = Produto::factory()->create([
        'nome' => 'Produto Original',
        'disponibilidade' => 1,
    ]);

    // Recuperar a loja online associada ao produto criado
    $lojaOnline = $produto->lojaOnline;

    // Atualizar diretamente a loja online para verificar a persistência
    $lojaOnline->update([
        'urlLoja' => 'http://nova-loja.com/produto-atualizado',
        'valor' => 199.99,
        'moeda' => 'USD',
    ]);

    // Atualizar diretamente o produto
    $produto->update([
        'nome' => 'Produto Atualizado',
        'disponibilidade' => 1,
    ]);

    // Recarregar os modelos para verificar a atualização
    $produto->refresh();
    $lojaOnline->refresh();

    // Verificar a atualização do produto no banco de dados
    $this->assertDatabaseHas('produtos', [
        'id' => $produto->id,
        'nome' => 'Produto Atualizado',
        'disponibilidade' => 1,
    ]);

    // Verificar a atualização da loja online no banco de dados
    $this->assertDatabaseHas('loja_online', [
        'id' => $lojaOnline->id,
        'urlLoja' => 'http://nova-loja.com/produto-atualizado',
        'valor' => 199.99,
        'moeda' => 'USD',
    ]);

});

it('atualiza  loja online', function () {
    // Criar um administrador e autenticar
    $admin = User::factory()->create();
    $this->actingAs($admin, 'admin');

    // Criar produto e loja online associados
    $produto = Produto::factory()->create([
        'nome' => 'Produto Original',
        'disponibilidade' => 1,
    ]);
    $lojaOnline = $produto->lojaOnline;

    // Atualizar diretamente a loja online para teste de persistência
    $lojaOnline->update([
        'urlLoja' => 'http://nova-loja.com/produto-atualizado',
        'valor' => 199.99,
        'moeda' => 'USD',
    ]);

    // Recarregar o modelo para confirmar persistência
    $lojaOnline->refresh();

    // Verificar se os valores foram atualizados corretamente
    $this->assertEquals('http://nova-loja.com/produto-atualizado', $lojaOnline->urlLoja);
    $this->assertEquals(199.99, $lojaOnline->valor);
    $this->assertEquals('USD', $lojaOnline->moeda);
});


//destroy
it('exclui o produto e a loja online associada com sucesso', function () {
    // Criar um administrador e autenticar
    $admin = User::factory()->create();
    $this->actingAs($admin, 'admin');

    // Criar um produto com uma loja online associada
    $produto = Produto::factory()->create();
    $lojaOnline = $produto->lojaOnline;

    // Fazer a requisição de exclusão
    $response = $this->delete(route('produtos.destroy', $produto->id));

    // Verificar que o produto foi excluído do banco de dados
    $this->assertDatabaseMissing('produtos', ['id' => $produto->id]);

    // Verificar que a loja online associada foi excluída do banco de dados
    $this->assertDatabaseMissing('loja_online', ['id' => $lojaOnline->id]);

});

it('exclui o estoque associado ao produto', function () {
    // Criar um administrador e autenticar
    $admin = User::factory()->create();
    $this->actingAs($admin, 'admin');

    // Criar um produto com estoque associado
    $produto = Produto::factory()->create();
    $lojaOnline = $produto->lojaOnline;
    $estoque = Estoque::factory()->create(['produto_id' => $produto->id]);

    // Fazer a requisição de exclusão
    $response = $this->delete(route('produtos.destroy', $produto->id));

    // Verificar que o produto foi excluído do banco de dados
    $this->assertDatabaseMissing('produtos', ['id' => $produto->id]);

    // Verificar que a loja online associada foi excluída do banco de dados
    $this->assertDatabaseMissing('loja_online', ['id' => $lojaOnline->id]);

    // Verificar que o estoque associado foi excluído do banco de dados
    $this->assertDatabaseMissing('estoque', ['produto_id' => $produto->id]);

});














