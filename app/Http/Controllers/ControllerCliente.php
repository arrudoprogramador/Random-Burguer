<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class ControllerCliente extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ÁREA ADMINISTRATIVA (Web)
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $clientes = User::orderBy('name')->get();

        return view('areaAdmin.clientesCadastrados', compact('clientes'));
    }

    public function destroyCliente(int $id)
    {
        $cliente = User::findOrFail($id);
        $cliente->delete();

        return redirect()
            ->route('admin.clientes.index')
            ->with('success', 'Cliente removido com sucesso.');
    }

    /*
    |--------------------------------------------------------------------------
    | CADASTRO (Web)
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'telefone' => 'nullable|string|max:20',

            // ----------------------------------------------------------------
            // Campos para compras — descomentar quando implementar checkout
            // ----------------------------------------------------------------
            // 'cpf'               => 'required|string|size:11|unique:users,cpf',
            // 'dataNasc'          => 'required|date|before:-18 years',
            // 'cep'               => 'required|string|size:8',
            // 'logradouro'        => 'required|string|max:255',
            // 'numero'            => 'required|string|max:20',
            // 'complemento'       => 'nullable|string|max:100',
            // 'bairro'            => 'required|string|max:100',
            // 'cidade'            => 'required|string|max:100',
            // 'estado'            => 'required|string|size:2',
        ], [
            'name.required'      => 'O nome é obrigatório.',
            'email.required'     => 'O e-mail é obrigatório.',
            'email.email'        => 'Informe um e-mail válido.',
            'email.unique'       => 'Este e-mail já está cadastrado.',
            'password.required'  => 'A senha é obrigatória.',
            'password.min'       => 'A senha deve ter pelo menos 6 caracteres.',
            'password.confirmed' => 'As senhas não conferem.',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'telefone' => $request->telefone,
            'role'     => 'cliente',
            'ativo'    => true,

            // ----------------------------------------------------------------
            // Campos para compras — descomentar quando implementar checkout
            // ----------------------------------------------------------------
            // 'cpf'          => $request->cpf,
            // 'dataNasc'     => $request->dataNasc,
            // 'cep'          => $request->cep,
            // 'logradouro'   => $request->logradouro,
            // 'numero'       => $request->numero,
            // 'complemento'  => $request->complemento,
            // 'bairro'       => $request->bairro,
            // 'cidade'       => $request->cidade,
            // 'estado'       => $request->estado,
        ]);

        return redirect()
            ->route('auth.login')
            ->with('success', 'Conta criada com sucesso! Faça login para continuar.');
    }

    /*
    |--------------------------------------------------------------------------
    | API — Clientes
    |--------------------------------------------------------------------------
    */

    public function indexApi(): JsonResponse
    {
        $clientes = User::select('id', 'name', 'email', 'telefone', 'role', 'ativo', 'created_at')
            ->orderBy('name')
            ->get();

        return response()->json($clientes);
    }

    public function showApi(int $id): JsonResponse
    {
        $cliente = User::findOrFail($id);

        return response()->json($cliente);
    }

    public function storeApi(Request $request): JsonResponse
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'telefone' => 'nullable|string|max:20',

            // ----------------------------------------------------------------
            // Campos para compras — descomentar quando implementar checkout
            // ----------------------------------------------------------------
            // 'cpf'      => 'required|string|size:11|unique:users,cpf',
            // 'dataNasc' => 'required|date',
            // 'cep'      => 'required|string|size:8',
        ]);

        $cliente = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'telefone' => $request->telefone,
            'role'     => 'cliente',
            'ativo'    => true,
        ]);

        return response()->json([
            'message' => 'Usuário criado com sucesso.',
            'data'    => $cliente,
        ], 201);
    }

    public function updateApi(Request $request, int $id): JsonResponse
    {
        $cliente = User::findOrFail($id);

        $request->validate([
            'name'     => 'sometimes|string|max:255',
            'email'    => 'sometimes|email|unique:users,email,' . $id,
            'password' => 'sometimes|string|min:6',
            'telefone' => 'nullable|string|max:20',
        ]);

        $cliente->fill($request->only(['name', 'email', 'telefone']));

        if ($request->filled('password')) {
            $cliente->password = Hash::make($request->password);
        }

        $cliente->save();

        return response()->json([
            'message' => 'Usuário atualizado com sucesso.',
            'data'    => $cliente,
        ]);
    }

    public function destroyApi(int $id): JsonResponse
    {
        $cliente = User::findOrFail($id);
        $cliente->delete();

        return response()->json([
            'message' => 'Usuário removido com sucesso.',
        ]);
    }
}