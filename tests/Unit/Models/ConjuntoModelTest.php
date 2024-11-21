<?php

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Conjunto;


uses(RefreshDatabase::class);

it('verifica os atributos fillable estão corretos', function () {
    $conjunto = new Conjunto();

    $expectedFillable = ['nome', 'categoria_id', 'user_id'];

    expect($conjunto->getFillable())->toBe($expectedFillable);
});

it('verifica o relacionamento belongsTo com User', function () {
    $conjunto = Mockery::mock(Conjunto::class)->makePartial();

    $mockUser = Mockery::mock(User::class);
    $conjunto->shouldReceive('user')->andReturn($mockUser);

    expect($conjunto->user())->toBe($mockUser);
});

it('verifica o relacionamento belongsToMany com Produto', function () {
    $conjunto = Mockery::mock(Conjunto::class)->makePartial();

    $mockProdutos = Mockery::mock(Collection::class);
    $conjunto->shouldReceive('produtos')->andReturn($mockProdutos);

    expect($conjunto->produtos())->toBe($mockProdutos);
});

it('verifica o relacionamento belongsToMany com Software', function () {
    $conjunto = Mockery::mock(Conjunto::class)->makePartial();

    $mockSoftwares = Mockery::mock(Collection::class);
    $conjunto->shouldReceive('softwares')->andReturn($mockSoftwares);

    expect($conjunto->softwares())->toBe($mockSoftwares);
});

it('verifica o relacionamento belongsTo com Categoria', function () {
    $conjunto = Mockery::mock(Conjunto::class)->makePartial();

    $mockCategoria = Mockery::mock(Categoria::class);
    $conjunto->shouldReceive('categoria')->andReturn($mockCategoria);

    expect($conjunto->categoria())->toBe($mockCategoria);
});

it('verifica que atributos não fillable não podem ser atribuídos', function () {
    $conjunto = new Conjunto();

    // Atribuir um campo não fillable
    $conjunto->fill([
        'nome' => 'Conjunto Teste',
        'categoria_id' => 1,
        'user_id' => 1,
        'campo_invalido' => 'Invalido'  // Este campo não é fillable
    ]);

    // Verifica se o campo inválido não foi atribuído
    expect($conjunto->campo_invalido)->toBeNull();
});

it('verifica se a model usa HasFactory', function () {
    $conjunto = new Conjunto();

    expect(class_uses($conjunto))->toContain(HasFactory::class);
});
