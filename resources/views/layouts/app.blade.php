<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'RandomBurguer')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            DEFAULT: '#F59E0B', // amber-500
                            dark:    '#D97706', // amber-600
                            light:   '#FCD34D', // amber-300
                        },
                        surface: {
                            DEFAULT: '#111111',
                            card:    '#1A1A1A',
                            muted:   '#252525',
                        },
                    },
                    fontFamily: {
                        display: ['"Playfair Display"', 'serif'],
                        body:    ['"DM Sans"', 'sans-serif'],
                    },
                    keyframes: {
                        fadeUp: {
                            '0%':   { opacity: '0', transform: 'translateY(32px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        scaleIn: {
                            '0%':   { opacity: '0', transform: 'scale(0.92)' },
                            '100%': { opacity: '1', transform: 'scale(1)' },
                        },
                    },
                    animation: {
                        'fade-up':    'fadeUp 0.7s ease forwards',
                        'fade-up-2':  'fadeUp 0.7s ease 0.15s forwards',
                        'fade-up-3':  'fadeUp 0.7s ease 0.3s forwards',
                        'scale-in':   'scaleIn 0.5s ease forwards',
                    },
                },
            },
        }
    </script>

    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet" />

    {{-- Bootstrap Icons (para ícones simples) --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" />

    <style>
        body { font-family: 'DM Sans', sans-serif; background-color: #111111; color: #f5f5f5; }
        .font-display { font-family: 'Playfair Display', serif; }
        .opacity-0-init { opacity: 0; }
    </style>

    

    @stack('styles')
</head>
<body class="antialiased">

    {{-- Navbar --}}
    @include('components.navbar')

    {{-- Conteúdo principal --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('components.footer')

    @stack('scripts')
</body>
</html>