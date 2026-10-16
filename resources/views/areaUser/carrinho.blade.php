{{-- resources/views/areaUser/carrinho.blade.php --}}
@extends('layouts.app')

@section('title', 'Meu Carrinho — RandomBurguer')

@section('content')

<div class="min-h-screen bg-surface py-12 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">

        {{-- Header --}}
        <div class="mb-10">
            <a href="{{ route('lanches.index') }}"
               class="inline-flex items-center gap-2 text-sm text-stone-500 dark:text-white/40 hover:text-brand transition-colors mb-6 font-semibold">
                <i class="bi bi-arrow-left"></i>
                Continuar comprando
            </a>
            <h1 class="font-display text-4xl lg:text-5xl text-stone-900 dark:text-white font-bold">
                Meu <span class="italic text-brand">Carrinho</span>
            </h1>
        </div>

        @php $total = 0; @endphp

        @if(session('carrinho') && count(session('carrinho')) > 0)

            <div class="flex flex-col lg:flex-row gap-8 items-start">

                {{-- =====================
                    LISTA DE ITENS
                ===================== --}}
                <div class="flex-1 w-full space-y-4">

                    {{-- Cabeçalho da lista --}}
                    <div class="flex items-center justify-between pb-4 border-b border-surface-border dark:border-white/5">
                        <p class="text-sm text-stone-500 dark:text-white/40 uppercase tracking-widest font-semibold">
                            {{ count(session('carrinho')) }} {{ count(session('carrinho')) == 1 ? 'item selecionado' : 'itens selecionados' }}
                        </p>
                        <form action="{{ route('carrinho.limpar') }}" method="POST">
                            @csrf
                            @method('DELETE') 
                            <button type="submit"
                                    class="text-xs text-stone-500 dark:text-white/40 hover:text-red-500 transition-colors flex items-center gap-1.5 font-semibold">
                                <i class="bi bi-trash3"></i>
                                Limpar carrinho
                            </button>
                        </form>
                    </div>

                    {{-- Itens --}}
                    @foreach(session('carrinho') as $id => $item)
                        @php
                            $subtotal = $item['preco'] * $item['quantidade'];
                            $total += $subtotal;
                        @endphp

                        <div class="group flex gap-5 bg-surface-card rounded-2xl border border-surface-border dark:border-white/5 hover:border-brand/40 p-5 transition-all duration-200 shadow-sm theme-card">

                            {{-- Imagem --}}
                            <div class="w-24 h-24 rounded-xl overflow-hidden bg-surface-muted shrink-0 border border-surface-border dark:border-white/5">
                                <img
                                    src="{{ url('/img/lanches/' . $item['imagem']) }}"
                                    alt="{{ $item['nome'] }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                    onerror="this.src='https://placehold.co/96x96/252525/F59E0B?text=🍔'"
                                />
                            </div>

                            {{-- Info --}}
                            <div class="flex-1 flex flex-col justify-between min-w-0">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <h3 class="font-display text-lg text-stone-900 dark:text-white font-bold leading-tight">
                                            {{ $item['nome'] }}
                                        </h3>
                                        <p class="text-sm text-stone-500 dark:text-white/40 mt-0.5">
                                            R$ {{ number_format($item['preco'], 2, ',', '.') }} cada
                                        </p>
                                    </div>
                                    {{-- Subtotal --}}
                                    <span class="text-brand font-bold text-lg whitespace-nowrap">
                                        R$ {{ number_format($subtotal, 2, ',', '.') }}
                                    </span>
                                </div>

                                {{-- Ações --}}
                                <div class="flex items-center justify-between mt-4">

                                    {{-- Quantidade --}}
                                    <form action="{{ route('carrinho.atualizar', $id) }}" method="POST"
                                          class="flex items-center gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <div class="flex items-center gap-1 bg-surface-muted rounded-full border border-surface-border dark:border-white/10 px-1.5 py-1">
                                            <button type="submit" name="quantidade" value="{{ max(1, $item['quantidade'] - 1) }}"
                                                    class="w-7 h-7 rounded-full flex items-center justify-center text-stone-600 dark:text-white/50 hover:text-brand hover:bg-stone-300/40 dark:hover:bg-white/10 transition-all text-sm">
                                                <i class="bi bi-dash"></i>
                                            </button>
                                            <span class="w-8 text-center text-sm text-stone-900 dark:text-white font-bold">
                                                {{ $item['quantidade'] }}
                                            </span>
                                            <button type="submit" name="quantidade" value="{{ $item['quantidade'] + 1 }}"
                                                    class="w-7 h-7 rounded-full flex items-center justify-center text-stone-600 dark:text-white/50 hover:text-brand hover:bg-stone-300/40 dark:hover:bg-white/10 transition-all text-sm">
                                                <i class="bi bi-plus"></i>
                                            </button>
                                        </div>
                                    </form>

                                    {{-- Remover --}}
                                    <form action="{{ route('carrinho.remover', $id) }}" method="POST">
                                        @csrf
                                        @method('DELETE') 
                                        <button type="submit"
                                                class="flex items-center gap-1.5 text-xs text-stone-500 dark:text-white/40 hover:text-red-500 transition-colors px-3 py-1.5 rounded-full hover:bg-red-500/10 font-medium">
                                            <i class="bi bi-trash3 text-sm"></i>
                                            Remover
                                        </button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- =====================
                    RESUMO
                ===================== --}}
                <div class="w-full lg:w-84 shrink-0 sticky top-28">
                    <div class="bg-surface-card rounded-2xl border border-surface-border dark:border-white/5 overflow-hidden shadow-md theme-card">

                        {{-- Header resumo --}}
                        <div class="px-6 py-5 border-b border-surface-border dark:border-white/5">
                            <h2 class="font-display text-xl text-stone-900 dark:text-white font-bold">Resumo da Compra</h2>
                        </div>

                        {{-- Detalhes --}}
                        <div class="px-6 py-5 space-y-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-stone-600 dark:text-white/50">Subtotal ({{ count(session('carrinho')) }} itens)</span>
                                <span class="text-stone-900 dark:text-white font-semibold">R$ {{ number_format($total, 2, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-stone-600 dark:text-white/50">Taxa de Entrega</span>
                                <span class="text-emerald-500 font-bold">Grátis</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-stone-600 dark:text-white/50">Tempo estimado</span>
                                <span class="text-stone-900 dark:text-white font-medium">~30-45 min</span>
                            </div>
                        </div>

                        {{-- Total --}}
                        <div class="px-6 py-5 border-t border-surface-border dark:border-white/5 bg-surface-muted/50 dark:bg-surface-muted">
                            <div class="flex justify-between items-center mb-6">
                                <span class="text-stone-900 dark:text-white font-bold text-base">Total</span>
                                <span class="text-brand font-display text-2xl font-black">
                                    R$ {{ number_format($total, 2, ',', '.') }}
                                </span>
                            </div>
                            <button
                                class="w-full py-4 rounded-full bg-brand text-black font-bold text-base hover:bg-brand-light transition-all shadow-xl shadow-brand/20 hover:shadow-brand/40 hover:-translate-y-0.5 active:scale-95 flex items-center justify-center gap-2">
                                <i class="bi bi-bag-check-fill text-lg"></i>
                                Finalizar Pedido
                            </button>
                        </div>

                        {{-- Segurança --}}
                        <div class="px-6 py-4 flex items-center justify-center gap-2 text-xs text-stone-500 dark:text-white/30">
                            <i class="bi bi-shield-check text-brand"></i>
                            Ambiente 100% seguro e protegido
                        </div>

                    </div>
                </div>

            </div>

        @else

            {{-- Carrinho vazio --}}
            <div class="flex flex-col items-center justify-center py-32 text-center">
                <div class="w-24 h-24 rounded-full bg-surface-card border border-surface-border dark:border-white/5 flex items-center justify-center mb-6 shadow-sm">
                    <i class="bi bi-bag text-4xl text-stone-400 dark:text-white/20"></i>
                </div>
                <h2 class="font-display text-3xl text-stone-900 dark:text-white font-bold mb-3">Seu carrinho está vazio</h2>
                <p class="text-stone-500 dark:text-white/40 text-sm mb-8 max-w-xs">
                    Adicione delícias do nosso cardápio e venha saborear nossos hambúrgueres artesanais.
                </p>
                <a href="{{ route('lanches.index') }}"
                   class="inline-flex items-center gap-2 px-8 py-4 rounded-full bg-brand text-black font-bold hover:bg-brand-light transition-all shadow-xl shadow-brand/20 hover:-translate-y-0.5 active:scale-95">
                    <i class="bi bi-fire"></i>
                    Ver Cardápio
                </a>
            </div>

        @endif

    </div>
</div>

@endsection