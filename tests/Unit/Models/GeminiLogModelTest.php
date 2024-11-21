<?php

use App\Models\GeminiLog;


it('verifica os atributos preenchíveis na model GeminiLog', function () {
    // Instância da model
    $geminiLog = new GeminiLog();

    // Verifica os campos preenchíveis definidos
    $this->assertEquals(['descricao', 'operacao', 'status', 'user_id'], $geminiLog->getFillable());
});

it('verifica os atributos fillable estão corretos', function () {
    $geminiLog = new GeminiLog();

    $expectedFillable = ['descricao', 'operacao', 'status', 'user_id'];

    expect($geminiLog->getFillable())->toBe($expectedFillable);
});

it('verifica que atributos não fillable não podem ser atribuídos', function () {
    $geminiLog = new GeminiLog();

    // Tenta atribuir um campo que não é `fillable`
    $geminiLog->fill([
        'descricao' => 'Log de exemplo',
        'operacao' => 'create',
        'status' => 'sucesso',
        'user_id' => 1,
        'campo_invalido' => 'Campo Invalido', // Campo não permitido
    ]);

    // Verifica que o campo inválido não foi atribuído
    expect($geminiLog->campo_invalido)->toBeNull();
});

it('verifica se a model GeminiLog usa HasFactory', function () {
    $geminiLog = new GeminiLog();

    expect(class_uses($geminiLog))->toContain(\Illuminate\Database\Eloquent\Factories\HasFactory::class);
});

it('permite configurar atributos válidos em uma instância de GeminiLog', function () {
    $log = new GeminiLog();
    $log->descricao = 'Ação executada com sucesso';
    $log->operacao = 'criação';
    $log->status = 'sucesso';
    $log->user_id = 1;

    // Verifica que os atributos estão definidos corretamente na instância
    expect($log->descricao)->toBe('Ação executada com sucesso');
    expect($log->operacao)->toBe('criação');
    expect($log->status)->toBe('sucesso');
    expect($log->user_id)->toBe(1);
});

it('permite user_id nulo em uma instância de GeminiLog', function () {
    $log = new GeminiLog();
    $log->descricao = 'Log sem usuário';
    $log->operacao = 'consulta';
    $log->status = 'pendente';
    $log->user_id = null;

    // Verifica que `user_id` é nulo
    expect($log->user_id)->toBeNull();
    expect($log->descricao)->toBe('Log sem usuário');
    expect($log->operacao)->toBe('consulta');
    expect($log->status)->toBe('pendente');
});

it('inicializa uma instância de GeminiLog sem atributos definidos', function () {
    $log = new GeminiLog();

    // Verifica que os atributos estão nulos ou indefinidos
    expect($log->descricao)->toBeNull();
    expect($log->operacao)->toBeNull();
    expect($log->status)->toBeNull();
    expect($log->user_id)->toBeNull();
});
