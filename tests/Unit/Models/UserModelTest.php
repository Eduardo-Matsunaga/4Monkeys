<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('verifica os atributos fillable estão corretos', function () {
    $user = new \App\Models\User();

    $expectedFillable = ['name', 'email', 'password', 'situacao'];

    expect($user->getFillable())->toBe($expectedFillable);
});

it('verifica os atributos hidden estão corretos', function () {
    $user = new \App\Models\User();

    $expectedHidden = ['password', 'remember_token'];

    expect($user->getHidden())->toBe($expectedHidden);
});

it('verifica os atributos casts estão corretos', function () {
    $user = new User();

    $expectedCasts = [
        'id' => 'int',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    expect($user->getCasts())->toBe($expectedCasts);
});

it('verifica o relacionamento hasMany com Conjunto', function () {
    $user = Mockery::mock(\App\Models\User::class)->makePartial();

    $mockConjuntos = Mockery::mock(\Illuminate\Database\Eloquent\Collection::class);
    $user->shouldReceive('conjuntos')->andReturn($mockConjuntos);

    expect($user->conjuntos())->toBe($mockConjuntos);
});

it('verifica se a model usa HasFactory', function () {
    $user = new \App\Models\User();

    expect(class_uses($user))->toContain(\Illuminate\Database\Eloquent\Factories\HasFactory::class);
});
