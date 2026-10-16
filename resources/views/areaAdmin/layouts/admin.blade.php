{{-- resources/views/areaAdmin/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>@yield('title', 'Admin') — RandomBurguer</title>

    {{-- Script anti-flash de tema --}}
    <script>
        (function() {
            try {
                const savedTheme = localStorage.getItem('theme');
                const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            } catch (e) {}
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" />

    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .font-display { font-family: 'Playfair Display', serif; }
        .sidebar-link.active {
            background: rgba(245,158,11,0.15);
            color: #D97706;
            font-weight: 600;
            border-right: 3px solid #F59E0B;
        }
        .dark .sidebar-link.active {
            color: #F59E0B;
        }
    </style>

    @stack('styles')
</head>
<body class="antialiased bg-surface text-content min-h-screen selection:bg-brand selection:text-black" x-data="{ sidebarOpen: true, mobileSidebar: false }">

<div class="flex min-h-screen bg-surface">

    {{-- ===================== SIDEBAR ===================== --}}
    <aside
        :class="sidebarOpen ? 'w-64' : 'w-20'"
        class="hidden lg:flex flex-col bg-surface-card border-r border-surface-border dark:border-white/5 transition-all duration-300 fixed top-0 left-0 h-full z-40 shadow-sm"
    >
        {{-- Logo --}}
        <div class="flex items-center gap-3 px-5 h-16 border-b border-surface-border dark:border-white/5">
            <div class="w-8 h-8 rounded-full bg-brand flex items-center justify-center shrink-0 shadow-sm">
                <i class="bi bi-fire text-black text-sm"></i>
            </div>
            <span x-show="sidebarOpen" class="font-display text-base text-stone-900 dark:text-white font-bold tracking-tight whitespace-nowrap">
                Random<span class="text-brand">Burguer</span>
            </span>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 px-3 py-6 space-y-1 overflow-y-auto">

            <p x-show="sidebarOpen" class="text-[10px] text-stone-400 dark:text-white/25 uppercase tracking-widest px-3 mb-3 font-bold">Principal</p>

            @foreach([
                ['route' => 'admin.dashboard',      'icon' => 'bi-grid-fill',     'label' => 'Dashboard'],
                ['route' => 'admin.lanches.index',  'icon' => 'bi-fire',          'label' => 'Lanches'],
                ['route' => 'admin.pedidos',        'icon' => 'bi-bag-check-fill','label' => 'Pedidos'],
                ['route' => 'admin.clientes.index', 'icon' => 'bi-people-fill',   'label' => 'Clientes'],
            ] as $item)
                <a href="{{ route($item['route']) }}"
                   class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-stone-600 dark:text-white/60 hover:text-stone-900 dark:hover:text-white hover:bg-stone-200/60 dark:hover:bg-white/5 transition-all {{ request()->routeIs($item['route']) ? 'active' : '' }}">
                    <i class="bi {{ $item['icon'] }} text-lg shrink-0"></i>
                    <span x-show="sidebarOpen" class="text-sm font-medium whitespace-nowrap">{{ $item['label'] }}</span>
                </a>
            @endforeach

            <div class="border-t border-surface-border dark:border-white/5 my-4"></div>
            <p x-show="sidebarOpen" class="text-[10px] text-stone-400 dark:text-white/25 uppercase tracking-widest px-3 mb-3 font-bold">Sistema</p>

            <a href="{{ route('admin.config') }}"
               class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-stone-600 dark:text-white/60 hover:text-stone-900 dark:hover:text-white hover:bg-stone-200/60 dark:hover:bg-white/5 transition-all {{ request()->routeIs('admin.config') ? 'active' : '' }}">
                <i class="bi bi-gear-fill text-lg shrink-0"></i>
                <span x-show="sidebarOpen" class="text-sm font-medium whitespace-nowrap">Configurações</span>
            </a>

            <a href="{{ route('home') }}" target="_blank"
               class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-stone-600 dark:text-white/60 hover:text-stone-900 dark:hover:text-white hover:bg-stone-200/60 dark:hover:bg-white/5 transition-all">
                <i class="bi bi-box-arrow-up-right text-lg shrink-0"></i>
                <span x-show="sidebarOpen" class="text-sm font-medium whitespace-nowrap">Ver loja</span>
            </a>
        </nav>

        {{-- Toggle --}}
        <div class="px-3 py-4 border-t border-surface-border dark:border-white/5">
            <button @click="sidebarOpen = !sidebarOpen"
                    aria-label="Recolher menu lateral"
                    class="w-full flex items-center justify-center gap-2 py-2 rounded-xl text-stone-400 dark:text-white/30 hover:text-stone-800 dark:hover:text-white hover:bg-stone-200/60 dark:hover:bg-white/5 transition-all">
                <i :class="sidebarOpen ? 'bi-chevron-double-left' : 'bi-chevron-double-right'" class="bi text-sm"></i>
            </button>
        </div>
    </aside>

    {{-- ===================== CONTEÚDO PRINCIPAL ===================== --}}
    <div
        :class="sidebarOpen ? 'lg:ml-64' : 'lg:ml-20'"
        class="flex-1 flex flex-col min-h-screen transition-all duration-300"
    >
        {{-- Topbar --}}
        <header class="sticky top-0 z-30 h-16 bg-surface-card/90 dark:bg-surface/95 backdrop-blur-md border-b border-surface-border dark:border-white/5 flex items-center justify-between px-6 shadow-sm">

            {{-- Mobile menu btn + breadcrumb --}}
            <div class="flex items-center gap-4">
                <button @click="mobileSidebar = true" class="lg:hidden text-stone-600 dark:text-white/60 hover:text-stone-900 dark:hover:text-white p-1">
                    <i class="bi bi-list text-2xl"></i>
                </button>
                <div class="flex items-center gap-2 text-sm text-stone-500 dark:text-white/40 font-medium">
                    <span>Admin</span>
                    <i class="bi bi-chevron-right text-xs"></i>
                    <span class="text-stone-900 dark:text-white/80 font-semibold">@yield('breadcrumb', 'Dashboard')</span>
                </div>
            </div>

            {{-- Ações Topbar --}}
            <div class="flex items-center gap-3 sm:gap-4">
                {{-- Toggle de Modo Claro / Escuro no Painel Admin --}}
                @include('components.theme-toggle')

                <span class="hidden sm:block text-xs font-semibold text-stone-500 dark:text-white/40 bg-surface px-3 py-1.5 rounded-full border border-surface-border dark:border-white/5">
                    {{ now()->format('d/m/Y') }}
                </span>

                <div class="flex items-center gap-2 px-3 py-1.5 rounded-full bg-surface-muted border border-surface-border dark:border-white/10">
                    <div class="w-6 h-6 rounded-full bg-brand flex items-center justify-center text-black text-xs font-bold">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <span class="text-sm font-semibold text-stone-800 dark:text-white/80 max-w-[120px] truncate hidden sm:block">
                        {{ auth()->user()->name ?? 'Admin' }}
                    </span>
                </div>

                <form action="{{ route('auth.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-stone-400 dark:text-white/40 hover:text-red-500 transition-colors p-1.5 rounded-lg hover:bg-stone-200/50 dark:hover:bg-white/5" title="Sair do painel">
                        <i class="bi bi-box-arrow-right text-lg"></i>
                    </button>
                </form>
            </div>
        </header>

        {{-- Alertas --}}
        @if(session('success'))
            <div class="mx-6 mt-4 flex items-center gap-3 px-4 py-3 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 text-sm">
                <i class="bi bi-check-circle-fill shrink-0"></i>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mx-6 mt-4 flex items-center gap-3 px-4 py-3 rounded-xl bg-red-500/10 border border-red-500/20 text-red-600 dark:text-red-400 text-sm">
                <i class="bi bi-exclamation-circle-fill shrink-0"></i>
                {{ session('error') }}
            </div>
        @endif

        {{-- Página --}}
        <main class="flex-1 p-6 bg-surface transition-colors duration-300">
            @yield('content')
        </main>

    </div>

    {{-- Sidebar Mobile Overlay --}}
    <div
        x-show="mobileSidebar"
        x-cloak
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="mobileSidebar = false"
        class="lg:hidden fixed inset-0 bg-black/60 z-50 backdrop-blur-sm"
    ></div>

    <aside
        x-show="mobileSidebar"
        x-cloak
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="lg:hidden fixed top-0 left-0 h-full w-64 bg-surface-card border-r border-surface-border dark:border-white/5 z-50 flex flex-col shadow-2xl"
    >
        <div class="flex items-center justify-between px-5 h-16 border-b border-surface-border dark:border-white/5">
            <span class="font-display text-base text-stone-900 dark:text-white font-bold">Random<span class="text-brand">Burguer</span></span>
            <button @click="mobileSidebar = false" class="text-stone-500 dark:text-white/40 hover:text-stone-900 dark:hover:text-white">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <nav class="flex-1 px-3 py-6 space-y-1">
            @foreach([
                ['route' => 'admin.dashboard',      'icon' => 'bi-grid-fill',     'label' => 'Dashboard'],
                ['route' => 'admin.lanches.index',  'icon' => 'bi-fire',          'label' => 'Lanches'],
                ['route' => 'admin.pedidos',        'icon' => 'bi-bag-check-fill','label' => 'Pedidos'],
                ['route' => 'admin.clientes.index', 'icon' => 'bi-people-fill',   'label' => 'Clientes'],
                ['route' => 'admin.config',         'icon' => 'bi-gear-fill',     'label' => 'Configurações'],
            ] as $item)
                <a href="{{ route($item['route']) }}" @click="mobileSidebar = false"
                   class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-stone-600 dark:text-white/60 hover:text-stone-900 dark:hover:text-white hover:bg-stone-200/60 dark:hover:bg-white/5 transition-all {{ request()->routeIs($item['route']) ? 'active' : '' }}">
                    <i class="bi {{ $item['icon'] }} text-lg"></i>
                    <span class="text-sm font-medium">{{ $item['label'] }}</span>
                </a>
            @endforeach
        </nav>
    </aside>

</div>

@stack('scripts')
</body>
</html>