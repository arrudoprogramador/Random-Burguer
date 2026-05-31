{{-- resources/views/areaAdmin/pedidos/pedidos.blade.php --}}
@extends('areaAdmin.layouts.admin')

@section('title', 'Pedidos')
@section('breadcrumb', 'Pedidos')

@section('content')

<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
    <div>
        <h1 class="font-display text-3xl text-white font-bold">Pedidos</h1>
        <p class="text-white/40 text-sm mt-1">Gerencie os pedidos da loja</p>
    </div>
</div>

<div class="bg-[#1A1A1A] rounded-2xl border border-white/5 flex flex-col items-center justify-center py-32 text-center">
    <div class="w-16 h-16 rounded-2xl bg-brand/10 border border-brand/20 flex items-center justify-center mb-6">
        <i class="bi bi-bag-check text-3xl text-brand"></i>
    </div>
    <h2 class="font-display text-xl text-white font-bold mb-2">Módulo de Pedidos</h2>
    <p class="text-white/40 text-sm max-w-xs">
        O módulo de pedidos será implementado em breve.
    </p>
</div>

@endsection