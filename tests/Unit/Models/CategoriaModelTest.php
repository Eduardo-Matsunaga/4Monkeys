<?php
use App\Models\Categoria;
use App\Models\Conjunto;
use Illuminate\Support\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;


uses(RefreshDatabase::class);


it('verifica se os atributos fillable estão corretos', function () {
    $categoria = new Categoria();

    // Espera que os atributos fillable estejam corretos
    $expectedFillable = ['nome', 'tipo'];

    // Verifica se os atributos fillable são os esperados
    expect($categoria->getFillable())->toBe($expectedFillable);
});

it('verifica se a tabela associada está correta', function () {
    $categoria = new Categoria();

    // Verifica se a tabela associada está correta
    expect($categoria->getTable())->toBe('categorias');
});

it('verifica se atributos não permitidos não podem ser atribuídos', function () {
    $categoria = new Categoria();

    // Tenta atribuir um campo não fillable
    $categoria->fill([
        'nome' => 'Categoria Teste',
        'tipo' => 'Tipo Teste',
        'extra' => 'Valor Não Permitido', // Este campo não é fillable
    ]);

    // Verifica se o campo não fillable não foi atribuído
    expect($categoria->extra)->toBeNull();
});





