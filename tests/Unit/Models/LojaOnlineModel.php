<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Produto;

uses(RefreshDatabase::class);

it('verifica os atributos fillable estão corretos', function () {
    $lojaOnline = new \App\Models\LojaOnline();

    $expectedFillable = ['urlLoja', 'valor', 'moeda', 'created_at', 'updated_at'];

    expect($lojaOnline->getFillable())->toBe($expectedFillable);
});

it('verifica que atributos não fillable não podem ser atribuídos', function () {
    $lojaOnline = new \App\Models\LojaOnline();

    // Atribuir um campo não fillable
    $lojaOnline->fill([
        'urlLoja' => 'http://example.com',
        'valor' => 100.50,
        'moeda' => 'USD',
        'campo_invalido' => 'Valor Invalido',  // Este campo não é fillable
    ]);

    // Verifica se o campo inválido não foi atribuído
    expect($lojaOnline->campo_invalido)->toBeNull();
});

it('verifica o relacionamento hasOne com Produto', function () {
    $lojaOnline = Mockery::mock(\App\Models\LojaOnline::class)->makePartial();

    $mockProduto = Mockery::mock(Produto::class);
    $lojaOnline->shouldReceive('produto')->andReturn($mockProduto);

    expect($lojaOnline->produto())->toBe($mockProduto);
});

it('verifica se a model usa HasFactory', function () {
    $lojaOnline = new \App\Models\LojaOnline();

    expect(class_uses($lojaOnline))->toContain(\Illuminate\Database\Eloquent\Factories\HasFactory::class);
});



