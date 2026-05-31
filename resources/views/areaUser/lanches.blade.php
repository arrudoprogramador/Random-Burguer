{{-- resources/views/areaUser/lanches.blade.php --}}
@extends('layouts.app')

@section('title', 'Cardápio — RandomBurguer')

@section('content')

{{-- =====================================================
    HERO DO CARDÁPIO
===================================================== --}}
<section class="relative h-72 lg:h-96 flex items-end">
    <div class="absolute inset-0 z-0">
        <img
            src="{{ asset('/img/bg (1).jpg') }}"
            alt="Cardápio background"
            class="w-full h-full object-cover object-center"
            onerror="this.src='https://placehold.co/1600x400/111111/F59E0B?text=Cardápio'"
        />
        <div class="absolute inset-0 bg-gradient-to-r from-black/90 via-black/60 to-transparent"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-surface via-transparent to-transparent"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-10 w-full pb-12">
        <p class="text-xs text-brand font-semibold uppercase tracking-widest mb-2">Feitos na hora</p>
        <h1 class="font-display text-5xl lg:text-6xl text-white leading-none">
            Nosso <span class="italic text-brand">Cardápio</span>
        </h1>
    </div>
</section>


{{-- =====================================================
    BARRA DE PESQUISA + FILTROS
===================================================== --}}
<div class="sticky top-20 z-40 bg-surface/95 backdrop-blur-md border-b border-white/5 shadow-lg shadow-black/30">
    <div class="max-w-7xl mx-auto px-6 lg:px-10 py-4">
        <div class="flex flex-col sm:flex-row items-center gap-3">

            {{-- Busca --}}
            <form method="GET" action="{{ route('lanches.busca') }}" class="flex-1 w-full">
                <div class="relative">
                    <i class="bi bi-search absolute left-4 top-1/2 -translate-y-1/2 text-white/30 text-sm"></i>
                    <input
                        type="text"
                        name="pesquisar"
                        placeholder="Buscar lanche..."
                        value="{{ request('pesquisar') }}"
                        class="w-full bg-surface-muted border border-white/10 rounded-full pl-10 pr-4 py-3 text-sm text-white placeholder-white/30 focus:outline-none focus:border-brand/50 focus:ring-1 focus:ring-brand/30 transition-all"
                    />
                    <button
                        type="submit"
                        class="absolute right-2 top-1/2 -translate-y-1/2 px-4 py-1.5 rounded-full bg-brand text-black text-xs font-semibold hover:bg-brand-light transition-all"
                    >
                        Buscar
                    </button>
                </div>
            </form>

            {{-- Carrinho --}}
            <a href="{{ url('/carrinho') }}"
               class="flex items-center gap-2 px-5 py-3 rounded-full border border-white/10 bg-surface-muted text-white/70 hover:text-brand hover:border-brand/30 transition-all text-sm font-medium whitespace-nowrap">
                <i class="bi bi-bag text-base"></i>
                Ver carrinho
                @if(session('cart') && count(session('cart')) > 0)
                    <span class="w-5 h-5 rounded-full bg-brand text-black text-[10px] font-bold flex items-center justify-center">
                        {{ count(session('cart')) }}
                    </span>
                @endif
            </a>

        </div>
    </div>
</div>


{{-- =====================================================
    GRID DE LANCHES
===================================================== --}}
<section class="py-16 bg-surface min-h-screen" id="menu">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">

        @if(isset($lanches) && $lanches->isNotEmpty())

            {{-- Contador de resultados --}}
            <div class="flex items-center justify-between mb-10">
                <p class="text-sm text-white/40">
                    @if(request('pesquisar'))
                        Resultados para <span class="text-brand font-medium">"{{ request('pesquisar') }}"</span> —
                    @endif
                    <span class="text-white/60">{{ $lanches->count() }} lanche{{ $lanches->count() > 1 ? 's' : '' }}</span>
                </p>
            </div>

            {{-- Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($lanches as $l)
                    <a href="{{ route('lanches.show', ['id' => $l->id]) }}"
                       class="group relative bg-surface-card rounded-2xl overflow-hidden border border-white/5 hover:border-brand/30 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl hover:shadow-brand/10 flex flex-col">

                        {{-- Imagem --}}
                        <div class="relative h-52 overflow-hidden bg-surface-muted">
                            <img
                                src="{{ url('/img/lanches/' . $l->imagem) }}"
                                alt="{{ $l->nome }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                onerror="this.src='https://placehold.co/400x300/1A1A1A/F59E0B?text=Burguer'"
                            />
                            <div class="absolute inset-0 bg-gradient-to-t from-surface-card/80 to-transparent"></div>
                        </div>

                        {{-- Info --}}
                        <div class="p-5 flex flex-col flex-1">
                            <h3 class="font-display text-lg text-white font-bold leading-tight mb-1">
                                {{ $l->nome }}
                            </h3>

                            @if(isset($l->descricao) && $l->descricao)
                                <p class="text-sm text-white/40 line-clamp-2 mb-4 leading-relaxed flex-1">
                                    {{ $l->descricao }}
                                </p>
                            @else
                                <div class="flex-1"></div>
                            @endif

                            <div class="flex items-center justify-between mt-4 pt-4 border-t border-white/5">
                                <span class="text-brand font-bold text-xl">
                                    R$ {{ number_format($l->preco, 2, ',', '.') }}
                                </span>
                                <span class="flex items-center gap-1.5 px-4 py-2 rounded-full bg-brand/10 text-brand border border-brand/20 text-sm font-semibold group-hover:bg-brand group-hover:text-black transition-all duration-200">
                                    <i class="bi bi-plus-lg text-base"></i>
                                    Pedir
                                </span>
                            </div>
                        </div>

                    </a>
                @endforeach
            </div>

        @else

            {{-- Estado vazio --}}
            <div class="flex flex-col items-center justify-center py-32 text-center">
                <div class="w-20 h-20 rounded-full bg-surface-muted border border-white/5 flex items-center justify-center mb-6">
                    <i class="bi bi-search text-3xl text-white/20"></i>
                </div>
                <h3 class="font-display text-2xl text-white mb-2">Nenhum lanche encontrado</h3>
                <p class="text-white/40 text-sm mb-8">
                    @if(request('pesquisar'))
                        Não encontramos resultados para "{{ request('pesquisar') }}".
                    @else
                        Ainda não há lanches cadastrados.
                    @endif
                </p>
                @if(request('pesquisar'))
                    <a href="{{ route('lanches.index') }}"
                       class="inline-flex items-center gap-2 px-6 py-3 rounded-full border border-brand/30 text-brand text-sm font-medium hover:bg-brand hover:text-black transition-all">
                        <i class="bi bi-arrow-left"></i>
                        Ver todos os lanches
                    </a>
                @endif
            </div>

        @endif

    </div>
</section>

@endsection