<?php

use App\Models\CustomLog;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);


it('verifica os atributos preenchíveis na model CustomLog', function () {
    // Instância da model
    $customLog = new CustomLog();

    // Verifica os campos preenchíveis definidos
    $this->assertEquals(['descricao', 'operacao', 'admin_id'], $customLog->getFillable());
});

it('verifica os atributos fillable estão corretos', function () {
    $customLog = new \App\Models\CustomLog();

    $expectedFillable = ['descricao', 'operacao', 'admin_id'];

    expect($customLog->getFillable())->toBe($expectedFillable);
});

it('verifica que atributos não fillable não podem ser atribuídos', function () {
    $customLog = new \App\Models\CustomLog();

    // Atribuir um campo não fillable
    $customLog->fill([
        'descricao' => 'Produto Criado',
        'operacao' => 'create',
        'admin_id' => 1,
        'campo_invalido' => 'Campo Invalido',  // Este campo não é fillable
    ]);

    // Verifica se o campo inválido não foi atribuído
    expect($customLog->campo_invalido)->toBeNull();
});

it('verifica se a model usa HasFactory', function () {
    $customLog = new \App\Models\CustomLog();

    expect(class_uses($customLog))->toContain(\Illuminate\Database\Eloquent\Factories\HasFactory::class);
});

it('permite configurar atributos válidos em uma instância de CustomLog', function () {
    $log = new CustomLog();
    $log->descricao = 'Ação executada com sucesso';
    $log->operacao = 'criação';
    $log->admin_id = 1;

    // Verifica que os atributos estão definidos corretamente na instância
    expect($log->descricao)->toBe('Ação executada com sucesso');
    expect($log->operacao)->toBe('criação');
    expect($log->admin_id)->toBe(1);
});

it('permite admin_id nulo em uma instância de CustomLog', function () {
    $log = new CustomLog();
    $log->descricao = 'Log sem admin';
    $log->operacao = 'consulta';
    $log->admin_id = null;

    // Verifica que admin_id é nulo
    expect($log->admin_id)->toBeNull();
    expect($log->descricao)->toBe('Log sem admin');
    expect($log->operacao)->toBe('consulta');
});

it('inicializa uma instância de CustomLog sem atributos definidos', function () {
    $log = new CustomLog();

    // Verifica que os atributos estão nulos ou indefinidos
    expect($log->descricao)->toBeNull();
    expect($log->operacao)->toBeNull();
    expect($log->admin_id)->toBeNull();
});


