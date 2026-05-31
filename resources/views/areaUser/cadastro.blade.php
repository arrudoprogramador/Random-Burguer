{{-- resources/views/areaUser/cadastro.blade.php --}}
@extends('layouts.app')

@section('title', 'Criar conta — RandomBurguer')

@section('content')

<div class="min-h-screen bg-surface flex">

    {{-- Lado esquerdo — imagem --}}
    <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden">
        <img
            src="{{ url('img/fundo.jpg') }}"
            alt="RandomBurguer"
            class="w-full h-full object-cover"
            onerror="this.src='https://placehold.co/800x1000/111111/F59E0B?text=🍔'"
        />
        <div class="absolute inset-0 bg-gradient-to-r from-black/60 to-surface/90"></div>
        <div class="absolute inset-0 flex flex-col justify-end p-12">
            <p class="text-xs text-brand font-semibold uppercase tracking-widest mb-3">Novo por aqui?</p>
            <h2 class="font-display text-4xl text-white font-bold leading-tight mb-4">
                Crie sua conta e<br>
                <span class="italic text-brand">aproveite tudo</span>
            </h2>
            <p class="text-white/50 text-sm leading-relaxed max-w-xs">
                Promoções exclusivas, histórico de pedidos e muito mais para membros cadastrados.
            </p>
            <div class="mt-8 flex flex-col gap-3">
                @foreach([
                    ['icon' => 'bi-gift',       'text' => 'Promoções exclusivas para membros'],
                    ['icon' => 'bi-clock-history','text' => 'Histórico completo de pedidos'],
                    ['icon' => 'bi-truck',       'text' => 'Entrega rápida e rastreável'],
                ] as $benefit)
                    <div class="flex items-center gap-3 text-sm text-white/60">
                        <div class="w-7 h-7 rounded-full bg-brand/15 border border-brand/20 flex items-center justify-center shrink-0">
                            <i class="bi {{ $benefit['icon'] }} text-brand text-xs"></i>
                        </div>
                        {{ $benefit['text'] }}
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Lado direito — formulário --}}
    <div class="flex-1 flex items-center justify-center px-6 py-16 lg:px-16 overflow-y-auto">
        <div class="w-full max-w-md">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2 mb-10 group w-fit">
                <div class="w-9 h-9 rounded-full bg-brand flex items-center justify-center shadow-md shadow-brand/30 group-hover:scale-110 transition-transform">
                    <i class="bi bi-fire text-black text-lg"></i>
                </div>
                <span class="font-display text-xl text-white tracking-tight">
                    Random<span class="text-brand">Burguer</span>
                </span>
            </a>

            {{-- Cabeçalho --}}
            <div class="mb-8">
                <h1 class="font-display text-3xl lg:text-4xl text-white font-bold mb-2">
                    Seus dados
                </h1>
                <p class="text-white/40 text-sm">
                    Registre-se e obtenha benefícios exclusivos.
                </p>
            </div>

            {{-- Alertas do Laravel --}}
            @if(session('success'))
                <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-green-500/10 border border-green-500/20 text-green-400 text-sm mb-6">
                    <i class="bi bi-check-circle-fill shrink-0"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="flex items-start gap-3 px-4 py-3 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm mb-6">
                    <i class="bi bi-exclamation-circle-fill shrink-0 mt-0.5"></i>
                    <ul class="flex flex-col gap-1">
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
                enctype="multipart/form-data"
                x-data="cadastroForm()"
                @submit.prevent="submit"
                class="flex flex-col gap-5"
            >
                @csrf

                {{-- Nome --}}
                <div class="flex flex-col gap-1.5">
                    <label for="name" class="text-xs text-white/40 uppercase tracking-widest font-medium">Nome completo</label>
                    <div class="relative">
                        <i class="bi bi-person absolute left-4 top-1/2 -translate-y-1/2 text-white/25 text-sm"></i>
                        <input
                            type="text" id="name" name="name"
                            placeholder="Seu name"
                            value="{{ old('name') }}"
                            x-model="fields.name"
                            @blur="validate('name')"
                            :class="errors.name ? 'border-red-500/50' : 'border-white/10'"
                            class="w-full bg-surface-muted border rounded-xl pl-10 pr-4 py-3.5 text-sm text-white placeholder-white/25 focus:outline-none focus:border-brand/50 focus:ring-1 focus:ring-brand/30 transition-all"
                        />
                    </div>
                    <p x-show="errors.name" x-text="errors.name" class="text-red-400 text-xs"></p>
                </div>

                {{-- E-mail --}}
                <div class="flex flex-col gap-1.5">
                    <label for="email" class="text-xs text-white/40 uppercase tracking-widest font-medium">E-mail</label>
                    <div class="relative">
                        <i class="bi bi-envelope absolute left-4 top-1/2 -translate-y-1/2 text-white/25 text-sm"></i>
                        <input
                            type="email" id="email" name="email"
                            placeholder="seu@email.com"
                            value="{{ old('email') }}"
                            x-model="fields.email"
                            @blur="validate('email')"
                            :class="errors.email ? 'border-red-500/50' : 'border-white/10'"
                            class="w-full bg-surface-muted border rounded-xl pl-10 pr-4 py-3.5 text-sm text-white placeholder-white/25 focus:outline-none focus:border-brand/50 focus:ring-1 focus:ring-brand/30 transition-all"
                        />
                    </div>
                    <p x-show="errors.email" x-text="errors.email" class="text-red-400 text-xs"></p>
                </div>

                {{-- Data de nascimento --}}
                <div class="flex flex-col gap-1.5">
                    <label for="dataNasc" class="text-xs text-white/40 uppercase tracking-widest font-medium">Data de nascimento</label>
                    <div class="relative">
                        <i class="bi bi-calendar3 absolute left-4 top-1/2 -translate-y-1/2 text-white/25 text-sm"></i>
                        <input
                            type="date" id="dataNasc" name="dataNasc"
                            value="{{ old('dataNasc') }}"
                            x-model="fields.dataNasc"
                            @blur="validate('dataNasc')"
                            :class="errors.dataNasc ? 'border-red-500/50' : 'border-white/10'"
                            class="w-full bg-surface-muted border rounded-xl pl-10 pr-4 py-3.5 text-sm text-white/70 focus:outline-none focus:border-brand/50 focus:ring-1 focus:ring-brand/30 transition-all [color-scheme:dark]"
                        />
                    </div>
                    <p x-show="errors.dataNasc" x-text="errors.dataNasc" class="text-red-400 text-xs"></p>
                </div>

                {{-- Senha --}}
                <div class="flex flex-col gap-1.5" x-data="{ show: false }">
                    <label for="password" class="text-xs text-white/40 uppercase tracking-widest font-medium">Senha</label>
                    <div class="relative">
                        <i class="bi bi-lock absolute left-4 top-1/2 -translate-y-1/2 text-white/25 text-sm"></i>
                        <input
                            :type="show ? 'text' : 'password'"
                            id="password" name="password"
                            placeholder="Mínimo 6 caracteres"
                            x-model="fields.password"
                            @blur="validate('password')"
                            :class="errors.password ? 'border-red-500/50' : 'border-white/10'"
                            class="w-full bg-surface-muted border rounded-xl pl-10 pr-12 py-3.5 text-sm text-white placeholder-white/25 focus:outline-none focus:border-brand/50 focus:ring-1 focus:ring-brand/30 transition-all"
                        />
                        <button type="button" @click="show = !show"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-white/25 hover:text-white/60 transition-colors">
                            <i :class="show ? 'bi-eye-slash' : 'bi-eye'" class="bi text-sm"></i>
                        </button>
                    </div>
                    {{-- Força da senha --}}
                    <div class="flex gap-1 mt-1" x-show="fields.password.length > 0">
                        <div class="h-1 flex-1 rounded-full transition-all"
                             :class="passwordStrength >= 1 ? 'bg-red-500' : 'bg-white/10'"></div>
                        <div class="h-1 flex-1 rounded-full transition-all"
                             :class="passwordStrength >= 2 ? 'bg-yellow-500' : 'bg-white/10'"></div>
                        <div class="h-1 flex-1 rounded-full transition-all"
                             :class="passwordStrength >= 3 ? 'bg-brand' : 'bg-white/10'"></div>
                    </div>
                    <p x-show="errors.password" x-text="errors.password" class="text-red-400 text-xs"></p>
                </div>

                {{-- Confirmar Senha --}}
                <div class="flex flex-col gap-1.5" x-data="{ show: false }">
                    <label for="password" class="text-xs text-white/40 uppercase tracking-widest font-medium">Confirmação de senha</label>
                    <div class="relative">
                        <i class="bi bi-lock absolute left-4 top-1/2 -translate-y-1/2 text-white/25 text-sm"></i>
                        <input
                            :type="show ? 'text' : 'password'"
                            id="password" name="password_confirmation"
                            placeholder="Repita a senha"
                            x-model="fields.password_confirmation"
                            @blur="validate('password_confirmation')"
                            :class="errors.password_confirmation ? 'border-red-500/50' : 'border-white/10'"
                            class="w-full bg-surface-muted border rounded-xl pl-10 pr-12 py-3.5 text-sm text-white placeholder-white/25 focus:outline-none focus:border-brand/50 focus:ring-1 focus:ring-brand/30 transition-all"
                        />
                        <button type="button" @click="show = !show"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-white/25 hover:text-white/60 transition-colors">
                            <i :class="show ? 'bi-eye-slash' : 'bi-eye'" class="bi text-sm"></i>
                        </button>
                    </div>
                    <p x-show="errors.password_confirmation" x-text="errors.password_confirmation" class="text-red-400 text-xs"></p>
                </div>

                {{-- Submit --}}
                <button
                    type="submit"
                    class="w-full py-4 rounded-full bg-brand text-black font-bold text-base hover:bg-brand-light transition-all shadow-xl shadow-brand/20 hover:shadow-brand/40 hover:-translate-y-0.5 active:scale-95 flex items-center justify-center gap-2 mt-2">
                    <i class="bi bi-person-plus-fill text-lg"></i>
                    Criar conta
                </button>

            </form>

            {{-- Login --}}
            <p class="text-center text-sm text-white/30 mt-8">
                Já tem uma conta?
                <a href="{{ route('auth.login') }}" class="text-brand font-medium hover:text-brand-light transition-colors ml-1">
                    Entrar
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
            name:     '',
            email:    '',
            
            password: '',
        },
        errors: {
            name:     '',
            email:    '',
            
            password: '',
        },
        get passwordStrength() {
            const p = this.fields.password;
            if (p.length === 0) return 0;
            if (p.length < 6)   return 1;
            if (p.length < 10)  return 2;
            return 3;
        },
        validate(field) {
            this.errors[field] = '';
            if (field === 'name' && !this.fields.name.trim())
                this.errors.name = 'O name é obrigatório.';
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
        },
        submit() {
            ['name', 'email', 'password'].forEach(f => this.validate(f));
            const hasErrors = Object.values(this.errors).some(e => e !== '');
            if (!hasErrors) document.getElementById('cadastroForm').submit();
        }
    }
}
</script>
@endpush

@endsection