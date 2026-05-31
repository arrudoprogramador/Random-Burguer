<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    @foreach($lanchesFavoritos as $lanche)
        <a href="{{ route('lanches.show', $lanche->id) }}"
           class="group bg-surface-card rounded-2xl border border-white/5 hover:border-brand/30 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl hover:shadow-brand/10 flex flex-col overflow-hidden">

            {{-- Imagem --}}
            <div class="h-56 overflow-hidden bg-surface-muted">
                <img
                    src="{{ $lanche->imagem ? url('img/lanches/' . $lanche->imagem) : url('img/sub2.jpg') }}"
                    alt="{{ $lanche->nome }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                />
            </div>

            {{-- Info --}}
            <div class="p-5 flex flex-col flex-1">
                <h3 class="font-display text-lg text-white font-bold mb-1">{{ $lanche->nome }}</h3>
                <p class="text-sm text-white/40 line-clamp-2 flex-1">{{ $lanche->descricao }}</p>
                <div class="flex items-center justify-between mt-4 pt-4 border-t border-white/5">
                    <span class="text-brand font-bold text-lg">
                        R$ {{ number_format($lanche->preco, 2, ',', '.') }}
                    </span>
                    <span class="px-4 py-2 rounded-full bg-brand/10 text-brand border border-brand/20 text-sm font-semibold group-hover:bg-brand group-hover:text-black transition-all">
                        + Pedir
                    </span>
                </div>
            </div>

        </a>
    @endforeach
</div>