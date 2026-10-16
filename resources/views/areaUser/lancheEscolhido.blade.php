{{-- resources/views/areaUser/lancheEscolhido.blade.php --}}
@extends('layouts.app')

@section('title', ($lanche->nome ?? 'Lanche') . ' — RandomBurguer')

@section('content')

<div class="min-h-screen bg-surface py-12 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">

        {{-- Breadcrumb --}}
        <div class="flex items-center gap-2 text-sm text-stone-500 dark:text-white/40 mb-10">
            <a href="{{ route('home') }}" class="hover:text-brand transition-colors">Home</a>
            <i class="bi bi-chevron-right text-xs"></i>
            <a href="{{ route('lanches.index') }}" class="hover:text-brand transition-colors">Cardápio</a>
            <i class="bi bi-chevron-right text-xs"></i>
            <span class="text-stone-900 dark:text-white/80 font-semibold">{{ $lanche->nome }}</span>
        </div>

        {{-- Layout principal --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-start">

            {{-- =====================
                IMAGEM
            ===================== --}}
            <div class="relative group">
                {{-- Glow decorativo --}}
                <div class="absolute -inset-4 bg-brand/15 rounded-3xl blur-3xl opacity-60 group-hover:opacity-100 transition-opacity duration-700"></div>

                <div class="relative aspect-square rounded-3xl overflow-hidden bg-[#131316] border border-white/10 shadow-2xl">
                    <img
                        src="{{ $lanche->imagem ? asset('img/lanches/' . $lanche->imagem) : asset('img/lanches/triplo-bacon.jpg') }}"
                        alt="{{ $lanche->nome }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                        onerror="this.src='{{ asset('img/lanches/triplo-bacon.jpg') }}'"
                    />
                    {{-- Overlay sutil --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
                </div>
            </div>

            {{-- =====================
                DETALHES
            ===================== --}}
            <div class="flex flex-col gap-6 lg:pt-4">

                {{-- Badge --}}
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-brand/10 border border-brand/20 w-fit">
                    <span class="w-1.5 h-1.5 rounded-full bg-brand"></span>
                    <span class="text-xs font-semibold text-brand uppercase tracking-widest">Disponível agora</span>
                </div>

                {{-- Nome --}}
                <h1 class="font-display text-4xl lg:text-5xl text-stone-900 dark:text-white font-bold leading-tight">
                    {{ $lanche->nome }}
                </h1>

                {{-- Descrição --}}
                @if($lanche->descricao)
                    <p class="text-stone-600 dark:text-white/60 text-base leading-relaxed">
                        {{ $lanche->descricao }}
                    </p>
                @endif

                {{-- Divisor --}}
                <div class="border-t border-surface-border dark:border-white/5"></div>

                {{-- Preço --}}
                <div class="flex items-end gap-3">
                    <span class="text-stone-500 dark:text-white/40 text-sm">por apenas</span>
                    <span class="font-display text-5xl text-brand font-black leading-none">
                        R$ {{ number_format($lanche->preco, 2, ',', '.') }}
                    </span>
                </div>

                {{-- Ações --}}
                @if(auth()->check())
                    <form action="{{ route('carrinho.adicionar', $lanche->id) }}" method="POST"
                          x-data="{ qty: 1, added: false }" class="flex flex-col gap-5">
                        @csrf

                        {{-- Seletor de quantidade --}}
                        <div class="flex flex-col gap-2">
                            <label class="text-xs text-stone-500 dark:text-white/40 uppercase tracking-widest font-semibold">Quantidade</label>
                            <div class="flex items-center gap-4">
                                <div class="flex items-center gap-1 bg-surface-card rounded-full border border-surface-border dark:border-white/10 px-2 py-1 shadow-sm">
                                    <button type="button"
                                            @click="qty = Math.max(1, qty - 1)"
                                            class="w-9 h-9 rounded-full flex items-center justify-center text-stone-600 dark:text-white/60 hover:text-brand hover:bg-stone-200/50 dark:hover:bg-white/10 transition-all">
                                        <i class="bi bi-dash text-lg"></i>
                                    </button>
                                    <input type="number" name="quantidade"
                                           x-model="qty"
                                           min="1" max="10"
                                           class="w-12 text-center bg-transparent text-stone-900 dark:text-white font-bold text-base focus:outline-none" />
                                    <button type="button"
                                            @click="qty = Math.min(10, qty + 1)"
                                            class="w-9 h-9 rounded-full flex items-center justify-center text-stone-600 dark:text-white/60 hover:text-brand hover:bg-stone-200/50 dark:hover:bg-white/10 transition-all">
                                        <i class="bi bi-plus text-lg"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Botões --}}
                        <div class="flex flex-col sm:flex-row gap-3 pt-2">
                            <button
                                type="submit"
                                @click="added = true; setTimeout(() => added = false, 2000)"
                                class="flex-1 flex items-center justify-center gap-2.5 py-4 rounded-full bg-brand text-black font-bold text-base hover:bg-brand-light transition-all shadow-xl shadow-brand/20 hover:shadow-brand/40 hover:-translate-y-0.5 active:scale-95">
                                <i class="bi bi-bag-plus-fill text-lg"></i>
                                <span x-text="added ? 'Adicionado ao carrinho! ✓' : 'Adicionar ao carrinho'"></span>
                            </button>

                            <a href="{{ route('lanches.index') }}"
                               class="flex items-center justify-center gap-2 px-6 py-4 rounded-full border border-surface-border dark:border-white/10 bg-surface-card text-stone-700 dark:text-white/70 font-semibold hover:text-brand hover:border-brand/40 transition-all shadow-sm">
                                <i class="bi bi-arrow-left text-sm"></i>
                                Voltar
                            </a>
                        </div>

                    </form>

                @else
                    {{-- Não logado --}}
                    <div class="flex flex-col gap-4 p-5 rounded-2xl bg-surface-card border border-surface-border dark:border-white/5 shadow-sm">
                        <div class="flex items-center gap-3 text-stone-600 dark:text-white/60 text-sm">
                            <i class="bi bi-lock-fill text-brand text-base"></i>
                            Faça login para adicionar ao seu pedido
                        </div>
                        <div class="flex flex-col sm:flex-row gap-3">
                            <a href="{{ route('auth.login') }}"
                               class="flex-1 text-center py-4 rounded-full bg-brand text-black font-bold hover:bg-brand-light transition-all shadow-lg shadow-brand/20 hover:-translate-y-0.5 active:scale-95">
                                Entrar / Cadastrar
                            </a>
                            <a href="{{ route('lanches.index') }}"
                               class="flex items-center justify-center gap-2 px-6 py-4 rounded-full border border-surface-border dark:border-white/10 bg-surface text-stone-700 dark:text-white/70 font-semibold hover:text-brand transition-all">
                                <i class="bi bi-arrow-left text-sm"></i>
                                Voltar
                            </a>
                        </div>
                    </div>
                @endif

                {{-- Info extra --}}
                <div class="grid grid-cols-3 gap-3 pt-2">
                    @foreach([
                        ['icon' => 'bi-clock-fill',   'label' => '~25 min',   'sub' => 'Preparo artesanal'],
                        ['icon' => 'bi-truck',        'label' => 'Entrega',   'sub' => 'Rápida e segura'],
                        ['icon' => 'bi-shield-check', 'label' => 'Qualidade', 'sub' => '100% garantida'],
                    ] as $info)
                        <div class="flex flex-col items-center gap-1 p-3 rounded-xl bg-surface-card border border-surface-border dark:border-white/5 text-center shadow-sm">
                            <i class="bi {{ $info['icon'] }} text-brand text-lg"></i>
                            <span class="text-stone-900 dark:text-white text-sm font-semibold">{{ $info['label'] }}</span>
                            <span class="text-stone-500 dark:text-white/40 text-xs">{{ $info['sub'] }}</span>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>

    </div>
</div>

@endsection