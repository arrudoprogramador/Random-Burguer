{{-- resources/views/areaUser/index.blade.php --}}
@extends('layouts.app')

@section('title', 'RandomBurguer — Burguers Artesanais')

@section('content')

{{-- =====================================================
    HERO
    ===================================================== --}}
<section class="relative min-h-screen flex items-end pb-24 lg:pb-32 overflow-hidden">

    {{-- Imagem de fundo --}}
    <div class="absolute inset-0 z-0">
        <img
            src="{{ asset('img/fundo.jpg') }}"
            alt="Hero background"
            class="w-full h-full object-cover object-center scale-105"
            style="animation: slowZoom 12s ease-out forwards;"
        />
        {{-- Overlay gradiente --}}
        <div class="absolute inset-0 bg-gradient-to-r from-black/85 via-black/60 to-transparent"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-surface via-transparent to-transparent"></div>
    </div>

    {{-- Conteúdo --}}
    <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-10 w-full">
        <div class="max-w-xl">

            {{-- Tag --}}
            <div class="opacity-0-init animate-fade-up inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-brand/30 bg-brand/10 mb-6">
                <span class="w-2 h-2 rounded-full bg-brand animate-pulse"></span>
                <span class="text-xs font-medium text-brand tracking-widest uppercase">Aberto agora</span>
            </div>

            {{-- Título --}}
            <h1 class="opacity-0-init animate-fade-up-2 font-display text-5xl lg:text-7xl text-white leading-none mb-6">
                Como você quer<br>
                <span class="text-brand italic">seu pedido</span><br>
                hoje?
            </h1>

            {{-- Subtítulo --}}
            <p class="opacity-0-init animate-fade-up-3 text-white/60 text-lg mb-10 leading-relaxed">
                Burguers artesanais com ingredientes selecionados.<br class="hidden sm:block">
                Entrega rápida ou retire no balcão.
            </p>

            {{-- CTAs --}}
            <div class="opacity-0-init animate-fade-up-3 flex flex-col sm:flex-row gap-4">
                <a href="{{ route('areaUser.lanches') }}"
                   class="inline-flex items-center justify-center gap-2.5 px-8 py-4 rounded-full bg-brand text-black font-semibold text-base hover:bg-brand-light transition-all shadow-xl shadow-brand/30 hover:shadow-brand/50 hover:-translate-y-0.5 active:scale-95">
                    <i class="bi bi-bag-fill text-lg"></i>
                    Ver Cardápio
                </a>
                <a href="#address"
                   class="inline-flex items-center justify-center gap-2.5 px-8 py-4 rounded-full border border-white/20 bg-white/5 text-white font-medium text-base hover:bg-white/10 transition-all backdrop-blur-sm hover:-translate-y-0.5 active:scale-95">
                    <i class="bi bi-geo-alt text-lg text-brand"></i>
                    Localização
                </a>
            </div>

        </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-10 flex flex-col items-center gap-2 text-white/30 animate-bounce">
        <span class="text-xs tracking-widest uppercase">Rolar</span>
        <i class="bi bi-chevron-down text-sm"></i>
    </div>

</section>


{{-- =====================================================
    STATS / DIFERENCIAIS
    ===================================================== --}}
<section class="bg-brand py-5">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center text-black">
            @foreach([
                ['icon' => 'bi-fire',       'value' => '+50',     'label' => 'Burguers no menu'],
                ['icon' => 'bi-star-fill',  'value' => '4.9★',    'label' => 'Avaliação média'],
                ['icon' => 'bi-clock',      'value' => '~25min',  'label' => 'Tempo de entrega'],
                ['icon' => 'bi-heart-fill', 'value' => '+2k',     'label' => 'Clientes felizes'],
            ] as $stat)
                <div class="flex flex-col items-center gap-1 py-2">
                    <i class="bi {{ $stat['icon'] }} text-xl mb-1"></i>
                    <span class="font-display text-2xl font-black">{{ $stat['value'] }}</span>
                    <span class="text-xs font-medium text-black/60">{{ $stat['label'] }}</span>
                </div>
            @endforeach
        </div>
    </div>
</section>


{{-- =====================================================
    FAVORITOS
    ===================================================== --}}
<section id="favoritos" class="py-24 bg-surface">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">

        {{-- Header da seção --}}
        <div class="flex flex-col md:flex-row md:items-end md:justify-between mb-14 gap-6">
            <div>
                <p class="text-xs text-brand font-semibold uppercase tracking-widest mb-3">Destaques da casa</p>
                <h2 class="font-display text-4xl lg:text-5xl text-white leading-tight">
                    Lanches <span class="italic text-brand">Favoritos</span>
                </h2>
            </div>
            <a href="{{ route('areaUser.lanches') }}"
               class="self-start md:self-auto inline-flex items-center gap-2 text-sm text-brand border border-brand/30 px-5 py-2.5 rounded-full hover:bg-brand hover:text-black transition-all font-medium">
                Ver todos
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        {{-- Grid de cards --}}
        @if(isset($lanchesFavoritos) && $lanchesFavoritos->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($lanchesFavoritos as $lanche)
                    @include('components.lanche-card', ['lanche' => $lanche])
                @endforeach
            </div>
        @else
            {{-- Estado vazio / placeholder --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @for($i = 0; $i < 4; $i++)
                    <div class="bg-surface-card rounded-2xl border border-white/5 animate-pulse">
                        <div class="h-56 bg-surface-muted rounded-t-2xl"></div>
                        <div class="p-5 space-y-3">
                            <div class="h-4 bg-surface-muted rounded w-3/4"></div>
                            <div class="h-3 bg-surface-muted rounded w-full"></div>
                            <div class="h-3 bg-surface-muted rounded w-2/3"></div>
                        </div>
                    </div>
                @endfor
            </div>
        @endif

    </div>
</section>


{{-- =====================================================
    SOBRE / DIFERENCIAIS
    ===================================================== --}}
<section id="about" class="py-24 bg-surface-card">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">

        <div class="text-center mb-16">
            <p class="text-xs text-brand font-semibold uppercase tracking-widest mb-3">Por que nos escolher</p>
            <h2 class="font-display text-4xl lg:text-5xl text-white">
                Sobre <span class="italic text-brand">Nós</span>
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach([
                [
                    'icon'  => 'bi-bicycle',
                    'title' => 'Entrega Rápida',
                    'desc'  => 'Solicite a entrega ou retire seu pedido no local de sua preferência. Rápido, prático e sem complicação.',
                ],
                [
                    'icon'  => 'bi-gift',
                    'title' => 'Promoções Exclusivas',
                    'desc'  => 'Cadastre-se e aproveite vantagens e promoções exclusivas para nossos clientes fiéis.',
                ],
                [
                    'icon'  => 'bi-emoji-smile',
                    'title' => 'Experiência Única',
                    'desc'  => 'A experiência RandomBurguer, totalmente pensada para você. Do pedido à última mordida.',
                ],
            ] as $item)
                <div class="group p-8 rounded-2xl border border-white/5 bg-surface hover:border-brand/20 hover:bg-surface-muted transition-all duration-300">
                    <div class="w-14 h-14 rounded-2xl bg-brand/10 border border-brand/20 flex items-center justify-center mb-6 group-hover:bg-brand group-hover:border-brand transition-all duration-300">
                        <i class="bi {{ $item['icon'] }} text-2xl text-brand group-hover:text-black transition-colors duration-300"></i>
                    </div>
                    <h3 class="font-display text-xl text-white font-bold mb-3">{{ $item['title'] }}</h3>
                    <p class="text-white/50 text-sm leading-relaxed">{{ $item['desc'] }}</p>
                </div>
            @endforeach
        </div>

    </div>
</section>


{{-- =====================================================
    AVALIAÇÕES
    ===================================================== --}}
<section id="review" class="py-24 bg-surface overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">

        <div class="text-center mb-16">
            <p class="text-xs text-brand font-semibold uppercase tracking-widest mb-3">O que dizem</p>
            <h2 class="font-display text-4xl lg:text-5xl text-white">
                Nossos <span class="italic text-brand">Clientes</span>
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach([
                ['nome' => 'Matheus Silva',    'texto' => 'O lanche estava incrível! Super saboroso e bem preparado. Com certeza voltarei para mais!', 'estrelas' => 4, 'inicial' => 'M'],
                ['nome' => 'Joana Goes',       'texto' => 'Adorei o atendimento e a qualidade do lanche! Uma ótima experiência, definitivamente recomendo!', 'estrelas' => 5, 'inicial' => 'J'],
                ['nome' => 'Cristiano Fernando','texto' => 'Simplesmente maravilhoso! O sabor do lanche é único e super bem equilibrado. Vale cada mordida!', 'estrelas' => 4, 'inicial' => 'C'],
            ] as $review)
                <div class="bg-surface-card rounded-2xl border border-white/5 p-7 flex flex-col gap-5 hover:border-brand/20 transition-all">
                    {{-- Estrelas --}}
                    <div class="flex gap-1">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="bi {{ $i <= $review['estrelas'] ? 'bi-star-fill text-brand' : 'bi-star text-white/20' }} text-sm"></i>
                        @endfor
                    </div>
                    {{-- Texto --}}
                    <p class="text-white/60 text-sm leading-relaxed flex-1">
                        "{{ $review['texto'] }}"
                    </p>
                    {{-- Autor --}}
                    <div class="flex items-center gap-3 border-t border-white/5 pt-5">
                        <div class="w-10 h-10 rounded-full bg-brand text-black font-bold flex items-center justify-center text-sm">
                            {{ $review['inicial'] }}
                        </div>
                        <span class="text-white font-medium text-sm">{{ $review['nome'] }}</span>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>


{{-- =====================================================
    ENDEREÇO / MAPA
    ===================================================== --}}
<section id="address" class="py-24 bg-surface-card">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">

        <div class="text-center mb-14">
            <p class="text-xs text-brand font-semibold uppercase tracking-widest mb-3">Venha nos visitar</p>
            <h2 class="font-display text-4xl lg:text-5xl text-white">
                Nosso <span class="italic text-brand">Endereço</span>
            </h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 items-stretch">

            {{-- Info --}}
            <div class="lg:col-span-2 flex flex-col gap-6 justify-center">
                @foreach([
                    ['icon' => 'bi-geo-alt-fill', 'title' => 'Endereço', 'value' => 'Morumbi, São Paulo – SP'],
                    ['icon' => 'bi-clock-fill',   'title' => 'Horário',  'value' => "Seg–Sex: 11h–23h\nSáb–Dom: 11h–00h"],
                    ['icon' => 'bi-telephone-fill','title' => 'Telefone','value' => '(11) 9 9999-9999'],
                ] as $info)
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-brand/10 border border-brand/20 flex items-center justify-center shrink-0">
                            <i class="bi {{ $info['icon'] }} text-brand"></i>
                        </div>
                        <div>
                            <p class="text-xs text-white/30 uppercase tracking-wider mb-0.5">{{ $info['title'] }}</p>
                            <p class="text-white/80 text-sm whitespace-pre-line">{{ $info['value'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Mapa --}}
            <div class="lg:col-span-3 rounded-2xl overflow-hidden border border-white/5 min-h-[320px]">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3656.0745712571147!2d-46.72411590814592!3d-23.601658400289445!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce57e46315cceb%3A0x9b0e0fe1faf2d837!2sDuckbill%20Cookies%20%26%20Coffee%20Morumbi%20(SPFC)!5e0!3m2!1spt-BR!2sbr!4v1733876899232!5m2!1spt-BR!2sbr"
                    class="w-full h-full min-h-[320px] grayscale"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                ></iframe>
            </div>

        </div>

    </div>
</section>


{{-- =====================================================
    CTA FINAL
    ===================================================== --}}
<section class="py-20 bg-brand relative overflow-hidden">
    {{-- Textura decorativa --}}
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 20% 50%, #000 1px, transparent 1px), radial-gradient(circle at 80% 50%, #000 1px, transparent 1px); background-size: 40px 40px;"></div>

    <div class="relative z-10 max-w-3xl mx-auto px-6 text-center">
        <h2 class="font-display text-4xl lg:text-5xl text-black font-black leading-tight mb-4">
            Gostou? Avalie nossa experiência!
        </h2>
        <p class="text-black/60 text-lg mb-8">
            Após fazer seu pedido, deixe sua avaliação. Sua opinião é muito importante para nós.
        </p>
        <a href="{{ route('login.index') }}"
           class="inline-flex items-center gap-2 px-8 py-4 rounded-full bg-black text-brand font-semibold hover:bg-surface transition-all shadow-xl shadow-black/30 text-base hover:-translate-y-0.5 active:scale-95">
            <i class="bi bi-star-fill"></i>
            Cadastre-se e avalie
        </a>
    </div>
</section>

@endsection

@push('styles')
<style>
    @keyframes slowZoom {
        from { transform: scale(1.05); }
        to   { transform: scale(1); }
    }
    .opacity-0-init { opacity: 0; }
</style>
@endpush