<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\lancheModel;
use App\Models\User;

class ControllerPesquisa extends Controller
{
    public function pesquisarLanches(Request $request)
    {
        $query = $request->input('pesquisar');

        $lanches = lancheModel::where('nomeLanche', 'like', '%'.$query.'%')->get();

        return view('areaUser.lanches', compact('lanches'));
    }

    public function pesquisarLanches2(Request $request)
    {
        $query = $request->input('pesquisar');

        $lanches = lancheModel::where('nomeLanche', 'like', '%'.$query.'%')->get();

        // Retorna a view com os resultados da pesquisa
        return view('areaAdmin.lanchesCadastrados', compact('lanches'));
    }

    // Método para pesquisar usuários na área do administrador
    public function pesquisarUsuarios(Request $request)
    {
        $query = $request->input('pesquisar');

        // Realiza a pesquisa de usuários com base no nome, email ou id
        $Cliente = User::where('nome', 'like', '%'.$query.'%')
        ->orWhere('email', 'like', '%'.$query.'%')
        ->orWhere('id', 'like', '%'.$query.'%')
        ->get();

        // Retorna a view com os resultados da pesquisa
        return view('areaAdmin.clientesCadastrados', compact('Cliente'));
    }
}

?>