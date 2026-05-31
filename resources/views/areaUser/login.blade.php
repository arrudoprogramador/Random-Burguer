{{-- resources/views/areaUser/login.blade.php --}}
@extends('layouts.app')

@section('title', 'Entrar — RandomBurguer')

@section('content')

<div class="min-h-screen bg-surface flex">

    {{-- =====================
        LADO ESQUERDO — imagem
    ===================== --}}
    <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden">
        <img
            src="{{ url('img/fundo.jpg') }}"
            alt="RandomBurguer"
            class="w-full h-full object-cover"
            onerror="this.src='https://placehold.co/800x1000/111111/F59E0B?text=🍔'"
        />
        {{-- Overlay --}}
        <div class="absolute inset-0 bg-gradient-to-r from-black/60 to-surface/90"></div>

        {{-- Conteúdo sobre a imagem --}}
        <div class="absolute inset-0 flex flex-col justify-end p-12">
            <p class="text-xs text-brand font-semibold uppercase tracking-widest mb-3">Bem-vindo de volta</p>
            <h2 class="font-display text-4xl text-white font-bold leading-tight mb-4">
                Sabor que você<br>
                <span class="italic text-brand">nunca esquece</span>
            </h2>
            <p class="text-white/50 text-sm leading-relaxed max-w-xs">
                Faça login e aproveite promoções exclusivas, acompanhe seus pedidos e muito mais.
            </p>

            {{-- Depoimento --}}
            <div class="mt-8 p-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-sm">
                <div class="flex gap-1 mb-2">
                    @for($i = 0; $i < 5; $i++)
                        <i class="bi bi-star-fill text-brand text-xs"></i>
                    @endfor
                </div>
                <p class="text-white/60 text-sm italic">"Melhor burguer de SP, sem dúvidas!"</p>
                <p class="text-white/30 text-xs mt-1">— Matheus Silva</p>
            </div>
        </div>
    </div>

    {{-- =====================
        LADO DIREITO — formulário
    ===================== --}}
    <div class="flex-1 flex items-center justify-center px-6 py-16 lg:px-16">
        <div class="w-full max-w-md">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2 mb-10 group w-fit">
                <div class="w-9 h-9 rounded-full bg-brand flex items-center justify-center shadow-md shadow-brand/30 group-hover:scale-110 transition-transform">
                    <i class="bi bi-fire text-black text-lg"></i>
                </div>
                <span class="font-display text-xl text-white tracking-tight">
                    Random<span class="text-brand">Burguer</span>
                </span>
            </a>

            {{-- Cabeçalho --}}
            <div class="mb-8">
                <h1 class="font-display text-3xl lg:text-4xl text-white font-bold mb-2">
                    Que alegria te ver<br>por aqui!
                </h1>
                <p class="text-white/40 text-sm">
                    Insira seus dados e aproveite benefícios exclusivos.
                </p>
            </div>

            {{-- Alertas --}}
            @if(session('success'))
                <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-green-500/10 border border-green-500/20 text-green-400 text-sm mb-6">
                    <i class="bi bi-check-circle-fill shrink-0"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->has('email') && $errors->first('email') === 'E-mail ou senha inválidos.')
                <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm mb-6">
                    <i class="bi bi-exclamation-circle-fill shrink-0"></i>
                    {{ $errors->first('email') }}
                </div>
            @endif

            {{-- Formulário --}}
            <form method="POST" action="{{ route('auth.login.store') }}" class="flex flex-col gap-5">
                @csrf

                {{-- E-mail --}}
                <div class="flex flex-col gap-1.5">
                    <label for="email" class="text-xs text-white/40 uppercase tracking-widest font-medium">
                        E-mail
                    </label>
                    <div class="relative">
                        <i class="bi bi-envelope absolute left-4 top-1/2 -translate-y-1/2 text-white/25 text-sm"></i>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="seu@email.com"
                            required
                            autocomplete="email"
                            class="w-full bg-surface-muted border @error('email') border-red-500/50 @else border-white/10 @enderror rounded-xl pl-10 pr-4 py-3.5 text-sm text-white placeholder-white/25 focus:outline-none focus:border-brand/50 focus:ring-1 focus:ring-brand/30 transition-all"
                        />
                    </div>
                    @error('email')
                        @if($message !== 'E-mail ou senha inválidos.')
                            <p class="text-red-400 text-xs mt-0.5">{{ $message }}</p>
                        @endif
                    @enderror
                </div>

                {{-- Senha --}}
                <div class="flex flex-col gap-1.5" x-data="{ show: false }">
                    <div class="flex items-center justify-between">
                        <label for="password" class="text-xs text-white/40 uppercase tracking-widest font-medium">
                            Senha
                        </label>
                        <a href="#" class="text-xs text-brand/70 hover:text-brand transition-colors">
                            Esqueceu a senha?
                        </a>
                    </div>
                    <div class="relative">
                        <i class="bi bi-lock absolute left-4 top-1/2 -translate-y-1/2 text-white/25 text-sm"></i>
                        <input
                            :type="show ? 'text' : 'password'"
                            id="password"
                            name="password"
                            placeholder="••••••••"
                            required
                            autocomplete="current-password"
                            class="w-full bg-surface-muted border @error('password') border-red-500/50 @else border-white/10 @enderror rounded-xl pl-10 pr-12 py-3.5 text-sm text-white placeholder-white/25 focus:outline-none focus:border-brand/50 focus:ring-1 focus:ring-brand/30 transition-all"
                        />
                        <button type="button"
                                @click="show = !show"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-white/25 hover:text-white/60 transition-colors">
                            <i :class="show ? 'bi-eye-slash' : 'bi-eye'" class="bi text-sm"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-red-400 text-xs mt-0.5">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Lembrar --}}
                <div class="flex items-center gap-2">
                    <input type="checkbox" id="remember" name="remember"
                           class="w-4 h-4 rounded border-white/20 bg-surface-muted accent-brand cursor-pointer" />
                    <label for="remember" class="text-sm text-white/40 cursor-pointer select-none">
                        Lembrar de mim
                    </label>
                </div>

                {{-- Submit --}}
                <button
                    type="submit"
                    class="w-full py-4 rounded-full bg-brand text-black font-bold text-base hover:bg-brand-light transition-all shadow-xl shadow-brand/20 hover:shadow-brand/40 hover:-translate-y-0.5 active:scale-95 flex items-center justify-center gap-2 mt-2">
                    <i class="bi bi-box-arrow-in-right text-lg"></i>
                    Entrar
                </button>

            </form>

            {{-- Cadastro --}}
            <p class="text-center text-sm text-white/30 mt-8">
                Ainda não tem conta?
                <a href="{{ route('auth.cadastro') }}" class="text-brand font-medium hover:text-brand-light transition-colors ml-1">
                    Criar conta grátis
                </a>
            </p>

        </div>
    </div>

</div>

@endsection