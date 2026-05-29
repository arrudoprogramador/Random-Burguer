<?php

use App\Http\Controllers\ControllerCliente;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\controllerLanches;
use App\Http\Controllers\ControllerPesquisa;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;

use Illuminate\Support\Facades\Http;

//gets User
Route::get('/', [ControllerLanches::class, 'show4'])->name('home');


//gets Adm
Route::get('/admin', function () {
    return view('/areaAdmin/index');
});
Route::get('/pedidos', function () {
    return view('/areaAdmin/pedidos');
});

Route::get('/lanchesCadastrados', function () {
    return view('/areaAdmin/lanchesCadastrados');
});
Route::get('/clientesCadastrados', function () {
    return view('/areaAdmin/clientesCadastrados');
});

Route::get('/registerLanche', function () {
    return view('/areaAdmin/registerLanche');
});
Route::get('/config', function () {
    return view('/areaAdmin/config');
});

//Routes da navbar 
Route::get('/pesquisa', function () {
    return view('/Controllers/ControllerPesquisa');
});

Route::get('/cadastro', function(){
    return view('/areaUser/cadastro');
});

Route::get('/carrinho', function(){
    return view('/areaUser/carrinho');
});

Route::get('/app', function(){
    return view('/areaUser/layouts/app');
});


//carrinho


Route::get('/carrinho', [CartController::class, 'visualizarCarrinho'])->name('carrinho.visualizar');
Route::post('/carrinho/adicionar/{id}', [CartController::class, 'adicionarAoCarrinho'])->name('carrinho.adicionar');
Route::post('/carrinho/remover/{id}', [CartController::class, 'removerDoCarrinho'])->name('carrinho.remover');
Route::post('/carrinho/limpar', [CartController::class, 'limparCarrinho'])->name('carrinho.limpar');
Route::put('/carrinho/atualizar/{id}', [CartController::class, 'atualizar'])->name('carrinho.atualizar');


//Componentes
Route::get('/navbarAdmin', function () {
    return view('/componentes.navbarAdmin');
});
Route::get('/componentes.navbarUser', function () {
    return view('/componentes/usuario/navbarUser');
});


//controllers
Route::get('/pesquisar', 'ControllerPesquisa@pesquisar');

// Pesquisa para lanches na área do usuário
Route::get('areaUser/lanches', [ControllerPesquisa::class, 'pesquisarLanches'])->name('pesquisar.lanches');

Route::get('areaAdmin/lanchesCadastrados', [ControllerPesquisa::class, 'pesquisarLanches2'])->name('pesquisar.lanches2');

// Pesquisa para usuários na área do administrador
Route::get('areaAdmin/clientesCadastrados', [ControllerPesquisa::class, 'pesquisarUsuarios'])->name('pesquisar.clientes');

// Route::get('/carrinho', [ControllerPesquisa::class, 'pesquisarLanches'])->name('pesquisar.lanches');
Route::get('/areaUser/lancheEscolhido/{id}', [ControllerLanches::class, 'show'])->name('lanche.show');



// Exibir todos os lanches para o usuário
Route::get('/lanches', [ControllerLanches::class, 'index'])->name('areaUser.lanches');


// Administração de lanches (somente para administradores)
Route::get('/lanchesCadastrados', [ControllerLanches::class, 'admin'])->name('lanches.admin');

Route::get('/clientesCadastrados', [ControllerCliente::class, 'index'])->name('clientes.admin');

// Route::get('/admin', [controllerLanches::class, 'vendasTotais'])->name('dashboard');
// Formulário de cadastro de lanche
Route::get('/areaAdmin/registerLanche', [ControllerLanches::class, 'create'])->name('lanches.create');

// Verif login
Route::post('/login', [AuthController::class, 'store'])->name('login.store');
Route::get('/login', [AuthController::class, 'index'])->name('login.index');


// Salvar o lanche no banco de dados (requisição POST)
Route::post('/register', [ControllerLanches::class, 'store'])->name('lanches.store');

// Salvar o cliente no banco de dados (requisição POST)
Route::post('/registerCliente', [ControllerCliente::class, 'store'])->name('cliente.store');


// Editar lanche
Route::put('/lanche/{id}', [controllerLanches::class, 'update'])->name('lanche.update');
Route::get('/lanchesCadastrados/{id}/edit', [controllerLanches::class, 'edit'])->name('lanche.edit');


// Logout login
Route::get('/logout', [AuthController::class, 'destroy'])->name('login.destroy');

Route::delete('/lanches/{id}', [ControllerLanches::class, 'destroy'])->name('lanches.destroy');
Route::delete('/clienteCadastrados/{id}', [ControllerCliente::class, 'destroyCliente'])->name('cliente.destroy');





