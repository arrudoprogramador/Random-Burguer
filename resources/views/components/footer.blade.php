{{-- resources/views/components/footer.blade.php --}}
<footer class="bg-surface border-t border-white/5 pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mb-12">

            {{-- Brand --}}
            <div class="space-y-4">
                <a href="/" class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-brand flex items-center justify-center">
                        <i class="bi bi-fire text-black"></i>
                    </div>
                    <span class="font-display text-lg text-white">Random<span class="text-brand">Burguer</span></span>
                </a>
                <p class="text-sm text-white/40 leading-relaxed max-w-xs">
                    Burguers artesanais feitos com ingredientes selecionados. Sabor que você nunca vai esquecer.
                </p>
                {{-- Redes sociais --}}
                <div class="flex gap-3 pt-2">
                    <a href="#" class="w-9 h-9 rounded-full border border-white/10 flex items-center justify-center text-white/40 hover:text-brand hover:border-brand/40 transition-all">
                        <i class="bi bi-instagram text-sm"></i>
                    </a>
                    <a href="#" class="w-9 h-9 rounded-full border border-white/10 flex items-center justify-center text-white/40 hover:text-brand hover:border-brand/40 transition-all">
                        <i class="bi bi-facebook text-sm"></i>
                    </a>
                    <a href="#" class="w-9 h-9 rounded-full border border-white/10 flex items-center justify-center text-white/40 hover:text-brand hover:border-brand/40 transition-all">
                        <i class="bi bi-tiktok text-sm"></i>
                    </a>
                </div>
            </div>

            {{-- Links --}}
            <div>
                <h4 class="text-xs font-semibold text-white/30 uppercase tracking-widest mb-5">Navegação</h4>
                <ul class="space-y-3">
                    @foreach([
                        ['href' => '/',          'label' => 'Home'],
                        ['href' => '#favoritos', 'label' => 'Favoritos'],
                        ['href' => '#about',     'label' => 'Sobre nós'],
                        ['href' => '#review',    'label' => 'Avaliações'],
                        ['href' => '#address',   'label' => 'Endereço'],
                    ] as $link)
                        <li>
                            <a href="{{ $link['href'] }}" class="text-sm text-white/50 hover:text-brand transition-colors">
                                {{ $link['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Contato / horário --}}
            <div>
                <h4 class="text-xs font-semibold text-white/30 uppercase tracking-widest mb-5">Funcionamento</h4>
                <ul class="space-y-3 text-sm text-white/50">
                    <li class="flex items-center gap-2">
                        <i class="bi bi-clock text-brand text-xs"></i>
                        Seg – Sex: 11h às 23h
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="bi bi-clock text-brand text-xs"></i>
                        Sáb – Dom: 11h às 00h
                    </li>
                    <li class="flex items-center gap-2 mt-4">
                        <i class="bi bi-whatsapp text-brand text-xs"></i>
                        (11) 9 9999-9999
                    </li>
                </ul>
            </div>

        </div>

        <div class="border-t border-white/5 pt-6 flex flex-col md:flex-row items-center justify-between gap-2 text-xs text-white/25">
            <p>&copy; {{ date('Y') }} RandomBurguer. Todos os direitos reservados.</p>
            <p>Feito com <span class="text-brand">♥</span> em São Paulo</p>
        </div>

    </div>
</footer>