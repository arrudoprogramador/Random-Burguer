@extends('areaUser.layouts.app')

@section('title', $lanche->nomeLanche . ' - Detalhes')

@section('content')
    <link rel="stylesheet" href="{{ url('/css/style4.css') }}">

    <div class="container">
        <div class="content">
            <div class="img_principal">
                <div class="img">
                    <img src="{{ url('/img/lanches/' . $lanche->fotoLanche) }}" alt="Imagem do lanche">
                </div>

                <div class="itens">
                    <form action="{{ route('carrinho.adicionar', $lanche->id) }}" method="POST">
                        @csrf


                    </form>
                </div>
            </div>

            <div class="content_desc">
                <h1 class="text">{{ $lanche->nomeLanche }}</h1>
                <p class="p">{{ $lanche->descLanche }}</p>

                <div class="price">
                    <div class="price_valor_lanche">
                        <p class="valor">Valor lanche:</p>
                        R$ {{ number_format($lanche->valorLanche, 2, ',', '.') }}
                    </div>
                    

                    <div class="input-quantidade">
                            <label for="quantidade">Quantidade:</label>
                            <input type="number" id="quantidade" name="quantidade" value="1" min="1" max="10">
                        </div>
                </div>
                <div class="buttons">
                    <div>
                    <a href="{{ url('/lanches') }}" class="button2">
                        Continuar navegando
                    </a>
                    </div>

                    <div class="price_button">
                        <button class="add-to-cart">Adicionar ao carrinho</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let cartCount = 0;
            const cartIcon = document.querySelector(".cart-count");
            const cartButton = document.querySelector(".add-to-cart");
            const cartIndicator = document.querySelector(".cart-icon");

            cartIcon.textContent = cartCount;

            cartButton.addEventListener("click", function () {
                cartCount++;
                cartIcon.textContent = cartCount;
                cartIcon.style.display = "flex";
                animateCart();
            });

            function animateCart() {
                cartIndicator.classList.add("animate");
                setTimeout(() => {
                    cartIndicator.classList.remove("animate");
                }, 500);
            }
        });
    </script>
@endsection
