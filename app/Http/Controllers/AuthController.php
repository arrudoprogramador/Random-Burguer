<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
}
