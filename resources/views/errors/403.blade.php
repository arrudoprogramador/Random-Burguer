@extends('layouts.app')

@section('title', 'Acesso Negado — RandomBurguer')

@section('content')
<div class="min-h-screen bg-surface flex items-center justify-center px-6 transition-colors duration-300">
    <div class="text-center max-w-md">

        <div class="w-20 h-20 rounded-full bg-red-500/10 border border-red-500/20 flex items-center justify-center mx-auto mb-6">
            <i class="bi bi-shield-x text-4xl text-red-500"></i>
        </div>

        <h1 class="font-display text-6xl text-stone-900 dark:text-white font-black mb-2">403</h1>
        <h2 class="font-display text-2xl text-stone-900 dark:text-white font-bold mb-4">Acesso Negado</h2>
        <p class="text-stone-500 dark:text-white/40 text-sm mb-8">
            Você não possui as permissões necessárias para acessar esta área restrita.
        </p>

        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <a href="{{ route('home') }}"
               class="px-6 py-3 rounded-full bg-brand text-black font-bold hover:bg-brand-light transition-all shadow-md shadow-brand/20">
                Voltar ao início
            </a>
            @guest
                <a href="{{ route('auth.login') }}"
                   class="px-6 py-3 rounded-full border border-surface-border dark:border-white/10 text-stone-700 dark:text-white/60 hover:text-brand hover:border-brand/40 transition-all font-semibold">
                    Fazer login
                </a>
            @endguest
        </div>

    </div>
</div>
@endsection