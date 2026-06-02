{{-- resources/views/areaAdmin/lanches/lanchesCadastrados.blade.php --}}
@extends('areaAdmin.layouts.admin')

@section('title', 'Lanches')
@section('breadcrumb', 'Lanches')

@section('content')

{{-- Header --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
    <div>
        <h1 class="font-display text-3xl text-white font-bold">Lanches</h1>
        <p class="text-white/40 text-sm mt-1">
            {{ $lanches->count() }} lanche(s)
            @if(request()->hasAny(['pesquisar', 'categoria', 'status', 'preco_min', 'preco_max']))
                <span class="text-brand">· filtrado(s)</span>
            @endif
        </p>
    </div>
    <a href="{{ route('admin.lanches.create') }}"
       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-brand text-black text-sm font-semibold hover:bg-brand-light transition-all shadow-lg shadow-brand/20 shrink-0">
        <i class="bi bi-plus-lg"></i>
        Novo Lanche
    </a>
</div>

{{-- Filtros --}}
<div
    x-data="{ filtersOpen: {{ request()->hasAny(['categoria', 'status', 'preco_min', 'preco_max']) ? 'true' : 'false' }} }"
    class="bg-[#1A1A1A] rounded-2xl border border-white/5 mb-4 overflow-hidden"
>
    {{-- Barra de busca + toggle filtros --}}
    <form method="GET" action="{{ route('admin.lanches.index') }}" id="filterForm">
        <div class="p-4 flex flex-col sm:flex-row gap-3">

            {{-- Busca --}}
            <div class="relative flex-1">
                <i class="bi bi-search absolute left-4 top-1/2 -translate-y-1/2 text-white/25 text-sm"></i>
                <input
                    type="text" name="pesquisar"
                    placeholder="Buscar por nome ou descrição..."
                    value="{{ request('pesquisar') }}"
                    class="w-full bg-[#252525] border border-white/10 rounded-xl pl-10 pr-4 py-2.5 text-sm text-white placeholder-white/25 focus:outline-none focus:border-brand/50 transition-all"
                />
            </div>

            {{-- Toggle filtros avançados --}}
            <button
                type="button"
                @click="filtersOpen = !filtersOpen"
                :class="filtersOpen ? 'bg-brand/10 border-brand/30 text-brand' : 'bg-[#252525] border-white/10 text-white/50 hover:text-white'"
                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border text-sm font-medium transition-all shrink-0"
            >
                <i class="bi bi-sliders text-sm"></i>
                <span class="hidden sm:inline">Filtros</span>
                @if(request()->hasAny(['categoria', 'status', 'preco_min', 'preco_max']))
                    <span class="w-5 h-5 rounded-full bg-brand text-black text-[10px] font-bold flex items-center justify-center">
                        {{ collect(['categoria', 'status', 'preco_min', 'preco_max'])->filter(fn($k) => request($k))->count() }}
                    </span>
                @endif
            </button>

            {{-- Buscar --}}
            <button type="submit"
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white/70 text-sm hover:bg-white/10 hover:text-white transition-all shrink-0">
                <i class="bi bi-search text-sm"></i>
                <span class="hidden sm:inline">Buscar</span>
            </button>
        </div>

        {{-- Filtros avançados --}}
        <div
            x-show="filtersOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="border-t border-white/5 px-4 py-5"
        >
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                {{-- Categoria --}}
                <div class="flex flex-col gap-1.5">
                    <label class="text-xs text-white/30 uppercase tracking-widest font-medium">Categoria</label>
                    <select name="categoria"
                            class="bg-[#252525] border border-white/10 rounded-xl px-3 py-2.5 text-sm text-white focus:outline-none focus:border-brand/50 transition-all">
                        <option value="">Todas</option>
                        @if(isset($categorias))
                            @foreach($categorias as $cat)
                                <option value="{{ $cat->id }}" {{ request('categoria') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->nome }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>

                {{-- Status --}}
                <div class="flex flex-col gap-1.5">
                    <label class="text-xs text-white/30 uppercase tracking-widest font-medium">Status</label>
                    <select name="status"
                            class="bg-[#252525] border border-white/10 rounded-xl px-3 py-2.5 text-sm text-white focus:outline-none focus:border-brand/50 transition-all">
                        <option value="">Todos</option>
                        <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Ativo</option>
                        <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inativo</option>
                    </select>
                </div>

                {{-- Preço mínimo --}}
                <div class="flex flex-col gap-1.5">
                    <label class="text-xs text-white/30 uppercase tracking-widest font-medium">Preço mínimo</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-white/25 text-xs font-medium">R$</span>
                        <input
                            type="number" name="preco_min" min="0" step="0.01"
                            value="{{ request('preco_min') }}"
                            placeholder="0,00"
                            class="w-full bg-[#252525] border border-white/10 rounded-xl pl-8 pr-3 py-2.5 text-sm text-white placeholder-white/20 focus:outline-none focus:border-brand/50 transition-all"
                        />
                    </div>
                </div>

                {{-- Preço máximo --}}
                <div class="flex flex-col gap-1.5">
                    <label class="text-xs text-white/30 uppercase tracking-widest font-medium">Preço máximo</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-white/25 text-xs font-medium">R$</span>
                        <input
                            type="number" name="preco_max" min="0" step="0.01"
                            value="{{ request('preco_max') }}"
                            placeholder="999,00"
                            class="w-full bg-[#252525] border border-white/10 rounded-xl pl-8 pr-3 py-2.5 text-sm text-white placeholder-white/20 focus:outline-none focus:border-brand/50 transition-all"
                        />
                    </div>
                </div>

            </div>

            {{-- Ações dos filtros --}}
            <div class="flex items-center gap-3 mt-4 pt-4 border-t border-white/5">
                <button type="submit"
                        class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-brand text-black text-sm font-semibold hover:bg-brand-light transition-all">
                    <i class="bi bi-funnel-fill text-xs"></i>
                    Aplicar filtros
                </button>
                @if(request()->hasAny(['pesquisar', 'categoria', 'status', 'preco_min', 'preco_max']))
                    <a href="{{ route('admin.lanches.index') }}"
                       class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-white/10 text-white/40 text-sm hover:text-white hover:border-white/20 transition-all">
                        <i class="bi bi-x-lg text-xs"></i>
                        Limpar filtros
                    </a>
                @endif
            </div>
        </div>

    </form>
</div>

{{-- Tags de filtros ativos --}}
@if(request()->hasAny(['pesquisar', 'categoria', 'status', 'preco_min', 'preco_max']))
    <div class="flex flex-wrap gap-2 mb-4">
        @if(request('pesquisar'))
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-brand/10 border border-brand/20 text-brand text-xs font-medium">
                <i class="bi bi-search text-[10px]"></i>
                "{{ request('pesquisar') }}"
            </span>
        @endif
        @if(request('status') !== null && request('status') !== '')
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/5 border border-white/10 text-white/60 text-xs">
                Status: {{ request('status') == '1' ? 'Ativo' : 'Inativo' }}
            </span>
        @endif
        @if(request('preco_min') || request('preco_max'))
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/5 border border-white/10 text-white/60 text-xs">
                <i class="bi bi-tag text-[10px]"></i>
                R$ {{ request('preco_min', '0') }} – {{ request('preco_max', '∞') }}
            </span>
        @endif
    </div>
@endif

{{-- Tabela --}}
<div class="bg-[#1A1A1A] rounded-2xl border border-white/5 overflow-hidden">

    @if($lanches->count())

        {{-- Desktop: tabela --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-white/5">
                        <th class="text-left text-xs text-white/25 uppercase tracking-widest px-6 py-4 font-medium">Lanche</th>
                        <th class="text-left text-xs text-white/25 uppercase tracking-widest px-6 py-4 font-medium">Categoria</th>
                        <th class="text-left text-xs text-white/25 uppercase tracking-widest px-6 py-4 font-medium">Preço</th>
                        <th class="text-left text-xs text-white/25 uppercase tracking-widest px-6 py-4 font-medium">Estoque</th>
                        <th class="text-left text-xs text-white/25 uppercase tracking-widest px-6 py-4 font-medium">Status</th>
                        <th class="text-right text-xs text-white/25 uppercase tracking-widest px-6 py-4 font-medium">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @foreach($lanches as $lanche)
                        <tr class="hover:bg-white/[0.02] transition-colors group">

                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-11 h-11 rounded-xl overflow-hidden bg-[#252525] shrink-0 border border-white/5">
                                        <img
                                            src="{{ $lanche->imagem ? url('img/lanches/' . $lanche->imagem) : 'https://placehold.co/44x44/252525/F59E0B?text=🍔' }}"
                                            alt="{{ $lanche->nome }}"
                                            class="w-full h-full object-cover"
                                        />
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-sm text-white font-medium truncate max-w-[200px]">{{ $lanche->nome }}</p>
                                        <p class="text-xs text-white/25 truncate max-w-[200px] mt-0.5">{{ Str::limit($lanche->descricao, 45) }}</p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <span class="text-sm text-white/45">{{ $lanche->categoria->nome ?? '—' }}</span>
                            </td>

                            <td class="px-6 py-4">
                                <span class="text-brand font-bold text-sm">
                                    R$ {{ number_format($lanche->preco, 2, ',', '.') }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                @php $estoque = $lanche->estoque ?? 0; @endphp
                                <span class="text-sm font-medium {{ $estoque <= 0 ? 'text-red-400' : ($estoque <= 5 ? 'text-yellow-400' : 'text-white/50') }}">
                                    {{ $estoque }} un.
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium
                                    {{ $lanche->ativo ? 'bg-green-500/10 text-green-400 border border-green-500/20' : 'bg-red-500/10 text-red-400 border border-red-500/20' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $lanche->ativo ? 'bg-green-400' : 'bg-red-400' }}"></span>
                                    {{ $lanche->ativo ? 'Ativo' : 'Inativo' }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-1.5 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <a href="{{ route('admin.lanches.edit', $lanche->id) }}"
                                       class="w-8 h-8 rounded-lg bg-white/5 hover:bg-brand/10 hover:text-brand text-white/40 flex items-center justify-center transition-all"
                                       title="Editar">
                                        <i class="bi bi-pencil text-xs"></i>
                                    </a>
                                    <form action="{{ route('admin.lanches.destroy', $lanche->id) }}" method="POST"
                                          onsubmit="return confirm('Remover {{ addslashes($lanche->nome) }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="w-8 h-8 rounded-lg bg-white/5 hover:bg-red-500/10 hover:text-red-400 text-white/40 flex items-center justify-center transition-all"
                                                title="Excluir">
                                            <i class="bi bi-trash3 text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Mobile: cards --}}
        <div class="md:hidden divide-y divide-white/5">
            @foreach($lanches as $lanche)
                <div class="p-4 flex gap-3">
                    <div class="w-14 h-14 rounded-xl overflow-hidden bg-[#252525] shrink-0 border border-white/5">
                        <img
                            src="{{ $lanche->imagem ? url('img/lanches/' . $lanche->imagem) : 'https://placehold.co/56x56/252525/F59E0B?text=🍔' }}"
                            alt="{{ $lanche->nome }}"
                            class="w-full h-full object-cover"
                        />
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between gap-2">
                            <p class="text-sm text-white font-medium truncate">{{ $lanche->nome }}</p>
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-medium shrink-0
                                {{ $lanche->ativo ? 'bg-green-500/10 text-green-400 border border-green-500/20' : 'bg-red-500/10 text-red-400 border border-red-500/20' }}">
                                {{ $lanche->ativo ? 'Ativo' : 'Inativo' }}
                            </span>
                        </div>
                        <p class="text-xs text-white/30 mt-0.5 truncate">{{ $lanche->categoria->nome ?? 'Sem categoria' }}</p>
                        <div class="flex items-center justify-between mt-2">
                            <span class="text-brand font-bold text-sm">R$ {{ number_format($lanche->preco, 2, ',', '.') }}</span>
                            <div class="flex gap-1.5">
                                <a href="{{ route('admin.lanches.edit', $lanche->id) }}"
                                   class="w-7 h-7 rounded-lg bg-white/5 hover:bg-brand/10 hover:text-brand text-white/40 flex items-center justify-center transition-all">
                                    <i class="bi bi-pencil text-xs"></i>
                                </a>
                                <form action="{{ route('admin.lanches.destroy', $lanche->id) }}" method="POST"
                                      onsubmit="return confirm('Remover {{ addslashes($lanche->nome) }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="w-7 h-7 rounded-lg bg-white/5 hover:bg-red-500/10 hover:text-red-400 text-white/40 flex items-center justify-center transition-all">
                                        <i class="bi bi-trash3 text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Footer da tabela --}}
        <div class="px-6 py-3 border-t border-white/5 flex items-center justify-between">
            <span class="text-xs text-white/25">
                Exibindo {{ $lanches->count() }} resultado(s)
            </span>
            <a href="{{ route('admin.lanches.create') }}"
               class="text-xs text-brand hover:text-brand-light transition-colors font-medium">
                + Novo lanche
            </a>
        </div>

    @else
        <div class="flex flex-col items-center justify-center py-24 text-center px-6">
            <div class="w-16 h-16 rounded-2xl bg-white/5 border border-white/5 flex items-center justify-center mb-5">
                <i class="bi bi-fire text-3xl text-white/15"></i>
            </div>
            <h3 class="text-white/60 font-medium mb-1">Nenhum lanche encontrado</h3>
            <p class="text-white/30 text-sm mb-6">
                @if(request()->hasAny(['pesquisar', 'categoria', 'status', 'preco_min', 'preco_max']))
                    Tente ajustar os filtros de busca.
                @else
                    Comece cadastrando o primeiro lanche.
                @endif
            </p>
            <div class="flex gap-3">
                @if(request()->hasAny(['pesquisar', 'categoria', 'status', 'preco_min', 'preco_max']))
                    <a href="{{ route('admin.lanches.index') }}"
                       class="px-4 py-2 rounded-full border border-white/10 text-white/40 text-sm hover:text-white transition-all">
                        Limpar filtros
                    </a>
                @endif
                <a href="{{ route('admin.lanches.create') }}"
                   class="px-4 py-2 rounded-full bg-brand text-black text-sm font-semibold hover:bg-brand-light transition-all">
                    + Novo lanche
                </a>
            </div>
        </div>
    @endif

</div>

@endsection