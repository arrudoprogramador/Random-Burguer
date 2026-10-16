{{-- resources/views/components/footer.blade.php --}}
<footer class="bg-surface border-t border-surface-border dark:border-white/5 pt-16 pb-8 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mb-12">

            {{-- Brand --}}
            <div class="space-y-4">
                <a href="/" class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-full bg-brand flex items-center justify-center shadow-sm">
                        <i class="bi bi-fire text-black"></i>
                    </div>
                    <span class="font-display text-lg text-stone-900 dark:text-white font-bold">Random<span class="text-brand">Burguer</span></span>
                </a>
                <p class="text-sm text-stone-600 dark:text-white/50 leading-relaxed max-w-xs">
                    Burguers artesanais feitos com ingredientes selecionados. Sabor marcante que você nunca vai esquecer.
                </p>
                {{-- Redes sociais --}}
                <div class="flex gap-3 pt-2">
                    <a href="#" aria-label="Instagram" class="w-9 h-9 rounded-full border border-stone-300 dark:border-white/10 flex items-center justify-center text-stone-600 dark:text-white/50 hover:text-brand hover:border-brand/40 dark:hover:border-brand/40 transition-all">
                        <i class="bi bi-instagram text-sm"></i>
                    </a>
                    <a href="#" aria-label="Facebook" class="w-9 h-9 rounded-full border border-stone-300 dark:border-white/10 flex items-center justify-center text-stone-600 dark:text-white/50 hover:text-brand hover:border-brand/40 dark:hover:border-brand/40 transition-all">
                        <i class="bi bi-facebook text-sm"></i>
                    </a>
                    <a href="#" aria-label="TikTok" class="w-9 h-9 rounded-full border border-stone-300 dark:border-white/10 flex items-center justify-center text-stone-600 dark:text-white/50 hover:text-brand hover:border-brand/40 dark:hover:border-brand/40 transition-all">
                        <i class="bi bi-tiktok text-sm"></i>
                    </a>
                </div>
            </div>

            {{-- Links --}}
            <div>
                <h4 class="text-xs font-semibold text-stone-400 dark:text-white/40 uppercase tracking-widest mb-5">Navegação</h4>
                <ul class="space-y-3">
                    @foreach([
                        ['href' => '/',          'label' => 'Home'],
                        ['href' => route('lanches.index'), 'label' => 'Cardápio Completo'],
                        ['href' => '#favoritos', 'label' => 'Destaques & Favoritos'],
                        ['href' => '#about',     'label' => 'Sobre nós'],
                        ['href' => '#address',   'label' => 'Endereço & Horários'],
                    ] as $link)
                        <li>
                            <a href="{{ $link['href'] }}" class="text-sm text-stone-600 dark:text-white/60 hover:text-brand dark:hover:text-brand transition-colors">
                                {{ $link['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Contato / horário --}}
            <div>
                <h4 class="text-xs font-semibold text-stone-400 dark:text-white/40 uppercase tracking-widest mb-5">Funcionamento</h4>
                <ul class="space-y-3 text-sm text-stone-600 dark:text-white/60">
                    <li class="flex items-center gap-2.5">
                        <i class="bi bi-clock-fill text-brand text-xs"></i>
                        Seg – Sex: 11h às 23h
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="bi bi-clock-fill text-brand text-xs"></i>
                        Sáb – Dom: 11h às 00h
                    </li>
                    <li class="flex items-center gap-2.5 mt-4">
                        <i class="bi bi-whatsapp text-brand text-sm"></i>
                        (11) 9 9999-9999
                    </li>
                </ul>
            </div>

        </div>

        <div class="border-t border-surface-border dark:border-white/5 pt-6 flex flex-col md:flex-row items-center justify-between gap-2 text-xs text-stone-500 dark:text-white/30">
            <p>&copy; {{ date('Y') }} RandomBurguer. Todos os direitos reservados.</p>
            <p>Feito com <span class="text-brand">♥</span> em São Paulo</p>
        </div>

    </div>
</footer>