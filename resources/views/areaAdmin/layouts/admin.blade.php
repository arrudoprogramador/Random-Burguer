{{-- resources/views/areaAdmin/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Admin') — RandomBurguer</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" />

    <style>
        body { font-family: 'DM Sans', sans-serif; background-color: #0d0d0d; color: #f5f5f5; }
        .font-display { font-family: 'Playfair Display', serif; }
        .sidebar-link.active { background: rgba(245,158,11,0.1); color: #F59E0B; border-right: 2px solid #F59E0B; }
    </style>

    @stack('styles')
</head>
<body class="antialiased" x-data="{ sidebarOpen: true, mobileSidebar: false }">

<div class="flex min-h-screen">

    {{-- ===================== SIDEBAR ===================== --}}
    <aside
        :class="sidebarOpen ? 'w-64' : 'w-16'"
        class="hidden lg:flex flex-col bg-[#111111] border-r border-white/5 transition-all duration-300 fixed top-0 left-0 h-full z-40"
    >
        {{-- Logo --}}
        <div class="flex items-center gap-3 px-5 h-16 border-b border-white/5">
            <div class="w-8 h-8 rounded-full bg-brand flex items-center justify-center shrink-0">
                <i class="bi bi-fire text-black text-sm"></i>
            </div>
            <span x-show="sidebarOpen" class="font-display text-base text-white tracking-tight whitespace-nowrap">
                Random<span class="text-brand">Burguer</span>
            </span>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 px-3 py-6 space-y-1 overflow-y-auto">

            <p x-show="sidebarOpen" class="text-[10px] text-white/25 uppercase tracking-widest px-3 mb-3">Principal</p>

            @foreach([
                ['route' => 'admin.dashboard',      'icon' => 'bi-grid',          'label' => 'Dashboard'],
                ['route' => 'admin.lanches.index',  'icon' => 'bi-fire',          'label' => 'Lanches'],
                ['route' => 'admin.pedidos',        'icon' => 'bi-bag-check',     'label' => 'Pedidos'],
                ['route' => 'admin.clientes.index', 'icon' => 'bi-people',        'label' => 'Clientes'],
            ] as $item)
                <a href="{{ route($item['route']) }}"
                   class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/50 hover:text-white hover:bg-white/5 transition-all {{ request()->routeIs($item['route']) ? 'active' : '' }}">
                    <i class="bi {{ $item['icon'] }} text-lg shrink-0"></i>
                    <span x-show="sidebarOpen" class="text-sm font-medium whitespace-nowrap">{{ $item['label'] }}</span>
                </a>
            @endforeach

            <div class="border-t border-white/5 my-4"></div>
            <p x-show="sidebarOpen" class="text-[10px] text-white/25 uppercase tracking-widest px-3 mb-3">Sistema</p>

            <a href="{{ route('admin.config') }}"
               class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/50 hover:text-white hover:bg-white/5 transition-all {{ request()->routeIs('admin.config') ? 'active' : '' }}">
                <i class="bi bi-gear text-lg shrink-0"></i>
                <span x-show="sidebarOpen" class="text-sm font-medium whitespace-nowrap">Configurações</span>
            </a>

            <a href="{{ route('home') }}" target="_blank"
               class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/50 hover:text-white hover:bg-white/5 transition-all">
                <i class="bi bi-box-arrow-up-right text-lg shrink-0"></i>
                <span x-show="sidebarOpen" class="text-sm font-medium whitespace-nowrap">Ver loja</span>
            </a>
        </nav>

        {{-- Toggle --}}
        <div class="px-3 py-4 border-t border-white/5">
            <button @click="sidebarOpen = !sidebarOpen"
                    class="w-full flex items-center justify-center gap-2 py-2 rounded-xl text-white/30 hover:text-white hover:bg-white/5 transition-all">
                <i :class="sidebarOpen ? 'bi-chevron-double-left' : 'bi-chevron-double-right'" class="bi text-sm"></i>
            </button>
        </div>
    </aside>

    {{-- ===================== CONTEÚDO PRINCIPAL ===================== --}}
    <div
        :class="sidebarOpen ? 'lg:ml-64' : 'lg:ml-16'"
        class="flex-1 flex flex-col min-h-screen transition-all duration-300"
    >
        {{-- Topbar --}}
        <header class="sticky top-0 z-30 h-16 bg-[#111111]/95 backdrop-blur-md border-b border-white/5 flex items-center justify-between px-6">

            {{-- Mobile menu btn + breadcrumb --}}
            <div class="flex items-center gap-4">
                <button @click="mobileSidebar = true" class="lg:hidden text-white/60 hover:text-white p-1">
                    <i class="bi bi-list text-2xl"></i>
                </button>
                <div class="flex items-center gap-2 text-sm text-white/30">
                    <span>Admin</span>
                    <i class="bi bi-chevron-right text-xs"></i>
                    <span class="text-white/70">@yield('breadcrumb', 'Dashboard')</span>
                </div>
            </div>

            {{-- Ações --}}
            <div class="flex items-center gap-4">
                <span class="hidden sm:block text-sm text-white/40">
                    {{ now()->format('d/m/Y') }}
                </span>
                <div class="flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/5 border border-white/10">
                    <div class="w-6 h-6 rounded-full bg-brand flex items-center justify-center text-black text-xs font-bold">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <span class="text-sm text-white/70 max-w-[100px] truncate hidden sm:block">
                        {{ auth()->user()->name ?? 'Admin' }}
                    </span>
                </div>
                <form action="{{ route('auth.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-white/30 hover:text-red-400 transition-colors p-1" title="Sair">
                        <i class="bi bi-box-arrow-right text-lg"></i>
                    </button>
                </form>
            </div>
        </header>

        {{-- Alertas --}}
        @if(session('success'))
            <div class="mx-6 mt-4 flex items-center gap-3 px-4 py-3 rounded-xl bg-green-500/10 border border-green-500/20 text-green-400 text-sm">
                <i class="bi bi-check-circle-fill shrink-0"></i>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mx-6 mt-4 flex items-center gap-3 px-4 py-3 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm">
                <i class="bi bi-exclamation-circle-fill shrink-0"></i>
                {{ session('error') }}
            </div>
        @endif

        {{-- Página --}}
        <main class="flex-1 p-6">
            @yield('content')
        </main>

    </div>

    {{-- Sidebar Mobile Overlay --}}
    <div
        x-show="mobileSidebar"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="mobileSidebar = false"
        class="lg:hidden fixed inset-0 bg-black/60 z-50"
    ></div>

    <aside
        x-show="mobileSidebar"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="lg:hidden fixed top-0 left-0 h-full w-64 bg-[#111111] border-r border-white/5 z-50 flex flex-col"
    >
        <div class="flex items-center justify-between px-5 h-16 border-b border-white/5">
            <span class="font-display text-base text-white">Random<span class="text-brand">Burguer</span></span>
            <button @click="mobileSidebar = false" class="text-white/40 hover:text-white">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <nav class="flex-1 px-3 py-6 space-y-1">
            @foreach([
                ['route' => 'admin.dashboard',      'icon' => 'bi-grid',      'label' => 'Dashboard'],
                ['route' => 'admin.lanches.index',  'icon' => 'bi-fire',      'label' => 'Lanches'],
                ['route' => 'admin.pedidos',        'icon' => 'bi-bag-check', 'label' => 'Pedidos'],
                ['route' => 'admin.clientes.index', 'icon' => 'bi-people',    'label' => 'Clientes'],
                ['route' => 'admin.config',         'icon' => 'bi-gear',      'label' => 'Configurações'],
            ] as $item)
                <a href="{{ route($item['route']) }}" @click="mobileSidebar = false"
                   class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/50 hover:text-white hover:bg-white/5 transition-all {{ request()->routeIs($item['route']) ? 'active' : '' }}">
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