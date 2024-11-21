<?php

use App\Models\Estoque;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('verifica os atributos fillable estão corretos', function () {
    $estoque = new Estoque();

    $expectedFillable = ['produto_id', 'created_at', 'updated_at'];

    expect($estoque->getFillable())->toBe($expectedFillable);
});


it('verifica o relacionamento belongsTo com Produto', function () {
    $estoque = Mockery::mock(\App\Models\Estoque::class)->makePartial();

    $mockProduto = Mockery::mock(Produto::class);
    $estoque->shouldReceive('produto')->andReturn($mockProduto);

    expect($estoque->produto())->toBe($mockProduto);
});

it('verifica se a model usa HasFactory', function () {
    $estoque = new \App\Models\Estoque();

    expect(class_uses($estoque))->toContain(\Illuminate\Database\Eloquent\Factories\HasFactory::class);
});



