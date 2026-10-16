{{-- resources/views/areaAdmin/pedidos/pedidos.blade.php --}}
@extends('areaAdmin.layouts.admin')

@section('title', 'Pedidos — Admin')
@section('breadcrumb', 'Pedidos')

@section('content')

<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
    <div>
        <h1 class="font-display text-3xl text-stone-900 dark:text-white font-bold">Pedidos</h1>
        <p class="text-stone-500 dark:text-white/40 text-sm mt-1">Gerencie os pedidos em andamento e histórico de vendas</p>
    </div>
</div>

<div class="bg-surface-card rounded-2xl border border-surface-border dark:border-white/5 flex flex-col items-center justify-center py-32 text-center shadow-sm theme-card">
    <div class="w-16 h-16 rounded-2xl bg-brand/10 border border-brand/20 flex items-center justify-center mb-6">
        <i class="bi bi-bag-check text-3xl text-brand"></i>
    </div>
    <h2 class="font-display text-2xl text-stone-900 dark:text-white font-bold mb-2">Central de Pedidos</h2>
    <p class="text-stone-500 dark:text-white/40 text-sm max-w-sm mb-6 leading-relaxed">
        Os pedidos finalizados pelos clientes na loja virtual serão listados em tempo real nesta área para controle de entrega e despacho.
    </p>
    <a href="{{ route('admin.lanches.index') }}" class="px-5 py-2.5 rounded-full bg-brand text-black font-semibold text-sm hover:bg-brand-light transition-all shadow-sm">
        Ver cardápio disponível
    </a>
</div>

@endsection