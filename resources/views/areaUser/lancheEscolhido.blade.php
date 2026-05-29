@extends('layouts.app')

@section('title', $lanche->nome . ' - Detalhes')

@section('content')
    <link rel="stylesheet" href="{{ url('/css/styleLancheSelecionado.css') }}">

    <div class="container">
        <div class="content">
            <div class="img_principal">
                <div class="img">
                    <img src="{{ url('/img/lanches/' . $lanche->fotoLanche) }}" alt="Imagem do lanche">
                </div>
            </div>

            <div class="content_desc">
                <h1 class="text">{{ $lanche->nome }}</h1>
                <p class="p">{{ $lanche->descricao }}</p>

                <div class="price">
                    <div class="price_valor_lanche">
                        <p class="valor">Valor lanche:</p>
                        R$ {{ number_format($lanche->preco, 2, ',', '.') }}
                    </div>
                </div>

                @if(auth()->check())
                <form action="{{ route('carrinho.adicionar', $lanche->id) }}" method="POST">
                    @csrf
                    <div class="input-quantidade">
                        <label for="quantidade">Quantidade:</label>
                        <input type="number" id="quantidade" name="quantidade" value="1" min="1" max="10">
                    </div>

                    <div class="buttons">
                        <a href="{{ url('/lanches') }}" class="button2">Continuar navegando</a>
                        <button type="submit" class="button1 add-to-cart">Adicionar ao carrinho</button>
                    </div>
                </form>
                @else
                <div class="buttons">
                    <a href="{{ url('/lanches') }}" class="button2">Continuar navegando</a>
                    <a href="{{ route('login.index') }}" class="button1">Faça login para comprar</a>
                </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let cartCount = 0;
            const cartIcon = document.querySelector(".cart-count");
            const cartButton = document.querySelector(".add-to-cart");
            const cartIndicator = document.querySelector(".cart-icon");

            if (cartIcon) {
                cartIcon.textContent = cartCount;
            }

            if (cartButton) {
                cartButton.addEventListener("click", function () {
                    cartCount++;
                    if (cartIcon) {
                        cartIcon.textContent = cartCount;
                        cartIcon.style.display = "flex";
                    }
                    animateCart();
                });
            }

            function animateCart() {
                if (cartIndicator) {
                    cartIndicator.classList.add("animate");
                    setTimeout(() => {
                        cartIndicator.classList.remove("animate");
                    }, 500);
                }
            }
        });
    </script>
@endsection
