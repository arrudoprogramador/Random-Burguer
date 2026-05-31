{{-- resources/views/areaAdmin/lanches/registerLanche.blade.php --}}
@extends('areaAdmin.layouts.admin')

@section('title', 'Novo Lanche')
@section('breadcrumb', 'Novo Lanche')

@section('content')

<div class="max-w-2xl">

    {{-- Header --}}
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.lanches.index') }}"
           class="w-9 h-9 rounded-xl bg-white/5 hover:bg-white/10 text-white/50 hover:text-white flex items-center justify-center transition-all">
            <i class="bi bi-arrow-left text-sm"></i>
        </a>
        <div>
            <h1 class="font-display text-3xl text-white font-bold">Novo Lanche</h1>
            <p class="text-white/40 text-sm mt-0.5">Preencha os dados do lanche</p>
        </div>
    </div>

    {{-- Erros --}}
    @if($errors->any())
        <div class="flex items-start gap-3 px-4 py-3 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm mb-6">
            <i class="bi bi-exclamation-circle-fill shrink-0 mt-0.5"></i>
            <ul class="flex flex-col gap-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulário --}}
    <form action="{{ route('admin.lanches.store') }}" method="POST" enctype="multipart/form-data"
          class="bg-[#1A1A1A] rounded-2xl border border-white/5 p-6 flex flex-col gap-6">
        @csrf

        {{-- Nome --}}
        <div class="flex flex-col gap-1.5">
            <label class="text-xs text-white/40 uppercase tracking-widest font-medium">Nome do lanche</label>
            <input type="text" name="nome" value="{{ old('nome') }}" placeholder="Ex: X-Tudo Especial"
                   class="bg-[#252525] border @error('nome') border-red-500/50 @else border-white/10 @enderror rounded-xl px-4 py-3 text-sm text-white placeholder-white/25 focus:outline-none focus:border-brand/50 transition-all" />
            @error('nome') <p class="text-red-400 text-xs">{{ $message }}</p> @enderror
        </div>

        {{-- Descrição --}}
        <div class="flex flex-col gap-1.5">
            <label class="text-xs text-white/40 uppercase tracking-widest font-medium">Descrição</label>
            <textarea name="descricao" rows="3" placeholder="Descreva os ingredientes..."
                      class="bg-[#252525] border @error('descricao') border-red-500/50 @else border-white/10 @enderror rounded-xl px-4 py-3 text-sm text-white placeholder-white/25 focus:outline-none focus:border-brand/50 transition-all resize-none">{{ old('descricao') }}</textarea>
            @error('descricao') <p class="text-red-400 text-xs">{{ $message }}</p> @enderror
        </div>

        {{-- Preço + Estoque --}}
        <div class="grid grid-cols-2 gap-4">
            <div class="flex flex-col gap-1.5">
                <label class="text-xs text-white/40 uppercase tracking-widest font-medium">Preço (R$)</label>
                <input type="number" name="preco" value="{{ old('preco') }}" placeholder="0,00" step="0.01" min="0"
                       class="bg-[#252525] border @error('preco') border-red-500/50 @else border-white/10 @enderror rounded-xl px-4 py-3 text-sm text-white placeholder-white/25 focus:outline-none focus:border-brand/50 transition-all" />
                @error('preco') <p class="text-red-400 text-xs">{{ $message }}</p> @enderror
            </div>
            <div class="flex flex-col gap-1.5">
                <label class="text-xs text-white/40 uppercase tracking-widest font-medium">Estoque</label>
                <input type="number" name="estoque" value="{{ old('estoque', 0) }}" min="0"
                       class="bg-[#252525] border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-white/25 focus:outline-none focus:border-brand/50 transition-all" />
            </div>
        </div>

        {{-- Imagem --}}
        <div class="flex flex-col gap-1.5" x-data="{ preview: null }">
            <label class="text-xs text-white/40 uppercase tracking-widest font-medium">Imagem</label>
            <div class="relative border-2 border-dashed border-white/10 rounded-xl p-6 text-center hover:border-brand/30 transition-all cursor-pointer"
                 @click="$refs.imgInput.click()">
                <template x-if="!preview">
                    <div class="flex flex-col items-center gap-2 text-white/30">
                        <i class="bi bi-cloud-upload text-2xl"></i>
                        <p class="text-sm">Clique para selecionar uma imagem</p>
                        <p class="text-xs">JPG, PNG ou GIF — máx. 2MB</p>
                    </div>
                </template>
                <template x-if="preview">
                    <img :src="preview" class="mx-auto max-h-40 rounded-lg object-cover" />
                </template>
                <input type="file" name="imagem" accept="image/*" x-ref="imgInput" class="hidden"
                       @change="preview = URL.createObjectURL($event.target.files[0])" />
            </div>
            @error('imagem') <p class="text-red-400 text-xs">{{ $message }}</p> @enderror
        </div>

        {{-- Destaque + Ativo --}}
        <div class="flex items-center gap-6">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="destaque" value="1" {{ old('destaque') ? 'checked' : '' }}
                       class="w-4 h-4 rounded border-white/20 bg-[#252525] accent-brand" />
                <span class="text-sm text-white/60">Destaque</span>
            </label>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="ativo" value="1" checked
                       class="w-4 h-4 rounded border-white/20 bg-[#252525] accent-brand" />
                <span class="text-sm text-white/60">Ativo</span>
            </label>
        </div>

        {{-- Botões --}}
        <div class="flex items-center gap-3 pt-2 border-t border-white/5">
            <button type="submit"
                    class="px-6 py-3 rounded-full bg-brand text-black font-semibold text-sm hover:bg-brand-light transition-all shadow-lg shadow-brand/20">
                Cadastrar Lanche
            </button>
            <a href="{{ route('admin.lanches.index') }}"
               class="px-6 py-3 rounded-full border border-white/10 text-white/50 text-sm hover:text-white hover:border-white/20 transition-all">
                Cancelar
            </a>
        </div>

    </form>
</div>

@endsection