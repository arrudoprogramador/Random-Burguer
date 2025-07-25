<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ControllerCliente extends Controller
{
    
    public function index()
    {
        $Cliente = User::all();
        return view('areaAdmin/clientesCadastrados', compact('Cliente'));      
    }

    public function indexApi()
    {
        // Retorna todos os usuários
        $Cliente = User::all();
        return response()->json($Cliente);
    }
    
    public function login()
    {

    }

    public function destroyCliente($id)
    {
        $Cliente = User::find($id);

        // Verificar se o lanche existe
        if ($Cliente) {
            // Excluir o lanche
            $Cliente->delete();

            // Redirecionar com uma mensagem de sucesso
            return redirect()->route('clientes.admin')->with('success', 'Lanche excluído com sucesso!');
        } else {
            // Caso o lanche não seja encontrado
            return redirect()->route('clientes.admin')->with('error', 'Lanche não encontrado!');
        }
    }


    public function store(Request $request)
    {
        $Cliente = new User();
        $Cliente->nome = $request->input('nome');
        $Cliente->email = $request->input('email');
        $Cliente->dataNasc = $request->input('dataNasc');
        $Cliente->password = $request->input('password');
        $Cliente->save();

        return view('/areaUser/login');
    }

    public function storeApi(Request $request)
    {
        $Cliente = new User();
        $Cliente->nome = $request->input('nome');
        $Cliente->email = $request->input('email');
        $Cliente->dataNasc = $request->input('dataNasc');
        $Cliente->password = $request->input('password');
        $Cliente->save();

        // Resposta para a API
    return response()->json([
        'mensagem' => 'Usuário criado com sucesso!'
    ]);
}
    
    public function show($id)
    {
        //
    }

    public function showApi($id)
    {
        $Cliente = User::find($id);

        return response()->json($Cliente);
        
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    public function updateApi(Request $request, $id)
    {
        // Encontrar o usuário pelo ID
        $Cliente = User::find($id);


        if (!$Cliente) {
            return response()->json(['mensagem' => 'Usuário não encontrado'], 404);
        }

        $Cliente->nome = $request->input('nome');
        $Cliente->email = $request->input('email');
        $Cliente->dataNasc = $request->input('dataNasc');
        $Cliente->password = $request->input('password');
        $Cliente->save();

        // Resposta para a API
        return response()->json([
            'mensagem' => 'Usuário atualizado com sucesso!'
        ]);
    }

    public function destroyApi($id)
        {
            $Cliente = User::find($id);

            if ($Cliente) {
                $Cliente->delete();
                return response()->json(['mensagem' => 'Usuário deletado com sucesso!']);
            }

            return response()->json(['mensagem' => 'Usuário não encontrado'], 404);
        }
}
