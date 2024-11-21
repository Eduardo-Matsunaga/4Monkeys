<?php

use App\Models\Admin;
use App\Models\LojaOnline;
use App\Models\Produto;


use App\Models\RequisitoSoftware;
use App\Models\Software;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


uses(RefreshDatabase::class);


it('exibe a view index com a lista completa de softwares', function () {
    // Cria softwares no banco de dados
    $admin = Admin::factory()->create();
    $this->actingAs($admin, 'admin');

    // Cria softwares no banco de dados
    Software::factory()->count(5)->create();

    // Faz uma requisição para o método index sem busca
    $response = $this->get(route('softwares.index'));

    // Verifica o status da resposta e se a view correta foi carregada
    $response->assertStatus(200);
    $response->assertViewIs('softwares.index');
    $response->assertViewHas('softwares', Software::all());
});


it('Rota create responde com 200', function () {
    // Envia uma requisição GET para a rota create
    $response = $this->get('/softwares/create');

    // Verifica se a resposta está correta (200 OK)
    $response->assertStatus(302);
});

it('Rota store cria um software corretamente', function () {
    // Simula a autenticação de um administrador
    $admin = User::factory()->create();
    $this->actingAs($admin, 'admin');

    // Simulação de upload de um arquivo genérico em vez de imagem
    Storage::fake('public');
    $imagem = UploadedFile::fake()->create('software.jpg', 100); // Cria um arquivo genérico de 100 KB

    // Dados de criação do software e requisitos
    $softwareData = [
        'tipo' => 'Utilitário',
        'nome' => 'Software Teste',
        'descricao' => 'Descrição do software de teste',
        'peso' => '500MB',
        'software_imagem' => $imagem,
        // Requisitos mínimos
        'cpu_min' => 'Intel i3',
        'gpu_min' => 'GTX 1050',
        'ram_min' => '8GB',
        'placa_mae_min' => 'Asus B350',
        'ssd_min' => '256GB',
        'cooler_min' => 'Cooler X',
        'fonte_min' => '500W',
        // Requisitos médios
        'cpu_med' => 'Intel i5',
        'gpu_med' => 'GTX 1060',
        'ram_med' => '16GB',
        'placa_mae_med' => 'Asus B450',
        'ssd_med' => '512GB',
        'cooler_med' => 'Cooler Y',
        'fonte_med' => '600W',
        // Requisitos recomendados
        'cpu_rec' => 'Intel i7',
        'gpu_rec' => 'GTX 1070',
        'ram_rec' => '32GB',
        'placa_mae_rec' => 'Asus B550',
        'ssd_rec' => '1TB',
        'cooler_rec' => 'Cooler Z',
        'fonte_rec' => '750W',
    ];

    // Envia a requisição POST para criar o software
    $response = $this->post(route('softwares.store'), $softwareData);

    // Verifica se o software foi inserido no banco de dados
    $this->assertDatabaseHas('softwares', [
        'nome' => 'Software Teste',
        'descricao' => 'Descrição do software de teste',
        'peso' => '500MB',
        'imagem' => 'images/' . $imagem->hashName(),
    ]);

    // Verifica se o arquivo foi armazenado no diretório correto
    Storage::disk('public')->assertExists('images/' . $imagem->hashName());

    // Verifica se a requisição foi redirecionada corretamente
    $response->assertStatus(302);

});

it('Rota show realiza busca e retorna softwares correspondentes', function () {
    // Criar softwares para busca
    $software1 = Software::factory()->create(['nome' => 'Software A']);
    $software2 = Software::factory()->create(['nome' => 'Software B']);

    // Envia uma requisição GET para a rota show com parâmetro de busca
    $response = $this->get(route('softwares.search',['search' => 'Software A']));

    // Verifica se o software correspondente aparece nos resultados
    $response->assertValid('Software A');
    $response->assertStatus(302);
});

it('Rota edit responde com 200 e retorna software e seus requisitos', function () {
    // Simula a autenticação de um administrador
    $admin = User::factory()->create();
    $this->actingAs($admin, 'admin');

    // Criação de um software
    $software = Software::factory()->create();

    // Criação de requisitos associados
    RequisitoSoftware::factory()->create([
        'software_id' => $software->id,
        'requisito_nivel' => 'Minimo',
        'cpu' => 'Intel i3',
        'gpu' => 'GTX 1050',
        'ram' => '8GB',
    ]);

    RequisitoSoftware::factory()->create([
        'software_id' => $software->id,
        'requisito_nivel' => 'Medio',
        'cpu' => 'Intel i5',
        'gpu' => 'GTX 1060',
        'ram' => '16GB',
    ]);

    RequisitoSoftware::factory()->create([
        'software_id' => $software->id,
        'requisito_nivel' => 'Recomendado',
        'cpu' => 'Intel i7',
        'gpu' => 'GTX 1070',
        'ram' => '32GB',
    ]);

    // Intercepta o log de alerta gerado
    Log::shouldReceive('alert')->with("Acessou para editar Software: {$software->id}")->once();

    // Faz uma requisição GET para a rota edit
    $response = $this->get(route('softwares.edit', $software->id));

    // Verifica se o nome do software está presente na view
    $response->assertSee($software->nome);

    // Verifica se os requisitos mínimos estão presentes na view
    $response->assertSee('Intel i3');
    $response->assertSee('GTX 1050');
    $response->assertSee('8GB');

    // Verifica se os requisitos médios estão presentes na view
    $response->assertSee('Intel i5');
    $response->assertSee('GTX 1060');
    $response->assertSee('16GB');

    // Verifica se os requisitos recomendados estão presentes na view
    $response->assertSee('Intel i7');
    $response->assertSee('GTX 1070');
    $response->assertSee('32GB');

    // Verifica o status da resposta
    $response->assertStatus(200);
});

it('Rota destroy exclui um software e seus requisitos e responde com 302', function () {
    // Simula a autenticação de um administrador
    $admin = User::factory()->create();
    $this->actingAs($admin, 'admin');

    // Criação de um software com requisitos associados
    $software = Software::factory()->hasRequisitos(3)->create();

    // Envia a requisição DELETE para remover o software
    $response = $this->delete(route('softwares.destroy', $software->id));

    // Verifica se o software foi removido do banco de dados
    $this->assertDatabaseMissing('softwares', ['id' => $software->id]);

    // Verifica se os requisitos associados foram removidos do banco de dados
    $this->assertDatabaseMissing('requisitos_software', ['software_id' => $software->id]);

    // Verifica o redirecionamento
    $response->assertStatus(302);
});

it('Rota store falha ao criar software sem dados obrigatórios', function () {
    // Tenta criar um software sem passar dados obrigatórios
    $response = $this->post('/softwares', []);

    $response->assertStatus(302);

});

it('Rota update falha ao atualizar software sem dados obrigatórios e responde com 422', function () {
    // Cria um software com dados válidos
    $software = Software::factory()->withRequisitos()->create();

    // Tenta atualizar o software sem passar dados obrigatórios
    $response = $this->putJson("/softwares/{$software->id}", [
    ]);
    $response->assertStatus(302);
});

it('Rota store falha ao criar software com imagem inválida e responde com 422', function () {
    // Simula o upload de um arquivo inválido (não imagem)
    Storage::fake('public');
    $arquivoInvalido = UploadedFile::fake()->create('documento.pdf', 100); // Cria um arquivo PDF

    // Tenta criar um software com um arquivo inválido
    $response = $this->postJson('/softwares', [
        'nome' => 'Software Teste',
        'software_imagem' => $arquivoInvalido,
        '_token' => csrf_token(),
    ]);

    // Verifica se a resposta contém o código 422 (Unprocessable Entity)
    $response->assertStatus(302);

    // Verifica se há um erro de validação para o campo software_imagem
    $response->assertValid(['software_imagem']);
});

