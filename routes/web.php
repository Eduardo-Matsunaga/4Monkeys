<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AvaliacaoController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\ConjuntoLocalController;
use App\Http\Controllers\FreeConjuntoController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\LogRoboController;
use App\Http\Controllers\PremiumController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ConjuntoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SoftwareController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminAuthenticated;
use Illuminate\Support\Facades\Route;

/*Route::get('/home', function () {
    return view('home');
});*/

Route::get('/dashboard', [ConjuntoController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/', [ConjuntoController::class, 'create'])->name('home.create');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/selecionar', [ConjuntoController::class, 'selecionar'])->name('home.selecionar');
    Route::get('/historico-conjuntos', [ConjuntoController::class, 'historicoConjuntos']);
    Route::post('/avaliar', [AvaliacaoController::class, 'store'])->name('avaliar.store');
    Route::get('/avaliar/create', [AvaliacaoController::class, 'create'])->name('avaliar.create');
});


Route::post('/selecionar-free', [FreeConjuntoController::class, 'selecionar'])->name('free.selecionar');
Route::post('/conjunto-produtos', [ConjuntoLocalController::class, 'getConjuntoProdutos'])->name('conjunto.produtos');


Route::resource('/produtos', ProdutoController::class)->middleware(AdminAuthenticated::class);
Route::resource('/softwares', SoftwareController::class)->middleware(AdminAuthenticated::class);
Route::resource('/usuario-premium', PremiumController::class)->middleware(AdminAuthenticated::class);
Route::get('/api/desktops-by-day', [AdminDashboardController::class, 'getDesktopsByDay'])->middleware(AdminAuthenticated::class);


Route::get('/avaliar', [AvaliacaoController::class, 'index'])->name('avaliar.index')->middleware(AdminAuthenticated::class);
Route::get('/login-admin', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/login-admin', [AdminController::class, 'login']);
Route::resource('/create-admin', AdminController::class)->middleware(AdminAuthenticated::class);
Route::post('/admin/logout', function () {
    auth()->guard('admin')->logout();  // Faz o logout usando o guard 'admin'
    return redirect('/');  // Redireciona para a página de login do admin (ou outra rota que você definir)
})->name('admin.logout');

Route::get('/dashboard-admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard')->middleware(AdminAuthenticated::class);

Route::get('/logRobo', [LogRoboController::class, 'index'])->name('auth.admin.logs');
Route::get('/tables', [LogController::class, 'index'])->name('auth.admin.logs');
Route::get('/logs/export', [LogController::class, 'export'])->name('logs.export');
Route::get('/charts', function () {
    return view('admin.charts');
})->name('admin.charts')->middleware(AdminAuthenticated::class);

Route::get('/api/charts-data', [ChartController::class, 'getChartData']);

/*Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('auth.admin.AdminDashboard');
});*/ //implementação da rota com o token

//rotas para teste
Route::get('/produtos/search', [ProdutoController::class, 'show'])->name('produtos.search');
Route::get('/softwares/search', [SoftwareController::class, 'show'])->name('softwares.search');



require __DIR__.'/auth.php';
