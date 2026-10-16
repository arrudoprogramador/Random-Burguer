{{-- resources/views/areaAdmin/index.blade.php --}}
@extends('areaAdmin.layouts.admin')

@section('title', 'Dashboard Administrativo')
@section('breadcrumb', 'Dashboard')

@section('content')

{{-- Header --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
    <div>
        <h1 class="font-display text-3xl text-stone-900 dark:text-white font-bold">Dashboard</h1>
        <p class="text-stone-500 dark:text-white/40 text-sm mt-1">Visão geral do faturamento e operações</p>
    </div>
    <a href="{{ route('admin.lanches.create') }}"
       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-brand text-black text-sm font-bold hover:bg-brand-light transition-all shadow-md shadow-brand/20 hover:-translate-y-0.5 active:scale-95">
        <i class="bi bi-plus-lg"></i>
        Novo Lanche
    </a>
</div>

{{-- Cards de métricas --}}
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-8">
    @foreach([
        ['icon' => 'bi-fire',           'label' => 'Total de Lanches',  'value' => $totalLanches ?? 0,       'color' => 'text-amber-500',   'bg' => 'bg-amber-500/10 dark:bg-amber-500/15'],
        ['icon' => 'bi-people',         'label' => 'Clientes',          'value' => $totalClientes ?? 0,      'color' => 'text-blue-500',    'bg' => 'bg-blue-500/10 dark:bg-blue-500/15'],
        ['icon' => 'bi-bag-check',      'label' => 'Pedidos hoje',      'value' => $pedidosHoje ?? 0,        'color' => 'text-emerald-500', 'bg' => 'bg-emerald-500/10 dark:bg-emerald-500/15'],
        ['icon' => 'bi-currency-dollar','label' => 'Receita total',     'value' => 'R$ ' . number_format($totalArrecadado ?? 0, 2, ',', '.'), 'color' => 'text-purple-500', 'bg' => 'bg-purple-500/10 dark:bg-purple-500/15'],
    ] as $card)
        <div class="bg-surface-card rounded-2xl border border-surface-border dark:border-white/5 p-5 flex items-center gap-4 shadow-sm theme-card">
            <div class="w-12 h-12 rounded-xl {{ $card['bg'] }} flex items-center justify-center shrink-0">
                <i class="bi {{ $card['icon'] }} {{ $card['color'] }} text-xl"></i>
            </div>
            <div>
                <p class="text-xs text-stone-500 dark:text-white/40 font-medium mb-0.5">{{ $card['label'] }}</p>
                <p class="text-xl font-bold text-stone-900 dark:text-white">{{ $card['value'] }}</p>
            </div>
        </div>
    @endforeach
</div>

{{-- Grid principal --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Top Lanches --}}
    <div class="lg:col-span-2 bg-surface-card rounded-2xl border border-surface-border dark:border-white/5 p-6 shadow-sm theme-card">
        <div class="flex items-center justify-between mb-6">
            <h2 class="font-display text-lg text-stone-900 dark:text-white font-bold">Lanches Recentes</h2>
            <a href="{{ route('admin.lanches.index') }}" class="text-xs text-brand font-semibold hover:underline transition-colors">
                Ver todos os lanches →
            </a>
        </div>

        @if(isset($topLanches) && $topLanches->count())
            <div class="space-y-3">
                @foreach($topLanches as $lanche)
                    <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-stone-200/50 dark:hover:bg-white/5 transition-all">
                        <div class="w-11 h-11 rounded-xl overflow-hidden bg-surface-muted shrink-0 border border-surface-border dark:border-white/5">
                            <img
                                src="{{ $lanche->imagem ? url('img/lanches/' . $lanche->imagem) : 'https://placehold.co/44x44/252525/F59E0B?text=🍔' }}"
                                alt="{{ $lanche->nome }}"
                                class="w-full h-full object-cover"
                            />
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-stone-900 dark:text-white font-semibold truncate">{{ $lanche->nome }}</p>
                            <p class="text-xs text-stone-500 dark:text-white/40">{{ $lanche->categoria->nome ?? 'Burguer Artesanal' }}</p>
                        </div>
                        <span class="text-brand font-bold text-sm whitespace-nowrap">
                            R$ {{ number_format($lanche->preco, 2, ',', '.') }}
                        </span>
                        <span class="w-2.5 h-2.5 rounded-full {{ ($lanche->ativo ?? true) ? 'bg-emerald-500' : 'bg-red-500' }}" title="{{ ($lanche->ativo ?? true) ? 'Ativo' : 'Inativo' }}"></span>
                    </div>
                @endforeach
            </div>
        @else
            <div class="flex flex-col items-center justify-center py-10 text-center">
                <i class="bi bi-fire text-3xl text-stone-300 dark:text-white/10 mb-3"></i>
                <p class="text-sm text-stone-500 dark:text-white/40">Nenhum lanche cadastrado no momento.</p>
            </div>
        @endif
    </div>

    {{-- Ações rápidas --}}
    <div class="bg-surface-card rounded-2xl border border-surface-border dark:border-white/5 p-6 shadow-sm theme-card">
        <h2 class="font-display text-lg text-stone-900 dark:text-white font-bold mb-6">Ações Rápidas</h2>
        <div class="flex flex-col gap-3">
            @foreach([
                ['route' => 'admin.lanches.create',  'icon' => 'bi-plus-circle',  'label' => 'Cadastrar novo lanche',  'color' => 'text-amber-500'],
                ['route' => 'admin.lanches.index',   'icon' => 'bi-list-ul',      'label' => 'Gerenciar cardápio',     'color' => 'text-blue-500'],
                ['route' => 'admin.clientes.index',  'icon' => 'bi-people',       'label' => 'Ver clientes',           'color' => 'text-emerald-500'],
                ['route' => 'admin.pedidos',         'icon' => 'bi-bag-check',    'label' => 'Ver pedidos',            'color' => 'text-purple-500'],
            ] as $action)
                <a href="{{ route($action['route']) }}"
                   class="flex items-center gap-3 p-3.5 rounded-xl border border-surface-border dark:border-white/5 hover:border-brand/40 hover:bg-stone-100 dark:hover:bg-white/5 transition-all group">
                    <i class="bi {{ $action['icon'] }} {{ $action['color'] }} text-lg"></i>
                    <span class="text-sm font-medium text-stone-700 dark:text-white/70 group-hover:text-stone-900 dark:group-hover:text-white transition-colors">{{ $action['label'] }}</span>
                    <i class="bi bi-arrow-right text-xs text-stone-400 dark:text-white/20 group-hover:text-brand ml-auto transition-all group-hover:translate-x-0.5"></i>
                </a>
            @endforeach
        </div>
    </div>

</div>

@endsection