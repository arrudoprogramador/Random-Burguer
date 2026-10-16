{{-- resources/views/areaAdmin/lanches/editLanche.blade.php --}}
@extends('areaAdmin.layouts.admin')

@section('title', 'Editar — ' . $lanche->nome)
@section('breadcrumb', 'Editar Lanche')

@section('content')

<form
    action="{{ route('admin.lanches.update', $lanche->id) }}"
    method="POST"
    enctype="multipart/form-data"
    x-data="{
        preview: '{{ $lanche->imagem ? url('img/lanches/' . $lanche->imagem) : '' }}',
        nome: '{{ old('nome', addslashes($lanche->nome)) }}',
        preco: '{{ old('preco', $lanche->preco) }}',
        dragging: false
    }"
>
    @csrf
    @method('PUT')

    {{-- Topbar da página --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.lanches.index') }}"
               class="w-9 h-9 rounded-xl bg-surface-card border border-surface-border dark:border-white/5 hover:bg-stone-200/50 dark:hover:bg-white/10 text-stone-600 dark:text-white/40 hover:text-stone-900 dark:hover:text-white flex items-center justify-center transition-all shrink-0 shadow-sm">
                <i class="bi bi-arrow-left text-sm"></i>
            </a>
            <div>
                <div class="flex items-center gap-2.5 mb-0.5">
                    <h1 class="font-display text-2xl lg:text-3xl text-stone-900 dark:text-white font-bold leading-none" x-text="nome || 'Editar Lanche'"></h1>
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider
                        {{ $lanche->ativo ? 'bg-emerald-500/15 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20' : 'bg-red-500/15 text-red-600 dark:text-red-400 border border-red-500/20' }}">
                        {{ $lanche->ativo ? 'Ativo' : 'Inativo' }}
                    </span>
                </div>
                <p class="text-stone-500 dark:text-white/40 text-xs">
                    ID #{{ $lanche->id }} · Atualizado {{ $lanche->updated_at->diffForHumans() }}
                </p>
            </div>
        </div>
        <div class="flex items-center gap-2 shrink-0">
            <a href="{{ route('admin.lanches.index') }}"
               class="px-4 py-2 rounded-full border border-surface-border dark:border-white/10 text-stone-600 dark:text-white/40 text-sm font-semibold hover:text-stone-900 dark:hover:text-white transition-all">
                Cancelar
            </a>
            <button type="submit"
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-brand text-black text-sm font-bold hover:bg-brand-light transition-all shadow-md shadow-brand/20 hover:-translate-y-0.5 active:scale-95">
                <i class="bi bi-check-lg text-base"></i>
                Salvar Alterações
            </button>
        </div>
    </div>

    {{-- Erros --}}
    @if($errors->any())
        <div class="flex items-start gap-3 px-4 py-3 rounded-xl bg-red-500/10 border border-red-500/20 text-red-600 dark:text-red-400 text-sm mb-6">
            <i class="bi bi-exclamation-circle-fill shrink-0 mt-0.5"></i>
            <ul class="flex flex-col gap-1 text-xs">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    {{-- Layout principal --}}
    <div class="grid grid-cols-1 xl:grid-cols-5 gap-6 items-start">

        {{-- COLUNA ESQUERDA — Imagem --}}
        <div class="xl:col-span-2 space-y-4">

            <div class="bg-surface-card rounded-2xl border border-surface-border dark:border-white/5 overflow-hidden shadow-sm theme-card">
                <div
                    class="relative cursor-pointer transition-all bg-surface-muted/30"
                    :class="dragging ? 'ring-2 ring-brand ring-inset' : ''"
                    @click="$refs.imgInput.click()"
                    @dragover.prevent="dragging = true"
                    @dragleave="dragging = false"
                    @drop.prevent="dragging = false; preview = URL.createObjectURL($event.dataTransfer.files[0])"
                >
                    <template x-if="preview">
                        <div class="relative group aspect-square">
                            <img :src="preview" class="w-full h-full object-cover" />
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/60 transition-all flex flex-col items-center justify-center gap-2 opacity-0 group-hover:opacity-100">
                                <div class="w-12 h-12 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center">
                                    <i class="bi bi-camera text-white text-xl"></i>
                                </div>
                                <span class="text-white text-xs font-semibold tracking-wide">Trocar imagem</span>
                            </div>
                        </div>
                    </template>
                    <template x-if="!preview">
                        <div class="aspect-square flex flex-col items-center justify-center gap-4 text-stone-400 dark:text-white/20 hover:text-brand transition-all p-8">
                            <i class="bi bi-cloud-upload text-5xl"></i>
                            <div class="text-center">
                                <p class="text-sm font-semibold">Arraste ou clique para enviar</p>
                                <p class="text-xs mt-1 text-stone-500 dark:text-white/40">JPG, PNG ou WEBP — máx. 2MB</p>
                            </div>
                        </div>
                    </template>
                    <input type="file" name="imagem" accept="image/*" x-ref="imgInput" class="hidden"
                           @change="preview = URL.createObjectURL($event.target.files[0])" />
                </div>
                <div class="px-4 py-3 border-t border-surface-border dark:border-white/5 flex items-center justify-between bg-surface-muted/20">
                    <span class="text-xs text-stone-500 dark:text-white/30 font-medium">Foto do lanche</span>
                    <button type="button" @click="$refs.imgInput.click()"
                            class="text-xs text-brand hover:underline font-bold">
                        Alterar imagem →
                    </button>
                </div>
            </div>

            {{-- Info & toggles --}}
            <div class="bg-surface-card rounded-2xl border border-surface-border dark:border-white/5 divide-y divide-surface-border dark:divide-white/5 shadow-sm theme-card">

                <div class="px-5 py-4">
                    <p class="text-xs text-stone-500 dark:text-white/30 uppercase tracking-widest mb-4 font-semibold">Visibilidade</p>
                    <div class="space-y-4">
                        @foreach([
                            ['name' => 'destaque', 'id' => 'toggle_destaque', 'icon' => 'bi-star-fill', 'label' => 'Destaque no cardápio', 'value' => old('destaque', $lanche->destaque)],
                            ['name' => 'ativo',    'id' => 'toggle_ativo',    'icon' => 'bi-eye-fill',  'label' => 'Ativo para vendas',     'value' => old('ativo', $lanche->ativo)],
                        ] as $toggle)
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <i class="bi {{ $toggle['icon'] }} text-brand text-sm"></i>
                                    <span class="text-sm text-stone-700 dark:text-white/70 font-medium">{{ $toggle['label'] }}</span>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="{{ $toggle['name'] }}" value="1"
                                           id="{{ $toggle['id'] }}"
                                           {{ $toggle['value'] ? 'checked' : '' }}
                                           class="sr-only peer" />
                                    <div class="w-11 h-6 bg-stone-300 dark:bg-white/10 rounded-full peer peer-checked:bg-brand transition-all
                                                after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                                after:bg-white after:rounded-full after:h-5 after:w-5
                                                after:transition-all peer-checked:after:translate-x-5 shadow-inner"></div>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="px-5 py-4">
                    <p class="text-xs text-stone-500 dark:text-white/30 uppercase tracking-widest mb-3 font-semibold">Histórico</p>
                    <div class="space-y-2">
                        <div class="flex justify-between text-xs">
                            <span class="text-stone-500 dark:text-white/40">Criado em</span>
                            <span class="text-stone-800 dark:text-white/70 font-medium">{{ $lanche->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <div class="flex justify-between text-xs">
                            <span class="text-stone-500 dark:text-white/40">Última atualização</span>
                            <span class="text-stone-800 dark:text-white/70 font-medium">{{ $lanche->updated_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                </div>

                <div class="px-5 py-4">
                    <button type="button"
                            onclick="if(confirm('Excluir este lanche permanentemente?')) document.getElementById('deleteLancheForm').submit()"
                            class="w-full flex items-center justify-center gap-2 py-2.5 rounded-xl border border-red-500/20 text-red-600 dark:text-red-400 text-sm font-semibold hover:bg-red-500/10 transition-all">
                        <i class="bi bi-trash3 text-sm"></i>
                        Excluir este lanche
                    </button>
                </div>

            </div>
        </div>

        {{-- COLUNA DIREITA — Dados --}}
        <div class="xl:col-span-3 space-y-4">

            <div class="bg-surface-card rounded-2xl border border-surface-border dark:border-white/5 p-6 space-y-5 shadow-sm theme-card">
                <p class="text-xs text-stone-500 dark:text-white/30 uppercase tracking-widest font-semibold">Informações do produto</p>

                <div class="flex flex-col gap-1.5">
                    <label for="nome" class="text-xs text-stone-600 dark:text-white/50 font-semibold">Nome do lanche</label>
                    <input type="text" id="nome" name="nome"
                           value="{{ old('nome', $lanche->nome) }}"
                           x-model="nome" placeholder="Ex: Smash Bacon Especial" required
                           class="bg-surface-muted border @error('nome') border-red-500/50 @else border-surface-border dark:border-white/10 @enderror rounded-xl px-4 py-3 text-sm text-stone-900 dark:text-white placeholder-stone-400 dark:placeholder-white/20 focus:outline-none focus:border-brand/60 focus:ring-1 focus:ring-brand/30 transition-all" />
                    @error('nome')<p class="text-red-500 dark:text-red-400 text-xs mt-0.5">{{ $message }}</p>@enderror
                </div>

                <div class="flex flex-col gap-1.5">
                    <label for="descricao" class="text-xs text-stone-600 dark:text-white/50 font-semibold">Descrição dos ingredientes</label>
                    <textarea id="descricao" name="descricao" rows="4"
                              placeholder="Descreva os ingredientes selecionados e molhos especiais..."
                              class="bg-surface-muted border @error('descricao') border-red-500/50 @else border-surface-border dark:border-white/10 @enderror rounded-xl px-4 py-3 text-sm text-stone-900 dark:text-white placeholder-stone-400 dark:placeholder-white/20 focus:outline-none focus:border-brand/60 focus:ring-1 focus:ring-brand/30 transition-all resize-none leading-relaxed"
                    >{{ old('descricao', $lanche->descricao) }}</textarea>
                    @error('descricao')<p class="text-red-500 dark:text-red-400 text-xs mt-0.5">{{ $message }}</p>@enderror
                </div>

                @if(isset($categorias) && $categorias->count())
                <div class="flex flex-col gap-1.5">
                    <label class="text-xs text-stone-600 dark:text-white/50 font-semibold">Categoria</label>
                    <select name="categoria_id"
                            class="bg-surface-muted border border-surface-border dark:border-white/10 rounded-xl px-4 py-3 text-sm text-stone-900 dark:text-white focus:outline-none focus:border-brand/60 transition-all">
                        <option value="">Sem categoria</option>
                        @foreach($categorias as $cat)
                            <option value="{{ $cat->id }}" {{ old('categoria_id', $lanche->categoria_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @endif
            </div>

            <div class="bg-surface-card rounded-2xl border border-surface-border dark:border-white/5 p-6 space-y-5 shadow-sm theme-card">
                <p class="text-xs text-stone-500 dark:text-white/30 uppercase tracking-widest font-semibold">Precificação & Estoque</p>

                <div class="grid grid-cols-2 gap-4">
                    <div class="flex flex-col gap-1.5">
                        <label for="preco" class="text-xs text-stone-600 dark:text-white/50 font-semibold">Preço de venda (R$)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-stone-400 dark:text-white/30 text-sm font-semibold">R$</span>
                            <input type="number" id="preco" name="preco"
                                   value="{{ old('preco', $lanche->preco) }}"
                                   x-model="preco" placeholder="0,00" step="0.01" min="0" required
                                   class="w-full bg-surface-muted border @error('preco') border-red-500/50 @else border-surface-border dark:border-white/10 @enderror rounded-xl pl-11 pr-4 py-3 text-sm text-stone-900 dark:text-white placeholder-stone-400 dark:placeholder-white/20 focus:outline-none focus:border-brand/60 transition-all" />
                        </div>
                        @error('preco')<p class="text-red-500 dark:text-red-400 text-xs mt-0.5">{{ $message }}</p>@enderror
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <label for="estoque" class="text-xs text-stone-600 dark:text-white/50 font-semibold">Quantidade em Estoque</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-stone-400 dark:text-white/30 text-sm">
                                <i class="bi bi-box-seam"></i>
                            </span>
                            <input type="number" id="estoque" name="estoque"
                                   value="{{ old('estoque', $lanche->estoque ?? 0) }}" min="0"
                                   class="w-full bg-surface-muted border border-surface-border dark:border-white/10 rounded-xl pl-11 pr-4 py-3 text-sm text-stone-900 dark:text-white focus:outline-none focus:border-brand/60 transition-all" />
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-3 p-4 rounded-xl bg-brand/10 border border-brand/20">
                    <i class="bi bi-tag-fill text-brand text-base"></i>
                    <span class="text-xs text-stone-600 dark:text-white/60 font-medium">Preço ao cliente:</span>
                    <span class="text-brand font-bold text-base ml-auto"
                          x-text="'R$ ' + parseFloat(preco || 0).toFixed(2).replace('.', ',')">
                    </span>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-2">
                <a href="{{ route('admin.lanches.index') }}"
                   class="px-6 py-3 rounded-full border border-surface-border dark:border-white/10 text-stone-600 dark:text-white/40 text-sm font-semibold hover:text-stone-900 dark:hover:text-white hover:border-brand/40 transition-all">
                    Cancelar
                </a>
                <button type="submit"
                        class="inline-flex items-center gap-2 px-8 py-3 rounded-full bg-brand text-black font-bold text-sm hover:bg-brand-light transition-all shadow-xl shadow-brand/20 hover:-translate-y-0.5 active:scale-95">
                    <i class="bi bi-check-lg text-base"></i>
                    Salvar Alterações
                </button>
            </div>

        </div>
    </div>

</form>

{{-- Formulário oculto para deleção --}}
<form id="deleteLancheForm" action="{{ route('admin.lanches.destroy', $lanche->id) }}" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

@endsection