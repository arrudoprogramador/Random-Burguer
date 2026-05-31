{{-- resources/views/areaAdmin/clientes/clientesCadastrados.blade.php --}}
@extends('areaAdmin.layouts.admin')

@section('title', 'Clientes')
@section('breadcrumb', 'Clientes')

@section('content')

{{-- Header --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
    <div>
        <h1 class="font-display text-3xl text-white font-bold">Clientes</h1>
        <p class="text-white/40 text-sm mt-1">{{ $clientes->count() }} cliente(s) cadastrado(s)</p>
    </div>
</div>

{{-- Tabela --}}
<div class="bg-[#1A1A1A] rounded-2xl border border-white/5 overflow-hidden">

    {{-- Busca --}}
    <div class="p-5 border-b border-white/5">
        <form method="GET" action="{{ route('admin.clientes.busca') }}">
            <div class="relative max-w-sm">
                <i class="bi bi-search absolute left-4 top-1/2 -translate-y-1/2 text-white/25 text-sm"></i>
                <input type="text" name="pesquisar" placeholder="Buscar cliente..."
                       value="{{ request('pesquisar') }}"
                       class="w-full bg-[#252525] border border-white/10 rounded-full pl-10 pr-4 py-2.5 text-sm text-white placeholder-white/25 focus:outline-none focus:border-brand/50 transition-all" />
            </div>
        </form>
    </div>

    @if($clientes->count())
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-white/5">
                        <th class="text-left text-xs text-white/30 uppercase tracking-widest px-6 py-4 font-medium">Cliente</th>
                        <th class="text-left text-xs text-white/30 uppercase tracking-widest px-6 py-4 font-medium hidden sm:table-cell">Telefone</th>
                        <th class="text-left text-xs text-white/30 uppercase tracking-widest px-6 py-4 font-medium hidden md:table-cell">Cadastro</th>
                        <th class="text-left text-xs text-white/30 uppercase tracking-widest px-6 py-4 font-medium">Status</th>
                        <th class="text-right text-xs text-white/30 uppercase tracking-widest px-6 py-4 font-medium">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @foreach($clientes as $cliente)
                        <tr class="hover:bg-white/2 transition-colors">

                            {{-- Nome + email --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-brand/10 border border-brand/20 flex items-center justify-center shrink-0 text-brand font-bold text-sm">
                                        {{ strtoupper(substr($cliente->name, 0, 1)) }}
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-sm text-white font-medium truncate">{{ $cliente->name }}</p>
                                        <p class="text-xs text-white/30 truncate">{{ $cliente->email }}</p>
                                    </div>
                                </div>
                            </td>

                            {{-- Telefone --}}
                            <td class="px-6 py-4 hidden sm:table-cell">
                                <span class="text-sm text-white/50">{{ $cliente->telefone ?? '—' }}</span>
                            </td>

                            {{-- Cadastro --}}
                            <td class="px-6 py-4 hidden md:table-cell">
                                <span class="text-sm text-white/40">
                                    {{ $cliente->created_at->format('d/m/Y') }}
                                </span>
                            </td>

                            {{-- Status --}}
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium
                                    {{ $cliente->ativo ? 'bg-green-500/10 text-green-400 border border-green-500/20' : 'bg-red-500/10 text-red-400 border border-red-500/20' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $cliente->ativo ? 'bg-green-400' : 'bg-red-400' }}"></span>
                                    {{ $cliente->ativo ? 'Ativo' : 'Inativo' }}
                                </span>
                            </td>

                            {{-- Ações --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end">
                                    <form action="{{ route('admin.clientes.destroy', $cliente->id) }}" method="POST"
                                          onsubmit="return confirm('Remover {{ addslashes($cliente->name) }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="w-8 h-8 rounded-lg bg-white/5 hover:bg-red-500/10 hover:text-red-400 text-white/40 flex items-center justify-center transition-all">
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
        <div class="flex flex-col items-center justify-center py-20 text-center">
            <i class="bi bi-people text-4xl text-white/10 mb-4"></i>
            <p class="text-white/40 text-sm">Nenhum cliente encontrado.</p>
        </div>
    @endif

</div>

@endsection