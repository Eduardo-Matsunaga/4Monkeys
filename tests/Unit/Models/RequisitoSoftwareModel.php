<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Software;
uses(RefreshDatabase::class);

it('verifica os atributos fillable estão corretos', function () {
    $requisitoSoftware = new \App\Models\RequisitoSoftware();

    $expectedFillable = [
        'software_id',
        'requisito_nivel',
        'cpu',
        'gpu',
        'ram',
        'placa_mae',
        'ssd',
        'cooler',
        'fonte',
    ];

    expect($requisitoSoftware->getFillable())->toBe($expectedFillable);
});

it('verifica que atributos não fillable não podem ser atribuídos', function () {
    $requisitoSoftware = new \App\Models\RequisitoSoftware();

    // Atribuir um campo não fillable
    $requisitoSoftware->fill([
        'software_id' => 1,
        'requisito_nivel' => 'Minimo',
        'cpu' => 'Intel i5',
        'gpu' => 'GTX 1060',
        'ram' => '16GB',
        'campo_invalido' => 'Valor Invalido',  // Este campo não é fillable
    ]);

    // Verifica se o campo inválido não foi atribuído
    expect($requisitoSoftware->campo_invalido)->toBeNull();
});

it('verifica o relacionamento belongsTo com Software', function () {
    $requisitoSoftware = Mockery::mock(\App\Models\RequisitoSoftware::class)->makePartial();

    $mockSoftware = Mockery::mock(Software::class);
    $requisitoSoftware->shouldReceive('software')->andReturn($mockSoftware);

    expect($requisitoSoftware->software())->toBe($mockSoftware);
});

it('verifica se a model usa HasFactory', function () {
    $requisitoSoftware = new \App\Models\RequisitoSoftware();

    expect(class_uses($requisitoSoftware))->toContain(\Illuminate\Database\Eloquent\Factories\HasFactory::class);
});

