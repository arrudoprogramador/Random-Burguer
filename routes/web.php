<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ControllerCliente;
use App\Http\Controllers\ControllerLanches;
use App\Http\Controllers\ControllerPesquisa;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| ROTAS PÚBLICAS — Área do Usuário
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', [ControllerLanches::class, 'show4'])->name('home');

// Cardápio
Route::prefix('lanches')->name('lanches.')->group(function () {
    Route::get('/',        [ControllerLanches::class, 'index'])->name('index');
    Route::get('/{id}',    [ControllerLanches::class, 'show'])->name('show')->whereNumber('id');
});

// Pesquisa
Route::get('/busca', [ControllerPesquisa::class, 'pesquisarLanches'])->name('lanches.busca');

/*
|--------------------------------------------------------------------------
| ROTAS DE AUTENTICAÇÃO — Guest only
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->prefix('auth')->name('auth.')->group(function () {
    Route::get( '/login',    [AuthController::class, 'index'])->name('login');
    Route::post('/login',    [AuthController::class, 'store'])->name('login.store');
    Route::get( '/cadastro', fn() => view('areaUser.cadastro'))->name('cadastro');
    Route::post('/cadastro', [ControllerCliente::class, 'store'])->name('cadastro.store');
});

// Logout (autenticado)
Route::post('/auth/logout', [AuthController::class, 'destroy'])
    ->middleware('auth')
    ->name('auth.logout');

/*
|--------------------------------------------------------------------------
| ROTAS AUTENTICADAS — Carrinho e Pedidos
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->prefix('carrinho')->name('carrinho.')->group(function () {
    Route::get('/',              [CartController::class, 'visualizarCarrinho'])->name('index');
    Route::post('/adicionar/{id}',[CartController::class, 'adicionarAoCarrinho'])->name('adicionar')->whereNumber('id');
    Route::delete('/remover/{id}',[CartController::class, 'removerDoCarrinho'])->name('remover')->whereNumber('id');
    Route::patch('/atualizar/{id}',[CartController::class, 'atualizar'])->name('atualizar')->whereNumber('id');
    Route::delete('/limpar',     [CartController::class, 'limparCarrinho'])->name('limpar');
});

/*
|--------------------------------------------------------------------------
| ROTAS ADMINISTRATIVAS — Middleware auth + role admin
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/', [ControllerLanches::class, 'vendasTotais'])->name('dashboard');

    // Lanches
    Route::prefix('lanches')->name('lanches.')->group(function () {
        Route::get('/',           [ControllerLanches::class, 'admin'])->name('index');
        Route::get('/criar',      [ControllerLanches::class, 'create'])->name('create');
        Route::post('/',          [ControllerLanches::class, 'store'])->name('store');
        Route::get('/{id}/editar',[ControllerLanches::class, 'edit'])->name('edit')->whereNumber('id');
        Route::put('/{id}',       [ControllerLanches::class, 'update'])->name('update')->whereNumber('id');
        Route::delete('/{id}',    [ControllerLanches::class, 'destroy'])->name('destroy')->whereNumber('id');
    });

    // Clientes
    Route::prefix('clientes')->name('clientes.')->group(function () {
        Route::get('/',        [ControllerCliente::class, 'index'])->name('index');
        Route::get('/busca',   [ControllerPesquisa::class, 'pesquisarUsuarios'])->name('busca');
        Route::delete('/{id}', [ControllerCliente::class, 'destroyCliente'])->name('destroy')->whereNumber('id');
    });

    // Pedidos
    Route::get('/pedidos', fn() => view('areaAdmin.pedidos'))->name('pedidos');

    // Configurações
    Route::get('/config', fn() => view('areaAdmin.config'))->name('config');
});