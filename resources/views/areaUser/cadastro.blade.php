{{-- resources/views/areaUser/cadastro.blade.php --}}
@extends('layouts.app')

@section('title', 'Criar Conta — RandomBurguer')

@section('content')

<div class="min-h-screen bg-surface flex transition-colors duration-300">

    {{-- Lado esquerdo — imagem --}}
    <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden">
        <img
            src="{{ asset('img/lanches/trufado-supreme.jpg') }}"
            alt="RandomBurguer"
            class="w-full h-full object-cover"
            onerror="this.src='{{ asset('img/lanches/triplo-bacon.jpg') }}'"
        />
        <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/60 to-black/90"></div>
        <div class="absolute inset-0 flex flex-col justify-end p-12 z-10">
            <p class="text-xs text-brand font-bold uppercase tracking-widest mb-3">Novo por aqui?</p>
            <h2 class="font-display text-4xl text-white font-bold leading-tight mb-4 drop-shadow">
                Crie sua conta e<br>
                <span class="italic text-brand">aproveite tudo</span>
            </h2>
            <p class="text-white/70 text-sm leading-relaxed max-w-xs mb-8">
                Promoções exclusivas, acompanhamento de pedidos em tempo real e entrega rápida para membros cadastrados.
            </p>
            <div class="flex flex-col gap-3">
                @foreach([
                    ['icon' => 'bi-gift-fill',        'text' => 'Promoções e cupons exclusivos para membros'],
                    ['icon' => 'bi-clock-history',   'text' => 'Histórico e acompanhamento de pedidos'],
                    ['icon' => 'bi-truck',           'text' => 'Entrega ágil com atendimento prioritário'],
                ] as $benefit)
                    <div class="flex items-center gap-3 text-sm text-white/80">
                        <div class="w-8 h-8 rounded-full bg-brand/20 border border-brand/30 flex items-center justify-center shrink-0">
                            <i class="bi {{ $benefit['icon'] }} text-brand text-xs"></i>
                        </div>
                        <span class="font-medium">{{ $benefit['text'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Lado direito — formulário --}}
    <div class="flex-1 flex items-center justify-center px-6 py-16 lg:px-16 overflow-y-auto">
        <div class="w-full max-w-md">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 mb-10 group w-fit">
                <div class="w-9 h-9 rounded-full bg-brand flex items-center justify-center shadow-md shadow-brand/30 group-hover:scale-110 transition-transform">
                    <i class="bi bi-fire text-black text-lg"></i>
                </div>
                <span class="font-display text-xl text-stone-900 dark:text-white font-bold tracking-tight">
                    Random<span class="text-brand">Burguer</span>
                </span>
            </a>

            {{-- Cabeçalho --}}
            <div class="mb-8">
                <h1 class="font-display text-3xl lg:text-4xl text-stone-900 dark:text-white font-bold mb-2">
                    Criar sua conta
                </h1>
                <p class="text-stone-500 dark:text-white/40 text-sm">
                    Preencha seus dados para começar a pedir agora mesmo.
                </p>
            </div>

            {{-- Alertas do Laravel --}}
            @if(session('success'))
                <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 text-sm mb-6">
                    <i class="bi bi-check-circle-fill shrink-0"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="flex items-start gap-3 px-4 py-3 rounded-xl bg-red-500/10 border border-red-500/20 text-red-600 dark:text-red-400 text-sm mb-6">
                    <i class="bi bi-exclamation-circle-fill shrink-0 mt-0.5"></i>
                    <ul class="flex flex-col gap-1 text-xs">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Formulário --}}
            <form
                id="cadastroForm"
                method="POST"
                action="{{ route('auth.cadastro.store') }}"
                x-data="cadastroForm()"
                @submit.prevent="submit"
                class="flex flex-col gap-5"
            >
                @csrf

                {{-- Nome --}}
                <div class="flex flex-col gap-1.5">
                    <label for="name" class="text-xs text-stone-600 dark:text-white/50 uppercase tracking-widest font-semibold">Nome completo</label>
                    <div class="relative">
                        <i class="bi bi-person absolute left-4 top-1/2 -translate-y-1/2 text-stone-400 dark:text-white/25 text-sm"></i>
                        <input
                            type="text" id="name" name="name"
                            placeholder="Seu nome completo"
                            value="{{ old('name') }}"
                            x-model="fields.name"
                            @blur="validate('name')"
                            :class="errors.name ? 'border-red-500/50' : 'border-surface-border dark:border-white/10'"
                            class="w-full bg-surface-card border rounded-xl pl-10 pr-4 py-3.5 text-sm text-stone-900 dark:text-white placeholder-stone-400 dark:placeholder-white/25 focus:outline-none focus:border-brand/60 focus:ring-2 focus:ring-brand/20 transition-all shadow-sm"
                        />
                    </div>
                    <p x-show="errors.name" x-text="errors.name" class="text-red-500 dark:text-red-400 text-xs"></p>
                </div>

                {{-- E-mail --}}
                <div class="flex flex-col gap-1.5">
                    <label for="email" class="text-xs text-stone-600 dark:text-white/50 uppercase tracking-widest font-semibold">E-mail</label>
                    <div class="relative">
                        <i class="bi bi-envelope absolute left-4 top-1/2 -translate-y-1/2 text-stone-400 dark:text-white/25 text-sm"></i>
                        <input
                            type="email" id="email" name="email"
                            placeholder="seu@email.com"
                            value="{{ old('email') }}"
                            x-model="fields.email"
                            @blur="validate('email')"
                            :class="errors.email ? 'border-red-500/50' : 'border-surface-border dark:border-white/10'"
                            class="w-full bg-surface-card border rounded-xl pl-10 pr-4 py-3.5 text-sm text-stone-900 dark:text-white placeholder-stone-400 dark:placeholder-white/25 focus:outline-none focus:border-brand/60 focus:ring-2 focus:ring-brand/20 transition-all shadow-sm"
                        />
                    </div>
                    <p x-show="errors.email" x-text="errors.email" class="text-red-500 dark:text-red-400 text-xs"></p>
                </div>

                {{-- Data de nascimento --}}
                <div class="flex flex-col gap-1.5">
                    <label for="dataNasc" class="text-xs text-stone-600 dark:text-white/50 uppercase tracking-widest font-semibold">Data de nascimento</label>
                    <div class="relative">
                        <i class="bi bi-calendar3 absolute left-4 top-1/2 -translate-y-1/2 text-stone-400 dark:text-white/25 text-sm"></i>
                        <input
                            type="date" id="dataNasc" name="dataNasc"
                            value="{{ old('dataNasc') }}"
                            x-model="fields.dataNasc"
                            @blur="validate('dataNasc')"
                            :class="errors.dataNasc ? 'border-red-500/50' : 'border-surface-border dark:border-white/10'"
                            class="w-full bg-surface-card border rounded-xl pl-10 pr-4 py-3.5 text-sm text-stone-900 dark:text-white/90 focus:outline-none focus:border-brand/60 focus:ring-2 focus:ring-brand/20 transition-all shadow-sm dark:[color-scheme:dark]"
                        />
                    </div>
                    <p x-show="errors.dataNasc" x-text="errors.dataNasc" class="text-red-500 dark:text-red-400 text-xs"></p>
                </div>

                {{-- Senha --}}
                <div class="flex flex-col gap-1.5" x-data="{ show: false }">
                    <label for="password" class="text-xs text-stone-600 dark:text-white/50 uppercase tracking-widest font-semibold">Senha</label>
                    <div class="relative">
                        <i class="bi bi-lock absolute left-4 top-1/2 -translate-y-1/2 text-stone-400 dark:text-white/25 text-sm"></i>
                        <input
                            :type="show ? 'text' : 'password'"
                            id="password" name="password"
                            placeholder="Mínimo 6 caracteres"
                            x-model="fields.password"
                            @blur="validate('password')"
                            :class="errors.password ? 'border-red-500/50' : 'border-surface-border dark:border-white/10'"
                            class="w-full bg-surface-card border rounded-xl pl-10 pr-12 py-3.5 text-sm text-stone-900 dark:text-white placeholder-stone-400 dark:placeholder-white/25 focus:outline-none focus:border-brand/60 focus:ring-2 focus:ring-brand/20 transition-all shadow-sm"
                        />
                        <button type="button" @click="show = !show"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-stone-400 dark:text-white/30 hover:text-stone-700 dark:hover:text-white transition-colors">
                            <i :class="show ? 'bi-eye-slash' : 'bi-eye'" class="bi text-sm"></i>
                        </button>
                    </div>
                    {{-- Força da senha --}}
                    <div class="flex gap-1 mt-1" x-show="fields.password && fields.password.length > 0">
                        <div class="h-1 flex-1 rounded-full transition-all"
                             :class="passwordStrength >= 1 ? 'bg-red-500' : 'bg-stone-200 dark:bg-white/10'"></div>
                        <div class="h-1 flex-1 rounded-full transition-all"
                             :class="passwordStrength >= 2 ? 'bg-amber-500' : 'bg-stone-200 dark:bg-white/10'"></div>
                        <div class="h-1 flex-1 rounded-full transition-all"
                             :class="passwordStrength >= 3 ? 'bg-emerald-500' : 'bg-stone-200 dark:bg-white/10'"></div>
                    </div>
                    <p x-show="errors.password" x-text="errors.password" class="text-red-500 dark:text-red-400 text-xs"></p>
                </div>

                {{-- Confirmar Senha --}}
                <div class="flex flex-col gap-1.5" x-data="{ show: false }">
                    <label for="password_confirmation" class="text-xs text-stone-600 dark:text-white/50 uppercase tracking-widest font-semibold">Confirmação de senha</label>
                    <div class="relative">
                        <i class="bi bi-lock absolute left-4 top-1/2 -translate-y-1/2 text-stone-400 dark:text-white/25 text-sm"></i>
                        <input
                            :type="show ? 'text' : 'password'"
                            id="password_confirmation" name="password_confirmation"
                            placeholder="Repita sua senha"
                            x-model="fields.password_confirmation"
                            @blur="validate('password_confirmation')"
                            :class="errors.password_confirmation ? 'border-red-500/50' : 'border-surface-border dark:border-white/10'"
                            class="w-full bg-surface-card border rounded-xl pl-10 pr-12 py-3.5 text-sm text-stone-900 dark:text-white placeholder-stone-400 dark:placeholder-white/25 focus:outline-none focus:border-brand/60 focus:ring-2 focus:ring-brand/20 transition-all shadow-sm"
                        />
                        <button type="button" @click="show = !show"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-stone-400 dark:text-white/30 hover:text-stone-700 dark:hover:text-white transition-colors">
                            <i :class="show ? 'bi-eye-slash' : 'bi-eye'" class="bi text-sm"></i>
                        </button>
                    </div>
                    <p x-show="errors.password_confirmation" x-text="errors.password_confirmation" class="text-red-500 dark:text-red-400 text-xs"></p>
                </div>

                {{-- Submit --}}
                <button
                    type="submit"
                    class="w-full py-4 rounded-full bg-brand text-black font-bold text-base hover:bg-brand-light transition-all shadow-xl shadow-brand/20 hover:shadow-brand/40 hover:-translate-y-0.5 active:scale-95 flex items-center justify-center gap-2 mt-2">
                    <i class="bi bi-person-plus-fill text-lg"></i>
                    Criar minha conta
                </button>

            </form>

            {{-- Login --}}
            <p class="text-center text-sm text-stone-500 dark:text-white/40 mt-8">
                Já tem uma conta?
                <a href="{{ route('auth.login') }}" class="text-brand font-bold hover:underline ml-1">
                    Fazer login
                </a>
            </p>

        </div>
    </div>

</div>

@push('scripts')
<script>
function cadastroForm() {
    return {
        fields: {
            name:                  '{{ old('name') }}',
            email:                 '{{ old('email') }}',
            dataNasc:              '{{ old('dataNasc') }}',
            password:              '',
            password_confirmation: '',
        },
        errors: {
            name:                  '',
            email:                 '',
            dataNasc:              '',
            password:              '',
            password_confirmation: '',
        },
        get passwordStrength() {
            const p = this.fields.password || '';
            if (p.length === 0) return 0;
            if (p.length < 6)   return 1;
            if (p.length < 10)  return 2;
            return 3;
        },
        validate(field) {
            this.errors[field] = '';
            if (field === 'name' && !this.fields.name.trim())
                this.errors.name = 'O nome completo é obrigatório.';
            if (field === 'email') {
                if (!this.fields.email.trim())
                    this.errors.email = 'O e-mail é obrigatório.';
                else if (!/^\S+@\S+\.\S+$/.test(this.fields.email))
                    this.errors.email = 'Digite um e-mail válido.';
            }
            if (field === 'password') {
                if (!this.fields.password)
                    this.errors.password = 'A senha é obrigatória.';
                else if (this.fields.password.length < 6)
                    this.errors.password = 'A senha deve ter pelo menos 6 caracteres.';
            }
            if (field === 'password_confirmation') {
                if (this.fields.password_confirmation !== this.fields.password)
                    this.errors.password_confirmation = 'As senhas não coincidem.';
            }
        },
        submit() {
            ['name', 'email', 'password', 'password_confirmation'].forEach(f => this.validate(f));
            const hasErrors = Object.values(this.errors).some(e => e !== '');
            if (!hasErrors) document.getElementById('cadastroForm').submit();
        }
    }
}
</script>
@endpush

@endsection