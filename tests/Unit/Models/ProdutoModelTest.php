<?php

use App\Models\Produto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\LojaOnline;
use App\Models\Estoque;
use App\Models\Conjunto;

uses(RefreshDatabase::class);

it('verifica os atributos fillable estão corretos', function () {
    $produto = new \App\Models\Produto();

    $expectedFillable = ['nome', 'loja_online_id', 'disponibilidade', 'created_at', 'updated_at'];

    expect($produto->getFillable())->toBe($expectedFillable);
});

it('verifica o relacionamento belongsTo com LojaOnline', function () {
    $produto = Mockery::mock(Produto::class)->makePartial();

    $mockLojaOnline = Mockery::mock(LojaOnline::class);
    $produto->shouldReceive('lojaOnline')->andReturn($mockLojaOnline);

    expect($produto->lojaOnline())->toBe($mockLojaOnline);
});

it('verifica o relacionamento belongsToMany com Conjunto', function () {
    $produto = Mockery::mock(\App\Models\Produto::class)->makePartial();

    $mockConjuntos = Mockery::mock(\Illuminate\Database\Eloquent\Collection::class);
    $produto->shouldReceive('conjunto')->andReturn($mockConjuntos);

    expect($produto->conjunto())->toBe($mockConjuntos);
});

it('verifica o relacionamento hasOne com Estoque', function () {
    $produto = Mockery::mock(\App\Models\Produto::class)->makePartial();

    $mockEstoque = Mockery::mock(Estoque::class);
    $produto->shouldReceive('estoque')->andReturn($mockEstoque);

    expect($produto->estoque())->toBe($mockEstoque);
});

it('verifica que atributos não fillable não podem ser atribuídos', function () {
    $produto = new \App\Models\Produto();

    // Atribuir um campo não fillable
    $produto->fill([
        'nome' => 'Produto Teste',
        'loja_online_id' => 1,
        'disponibilidade' => 1,
        'campo_invalido' => 'Invalido'  // Este campo não é fillable
    ]);

    // Verifica se o campo inválido não foi atribuído
    expect($produto->campo_invalido)->toBeNull();
});

it('verifica se a model usa HasFactory', function () {
    $produto = new \App\Models\Produto();

    expect(class_uses($produto))->toContain(\Illuminate\Database\Eloquent\Factories\HasFactory::class);
});


