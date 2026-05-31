{{-- resources/views/areaAdmin/index.blade.php --}}
@extends('areaAdmin.layouts.admin')

@section('title', 'Dashboard')
@section('breadcrumb', 'Dashboard')

@section('content')

{{-- Header --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
    <div>
        <h1 class="font-display text-3xl text-white font-bold">Dashboard</h1>
        <p class="text-white/40 text-sm mt-1">Visão geral do sistema</p>
    </div>
    <a href="{{ route('admin.lanches.create') }}"
       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-brand text-black text-sm font-semibold hover:bg-brand-light transition-all shadow-lg shadow-brand/20">
        <i class="bi bi-plus-lg"></i>
        Novo Lanche
    </a>
</div>

{{-- Cards de métricas --}}
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-8">
    @foreach([
        ['icon' => 'bi-fire',        'label' => 'Total de Lanches',  'value' => $totalLanches ?? 0,       'color' => 'text-brand',      'bg' => 'bg-brand/10'],
        ['icon' => 'bi-people',      'label' => 'Clientes',          'value' => $totalClientes ?? 0,      'color' => 'text-blue-400',   'bg' => 'bg-blue-400/10'],
        ['icon' => 'bi-bag-check',   'label' => 'Pedidos hoje',      'value' => $pedidosHoje ?? 0,        'color' => 'text-green-400',  'bg' => 'bg-green-400/10'],
        ['icon' => 'bi-currency-dollar','label' => 'Receita total',  'value' => 'R$ ' . number_format($totalArrecadado ?? 0, 2, ',', '.'), 'color' => 'text-purple-400', 'bg' => 'bg-purple-400/10'],
    ] as $card)
        <div class="bg-[#1A1A1A] rounded-2xl border border-white/5 p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl {{ $card['bg'] }} flex items-center justify-center shrink-0">
                <i class="bi {{ $card['icon'] }} {{ $card['color'] }} text-xl"></i>
            </div>
            <div>
                <p class="text-xs text-white/40 mb-0.5">{{ $card['label'] }}</p>
                <p class="text-xl font-bold text-white">{{ $card['value'] }}</p>
            </div>
        </div>
    @endforeach
</div>

{{-- Grid principal --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Top Lanches --}}
    <div class="lg:col-span-2 bg-[#1A1A1A] rounded-2xl border border-white/5 p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="font-display text-lg text-white font-bold">Lanches Cadastrados</h2>
            <a href="{{ route('admin.lanches.index') }}" class="text-xs text-brand hover:text-brand-light transition-colors">
                Ver todos →
            </a>
        </div>

        @if(isset($topLanches) && $topLanches->count())
            <div class="space-y-3">
                @foreach($topLanches as $lanche)
                    <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-white/5 transition-all">
                        <div class="w-10 h-10 rounded-xl overflow-hidden bg-[#252525] shrink-0">
                            <img
                                src="{{ $lanche->imagem ? url('img/lanches/' . $lanche->imagem) : 'https://placehold.co/40x40/252525/F59E0B?text=🍔' }}"
                                alt="{{ $lanche->nome }}"
                                class="w-full h-full object-cover"
                            />
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-white font-medium truncate">{{ $lanche->nome }}</p>
                            <p class="text-xs text-white/30">{{ $lanche->categoria->nome ?? 'Sem categoria' }}</p>
                        </div>
                        <span class="text-brand font-bold text-sm whitespace-nowrap">
                            R$ {{ number_format($lanche->preco, 2, ',', '.') }}
                        </span>
                        <span class="w-2 h-2 rounded-full {{ $lanche->ativo ? 'bg-green-400' : 'bg-red-400' }}"></span>
                    </div>
                @endforeach
            </div>
        @else
            <div class="flex flex-col items-center justify-center py-10 text-center">
                <i class="bi bi-fire text-3xl text-white/10 mb-3"></i>
                <p class="text-sm text-white/30">Nenhum lanche cadastrado.</p>
            </div>
        @endif
    </div>

    {{-- Ações rápidas --}}
    <div class="bg-[#1A1A1A] rounded-2xl border border-white/5 p-6">
        <h2 class="font-display text-lg text-white font-bold mb-6">Ações Rápidas</h2>
        <div class="flex flex-col gap-3">
            @foreach([
                ['route' => 'admin.lanches.create',  'icon' => 'bi-plus-circle',  'label' => 'Cadastrar lanche',  'color' => 'text-brand'],
                ['route' => 'admin.lanches.index',   'icon' => 'bi-list-ul',      'label' => 'Ver lanches',       'color' => 'text-blue-400'],
                ['route' => 'admin.clientes.index',  'icon' => 'bi-people',       'label' => 'Ver clientes',      'color' => 'text-green-400'],
                ['route' => 'admin.pedidos',         'icon' => 'bi-bag-check',    'label' => 'Ver pedidos',       'color' => 'text-purple-400'],
            ] as $action)
                <a href="{{ route($action['route']) }}"
                   class="flex items-center gap-3 p-3 rounded-xl border border-white/5 hover:border-brand/20 hover:bg-white/5 transition-all group">
                    <i class="bi {{ $action['icon'] }} {{ $action['color'] }} text-lg"></i>
                    <span class="text-sm text-white/60 group-hover:text-white transition-colors">{{ $action['label'] }}</span>
                    <i class="bi bi-arrow-right text-xs text-white/20 group-hover:text-brand ml-auto transition-all group-hover:translate-x-0.5"></i>
                </a>
            @endforeach
        </div>
    </div>

</div>

@endsection