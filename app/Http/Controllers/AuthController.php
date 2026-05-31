<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | AUTENTICAÇÃO WEB
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('areaUser.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required'    => 'O campo de e-mail é obrigatório.',
            'email.email'       => 'Informe um e-mail válido.',
            'password.required' => 'O campo de senha é obrigatório.',
        ]);

        
        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'E-mail ou senha inválidos.']);
        }

        $request->session()->regenerate();

        return redirect()
            ->intended(route('home'))
            ->with('success', 'Bem-vindo de volta, ' . Auth::user()->name . '!');
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    /*
    |--------------------------------------------------------------------------
    | AUTENTICAÇÃO API (Sanctum)
    |--------------------------------------------------------------------------
    */

    public function loginApi(Request $request): JsonResponse
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Credenciais inválidas.',
            ], 401);
        }

        if (!$user->ativo) {
            return response()->json([
                'message' => 'Conta desativada. Entre em contato com o suporte.',
            ], 403);
        }

        // Revoga tokens anteriores e emite novo token
        $user->tokens()->delete();

        $token = $user->createToken(
            'api-token',
            ['*'],                      // abilities — restringir quando necessário
            now()->addDays(30)          // expiração em 30 dias
        )->plainTextToken;

        return response()->json([
            'message' => 'Login realizado com sucesso.',
            'data'    => [
                'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
                'role'  => $user->role,
            ],
            'token' => $token,
        ]);
    }

    public function logoutApi(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout realizado com sucesso.',
        ]);
    }
}