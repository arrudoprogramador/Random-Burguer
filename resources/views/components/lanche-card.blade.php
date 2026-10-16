{{-- components/lanche-card.blade.php --}}
<a href="{{ route('lanches.show', $lanche->id) }}"
   class="group relative bg-[#131316] rounded-2xl border border-white/8
          hover:border-brand/50 transition-all duration-300
          hover:-translate-y-1.5 shadow-lg shadow-black/40 hover:shadow-2xl hover:shadow-brand/15
          flex flex-col overflow-hidden">

    {{-- Imagem do Lanche --}}
    <div class="relative aspect-[4/3] overflow-hidden bg-[#1a1a1f]">
        <img
            src="{{ $lanche->imagem ? asset('img/lanches/' . $lanche->imagem) : asset('img/lanches/triplo-bacon.jpg') }}"
            alt="{{ $lanche->nome }}"
            class="w-full h-full object-cover group-hover:scale-108 group-hover:rotate-0.5 transition-transform duration-700 ease-out"
            loading="lazy"
            onerror="this.src='{{ asset('img/lanches/triplo-bacon.jpg') }}'"
        />
        {{-- Vinheta sofisticada --}}
        <div class="absolute inset-0 bg-gradient-to-t from-[#131316] via-transparent to-black/30 opacity-90 group-hover:opacity-75 transition-opacity"></div>

        {{-- Badge de Categoria / Destaque --}}
        <div class="absolute top-3 left-3 flex items-center gap-1.5">
            @if(str_contains(strtolower($lanche->nome), 'trufado'))
                <span class="inline-flex items-center gap-1 px-3 py-1 bg-amber-500/90 backdrop-blur-md text-black text-[11px] font-black rounded-full uppercase tracking-wider shadow-lg shadow-amber-500/20">
                    <i class="bi bi-stars"></i> Gourmet
                </span>
            @elseif(str_contains(strtolower($lanche->nome), 'bacon') || str_contains(strtolower($lanche->nome), 'mata fome'))
                <span class="inline-flex items-center gap-1 px-3 py-1 bg-brand text-black text-[11px] font-black rounded-full uppercase tracking-wider shadow-lg shadow-brand/30">
                    <i class="bi bi-fire"></i> Mais Pedido
                </span>
            @else
                <span class="inline-flex items-center gap-1 px-3 py-1 bg-white/10 backdrop-blur-md text-white/90 border border-white/15 text-[11px] font-bold rounded-full uppercase tracking-wider">
                    <i class="bi bi-star-fill text-brand"></i> Artesanal
                </span>
            @endif
        </div>
    </div>

    {{-- Conteúdo do Card --}}
    <div class="p-5 flex flex-col flex-1 gap-2.5">
        <h3 class="font-display text-lg lg:text-xl text-white font-bold leading-tight group-hover:text-brand transition-colors line-clamp-1">
            {{ $lanche->nome }}
        </h3>
        <p class="text-xs lg:text-sm text-white/55 line-clamp-2 flex-1 leading-relaxed font-light">
            {{ $lanche->descricao ?? 'Blend nobre preparado na brasa com ingredientes selecionados e molho autoral.' }}
        </p>

        {{-- Preço e Ação --}}
        <div class="flex items-center justify-between pt-3.5 mt-2 border-t border-white/8">
            <div class="flex flex-col">
                <span class="text-[10px] uppercase tracking-wider text-white/40 font-semibold">A partir de</span>
                <span class="text-brand font-black text-lg lg:text-xl tracking-tight">
                    R$ {{ number_format($lanche->preco, 2, ',', '.') }}
                </span>
            </div>
            <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full
                        bg-brand/15 text-brand border border-brand/30 text-xs font-bold
                        group-hover:bg-brand group-hover:text-black group-hover:shadow-lg group-hover:shadow-brand/30 transition-all duration-300">
                <i class="bi bi-bag-plus text-sm"></i>
                Pedir
            </span>
        </div>
    </div>

</a>