<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ControllerCliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| ROTAS PÚBLICAS — Autenticação
|--------------------------------------------------------------------------
*/

Route::prefix('auth')->name('api.auth.')->group(function () {
    Route::post('/login',    [AuthController::class,    'loginApi'])->middleware('throttle:10,1')->name('login');
    Route::post('/cadastro', [ControllerCliente::class, 'storeApi'])->middleware('throttle:5,1')->name('cadastro');
});

/*
|--------------------------------------------------------------------------
| ROTAS AUTENTICADAS — Sanctum
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {

    // Usuário autenticado
    Route::get('/me',      fn(Request $r) => response()->json($r->user()))->name('api.me');
    Route::post('/logout', [AuthController::class, 'logoutApi'])->name('api.auth.logout');

    // Clientes (admin)
    Route::prefix('clientes')->name('api.clientes.')->group(function () {
        Route::get('/',        [ControllerCliente::class, 'indexApi'])->name('index');
        Route::get('/{id}',    [ControllerCliente::class, 'showApi'])->name('show')->whereNumber('id');
        Route::patch('/{id}',  [ControllerCliente::class, 'updateApi'])->name('update')->whereNumber('id');
        Route::delete('/{id}', [ControllerCliente::class, 'destroyApi'])->name('destroy')->whereNumber('id');
    });
});