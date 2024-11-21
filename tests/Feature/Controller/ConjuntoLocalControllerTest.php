<?php
/*
use App\Models\Categoria;
use App\Models\Conjunto;
use App\Models\Produto;
use App\Models\Software;

it('Rota getConjuntoProdutos falha na validação quando menos de 1 ou mais de 3 softwares são enviados', function () {
    // Cria alguns softwares para usar nos testes
    $software1 = Software::factory()->create();
    $software2 = Software::factory()->create();
    $software3 = Software::factory()->create();
    $software4 = Software::factory()->create();

    // Faz uma requisição POST com 0 softwares (inválido)
    $response = $this->postJson('/conjunto-produtos', [
        'softwares' => [], // Nenhum software enviado
    ]);

    // Verifica se a validação falhou e retornou um status 422
    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['softwares']);

    $response = $this->postJson('/conjunto-produtos', [
        'softwares' => [$software1->id, $software2->id, $software3->id, $software4->id],
    ]);

    // Verifica se a validação falhou e retornou um status 422
    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['softwares']);
});

it('Rota getConjuntoProdutos retorna o software mais pesado e os produtos relacionados por categoria', function () {
    // Criação de três softwares com diferentes pesos
    $software1 = Software::factory()->create(['peso' => 1.5]);
    $software2 = Software::factory()->create(['peso' => 2.0]);
    $software3 = Software::factory()->create(['peso' => 3.0]); // O mais pesado

    // Criação de conjuntos
    $conjunto1 = Conjunto::factory()->create(['categoria_id' => 1]);
    $conjunto2 = Conjunto::factory()->create(['categoria_id' => 2]);

    // Associa o software mais pesado aos conjuntos via a tabela pivô 'conjunto_software'
    $conjunto1->softwares()->attach($software3->id);
    $conjunto2->softwares()->attach($software3->id);

    // Criação de produtos para os conjuntos (associados via a tabela pivô 'conjunto_produto')
    $produto1 = Produto::factory()->create();
    $produto2 = Produto::factory()->create();

    // Associa produtos aos conjuntos
    $conjunto1->produtos()->attach($produto1->id);
    $conjunto2->produtos()->attach($produto2->id);

    // Envia a requisição POST com os IDs dos softwares
    $response = $this->postJson('/conjunto-produtos', [
        'softwares' => [$software1->id, $software2->id, $software3->id],
    ]);

    // Verifica se o software mais pesado foi retornado
    $response->assertJsonFragment(['id' => $software3->id]);

    // Verifica se os produtos relacionados foram retornados, separados por categoria
    $response->assertJsonStructure([
        'categoria_1' => [['id']],  // Produtos da categoria 1
        'categoria_2' => [['id']],  // Produtos da categoria 2
        'categoria_3' => [],        // Nenhum produto na categoria 3
    ]);

    // Verifica se a resposta tem status 200
    $response->assertStatus(200);
});

it('Rota getConjuntoProdutos retorna erro 404 quando nenhum conjunto é encontrado para o software', function () {
    // Cria um software válido, mas sem conjuntos associados
    $software = Software::factory()->create();

    // Faz uma requisição POST com o ID do software criado
    $response = $this->postJson('/conjunto-produtos', [
        'softwares' => [$software->id], // Software existente, mas sem conjuntos
    ]);

    // Verifica se a resposta é 404 (nenhum conjunto encontrado)
    $response->assertStatus(404);
    $response->assertJsonFragment(['message' => 'Nenhum conjunto encontrado para o software mais pesado']);
});

it('Rota getConjuntoProdutos retorna erro 404 quando nenhum conjunto é encontrado para o software mais pesado', function () {
    // Criação de três softwares sem conjuntos
    $software1 = Software::factory()->create(['peso' => 1.5]);
    $software2 = Software::factory()->create(['peso' => 2.0]);
    $software3 = Software::factory()->create(['peso' => 3.0]); // O mais pesado

    // Envia a requisição POST com os IDs dos softwares
    $response = $this->post('/conjunto-produtos', [
        'softwares' => [$software1->id, $software2->id, $software3->id],
        '_token' => csrf_token(),
    ]);

    // Verifica se a resposta é 404 (não encontrado)
    $response->assertStatus(404);
    $response->assertJsonFragment(['message' => 'Nenhum conjunto encontrado para o software mais pesado']);
});

it('verifica a relação hasMany com Conjunto', function () {
    // Cria uma categoria
    $categoria = Categoria::factory()->create();

    // Cria dois conjuntos relacionados à categoria
    $conjunto1 = Conjunto::factory()->create(['categoria_id' => $categoria->id]);
    $conjunto2 = Conjunto::factory()->create(['categoria_id' => $categoria->id]);

    // Verifica se a relação hasMany com Conjunto está correta
    expect($categoria->conjuntos)->toHaveCount(2);
    expect($categoria->conjuntos->pluck('id'))->toContain($conjunto1->id, $conjunto2->id);
}); */

