{{-- resources/views/areaAdmin/lanches/lanchesCadastrados.blade.php --}}
@extends('areaAdmin.layouts.admin')

@section('title', 'Lanches Cadastrados — Admin')
@section('breadcrumb', 'Lanches')

@section('content')

{{-- Header --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
    <div>
        <h1 class="font-display text-3xl text-stone-900 dark:text-white font-bold">Lanches</h1>
        <p class="text-stone-500 dark:text-white/40 text-sm mt-1">
            {{ $lanches->count() }} lanche(s) no cardápio
            @if(request()->hasAny(['pesquisar', 'categoria', 'status', 'preco_min', 'preco_max']))
                <span class="text-brand font-semibold">· com filtros aplicados</span>
            @endif
        </p>
    </div>
    <a href="{{ route('admin.lanches.create') }}"
       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-brand text-black text-sm font-bold hover:bg-brand-light transition-all shadow-md shadow-brand/20 shrink-0 hover:-translate-y-0.5 active:scale-95">
        <i class="bi bi-plus-lg"></i>
        Novo Lanche
    </a>
</div>

{{-- Filtros --}}
<div
    x-data="{ filtersOpen: {{ request()->hasAny(['categoria', 'status', 'preco_min', 'preco_max']) ? 'true' : 'false' }} }"
    class="bg-surface-card rounded-2xl border border-surface-border dark:border-white/5 mb-6 overflow-hidden shadow-sm theme-card"
>
    {{-- Barra de busca + toggle filtros --}}
    <form method="GET" action="{{ route('admin.lanches.index') }}" id="filterForm">
        <div class="p-4 flex flex-col sm:flex-row gap-3">

            {{-- Busca --}}
            <div class="relative flex-1">
                <i class="bi bi-search absolute left-4 top-1/2 -translate-y-1/2 text-stone-400 dark:text-white/25 text-sm"></i>
                <input
                    type="text" name="pesquisar"
                    placeholder="Buscar por nome ou descrição..."
                    value="{{ request('pesquisar') }}"
                    class="w-full bg-surface-muted border border-surface-border dark:border-white/10 rounded-xl pl-10 pr-4 py-2.5 text-sm text-stone-900 dark:text-white placeholder-stone-400 dark:placeholder-white/25 focus:outline-none focus:border-brand/60 focus:ring-1 focus:ring-brand/30 transition-all"
                />
            </div>

            {{-- Toggle filtros avançados --}}
            <button
                type="button"
                @click="filtersOpen = !filtersOpen"
                :class="filtersOpen ? 'bg-brand/10 border-brand/40 text-brand' : 'bg-surface-muted border-surface-border dark:border-white/10 text-stone-600 dark:text-white/50 hover:text-stone-900 dark:hover:text-white'"
                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border text-sm font-semibold transition-all shrink-0"
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
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-stone-200/80 dark:bg-white/5 border border-surface-border dark:border-white/10 text-stone-800 dark:text-white/70 text-sm font-semibold hover:bg-stone-300 dark:hover:bg-white/10 hover:text-black dark:hover:text-white transition-all shrink-0">
                <i class="bi bi-search text-sm"></i>
                <span class="hidden sm:inline">Buscar</span>
            </button>
        </div>

        {{-- Filtros avançados --}}
        <div
            x-show="filtersOpen"
            x-cloak
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="border-t border-surface-border dark:border-white/5 px-4 py-5 bg-surface-muted/30"
        >
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                {{-- Categoria --}}
                <div class="flex flex-col gap-1.5">
                    <label class="text-xs text-stone-600 dark:text-white/40 uppercase tracking-widest font-semibold">Categoria</label>
                    <select name="categoria"
                            class="bg-surface-card border border-surface-border dark:border-white/10 rounded-xl px-3 py-2.5 text-sm text-stone-900 dark:text-white focus:outline-none focus:border-brand/60 transition-all">
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
                    <label class="text-xs text-stone-600 dark:text-white/40 uppercase tracking-widest font-semibold">Status</label>
                    <select name="status"
                            class="bg-surface-card border border-surface-border dark:border-white/10 rounded-xl px-3 py-2.5 text-sm text-stone-900 dark:text-white focus:outline-none focus:border-brand/60 transition-all">
                        <option value="">Todos</option>
                        <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Ativo</option>
                        <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inativo</option>
                    </select>
                </div>

                {{-- Preço mínimo --}}
                <div class="flex flex-col gap-1.5">
                    <label class="text-xs text-stone-600 dark:text-white/40 uppercase tracking-widest font-semibold">Preço mínimo</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-stone-400 dark:text-white/30 text-xs font-semibold">R$</span>
                        <input
                            type="number" name="preco_min" min="0" step="0.01"
                            value="{{ request('preco_min') }}"
                            placeholder="0,00"
                            class="w-full bg-surface-card border border-surface-border dark:border-white/10 rounded-xl pl-8 pr-3 py-2.5 text-sm text-stone-900 dark:text-white placeholder-stone-400 dark:placeholder-white/20 focus:outline-none focus:border-brand/60 transition-all"
                        />
                    </div>
                </div>

                {{-- Preço máximo --}}
                <div class="flex flex-col gap-1.5">
                    <label class="text-xs text-stone-600 dark:text-white/40 uppercase tracking-widest font-semibold">Preço máximo</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-stone-400 dark:text-white/30 text-xs font-semibold">R$</span>
                        <input
                            type="number" name="preco_max" min="0" step="0.01"
                            value="{{ request('preco_max') }}"
                            placeholder="999,00"
                            class="w-full bg-surface-card border border-surface-border dark:border-white/10 rounded-xl pl-8 pr-3 py-2.5 text-sm text-stone-900 dark:text-white placeholder-stone-400 dark:placeholder-white/20 focus:outline-none focus:border-brand/60 transition-all"
                        />
                    </div>
                </div>

            </div>

            {{-- Ações dos filtros --}}
            <div class="flex items-center gap-3 mt-4 pt-4 border-t border-surface-border dark:border-white/5">
                <button type="submit"
                        class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-brand text-black text-sm font-bold hover:bg-brand-light transition-all shadow-sm">
                    <i class="bi bi-funnel-fill text-xs"></i>
                    Aplicar filtros
                </button>
                @if(request()->hasAny(['pesquisar', 'categoria', 'status', 'preco_min', 'preco_max']))
                    <a href="{{ route('admin.lanches.index') }}"
                       class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-surface-border dark:border-white/10 text-stone-600 dark:text-white/50 text-sm font-medium hover:text-stone-900 dark:hover:text-white transition-all">
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
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-brand/10 border border-brand/20 text-brand text-xs font-semibold">
                <i class="bi bi-search text-[10px]"></i>
                "{{ request('pesquisar') }}"
            </span>
        @endif
        @if(request('status') !== null && request('status') !== '')
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-stone-200/60 dark:bg-white/5 border border-surface-border dark:border-white/10 text-stone-700 dark:text-white/60 text-xs font-medium">
                Status: {{ request('status') == '1' ? 'Ativo' : 'Inativo' }}
            </span>
        @endif
        @if(request('preco_min') || request('preco_max'))
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-stone-200/60 dark:bg-white/5 border border-surface-border dark:border-white/10 text-stone-700 dark:text-white/60 text-xs font-medium">
                <i class="bi bi-tag text-[10px]"></i>
                R$ {{ request('preco_min', '0') }} – {{ request('preco_max', '∞') }}
            </span>
        @endif
    </div>
@endif

{{-- Tabela --}}
<div class="bg-surface-card rounded-2xl border border-surface-border dark:border-white/5 overflow-hidden shadow-sm theme-card">

    @if($lanches->count())

        {{-- Desktop: tabela --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-surface-border dark:border-white/5 bg-surface-muted/40">
                        <th class="text-left text-xs text-stone-500 dark:text-white/30 uppercase tracking-widest px-6 py-4 font-semibold">Lanche</th>
                        <th class="text-left text-xs text-stone-500 dark:text-white/30 uppercase tracking-widest px-6 py-4 font-semibold">Categoria</th>
                        <th class="text-left text-xs text-stone-500 dark:text-white/30 uppercase tracking-widest px-6 py-4 font-semibold">Preço</th>
                        <th class="text-left text-xs text-stone-500 dark:text-white/30 uppercase tracking-widest px-6 py-4 font-semibold">Estoque</th>
                        <th class="text-left text-xs text-stone-500 dark:text-white/30 uppercase tracking-widest px-6 py-4 font-semibold">Status</th>
                        <th class="text-right text-xs text-stone-500 dark:text-white/30 uppercase tracking-widest px-6 py-4 font-semibold">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-border dark:divide-white/5">
                    @foreach($lanches as $lanche)
                        <tr class="hover:bg-stone-100/70 dark:hover:bg-white/[0.02] transition-colors group">

                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-11 h-11 rounded-xl overflow-hidden bg-surface-muted shrink-0 border border-surface-border dark:border-white/5">
                                        <img
                                            src="{{ $lanche->imagem ? asset('img/lanches/' . $lanche->imagem) : asset('img/lanches/triplo-bacon.jpg') }}"
                                            alt="{{ $lanche->nome }}"
                                            class="w-full h-full object-cover"
                                        />
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-sm text-stone-900 dark:text-white font-semibold truncate max-w-[200px]">{{ $lanche->nome }}</p>
                                        <p class="text-xs text-stone-500 dark:text-white/30 truncate max-w-[200px] mt-0.5">{{ Str::limit($lanche->descricao, 45) }}</p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <span class="text-sm text-stone-600 dark:text-white/60 font-medium">{{ $lanche->categoria->nome ?? '—' }}</span>
                            </td>

                            <td class="px-6 py-4">
                                <span class="text-brand font-bold text-sm">
                                    R$ {{ number_format($lanche->preco, 2, ',', '.') }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                @php $estoque = $lanche->estoque ?? 0; @endphp
                                <span class="text-sm font-semibold {{ $estoque <= 0 ? 'text-red-500' : ($estoque <= 5 ? 'text-amber-500' : 'text-stone-600 dark:text-white/60') }}">
                                    {{ $estoque }} un.
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold
                                    {{ $lanche->ativo ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20' : 'bg-red-500/10 text-red-600 dark:text-red-400 border border-red-500/20' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $lanche->ativo ? 'bg-emerald-500' : 'bg-red-500' }}"></span>
                                    {{ $lanche->ativo ? 'Ativo' : 'Inativo' }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-1.5 opacity-90 group-hover:opacity-100 transition-opacity">
                                    <a href="{{ route('admin.lanches.edit', $lanche->id) }}"
                                       class="w-8 h-8 rounded-lg bg-stone-200/80 hover:bg-brand/20 hover:text-brand text-stone-600 dark:bg-white/5 dark:text-white/50 flex items-center justify-center transition-all"
                                       title="Editar">
                                        <i class="bi bi-pencil text-xs"></i>
                                    </a>
                                    <form action="{{ route('admin.lanches.destroy', $lanche->id) }}" method="POST"
                                          onsubmit="return confirm('Remover {{ addslashes($lanche->nome) }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="w-8 h-8 rounded-lg bg-stone-200/80 hover:bg-red-500/15 hover:text-red-500 text-stone-600 dark:bg-white/5 dark:text-white/50 flex items-center justify-center transition-all"
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
        <div class="md:hidden divide-y divide-surface-border dark:divide-white/5">
            @foreach($lanches as $lanche)
                <div class="p-4 flex gap-3">
                    <div class="w-14 h-14 rounded-xl overflow-hidden bg-surface-muted shrink-0 border border-surface-border dark:border-white/5">
                        <img
                            src="{{ $lanche->imagem ? asset('img/lanches/' . $lanche->imagem) : asset('img/lanches/triplo-bacon.jpg') }}"
                            alt="{{ $lanche->nome }}"
                            class="w-full h-full object-cover"
                        />
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between gap-2">
                            <p class="text-sm text-stone-900 dark:text-white font-semibold truncate">{{ $lanche->nome }}</p>
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-semibold shrink-0
                                {{ $lanche->ativo ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20' : 'bg-red-500/10 text-red-600 dark:text-red-400 border border-red-500/20' }}">
                                {{ $lanche->ativo ? 'Ativo' : 'Inativo' }}
                            </span>
                        </div>
                        <p class="text-xs text-stone-500 dark:text-white/40 mt-0.5 truncate">{{ $lanche->categoria->nome ?? 'Sem categoria' }}</p>
                        <div class="flex items-center justify-between mt-2">
                            <span class="text-brand font-bold text-sm">R$ {{ number_format($lanche->preco, 2, ',', '.') }}</span>
                            <div class="flex gap-1.5">
                                <a href="{{ route('admin.lanches.edit', $lanche->id) }}"
                                   class="w-7 h-7 rounded-lg bg-stone-200/80 hover:bg-brand/20 hover:text-brand text-stone-600 dark:bg-white/5 dark:text-white/50 flex items-center justify-center transition-all">
                                    <i class="bi bi-pencil text-xs"></i>
                                </a>
                                <form action="{{ route('admin.lanches.destroy', $lanche->id) }}" method="POST"
                                      onsubmit="return confirm('Remover {{ addslashes($lanche->nome) }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="w-7 h-7 rounded-lg bg-stone-200/80 hover:bg-red-500/15 hover:text-red-500 text-stone-600 dark:bg-white/5 dark:text-white/50 flex items-center justify-center transition-all">
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
        <div class="px-6 py-3 border-t border-surface-border dark:border-white/5 flex items-center justify-between bg-surface-muted/30">
            <span class="text-xs text-stone-500 dark:text-white/30 font-medium">
                Exibindo {{ $lanches->count() }} resultado(s)
            </span>
            <a href="{{ route('admin.lanches.create') }}"
               class="text-xs text-brand hover:underline font-bold">
                + Novo lanche
            </a>
        </div>

    @else
        <div class="flex flex-col items-center justify-center py-24 text-center px-6">
            <div class="w-16 h-16 rounded-2xl bg-surface-muted border border-surface-border dark:border-white/5 flex items-center justify-center mb-5">
                <i class="bi bi-fire text-3xl text-stone-400 dark:text-white/20"></i>
            </div>
            <h3 class="text-stone-900 dark:text-white font-bold mb-1">Nenhum lanche encontrado</h3>
            <p class="text-stone-500 dark:text-white/40 text-sm mb-6 max-w-sm">
                @if(request()->hasAny(['pesquisar', 'categoria', 'status', 'preco_min', 'preco_max']))
                    Tente ajustar ou limpar os filtros de busca.
                @else
                    Comece cadastrando o primeiro item do cardápio.
                @endif
            </p>
            <div class="flex gap-3">
                @if(request()->hasAny(['pesquisar', 'categoria', 'status', 'preco_min', 'preco_max']))
                    <a href="{{ route('admin.lanches.index') }}"
                       class="px-4 py-2 rounded-full border border-surface-border dark:border-white/10 text-stone-600 dark:text-white/50 text-sm hover:text-stone-900 dark:hover:text-white transition-all">
                        Limpar filtros
                    </a>
                @endif
                <a href="{{ route('admin.lanches.create') }}"
                   class="px-5 py-2.5 rounded-full bg-brand text-black text-sm font-bold hover:bg-brand-light transition-all shadow-sm">
                    + Novo lanche
                </a>
            </div>
        </div>
    @endif

</div>

@endsection