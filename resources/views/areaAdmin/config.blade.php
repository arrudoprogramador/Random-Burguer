{{-- resources/views/areaAdmin/config.blade.php --}}
@extends('areaAdmin.layouts.admin')

@section('title', 'Configurações')
@section('breadcrumb', 'Configurações')

@section('content')

<div class="max-w-2xl">

    <div class="mb-8">
        <h1 class="font-display text-3xl text-white font-bold">Configurações</h1>
        <p class="text-white/40 text-sm mt-1">Configurações gerais do sistema</p>
    </div>

    {{-- Info da conta --}}
    <div class="bg-[#1A1A1A] rounded-2xl border border-white/5 p-6 mb-6">
        <h2 class="text-sm font-semibold text-white/50 uppercase tracking-widest mb-5">Conta Admin</h2>
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-full bg-brand flex items-center justify-center text-black font-bold text-xl">
                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
            </div>
            <div>
                <p class="text-white font-semibold">{{ auth()->user()->name ?? 'Admin' }}</p>
                <p class="text-white/40 text-sm">{{ auth()->user()->email ?? '' }}</p>
                <span class="inline-flex items-center gap-1 mt-1 px-2 py-0.5 rounded-full bg-brand/10 text-brand text-xs font-semibold border border-brand/20">
                    <i class="bi bi-shield-check text-xs"></i>
                    Administrador
                </span>
            </div>
        </div>
    </div>

    {{-- Sistema --}}
    <div class="bg-[#1A1A1A] rounded-2xl border border-white/5 p-6">
        <h2 class="text-sm font-semibold text-white/50 uppercase tracking-widest mb-5">Sistema</h2>
        <div class="flex flex-col gap-4">
            @foreach([
                ['icon' => 'bi-fire',        'label' => 'Nome da loja',    'value' => 'RandomBurguer'],
                ['icon' => 'bi-geo-alt',     'label' => 'Cidade',          'value' => 'São Paulo, SP'],
                ['icon' => 'bi-clock',       'label' => 'Funcionamento',   'value' => 'Seg–Dom: 11h às 23h'],
                ['icon' => 'bi-whatsapp',    'label' => 'Contato',         'value' => '(11) 9 9999-9999'],
            ] as $info)
                <div class="flex items-center gap-4 py-3 border-b border-white/5 last:border-0">
                    <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center shrink-0">
                        <i class="bi {{ $info['icon'] }} text-brand text-sm"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs text-white/30">{{ $info['label'] }}</p>
                        <p class="text-sm text-white">{{ $info['value'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>

@endsection