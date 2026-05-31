{{-- resources/views/areaAdmin/lanches/lanchesCadastrados.blade.php --}}
@extends('areaAdmin.layouts.admin')

@section('title', 'Lanches')
@section('breadcrumb', 'Lanches')

@section('content')

{{-- Header --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
    <div>
        <h1 class="font-display text-3xl text-white font-bold">Lanches</h1>
        <p class="text-white/40 text-sm mt-1">{{ $lanches->count() }} lanche(s) cadastrado(s)</p>
    </div>
    <a href="{{ route('admin.lanches.create') }}"
       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-brand text-black text-sm font-semibold hover:bg-brand-light transition-all shadow-lg shadow-brand/20">
        <i class="bi bi-plus-lg"></i>
        Novo Lanche
    </a>
</div>

{{-- Tabela --}}
<div class="bg-[#1A1A1A] rounded-2xl border border-white/5 overflow-hidden">

    {{-- Busca --}}
    <div class="p-5 border-b border-white/5">
        <form method="GET" action="{{ route('lanches.busca') }}">
            <div class="relative max-w-sm">
                <i class="bi bi-search absolute left-4 top-1/2 -translate-y-1/2 text-white/25 text-sm"></i>
                <input
                    type="text" name="pesquisar"
                    placeholder="Buscar lanche..."
                    value="{{ request('pesquisar') }}"
                    class="w-full bg-[#252525] border border-white/10 rounded-full pl-10 pr-4 py-2.5 text-sm text-white placeholder-white/25 focus:outline-none focus:border-brand/50 transition-all"
                />
            </div>
        </form>
    </div>

    @if($lanches->count())
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-white/5">
                        <th class="text-left text-xs text-white/30 uppercase tracking-widest px-6 py-4 font-medium">Lanche</th>
                        <th class="text-left text-xs text-white/30 uppercase tracking-widest px-6 py-4 font-medium hidden md:table-cell">Categoria</th>
                        <th class="text-left text-xs text-white/30 uppercase tracking-widest px-6 py-4 font-medium">Preço</th>
                        <th class="text-left text-xs text-white/30 uppercase tracking-widest px-6 py-4 font-medium hidden sm:table-cell">Status</th>
                        <th class="text-right text-xs text-white/30 uppercase tracking-widest px-6 py-4 font-medium">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @foreach($lanches as $lanche)
                        <tr class="hover:bg-white/2 transition-colors group">

                            {{-- Nome + imagem --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl overflow-hidden bg-[#252525] shrink-0">
                                        <img
                                            src="{{ $lanche->imagem ? url('img/lanches/' . $lanche->imagem) : 'https://placehold.co/40x40/252525/F59E0B?text=🍔' }}"
                                            alt="{{ $lanche->nome }}"
                                            class="w-full h-full object-cover"
                                        />
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-sm text-white font-medium truncate max-w-[180px]">{{ $lanche->nome }}</p>
                                        <p class="text-xs text-white/30 truncate max-w-[180px]">{{ Str::limit($lanche->descricao, 40) }}</p>
                                    </div>
                                </div>
                            </td>

                            {{-- Categoria --}}
                            <td class="px-6 py-4 hidden md:table-cell">
                                <span class="text-sm text-white/50">{{ $lanche->categoria->nome ?? '—' }}</span>
                            </td>

                            {{-- Preço --}}
                            <td class="px-6 py-4">
                                <span class="text-brand font-semibold text-sm">
                                    R$ {{ number_format($lanche->preco, 2, ',', '.') }}
                                </span>
                            </td>

                            {{-- Status --}}
                            <td class="px-6 py-4 hidden sm:table-cell">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium
                                    {{ $lanche->ativo ? 'bg-green-500/10 text-green-400 border border-green-500/20' : 'bg-red-500/10 text-red-400 border border-red-500/20' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $lanche->ativo ? 'bg-green-400' : 'bg-red-400' }}"></span>
                                    {{ $lanche->ativo ? 'Ativo' : 'Inativo' }}
                                </span>
                            </td>

                            {{-- Ações --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.lanches.edit', $lanche->id) }}"
                                       class="w-8 h-8 rounded-lg bg-white/5 hover:bg-brand/10 hover:text-brand text-white/40 flex items-center justify-center transition-all">
                                        <i class="bi bi-pencil text-sm"></i>
                                    </a>
                                    <form action="{{ route('admin.lanches.destroy', $lanche->id) }}" method="POST"
                                          onsubmit="return confirm('Remover {{ addslashes($lanche->nome) }}?')">
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
            <i class="bi bi-fire text-4xl text-white/10 mb-4"></i>
            <p class="text-white/40 text-sm">Nenhum lanche encontrado.</p>
            <a href="{{ route('admin.lanches.create') }}" class="mt-4 text-brand text-sm hover:text-brand-light transition-colors">
                + Cadastrar primeiro lanche
            </a>
        </div>
    @endif

</div>

@endsection