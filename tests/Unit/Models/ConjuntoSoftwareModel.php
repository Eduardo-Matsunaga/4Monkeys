<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('verifica os atributos fillable estão corretos', function () {
    $conjuntoSoftware = new \App\Models\ConjuntoSoftware();

    $expectedFillable = ['conjunto_id', 'software_id'];

    expect($conjuntoSoftware->getFillable())->toBe($expectedFillable);
});

it('verifica que atributos não fillable não podem ser atribuídos', function () {
    $conjuntoSoftware = new \App\Models\ConjuntoSoftware();

    // Atribuir um campo não fillable
    $conjuntoSoftware->fill([
        'conjunto_id' => 1,
        'software_id' => 2,
        'campo_invalido' => 'Invalido'  // Este campo não é fillable
    ]);

    // Verifica se o campo inválido não foi atribuído
    expect($conjuntoSoftware->campo_invalido)->toBeNull();
});

it('verifica se a model usa HasFactory', function () {
    $conjuntoSoftware = new \App\Models\ConjuntoSoftware();

    expect(class_uses($conjuntoSoftware))->toContain(\Illuminate\Database\Eloquent\Factories\HasFactory::class);
});


