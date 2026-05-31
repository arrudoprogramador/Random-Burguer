<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lanche;
use App\Models\User;

class ControllerPesquisa extends Controller
{
    public function pesquisarLanches(Request $request)
    {
        $query = $request->input('pesquisar');

        $lanches = Lanche::where('nome', 'like', '%'.$query.'%')
        ->orWhere('descricao', 'like', '%'.$query.'%')
        ->orWhere('preco', 'like', '%'.$query.'%')
        ->get();

        return view('lanches.index', compact('lanches'));
    }

    public function pesquisarLanches2(Request $request)
    {
        $query = $request->input('pesquisar');

        $lanches = Lanche::where('nome', 'like', '%'.$query.'%')
        ->orWhere('descricao', 'like', '%'.$query.'%')
        ->orWhere('preco', 'like', '%'.$query.'%')
        ->get();

        // Retorna a view com os resultados da pesquisa
        return view('areaAdmin.lanchesCadastrados', compact('lanches'));
    }

    // Método para pesquisar usuários na área do administrador
    public function pesquisarUsuarios(Request $request)
    {
        $query = $request->input('pesquisar');

        // Realiza a pesquisa de usuários com base no nome, email ou id
        $Cliente = user::where('nome', 'like', '%'.$query.'%')
        ->orWhere('email', 'like', '%'.$query.'%')
        ->orWhere('id', 'like', '%'.$query.'%')
        ->get();

        // Retorna a view com os resultados da pesquisa
        return view('areaAdmin.clientesCadastrados', compact('Cliente'));
    }
}

?>