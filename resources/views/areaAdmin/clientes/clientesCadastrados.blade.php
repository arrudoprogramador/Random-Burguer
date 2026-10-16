{{-- resources/views/areaAdmin/clientes/clientesCadastrados.blade.php --}}
@extends('areaAdmin.layouts.admin')

@section('title', 'Clientes Cadastrados — Admin')
@section('breadcrumb', 'Clientes')

@section('content')

{{-- Header --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
    <div>
        <h1 class="font-display text-3xl text-stone-900 dark:text-white font-bold">Clientes</h1>
        <p class="text-stone-500 dark:text-white/40 text-sm mt-1">{{ $clientes->count() }} cliente(s) cadastrado(s)</p>
    </div>
</div>

{{-- Tabela --}}
<div class="bg-surface-card rounded-2xl border border-surface-border dark:border-white/5 overflow-hidden shadow-sm theme-card">

    {{-- Busca --}}
    <div class="p-5 border-b border-surface-border dark:border-white/5">
        <form method="GET" action="{{ route('admin.clientes.busca') }}">
            <div class="relative max-w-sm">
                <i class="bi bi-search absolute left-4 top-1/2 -translate-y-1/2 text-stone-400 dark:text-white/25 text-sm"></i>
                <input type="text" name="pesquisar" placeholder="Buscar cliente por nome ou e-mail..."
                       value="{{ request('pesquisar') }}"
                       class="w-full bg-surface-muted border border-surface-border dark:border-white/10 rounded-full pl-10 pr-4 py-2.5 text-sm text-stone-900 dark:text-white placeholder-stone-400 dark:placeholder-white/25 focus:outline-none focus:border-brand/60 transition-all" />
            </div>
        </form>
    </div>

    @if($clientes->count())
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-surface-border dark:border-white/5 bg-surface-muted/40">
                        <th class="text-left text-xs text-stone-500 dark:text-white/30 uppercase tracking-widest px-6 py-4 font-semibold">Cliente</th>
                        <th class="text-left text-xs text-stone-500 dark:text-white/30 uppercase tracking-widest px-6 py-4 font-semibold hidden sm:table-cell">Telefone</th>
                        <th class="text-left text-xs text-stone-500 dark:text-white/30 uppercase tracking-widest px-6 py-4 font-semibold hidden md:table-cell">Cadastro</th>
                        <th class="text-left text-xs text-stone-500 dark:text-white/30 uppercase tracking-widest px-6 py-4 font-semibold">Status</th>
                        <th class="text-right text-xs text-stone-500 dark:text-white/30 uppercase tracking-widest px-6 py-4 font-semibold">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-border dark:divide-white/5">
                    @foreach($clientes as $cliente)
                        <tr class="hover:bg-stone-100/70 dark:hover:bg-white/[0.02] transition-colors">

                            {{-- Nome + email --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-brand/10 border border-brand/20 flex items-center justify-center shrink-0 text-brand font-bold text-sm">
                                        {{ strtoupper(substr($cliente->name, 0, 1)) }}
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-sm text-stone-900 dark:text-white font-semibold truncate">{{ $cliente->name }}</p>
                                        <p class="text-xs text-stone-500 dark:text-white/30 truncate">{{ $cliente->email }}</p>
                                    </div>
                                </div>
                            </td>

                            {{-- Telefone --}}
                            <td class="px-6 py-4 hidden sm:table-cell">
                                <span class="text-sm text-stone-600 dark:text-white/50">{{ $cliente->telefone ?? '—' }}</span>
                            </td>

                            {{-- Cadastro --}}
                            <td class="px-6 py-4 hidden md:table-cell">
                                <span class="text-sm text-stone-500 dark:text-white/40">
                                    {{ $cliente->created_at->format('d/m/Y') }}
                                </span>
                            </td>

                            {{-- Status --}}
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold
                                    {{ ($cliente->ativo ?? true) ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20' : 'bg-red-500/10 text-red-600 dark:text-red-400 border border-red-500/20' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ ($cliente->ativo ?? true) ? 'bg-emerald-500' : 'bg-red-500' }}"></span>
                                    {{ ($cliente->ativo ?? true) ? 'Ativo' : 'Inativo' }}
                                </span>
                            </td>

                            {{-- Ações --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end">
                                    <form action="{{ route('admin.clientes.destroy', $cliente->id) }}" method="POST"
                                          onsubmit="return confirm('Remover o cliente {{ addslashes($cliente->name) }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="w-8 h-8 rounded-lg bg-stone-200/80 hover:bg-red-500/15 hover:text-red-500 text-stone-600 dark:bg-white/5 dark:text-white/40 flex items-center justify-center transition-all"
                                                title="Remover cliente">
                                            <i class="bi bi-trash3 text-sm"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="flex flex-col items-center justify-center py-20 text-center px-6">
            <div class="w-16 h-16 rounded-2xl bg-surface-muted border border-surface-border dark:border-white/5 flex items-center justify-center mb-4">
                <i class="bi bi-people text-3xl text-stone-400 dark:text-white/20"></i>
            </div>
            <h3 class="text-stone-900 dark:text-white font-bold mb-1">Nenhum cliente encontrado</h3>
            <p class="text-stone-500 dark:text-white/40 text-sm">
                {{ request('pesquisar') ? 'Tente buscar com outro termo.' : 'Os novos cadastros aparecerão listados aqui.' }}
            </p>
        </div>
    @endif

</div>

@endsection