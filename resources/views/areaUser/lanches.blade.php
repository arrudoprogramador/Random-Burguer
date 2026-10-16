{{-- resources/views/areaUser/lanches.blade.php --}}
@extends('layouts.app')

@section('title', 'Cardápio Completo — RandomBurguer')

@section('content')

{{-- =====================================================
    HERO DO CARDÁPIO
===================================================== --}}
<section class="relative h-72 lg:h-96 flex items-end overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img
            src="{{ asset('/img/bg (1).jpg') }}"
            alt="Cardápio background"
            class="w-full h-full object-cover object-center"
            onerror="this.src='{{ asset('img/lanches/triplo-bacon.jpg') }}'"
        />
        <div class="absolute inset-0 bg-gradient-to-r from-black/90 via-black/70 to-black/30"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-surface via-transparent to-transparent"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-10 w-full pb-12">
        <p class="text-xs text-brand font-semibold uppercase tracking-widest mb-2">Feitos na hora artesanalmente</p>
        <h1 class="font-display text-5xl lg:text-6xl text-white leading-none font-bold drop-shadow">
            Nosso <span class="italic text-brand">Cardápio</span>
        </h1>
    </div>
</section>


{{-- =====================================================
    BARRA DE PESQUISA + FILTROS
===================================================== --}}
<div class="sticky top-20 z-40 bg-surface/90 dark:bg-surface/95 backdrop-blur-md border-b border-surface-border dark:border-white/5 shadow-sm dark:shadow-lg dark:shadow-black/30 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-6 lg:px-10 py-4">
        <div class="flex flex-col sm:flex-row items-center gap-3">

            {{-- Busca --}}
            <form method="GET" action="{{ route('lanches.busca') }}" class="flex-1 w-full">
                <div class="relative">
                    <i class="bi bi-search absolute left-4 top-1/2 -translate-y-1/2 text-stone-400 dark:text-white/30 text-sm"></i>
                    <input
                        type="text"
                        name="pesquisar"
                        placeholder="Buscar lanche por nome ou sabor..."
                        value="{{ request('pesquisar') }}"
                        class="w-full bg-surface-card border border-surface-border dark:border-white/10 rounded-full pl-10 pr-24 py-3 text-sm text-stone-900 dark:text-white placeholder-stone-400 dark:placeholder-white/30 focus:outline-none focus:border-brand/60 focus:ring-2 focus:ring-brand/20 transition-all shadow-sm"
                    />
                    <button
                        type="submit"
                        class="absolute right-2 top-1/2 -translate-y-1/2 px-4 py-1.5 rounded-full bg-brand text-black text-xs font-bold hover:bg-brand-light transition-all shadow-sm"
                    >
                        Buscar
                    </button>
                </div>
            </form>

            {{-- Carrinho --}}
            <a href="{{ url('/carrinho') }}"
               class="flex items-center gap-2 px-5 py-3 rounded-full border border-surface-border dark:border-white/10 bg-surface-card text-stone-700 dark:text-white/70 hover:text-brand hover:border-brand/40 transition-all text-sm font-semibold whitespace-nowrap shadow-sm">
                <i class="bi bi-bag text-base"></i>
                <span>Ver carrinho</span>
                @if(session('carrinho') && count(session('carrinho')) > 0)
                    <span class="w-5 h-5 rounded-full bg-brand text-black text-[10px] font-bold flex items-center justify-center">
                        {{ count(session('carrinho')) }}
                    </span>
                @endif
            </a>

        </div>
    </div>
</div>


{{-- =====================================================
    GRID DE LANCHES
===================================================== --}}
<section class="py-16 bg-surface min-h-[60vh] transition-colors duration-300" id="menu">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">

        @if(isset($lanches) && $lanches->isNotEmpty())

            {{-- Contador de resultados --}}
            <div class="flex items-center justify-between mb-10">
                <p class="text-sm text-stone-500 dark:text-white/40">
                    @if(request('pesquisar'))
                        Resultados para <span class="text-brand font-semibold">"{{ request('pesquisar') }}"</span> —
                    @endif
                    <span class="text-stone-800 dark:text-white/70 font-medium">{{ $lanches->count() }} lanche{{ $lanches->count() > 1 ? 's' : '' }} encontrado{{ $lanches->count() > 1 ? 's' : '' }}</span>
                </p>
                @if(request('pesquisar'))
                    <a href="{{ route('lanches.index') }}" class="text-xs text-brand hover:underline font-semibold flex items-center gap-1">
                        <i class="bi bi-x-circle"></i> Limpar filtro
                    </a>
                @endif
            </div>

            {{-- Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($lanches as $l)
                    @include('components.lanche-card', ['lanche' => $l])
                @endforeach
            </div>

        @else

            {{-- Estado vazio --}}
            <div class="flex flex-col items-center justify-center py-28 text-center">
                <div class="w-20 h-20 rounded-full bg-surface-card border border-surface-border dark:border-white/10 flex items-center justify-center mb-6 shadow-sm">
                    <i class="bi bi-search text-3xl text-stone-400 dark:text-white/20"></i>
                </div>
                <h3 class="font-display text-2xl text-stone-900 dark:text-white font-bold mb-2">Nenhum lanche encontrado</h3>
                <p class="text-stone-500 dark:text-white/40 text-sm mb-8 max-w-sm">
                    @if(request('pesquisar'))
                        Não encontramos resultados para "{{ request('pesquisar') }}". Tente buscar por outros ingredientes ou palavras-chave.
                    @else
                        Ainda não há lanches cadastrados no cardápio.
                    @endif
                </p>
                @if(request('pesquisar'))
                    <a href="{{ route('lanches.index') }}"
                       class="inline-flex items-center gap-2 px-6 py-3 rounded-full border border-brand/40 text-brand text-sm font-semibold hover:bg-brand hover:text-black transition-all">
                        <i class="bi bi-arrow-left"></i>
                        Ver todos os lanches
                    </a>
                @endif
            </div>

        @endif

    </div>
</section>

@endsection