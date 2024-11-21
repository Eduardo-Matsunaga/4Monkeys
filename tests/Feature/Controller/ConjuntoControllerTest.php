<?php

use App\Models\Categoria;
use App\Models\Conjunto;
use App\Models\Estoque;
use App\Models\LojaOnline;
use App\Models\Produto;
use App\Models\RequisitoSoftware;
use App\Services\GeminiAPIService;
use App\Http\Controllers\ConjuntoController;
use App\Models\Software;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


uses(RefreshDatabase::class);

// Mock do serviço GeminiApiService
beforeEach(function () {
    // Mock do serviço GeminiAPIService
    $this->geminiAPIServiceMock = Mockery::mock(GeminiAPIService::class);

    // Instância do controller
    $this->controller = new ConjuntoController($this->geminiAPIServiceMock);

    $this->user = User::factory()->create(); // Cria um usuário autenticado
    $this->actingAs($this->user); // Autentica o usuário
});

//Create
it('usuário autenticado pode acessar a página de criação do conjunto', function () {
// Cria um usuário e autentica
$user = User::factory()->create();

// Cria alguns softwares para o teste
$softwares = Software::factory()->count(3)->create();

// Simula a autenticação do usuário e faz a requisição para o método create
$response = $this->actingAs($user)->get(route('home.create'));

// Verifica se a view correta foi renderizada
$response->assertViewIs('dashboard');

// Verifica se a view contém a variável correta com os softwares
$response->assertViewHas('softwares', function ($viewSoftwares) use ($softwares) {
return $softwares->pluck('id')->diff($viewSoftwares->pluck('id'))->isEmpty();
});
});

it('usuário não autenticado é redirecionado para a página de home', function () {
    // Cria alguns softwares para o teste
    $softwares = Software::factory()->count(3)->create();

    // Faz a requisição sem autenticação
    $response = $this->get(route('home.create'));

    // Verifica se a view correta foi renderizada
    $response->assertValid('home');

    // Verifica se a view contém a variável correta com os softwares
    $response->assertViewHas('softwares', function ($viewSoftwares) use ($softwares) {
        return $softwares->pluck('id')->diff($viewSoftwares->pluck('id'))->isEmpty();
    });
});

it('a lista de softwares é retornada corretamente', function () {
    // Cria alguns softwares para o teste
    $softwares = Software::factory()->count(5)->create();

    // Autentica um usuário
    $user = User::factory()->create();

    // Faz a requisição autenticada
    $response = $this->actingAs($user)->get(route('home.create'));

    // Verifica se a variável 'softwares' contém os softwares criados
    $response->assertViewHas('softwares', function ($viewSoftwares) use ($softwares) {
        return $softwares->pluck('id')->diff($viewSoftwares->pluck('id'))->isEmpty();
    });

    // Faz a requisição sem autenticação
    $response = $this->get(route('home.create'));

    // Verifica se a variável 'softwares' contém os softwares criados
    $response->assertViewHas('softwares', function ($viewSoftwares) use ($softwares) {
        return $softwares->pluck('id')->diff($viewSoftwares->pluck('id'))->isEmpty();
    });
});

it('usuário autenticado vê o dashboard', function () {
    // Cria e autentica um usuário
    $user = User::factory()->create();

    // Faz a requisição autenticada
    $response = $this->actingAs($user)->get(route('home.create'));

    // Verifica se a view renderizada é o dashboard
    $response->assertViewIs('dashboard');
});

it('usuário não autenticado vê a home', function () {
    // Faz a requisição sem autenticação
    $response = $this->get(route('home.create'));

    // Verifica se a view renderizada é a home
    $response->assertValid('home');
});

it('não há softwares disponíveis', function () {
    // Autentica um usuário
    $user = User::factory()->create();

    // Faz a requisição sem criar softwares
    $response = $this->actingAs($user)->get(route('home.create'));

    // Verifica se a view correta foi renderizada
    $response->assertViewIs('dashboard');

    // Verifica se a variável softwares está vazia
    $response->assertViewHas('softwares', function ($viewSoftwares) {
        return $viewSoftwares->isEmpty();
    });
});

//ObterSoftwaresSelecionados
it('retorna os softwares corretos quando IDs válidos são passados', function () {
    // Criar softwares no banco de dados
    $software1 = Software::factory()->create();
    $software2 = Software::factory()->create();

    // Mock da request com os IDs válidos
    $request = Request::create('/home', 'POST', ['softwares' => [$software1->id, $software2->id]]);

    // Chame o método do controller
    $response = $this->controller->obterSoftwaresSelecionados($request);

    // Verifique se os softwares retornados estão corretos
    expect($response)->toBeArray()->toHaveCount(2)
        ->and($response[0]['id'])->toBe($software1->id)
        ->and($response[1]['id'])->toBe($software2->id);
});

it('retorna um array vazio quando IDs inválidos são passados', function () {
    // Mock da request com IDs inválidos
    $request = Request::create('/home', 'POST', ['softwares' => [999, 1000]]);

    // Chame o método do controller
    $response = $this->controller->obterSoftwaresSelecionados($request);

    // Verifique se o retorno é um array vazio
    expect($response)->toBeArray()->toBeEmpty();
});

it('retorna um array vazio quando um array vazio é passado', function () {
    // Mock da request com um array vazio
    $request = Request::create('/home', 'POST', ['softwares' => []]);

    // Chame o método do controller
    $response = $this->controller->obterSoftwaresSelecionados($request);

    // Verifique se o retorno é um array vazio
    expect($response)->toBeArray()->toBeEmpty();
});

it('garante que o retorno é sempre um array, mesmo sem softwares', function () {
    // Mock da request com um array vazio
    $request = Request::create('/home', 'POST', ['softwares' => []]);

    // Chame o método do controller
    $response = $this->controller->obterSoftwaresSelecionados($request);

    // Verifique se o retorno é um array
    expect($response)->toBeArray();
});

it('retorna softwares corretamente quando IDs de software são passados como strings', function () {
    // Criar softwares no banco de dados
    $software1 = Software::factory()->create();
    $software2 = Software::factory()->create();

    // Mock da request com IDs de software como strings
    $request = Request::create('/home', 'POST', ['softwares' => [(string)$software1->id, (string)$software2->id]]);

    // Chame o método do controller
    $response = $this->controller->obterSoftwaresSelecionados($request);

    // Verifique se os softwares retornados estão corretos
    expect($response)->toBeArray()->toHaveCount(2)
        ->and($response[0]['id'])->toBe($software1->id)
        ->and($response[1]['id'])->toBe($software2->id);
});

it('retorna softwares corretamente com múltiplas chamadas simultâneas', function () {
    // Criar softwares no banco de dados
    $software1 = Software::factory()->create();
    $software2 = Software::factory()->create();

    // Mock da request com IDs válidos
    $request1 = Request::create('/home', 'POST', ['softwares' => [$software1->id]]);
    $request2 = Request::create('/home', 'POST', ['softwares' => [$software2->id]]);

    // Chame o método do controller simultaneamente
    $response1 = $this->controller->obterSoftwaresSelecionados($request1);
    $response2 = $this->controller->obterSoftwaresSelecionados($request2);

    // Verifique se os softwares retornados estão corretos
    expect($response1)->toBeArray()->toHaveCount(1)
        ->and($response1[0]['id'])->toBe($software1->id);

    expect($response2)->toBeArray()->toHaveCount(1)
        ->and($response2[0]['id'])->toBe($software2->id);
});

//ObterTodosProdutos
it('retorna produtos que possuem estoque', function () {
    // Criar produtos com estoque no banco de dados
    $produto1 = Produto::factory()->create();
    $produto2 = Produto::factory()->create();

    // Criar o relacionamento de estoque
    Estoque::factory()->create(['produto_id' => $produto1->id]);
    Estoque::factory()->create(['produto_id' => $produto2->id]);

    // Chame o método do controller
    $response = $this->controller->obterTodosProdutos();

    // Verifique se os produtos retornados estão corretos
    expect($response)->toBeArray()->toHaveCount(2)
        ->and($response[0]['id'])->toBe($produto1->id)
        ->and($response[1]['id'])->toBe($produto2->id);
});

it('retorna um array vazio quando nenhum produto tem estoque', function () {
    // Criar produtos sem estoque no banco de dados
    Produto::factory()->create();
    Produto::factory()->create();

    // Chame o método do controller
    $response = $this->controller->obterTodosProdutos();

    // Verifique se o retorno é um array vazio
    expect($response)->toBeArray()->toBeEmpty();
});

it('retorna sempre um array, mesmo quando não há produtos com estoque', function () {
    // Não criar produtos nem estoque

    // Chame o método do controller
    $response = $this->controller->obterTodosProdutos();

    // Verifique se o retorno é um array
    expect($response)->toBeArray()->toBeEmpty();
});

it('retorna corretamente produtos com e sem estoque', function () {
    // Criar produtos com e sem estoque
    $produto1 = Produto::factory()->create();
    $produto2 = Produto::factory()->create();
    $produtoSemEstoque = Produto::factory()->create();

    // Criar o relacionamento de estoque
    Estoque::factory()->create(['produto_id' => $produto1->id]);
    Estoque::factory()->create(['produto_id' => $produto2->id]);

    // Chame o método do controller
    $response = $this->controller->obterTodosProdutos();

    // Verifique se os produtos retornados são os que têm estoque
    expect($response)->toBeArray()->toHaveCount(2)
        ->and($response[0]['id'])->toBe($produto1->id)
        ->and($response[1]['id'])->toBe($produto2->id);
});

it('não retorna produtos sem estoque', function () {
    // Criar um produto sem estoque
    $produtoSemEstoque = Produto::factory()->create();

    // Chame o método do controller
    $response = $this->controller->obterTodosProdutos();

    // Verifique que o retorno é vazio
    expect($response)->toBeArray()->toBeEmpty();
});

//buscaCategoriaPorId
it('retorna a categoria correta quando um ID válido é passado', function () {
    // Criar uma categoria no banco de dados
    $categoria = Categoria::factory()->create();

    // Chame o método do controller com um ID válido
    $response = $this->controller->buscarCategoriaPorId($categoria->id);

    // Verifique se a categoria retornada está correta
    expect($response)->not->toBeNull()
        ->and($response->id)->toBe($categoria->id);
});

it('retorna null quando um ID de categoria inválido é passado', function () {
    // Chame o método do controller com um ID que não existe
    $response = $this->controller->buscarCategoriaPorId(9999);

    // Verifique se o retorno é null
    expect($response)->toBeNull();
});

it('retorna null quando o ID de categoria é null', function () {
    // Chame o método do controller com null como ID
    $response = $this->controller->buscarCategoriaPorId(null);

    // Verifique se o retorno é null
    expect($response)->toBeNull();
});

it('retorna null quando uma string inválida é passada como ID da categoria', function () {
    // Chame o método do controller com uma string inválida
    $response = $this->controller->buscarCategoriaPorId('string-invalida');

    // Verifique se o retorno é null
    expect($response)->toBeNull();
});

//CriarConjunto
it('cria um conjunto com categoria e usuário válidos', function () {
    // Criar um usuário e uma categoria no banco de dados
    $user = User::factory()->create();
    $categoria = Categoria::factory()->create(['nome' => 'categoria']);

    // Chame o método do controller para criar o conjunto
    $conjunto = $this->controller->criarConjunto($categoria, $user);

    // Verifique se o conjunto foi criado corretamente no banco de dados
    expect($conjunto)->not->toBeNull()
        ->and($conjunto->nome)->toBe('Conjunto Categoria')
        ->and($conjunto->categoria_id)->toBe($categoria->id)
        ->and($conjunto->user_id)->toBe($user->id);
});

it('cria o conjunto com o nome formatado corretamente', function () {
    // Criar um usuário e uma categoria no banco de dados
    $user = User::factory()->create();
    $categoria = Categoria::factory()->create(['nome' => 'Bronze']);

    // Chame o método do controller para criar o conjunto
    $conjunto = $this->controller->criarConjunto($categoria, $user);

    // Verifique se o nome do conjunto foi capitalizado corretamente
    expect($conjunto->nome)->toBe('Conjunto Bronze');
});

it('associa corretamente o conjunto à categoria', function () {
    // Criar um usuário e uma categoria no banco de dados
    $user = User::factory()->create();
    $categoria = Categoria::factory()->create();

    // Chame o método do controller para criar o conjunto
    $conjunto = $this->controller->criarConjunto($categoria, $user);

    // Verifique se a categoria está associada corretamente ao conjunto
    expect($conjunto->categoria_id)->toBe($categoria->id);
});


//AssociarProdutosAoConjunto
it('associa produto encontrado ao conjunto e salva logs', function () {
    // Cria um conjunto usando a ConjuntoFactory
    $conjunto = Conjunto::factory()->create();

    // Cria uma loja online com um valor específico
    $lojaOnline = LojaOnline::factory()->create(['valor' => 200.0]);

    // Cria um produto com a loja online associada
    $produto = Produto::factory()->create(['loja_online_id' => $lojaOnline->id]);

    // Mocka a chamada para GeminiAPIService para retornar o ID do produto
    $this->geminiAPIServiceMock
        ->shouldReceive('findProductIdBySimilarity')
        ->once()
        ->with('produto1')
        ->andReturn($produto->id);

    // Executa a função associarProdutosAoConjunto com um array de componentes contendo 'nome'
    $result = $this->controller->associarProdutosAoConjunto($conjunto, [['nome' => 'produto1']]);

    // Verifica se a função retornou sucesso
    $this->assertTrue($result);

    // Verifica se o produto foi associado ao conjunto
    $this->assertDatabaseHas('conjunto_produto', [
        'conjunto_id' => $conjunto->id,
        'produto_id' => $produto->id,
    ]);

    // Verifica se o histórico de preço foi salvo com o valor correto
    $this->assertDatabaseHas('conjunto_historicos', [
        'produto_id' => $produto->id,
        'conjunto_id' => $conjunto->id,
        'valor' => 200.0,
    ]);

    // Verifica se um log de sucesso foi criado na tabela GeminiLog
    $this->assertDatabaseHas('gemini_logs', [
        'descricao' => "Produtos associados com sucesso ao conjunto ID: {$conjunto->id}",
        'operacao' => 'associarProdutosAoConjunto',
        'status' => 'sucesso',
    ]);
});

it('não encontra produto e registra log de erro', function () {
    // Cria um conjunto
    $conjunto = Conjunto::factory()->create();

    // Mock da chamada para GeminiAPIService que retorna null
    $this->geminiAPIServiceMock
        ->shouldReceive('findProductIdBySimilarity')
        ->once()
        ->with('produto_inexistente')
        ->andReturn(null);

    // Executa a função associarProdutosAoConjunto com um array de componentes contendo 'nome'
    $result = $this->controller->associarProdutosAoConjunto($conjunto, [['nome' => 'produto_inexistente']]);

    // Verifica se o resultado é falso
    $this->assertFalse($result);

    // Verifica se um log de erro foi registrado na tabela GeminiLog
    $this->assertDatabaseHas('gemini_logs', [
        'descricao' => 'Produto produto_inexistente não encontrado para associação ao conjunto',
        'operacao' => 'associarProdutosAoConjunto',
        'status' => 'erro',
    ]);
});

it('lança exceção e registra log de erro', function () {
    // Cria um conjunto
    $conjunto = Conjunto::factory()->create();

    // Simula uma exceção no GeminiAPIService ao tentar encontrar o ID do produto
    $this->geminiAPIServiceMock
        ->shouldReceive('findProductIdBySimilarity')
        ->once()
        ->with('produto1')
        ->andThrow(new \Exception('Erro na API Gemini'));

    // Configura a expectativa de uma exceção ao chamar a função
    $this->expectException(\Exception::class);
    $this->expectExceptionMessage('Erro na API Gemini');

    // Executa a função associarProdutosAoConjunto com o array de componentes contendo 'nome'
    $this->controller->associarProdutosAoConjunto($conjunto, [['nome' => 'produto1']]);

    // Verifica se o log de erro foi registrado na tabela GeminiLog
    $this->assertDatabaseHas('gemini_logs', [
        'descricao' => 'Erro ao associar produtos ao conjunto: Erro na API Gemini',
        'operacao' => 'associarProdutosAoConjunto',
        'status' => 'erro',
    ]);
});


//AssociarSoftwaresAoConjunto
it('associa softwares ao conjunto com sucesso e registra log', function () {
    // Cria um conjunto usando a ConjuntoFactory
    $conjunto = Conjunto::factory()->create();

    // Cria alguns softwares e define IDs para associar
    $softwares = Software::factory()->count(3)->create();
    $softwaresSelecionados = $softwares->map(fn($software) => ['id' => $software->id])->toArray();

    // Executa a função associarSoftwaresAoConjunto
    $this->controller->associarSoftwaresAoConjunto($conjunto, $softwaresSelecionados);

    // Verifica se os softwares foram associados ao conjunto
    foreach ($softwares as $software) {
        $this->assertDatabaseHas('conjunto_software', [
            'conjunto_id' => $conjunto->id,
            'software_id' => $software->id,
        ]);
    }

    // Verifica se um log de sucesso foi criado
    $this->assertDatabaseHas('gemini_logs', [
        'descricao' => "Softwares associados com sucesso ao conjunto ID: {$conjunto->id}",
        'operacao' => 'associarSoftwaresAoConjunto',
        'status' => 'sucesso',
    ]);
});

it('lança exceção ao associar softwares e registra log de erro', function () {
    // Cria um conjunto
    $conjunto = Conjunto::factory()->create();

    // Cria softwares para simular associação
    $softwares = Software::factory()->count(3)->create();
    $softwaresSelecionados = $softwares->map(fn($software) => ['id' => $software->id])->toArray();

    // Simula uma exceção na inserção no banco de dados
    DB::shouldReceive('table')
        ->with('conjunto_software')
        ->andThrow(new \Exception());

    // Executa a função e espera uma exceção
    $this->expectException(\Exception::class);

    // Executa a função associarSoftwaresAoConjunto
    $this->controller->associarSoftwaresAoConjunto($conjunto, $softwaresSelecionados);

    // Verifica se o log de erro foi registrado no banco de dados
    $this->assertDatabaseHas('gemini_logs', [
        'descricao' => 'Erro ao associar softwares ao conjunto: Erro ao associar softwares',
        'operacao' => 'associarSoftwaresAoConjunto',
        'status' => 'erro',
    ]);
});

//HistoricoConjunto
it('retorna histórico de conjuntos do usuário com sucesso', function () {
    // Configuração dos dados de teste
    $categoria = Categoria::factory()->create();
    $conjunto = Conjunto::factory()->create([
        'user_id' => $this->user->id,
        'categoria_id' => $categoria->id,
    ]);

    $produto = Produto::factory()->create(['loja_online_id' => LojaOnline::factory()->create(['valor' => 150.0])->id]);
    $conjunto->produtos()->attach($produto->id);

    $software = Software::factory()->create();
    $conjunto->softwares()->attach($software->id);

    RequisitoSoftware::factory()->create([
        'software_id' => $software->id,
        'requisito_nivel' => 'Minimo',
        'cpu' => 'Intel i3',
        'gpu' => 'GTX 1050',
        'ram' => '8GB',
    ]);

    DB::table('conjunto_historicos')->insert([
        'conjunto_id' => $conjunto->id,
        'produto_id' => $produto->id,
        'valor' => 150.0,
    ]);

    // Realiza a requisição e verifica que a view correta foi carregada
    $response = $this->get('/historico-conjuntos');

    $response->assertStatus(200)
        ->assertViewIs('historico') // Confirma que a view 'historico' é carregada
        ->assertViewHas('historico'); // Confirma que a view possui a variável 'historico'

    // Acessa os dados da view para fazer verificações adicionais
    $historico = $response->viewData('historico');

    // Verifica a estrutura do histórico para garantir que contém os dados esperados
    $this->assertIsArray($historico);
    $this->assertNotEmpty($historico);

    // Exemplo de verificação detalhada da estrutura
    $this->assertArrayHasKey('data', $historico[0]);
    $this->assertArrayHasKey('conjuntos', $historico[0]);
    $this->assertEquals(150, $historico[0]['conjuntos'][0]['total']);
});


//SalvarConjuntoHistorico
it('salva histórico com dados válidos no conjunto_historicos', function () {
    // Cria instâncias válidas de Produto e Conjunto
    $produto = Produto::factory()->create();
    $conjunto = Conjunto::factory()->create();

    // Define valor válido
    $valor = 150.0;

    // Executa a função salvarConjuntoHistorico com dados válidos
    $this->controller->salvarConjuntoHistorico($produto->id, $valor, $conjunto->id);

    // Verifica se o registro foi salvo corretamente na tabela conjunto_historicos
    $this->assertDatabaseHas('conjunto_historicos', [
        'produto_id' => $produto->id,
        'conjunto_id' => $conjunto->id,
        'valor' => $valor,
    ]);
});

it('não salva histórico e registra log de aviso com dados inválidos', function () {
    // Mock do log de aviso
    Log::shouldReceive('warning')
        ->once()
        ->with("Produto ID, valor ou conjunto ID inválidos ao salvar no histórico.");

    // Chama a função com parâmetros inválidos
    $this->controller->salvarConjuntoHistorico(null, null, null);

    // Verifica que nenhum registro foi salvo na tabela conjunto_historicos
    $this->assertDatabaseMissing('conjunto_historicos', [
        'produto_id' => null,
        'conjunto_id' => null,
        'valor' => null,
    ]);
});
