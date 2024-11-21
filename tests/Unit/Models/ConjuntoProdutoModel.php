<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('verifica os atributos fillable estão corretos', function () {
    $conjuntoProduto = new \App\Models\ConjuntoProduto();

    $expectedFillable = ['conjunto_id', 'software_id'];

    expect($conjuntoProduto->getFillable())->toBe($expectedFillable);
});

it('verifica que atributos não fillable não podem ser atribuídos', function () {
    $conjuntoProduto = new \App\Models\ConjuntoProduto();

    // Atribuir um campo não fillable
    $conjuntoProduto->fill([
        'conjunto_id' => 1,
        'software_id' => 1,
        'campo_invalido' => 'Invalido'  // Este campo não é fillable
    ]);

    // Verifica se o campo inválido não foi atribuído
    expect($conjuntoProduto->campo_invalido)->toBeNull();
});

it('verifica se a model usa HasFactory', function () {
    $conjuntoProduto = new \App\Models\ConjuntoProduto();

    expect(class_uses($conjuntoProduto))->toContain(\Illuminate\Database\Eloquent\Factories\HasFactory::class);
});


