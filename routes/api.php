<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ControllerCliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/contas', [ControllerCliente::class, 'indexApi']);
Route::get('/conta/{id}', [ControllerCliente::class, 'showApi']);

Route::post('/conta/adicionar',[ControllerCliente::class, 'storeApi']);

Route::delete('/conta/excluir/{id}',[ControllerCliente::class, 'destroyApi']);

Route::put('/conta/atualizar/{id}',[ControllerCliente::class, 'updateApi']);

Route::post('login', [AuthController::class, 'loginApi']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
