{{-- resources/views/components/theme-toggle.blade.php --}}
@props(['class' => ''])

<button
    type="button"
    x-data="themeToggle"
    @click="toggle()"
    :title="dark ? 'Alternar para Modo Claro' : 'Alternar para Modo Escuro'"
    :aria-label="dark ? 'Alternar para Modo Claro' : 'Alternar para Modo Escuro'"
    class="relative inline-flex items-center justify-center w-10 h-10 rounded-full transition-all duration-300
           bg-stone-200/80 hover:bg-stone-300/80 text-stone-800
           dark:bg-white/5 dark:hover:bg-white/10 dark:text-amber-400
           border border-stone-300/60 dark:border-white/10 shadow-sm hover:scale-105 active:scale-95 focus:outline-none focus:ring-2 focus:ring-brand/40 {{ $class }}"
>
    {{-- Ícone Sol (aparece quando no Dark, convidando a ir para o Light) --}}
    <span x-show="dark" x-cloak class="flex items-center justify-center transition-transform duration-300 rotate-0 hover:rotate-90">
        <i class="bi bi-sun-fill text-lg text-amber-400"></i>
    </span>

    {{-- Ícone Lua (aparece quando no Light, convidando a ir para o Dark) --}}
    <span x-show="!dark" x-cloak class="flex items-center justify-center transition-transform duration-300 -rotate-12 hover:rotate-0">
        <i class="bi bi-moon-stars-fill text-base text-stone-700"></i>
    </span>
</button>
