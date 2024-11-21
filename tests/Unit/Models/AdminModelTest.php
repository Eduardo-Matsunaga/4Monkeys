<?php
use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

it('verifica se os atributos fillable estão corretos', function () {
    $admin = new Admin();

    // Espera que os atributos fillable estejam corretos
    $expectedFillable = ['name', 'email', 'password'];

    // Verifica se os atributos fillable são os esperados
    expect($admin->getFillable())->toBe($expectedFillable);
});

it('verifica se os atributos hidden estão corretos', function () {
    $admin = new Admin();

    // Espera que os atributos ocultos estejam corretos
    $expectedHidden = ['password', 'remember_token'];

    // Verifica se os atributos hidden são os esperados
    expect($admin->getHidden())->toBe($expectedHidden);
});

it('verifica se os atributos cast estão corretos', function () {
    $admin = new \App\Models\Admin();

    // Espera que os casts estejam configurados corretamente
    $expectedCasts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Verifica se os casts contêm os valores esperados
    foreach ($expectedCasts as $key => $value) {
        expect($admin->getCasts())->toHaveKey($key, $value);
    }
});


it('verifica se o administrador pode receber notificações', function () {
    $admin = new \App\Models\Admin();

    // Verifica se o modelo usa a trait Notifiable
    expect(method_exists($admin, 'notify'))->toBeTrue();
});

it('verifica se a model usa o trait Notifiable', function () {
    $admin = new Admin();
    expect(class_uses($admin))->toContain(\Illuminate\Notifications\Notifiable::class);
});


