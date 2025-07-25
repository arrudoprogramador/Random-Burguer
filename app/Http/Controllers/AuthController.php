<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function index()
    {
        return view('/areaUser/login');
    }

    public function store(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ],[
        'email.required' => 'O campo de email é obrigatório.',
        'email.email' => 'O email informado não é válido.',
        'password.required' => 'O campo de senha é obrigatório.',
    ]);

    $credentials = $request->only('email', 'password');

    if (!Auth::attempt($credentials)) {
        return redirect()->route('login.index')->withErrors(['error' => 'Email ou senha inválidos']);
    }

    return view('/areaUser/index')->with('success', 'Login realizado com sucesso!');
}


    public function destroy()
    {
        Auth::logout();
        return view('/areaUser/index')->with('sucess', 'Deslogged');
    }


    public function loginApi(Request $request)
        {
            // Validar os dados
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }

            // Buscar usuário
            $Cliente = User::where('email', $request->email)->first();

            if (!$Cliente || !Hash::check($request->password, $Cliente->password)) {
                return response()->json(['error' => 'Credenciais inválidas'], 401);
            }

            // Gerar um token fake só pra teste
            return response()->json([
                'message' => 'Login bem-sucedido',
                'usuario' => $Cliente,
                'token' => base64_encode($Cliente->email . now()) // só pra simular
            ], 200);
        }
}
