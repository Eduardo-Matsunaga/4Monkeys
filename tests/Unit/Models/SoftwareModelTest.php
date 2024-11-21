<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('verifica os atributos fillable estão corretos', function () {
    $software = new \App\Models\Software();

    $expectedFillable = ['nome', 'tipo', 'descricao', 'peso', 'imagem'];

    expect($software->getFillable())->toBe($expectedFillable);
});

it('verifica que atributos não fillable não podem ser atribuídos', function () {
    $software = new \App\Models\Software();

    // Atribuir um campo não fillable
    $software->fill([
        'nome' => 'Software Teste',
        'tipo' => 'Utilitário',
        'descricao' => 'Descrição Teste',
        'peso' => 3.5,
        'campo_invalido' => 'Invalido',  // Este campo não é fillable
    ]);

    // Verifica se o campo inválido não foi atribuído
    expect($software->campo_invalido)->toBeNull();
});

it('verifica o relacionamento belongsToMany com Conjunto através de produtoFinais', function () {
    $software = Mockery::mock(\App\Models\Software::class)->makePartial();

    $mockConjuntos = Mockery::mock(\Illuminate\Database\Eloquent\Collection::class);
    $software->shouldReceive('produtoFinais')->andReturn($mockConjuntos);

    expect($software->produtoFinais())->toBe($mockConjuntos);
});

it('verifica o relacionamento hasMany com RequisitoSoftware', function () {
    $software = Mockery::mock(\App\Models\Software::class)->makePartial();

    $mockRequisitos = Mockery::mock(\Illuminate\Database\Eloquent\Collection::class);
    $software->shouldReceive('requisitos')->andReturn($mockRequisitos);

    expect($software->requisitos())->toBe($mockRequisitos);
});

it('verifica o relacionamento belongsToMany com Conjunto através de conjuntos', function () {
    $software = Mockery::mock(\App\Models\Software::class)->makePartial();

    $mockConjuntos = Mockery::mock(\Illuminate\Database\Eloquent\Collection::class);
    $software->shouldReceive('conjuntos')->andReturn($mockConjuntos);

    expect($software->conjuntos())->toBe($mockConjuntos);
});

it('verifica se a model usa HasFactory', function () {
    $software = new \App\Models\Software();

    expect(class_uses($software))->toContain(\Illuminate\Database\Eloquent\Factories\HasFactory::class);
});
