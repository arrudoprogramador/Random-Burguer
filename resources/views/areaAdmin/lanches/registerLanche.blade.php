{{-- resources/views/areaAdmin/lanches/registerLanche.blade.php --}}
@extends('areaAdmin.layouts.admin')

@section('title', 'Novo Lanche — Admin')
@section('breadcrumb', 'Novo Lanche')

@section('content')

<div class="max-w-2xl">

    {{-- Header --}}
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.lanches.index') }}"
           class="w-9 h-9 rounded-xl bg-surface-card border border-surface-border dark:border-white/5 hover:bg-stone-200/50 dark:hover:bg-white/10 text-stone-600 dark:text-white/50 hover:text-stone-900 dark:hover:text-white flex items-center justify-center transition-all shadow-sm">
            <i class="bi bi-arrow-left text-sm"></i>
        </a>
        <div>
            <h1 class="font-display text-3xl text-stone-900 dark:text-white font-bold">Novo Lanche</h1>
            <p class="text-stone-500 dark:text-white/40 text-sm mt-0.5">Cadastre um novo item no cardápio</p>
        </div>
    </div>

    {{-- Erros --}}
    @if($errors->any())
        <div class="flex items-start gap-3 px-4 py-3 rounded-xl bg-red-500/10 border border-red-500/20 text-red-600 dark:text-red-400 text-sm mb-6">
            <i class="bi bi-exclamation-circle-fill shrink-0 mt-0.5"></i>
            <ul class="flex flex-col gap-1 text-xs">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulário --}}
    <form action="{{ route('admin.lanches.store') }}" method="POST" enctype="multipart/form-data"
          class="bg-surface-card rounded-2xl border border-surface-border dark:border-white/5 p-6 flex flex-col gap-6 shadow-sm theme-card">
        @csrf

        {{-- Nome --}}
        <div class="flex flex-col gap-1.5">
            <label class="text-xs text-stone-600 dark:text-white/40 uppercase tracking-widest font-semibold">Nome do lanche</label>
            <input type="text" name="nome" value="{{ old('nome') }}" placeholder="Ex: Smash Bacon Gourmet"
                   class="bg-surface-muted border @error('nome') border-red-500/50 @else border-surface-border dark:border-white/10 @enderror rounded-xl px-4 py-3 text-sm text-stone-900 dark:text-white placeholder-stone-400 dark:placeholder-white/25 focus:outline-none focus:border-brand/60 focus:ring-1 focus:ring-brand/30 transition-all" />
            @error('nome') <p class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</p> @enderror
        </div>

        {{-- Descrição --}}
        <div class="flex flex-col gap-1.5">
            <label class="text-xs text-stone-600 dark:text-white/40 uppercase tracking-widest font-semibold">Descrição</label>
            <textarea name="descricao" rows="3" placeholder="Descreva os ingredientes selecionados, tipo de carne e molhos..."
                      class="bg-surface-muted border @error('descricao') border-red-500/50 @else border-surface-border dark:border-white/10 @enderror rounded-xl px-4 py-3 text-sm text-stone-900 dark:text-white placeholder-stone-400 dark:placeholder-white/25 focus:outline-none focus:border-brand/60 focus:ring-1 focus:ring-brand/30 transition-all resize-none">{{ old('descricao') }}</textarea>
            @error('descricao') <p class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</p> @enderror
        </div>

        {{-- Categoria --}}
        <div class="flex flex-col gap-1.5">
            <label class="text-xs text-stone-600 dark:text-white/40 uppercase tracking-widest font-semibold">
                Selecionar categoria
            </label>
            <select name="categoria_id"
                    class="bg-surface-muted border @error('categoria_id') border-red-500/50 @else border-surface-border dark:border-white/10 @enderror rounded-xl px-4 py-3 text-sm text-stone-900 dark:text-white focus:outline-none focus:border-brand/60 transition-all">
                <option value="" disabled selected>Selecione uma categoria...</option>
                @if(isset($categorias))
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}"
                            {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->nome }}
                        </option>
                    @endforeach
                @endif
            </select>
            @error('categoria_id') <p class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</p> @enderror
        </div>

        {{-- Preço + Estoque --}}
        <div class="grid grid-cols-2 gap-4">
            <div class="flex flex-col gap-1.5">
                <label class="text-xs text-stone-600 dark:text-white/40 uppercase tracking-widest font-semibold">Preço (R$)</label>
                <input type="number" name="preco" value="{{ old('preco') }}" placeholder="0,00" step="0.01" min="0"
                       class="bg-surface-muted border @error('preco') border-red-500/50 @else border-surface-border dark:border-white/10 @enderror rounded-xl px-4 py-3 text-sm text-stone-900 dark:text-white placeholder-stone-400 dark:placeholder-white/25 focus:outline-none focus:border-brand/60 transition-all" />
                @error('preco') <p class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</p> @enderror
            </div>
            <div class="flex flex-col gap-1.5">
                <label class="text-xs text-stone-600 dark:text-white/40 uppercase tracking-widest font-semibold">Estoque</label>
                <input type="number" name="estoque" value="{{ old('estoque', 0) }}" min="0"
                       class="bg-surface-muted border border-surface-border dark:border-white/10 rounded-xl px-4 py-3 text-sm text-stone-900 dark:text-white placeholder-stone-400 dark:placeholder-white/25 focus:outline-none focus:border-brand/60 transition-all" />
            </div>
        </div>

        {{-- Imagem --}}
        <div class="flex flex-col gap-1.5" x-data="{ preview: null }">
            <label class="text-xs text-stone-600 dark:text-white/40 uppercase tracking-widest font-semibold">Foto do Lanche</label>
            <div class="relative border-2 border-dashed border-surface-border dark:border-white/10 bg-surface-muted/40 rounded-xl p-6 text-center hover:border-brand/50 transition-all cursor-pointer"
                 @click="$refs.imgInput.click()">
                <template x-if="!preview">
                    <div class="flex flex-col items-center gap-2 text-stone-500 dark:text-white/40">
                        <i class="bi bi-cloud-arrow-up text-3xl text-brand"></i>
                        <p class="text-sm font-medium text-stone-700 dark:text-white/70">Clique para selecionar uma imagem</p>
                        <p class="text-xs">JPG, PNG ou WEBP — máx. 2MB</p>
                    </div>
                </template>
                <template x-if="preview">
                    <img :src="preview" class="mx-auto max-h-48 rounded-lg object-cover shadow-sm" />
                </template>
                <input type="file" name="imagem" accept="image/*" x-ref="imgInput" class="hidden"
                       @change="preview = URL.createObjectURL($event.target.files[0])" />
            </div>
            @error('imagem') <p class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</p> @enderror
        </div>

        {{-- Destaque + Ativo --}}
        <div class="flex items-center gap-6">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="destaque" value="1" {{ old('destaque') ? 'checked' : '' }}
                       class="w-4 h-4 rounded border-stone-300 dark:border-white/20 bg-surface-muted accent-brand" />
                <span class="text-sm text-stone-700 dark:text-white/70 font-medium">Lanche em Destaque</span>
            </label>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="ativo" value="1" checked
                       class="w-4 h-4 rounded border-stone-300 dark:border-white/20 bg-surface-muted accent-brand" />
                <span class="text-sm text-stone-700 dark:text-white/70 font-medium">Disponível no Cardápio (Ativo)</span>
            </label>
        </div>

        {{-- Botões --}}
        <div class="flex items-center gap-3 pt-3 border-t border-surface-border dark:border-white/5">
            <button type="submit"
                    class="px-6 py-3 rounded-full bg-brand text-black font-bold text-sm hover:bg-brand-light transition-all shadow-md shadow-brand/20 hover:-translate-y-0.5 active:scale-95">
                Cadastrar Lanche
            </button>
            <a href="{{ route('admin.lanches.index') }}"
               class="px-6 py-3 rounded-full border border-surface-border dark:border-white/10 text-stone-600 dark:text-white/50 text-sm font-semibold hover:text-stone-900 dark:hover:text-white hover:border-brand/40 transition-all">
                Cancelar
            </a>
        </div>

    </form>
</div>

@endsection