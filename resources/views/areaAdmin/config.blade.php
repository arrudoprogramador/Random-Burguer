{{-- resources/views/areaAdmin/config.blade.php --}}
@extends('areaAdmin.layouts.admin')

@section('title', 'Configurações — Admin')
@section('breadcrumb', 'Configurações')

@section('content')

<div class="max-w-2xl">

    <div class="mb-8">
        <h1 class="font-display text-3xl text-stone-900 dark:text-white font-bold">Configurações</h1>
        <p class="text-stone-500 dark:text-white/40 text-sm mt-1">Configurações e informações gerais da plataforma</p>
    </div>

    {{-- Info da conta --}}
    <div class="bg-surface-card rounded-2xl border border-surface-border dark:border-white/5 p-6 mb-6 shadow-sm theme-card">
        <h2 class="text-xs font-semibold text-stone-400 dark:text-white/40 uppercase tracking-widest mb-5">Conta do Administrador</h2>
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-full bg-brand flex items-center justify-center text-black font-bold text-xl shadow-sm">
                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
            </div>
            <div>
                <p class="text-stone-900 dark:text-white font-bold text-base">{{ auth()->user()->name ?? 'Admin' }}</p>
                <p class="text-stone-500 dark:text-white/40 text-sm">{{ auth()->user()->email ?? 'admin@randomburguer.com' }}</p>
                <span class="inline-flex items-center gap-1.5 mt-2 px-2.5 py-0.5 rounded-full bg-brand/10 text-brand text-xs font-semibold border border-brand/20">
                    <i class="bi bi-shield-check text-xs"></i>
                    Acesso Administrador
                </span>
            </div>
        </div>
    </div>

    {{-- Preferências de Aparência --}}
    <div class="bg-surface-card rounded-2xl border border-surface-border dark:border-white/5 p-6 mb-6 shadow-sm theme-card">
        <h2 class="text-xs font-semibold text-stone-400 dark:text-white/40 uppercase tracking-widest mb-5">Aparência do Sistema</h2>
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold text-stone-900 dark:text-white">Modo Claro / Escuro</p>
                <p class="text-xs text-stone-500 dark:text-white/40 mt-0.5">Alterne entre o tema claro e o tema escuro</p>
            </div>
            @include('components.theme-toggle')
        </div>
    </div>

    {{-- Dados do Estabelecimento --}}
    <div class="bg-surface-card rounded-2xl border border-surface-border dark:border-white/5 p-6 shadow-sm theme-card">
        <h2 class="text-xs font-semibold text-stone-400 dark:text-white/40 uppercase tracking-widest mb-5">Dados do Estabelecimento</h2>
        <div class="flex flex-col divide-y divide-surface-border dark:divide-white/5">
            @foreach([
                ['icon' => 'bi-fire',        'label' => 'Nome da hamburgueria',  'value' => 'RandomBurguer'],
                ['icon' => 'bi-geo-alt-fill','label' => 'Localização física',    'value' => 'Morumbi, São Paulo – SP'],
                ['icon' => 'bi-clock-fill',  'label' => 'Horário de atendimento','value' => 'Seg–Dom: 11h às 23h (Sex/Sáb até 00h)'],
                ['icon' => 'bi-whatsapp',    'label' => 'Canal de atendimento',  'value' => '(11) 9 9999-9999'],
            ] as $info)
                <div class="flex items-center gap-4 py-3.5 first:pt-0 last:pb-0">
                    <div class="w-9 h-9 rounded-xl bg-brand/10 border border-brand/20 flex items-center justify-center shrink-0">
                        <i class="bi {{ $info['icon'] }} text-brand text-sm"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs text-stone-400 dark:text-white/30 font-medium">{{ $info['label'] }}</p>
                        <p class="text-sm font-medium text-stone-800 dark:text-white">{{ $info['value'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>

@endsection