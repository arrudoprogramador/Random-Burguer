{{-- resources/views/components/navbar.blade.php --}}
<header
    x-data="{ scrolled: false, mobileOpen: false }"
    x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 20 })"
    :class="scrolled
        ? 'bg-surface/90 dark:bg-surface/95 backdrop-blur-md shadow-md shadow-black/5 dark:shadow-black/40 border-b border-surface-border dark:border-white/5'
        : 'bg-surface/60 dark:bg-transparent backdrop-blur-sm lg:backdrop-blur-none'"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
>
    <div class="max-w-7xl mx-auto px-6 lg:px-10">
        <div class="flex items-center justify-between h-20">

            {{-- Logo --}}
            <a href="/" class="flex items-center gap-2.5 group">
                <div class="w-9 h-9 rounded-full bg-brand flex items-center justify-center shadow-md shadow-brand/30 group-hover:scale-110 transition-transform">
                    <i class="bi bi-fire text-black text-lg"></i>
                </div>
                <span class="font-display text-xl text-stone-900 dark:text-white font-bold tracking-tight">
                    Random<span class="text-brand">Burguer</span>
                </span>
            </a>

            {{-- Nav Desktop --}}
            <nav class="hidden md:flex items-center gap-8">
                <a href="{{ route('lanches.index') }}"
                   class="text-sm font-medium text-white/75 hover:text-brand transition-colors tracking-wide">
                    Cardápio
                </a>
                <a href="{{ route('home') }}#favoritos"
                   class="text-sm font-medium text-white/75 hover:text-brand transition-colors tracking-wide">
                    Favoritos
                </a>
                <a href="{{ route('home') }}#about"
                   class="text-sm font-medium text-white/75 hover:text-brand transition-colors tracking-wide">
                    Sobre Nós
                </a>
                <a href="{{ route('home') }}#address"
                   class="text-sm font-medium text-white/75 hover:text-brand transition-colors tracking-wide">
                    Localização
                </a>
            </nav>

            {{-- Ações Desktop --}}
            <div class="hidden md:flex items-center gap-4">

                {{-- Carrinho --}}
                <a href="{{ route('carrinho.index') }}"
                   aria-label="Meu Carrinho"
                   class="relative text-white/80 hover:text-brand transition-colors p-2.5 rounded-full hover:bg-white/5 border border-transparent hover:border-white/10">
                    <i class="bi bi-bag text-xl"></i>
                    @if(session('carrinho') && count(session('carrinho')) > 0)
                        <span class="absolute top-0.5 right-0.5 w-4 h-4 rounded-full bg-brand text-black text-[10px] font-bold flex items-center justify-center shadow-md shadow-brand/40">
                            {{ count(session('carrinho')) }}
                        </span>
                    @endif
                </a>

                @auth
                    {{-- Logado --}}
                    @if(auth()->user()->nivel_acesso === 'admin' || auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}"
                           class="text-xs px-3.5 py-1.5 rounded-full bg-brand/10 border border-brand/30 text-brand font-semibold hover:bg-brand hover:text-black transition-all">
                            Painel Admin
                        </a>
                    @endif
                    <span class="text-sm text-white/70 font-medium">
                        Olá, {{ auth()->user()->name }}
                    </span>
                    <form action="{{ route('auth.logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="px-4 py-2 rounded-full border border-white/10 text-white/70 text-sm font-medium hover:text-brand hover:border-brand/40 transition-all">
                            Sair
                        </button>
                    </form>
                @else
                    {{-- Não logado --}}
                    <a href="{{ route('auth.login') }}"
                       class="px-6 py-2.5 rounded-full bg-brand text-black text-sm font-bold hover:bg-brand-light transition-all shadow-lg shadow-brand/25 hover:shadow-brand/40 hover:-translate-y-0.5">
                        Entrar
                    </a>
                @endauth

            </div>

            {{-- Botão Mobile --}}
            <div class="flex items-center gap-2 md:hidden">
                <a href="{{ route('carrinho.index') }}" class="relative text-white p-2">
                    <i class="bi bi-bag text-xl"></i>
                    @if(session('carrinho') && count(session('carrinho')) > 0)
                        <span class="absolute top-0 right-0 w-4 h-4 rounded-full bg-brand text-black text-[10px] font-bold flex items-center justify-center">
                            {{ count(session('carrinho')) }}
                        </span>
                    @endif
                </a>

                <button @click="mobileOpen = !mobileOpen"
                        aria-label="Abrir menu"
                        class="text-white p-2 rounded-lg hover:bg-white/10 transition-colors">
                    <i :class="mobileOpen ? 'bi-x-lg' : 'bi-list'" class="bi text-2xl"></i>
                </button>
            </div>

        </div>
    </div>

    {{-- Menu Mobile --}}
    <div
        x-show="mobileOpen"
        x-cloak
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="md:hidden bg-surface-card/95 dark:bg-surface/98 backdrop-blur-xl border-t border-surface-border dark:border-white/5 px-6 py-6 flex flex-col gap-4 shadow-2xl"
    >
        <a @click="mobileOpen=false"
           href="{{ route('lanches.index') }}"
           class="text-stone-800 dark:text-white/80 hover:text-brand dark:hover:text-brand py-2 border-b border-surface-border dark:border-white/5 transition-colors font-medium">
            Cardápio
        </a>
        <a @click="mobileOpen=false"
           href="{{ route('home') }}#favoritos"
           class="text-stone-800 dark:text-white/80 hover:text-brand dark:hover:text-brand py-2 border-b border-surface-border dark:border-white/5 transition-colors font-medium">
            Favoritos
        </a>
        <a @click="mobileOpen=false"
           href="{{ route('home') }}#about"
           class="text-stone-800 dark:text-white/80 hover:text-brand dark:hover:text-brand py-2 border-b border-surface-border dark:border-white/5 transition-colors font-medium">
            Sobre
        </a>
        <a @click="mobileOpen=false"
           href="{{ route('home') }}#address"
           class="text-stone-800 dark:text-white/80 hover:text-brand dark:hover:text-brand py-2 border-b border-surface-border dark:border-white/5 transition-colors font-medium">
            Localização
        </a>

        @auth
            <div class="pt-2 flex flex-col gap-3 border-t border-surface-border dark:border-white/5">
                <p class="text-xs text-stone-500 dark:text-white/40 text-center">
                    Logado como <span class="font-semibold text-stone-800 dark:text-white/80">{{ auth()->user()->name }}</span>
                </p>
                @if(auth()->user()->nivel_acesso === 'admin' || auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}"
                       class="w-full text-center py-2.5 rounded-full bg-brand/10 border border-brand/30 text-brand text-sm font-semibold hover:bg-brand hover:text-black transition-all">
                        Ir para o Painel Admin
                    </a>
                @endif
                <form action="{{ route('auth.logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="w-full py-3 rounded-full border border-stone-300 dark:border-white/10 text-stone-700 dark:text-white/60 text-sm font-medium hover:text-brand dark:hover:text-brand hover:border-brand/30 transition-all">
                        Sair
                    </button>
                </form>
            </div>
        @else
            <a href="{{ route('auth.login') }}"
               class="mt-2 w-full text-center px-5 py-3 rounded-full bg-brand text-black font-semibold hover:bg-brand-light transition-all shadow-md shadow-brand/20">
                Entrar
            </a>
            <a href="{{ route('auth.cadastro') }}"
               class="w-full text-center px-5 py-3 rounded-full border border-stone-300 dark:border-white/10 text-stone-700 dark:text-white/70 text-sm font-medium hover:text-brand transition-all">
                Criar conta
            </a>
        @endauth
    </div>

</header>