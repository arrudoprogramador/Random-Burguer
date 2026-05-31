{{-- components/lanche-card.blade.php --}}
<a href="{{ route('lanches.show', $lanche->id) }}"
   class="group relative bg-surface-card rounded-2xl border border-white/5
          hover:border-brand/30 transition-all duration-300
          hover:-translate-y-1 hover:shadow-2xl hover:shadow-brand/10
          flex flex-col overflow-hidden">

    {{-- Imagem --}}
    <div class="relative aspect-[4/3] overflow-hidden bg-surface-muted">
        <img
            src="{{ $lanche->imagem ? url('img/lanches/' . $lanche->imagem) : url('img/sub2.jpg') }}"
            alt="{{ $lanche->nome }}"
            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
            loading="lazy"
        />
        <div class="absolute inset-0 bg-gradient-to-t from-surface-card/60 to-transparent"></div>
        <span class="absolute top-3 left-3 inline-flex items-center gap-1 px-2.5 py-1
                     bg-brand text-black text-[11px] font-bold rounded-full uppercase tracking-wider">
            ⭐ Favorito
        </span>
    </div>

    {{-- Conteúdo --}}
    <div class="p-4 lg:p-5 flex flex-col flex-1 gap-2">
        <h3 class="font-display text-base lg:text-lg text-white font-bold leading-tight line-clamp-1">
            {{ $lanche->nome }}
        </h3>
        <p class="text-xs lg:text-sm text-white/40 line-clamp-2 flex-1 leading-relaxed">
            {{ $lanche->descricao ?? 'Ingredientes selecionados, preparo artesanal.' }}
        </p>
        <div class="flex items-center justify-between pt-3 mt-1 border-t border-white/5">
            <span class="text-brand font-bold text-base lg:text-lg">
                R$ {{ number_format($lanche->preco, 2, ',', '.') }}
            </span>
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full
                        bg-brand/10 text-brand border border-brand/20 text-xs font-semibold
                        group-hover:bg-brand group-hover:text-black transition-all">
                <i class="bi bi-plus-lg"></i>
                Pedir
            </span>
        </div>
    </div>

</a>