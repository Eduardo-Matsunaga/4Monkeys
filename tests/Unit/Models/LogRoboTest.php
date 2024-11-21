<?php

use App\Models\LogRobo;


it('verifica os atributos preenchíveis na model LogRobo', function () {
    $logRobo = new LogRobo();

    $expectedFillable = ['url', 'pagina', 'mensagem'];
    expect($logRobo->getFillable())->toBe($expectedFillable);
});

it('verifica que atributos não fillable não podem ser atribuídos', function () {
    $logRobo = new LogRobo();

    // Tenta atribuir um campo que não é `fillable`
    $logRobo->fill([
        'url' => 'http://example.com',
        'pagina' => 1,
        'mensagem' => 'Erro encontrado na página',
        'campo_invalido' => 'Campo Invalido', // Campo não permitido
    ]);

    // Verifica que o campo inválido não foi atribuído
    expect($logRobo->campo_invalido)->toBeNull();
});

it('verifica se a model LogRobo usa HasFactory', function () {
    $logRobo = new LogRobo();

    expect(class_uses($logRobo))->toContain(\Illuminate\Database\Eloquent\Factories\HasFactory::class);
});

it('permite configurar atributos válidos em uma instância de LogRobo', function () {
    $logRobo = new LogRobo();
    $logRobo->url = 'http://example.com';
    $logRobo->pagina = 2;
    $logRobo->mensagem = 'Erro ao acessar a página';

    // Verifica que os atributos estão definidos corretamente na instância
    expect($logRobo->url)->toBe('http://example.com');
    expect($logRobo->pagina)->toBe(2);
    expect($logRobo->mensagem)->toBe('Erro ao acessar a página');
});

it('verifica que UPDATED_AT está desabilitado para a model LogRobo', function () {
    $logRobo = new LogRobo();

    // Atribui valores e confirma que `UPDATED_AT` está como `null`
    expect($logRobo::UPDATED_AT)->toBeNull();
});

it('inicializa uma instância de LogRobo sem atributos definidos', function () {
    $logRobo = new LogRobo();

    // Verifica que os atributos estão nulos ou indefinidos
    expect($logRobo->url)->toBeNull();
    expect($logRobo->pagina)->toBeNull();
    expect($logRobo->mensagem)->toBeNull();
});
