@extends('layouts.app')

@section('title', 'Acesso Negado')

@section('content')
<div class="min-h-screen bg-surface flex items-center justify-center px-6">
    <div class="text-center max-w-md">

        <div class="w-20 h-20 rounded-full bg-red-500/10 border border-red-500/20 flex items-center justify-center mx-auto mb-6">
            <i class="bi bi-shield-x text-4xl text-red-400"></i>
        </div>

        <h1 class="font-display text-6xl text-white font-black mb-2">403</h1>
        <h2 class="font-display text-2xl text-white mb-4">Acesso Negado</h2>
        <p class="text-white/40 text-sm mb-8">
            Você não tem permissão para acessar esta área.
        </p>

        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <a href="{{ route('home') }}"
               class="px-6 py-3 rounded-full bg-brand text-black font-semibold hover:bg-brand-light transition-all">
                Voltar ao início
            </a>
            @guest
                <a href="{{ route('auth.login') }}"
                   class="px-6 py-3 rounded-full border border-white/10 text-white/60 hover:text-brand hover:border-brand/30 transition-all">
                    Fazer login
                </a>
            @endguest
        </div>

    </div>
</div>
@endsection