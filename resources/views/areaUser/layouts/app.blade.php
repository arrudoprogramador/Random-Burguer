<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{url('/css/styleNavbar.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
    <title>RandomBurguer</title>
</head>

<body>
    @if(auth()->check())
    <header class="header">
    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="modal" data-bs-target="#navbarModal"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <a class="navbar-brand" href="#">
                <!-- Logo -->
                <!-- <img src="./img/logo.png" alt="Logo" class="icone" style="max-width: 100px;"> -->
            </a>

            <div class="icons">
                <form action="{{ route('pesquisar.lanches') }}" method="GET">
                    <div class="input-container">
                        <input 
                            type="text"
                            name="pesquisar"
                            placeholder="Pesquise algo..." 
                            class="input" 
                            value="{{ request('pesquisar') }}"
                        >
                        <button type="submit" class="icon-button">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon">
                                <path d="M7.25007 2.38782C8.54878 2.0992 10.1243 2 12 2C13.8757 2 15.4512 2.0992 16.7499 2.38782C18.06 2.67897 19.1488 3.176 19.9864 4.01358C20.824 4.85116 21.321 5.94002 21.6122 7.25007C21.9008 8.54878 22 10.1243 22 12C22 13.8757 21.9008 15.4512 21.6122 16.7499C21.321 18.06 20.824 19.1488 19.9864 19.9864C19.1488 20.824 18.06 21.321 16.7499 21.6122C15.4512 21.9008 13.8757 22 12 22C10.1243 22 8.54878 21.9008 7.25007 21.6122C5.94002 21.321 4.85116 20.824 4.01358 19.9864C3.176 19.1488 2.67897 18.06 2.38782 16.7499C2.0992 15.4512 2 13.8757 2 12C2 10.1243 2.0992 8.54878 2.38782 7.25007C2.67897 5.94002 3.176 4.85116 4.01358 4.01358C4.85116 3.176 5.94002 2.67897 7.25007 2.38782ZM9 11.5C9 10.1193 10.1193 9 11.5 9C12.8807 9 14 10.1193 14 11.5C14 12.8807 12.8807 14 11.5 14C10.1193 14 9 12.8807 9 11.5ZM11.5 7C9.01472 7 7 9.01472 7 11.5C7 13.9853 9.01472 16 11.5 16C12.3805 16 13.202 15.7471 13.8957 15.31L15.2929 16.7071C15.6834 17.0976 16.3166 17.0976 16.7071 16.7071C17.0976 16.3166 17.0976 15.6834 16.7071 15.2929L15.31 13.8957C15.7471 13.202 16 12.3805 16 11.5C16 9.01472 13.9853 7 11.5 7Z"></path>
                            </svg>
                        </button>
                    </div>
                </form>

                <a href="{{ url('/carrinho') }}" class="cart-link">
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACMAAAAjCAYAAAAe2bNZAAAACXBIWXMAAAsTAAALEwEAmpwYAAABxUlEQVR4nO3Yz4uPURTH8e8wSspGzQyzUzOlJBvKzsaPjaZmjLXdNEn4C7CRhY0FC0o2ZMbKwmpC1rKQWGJjhfJzSH68dDnyzeZ7n+/z66t86vRsnnPu+55z73PufTqd//pXhG344I8eYKgtmDFcwnU8C6DhVmD+ArscMHuxq0abLALThC5iZQ7MPOZqtMUY52AOzHCn/nWadHYQYPbHOHODALOArxhtFQZr8B63e73YBMzvEs0PAsxCzxI1AYPVeNezRA3BzGSVqCGYa/iGDa3C+FWit7iT61AnzHTEPpTrsBMnqgaJ2FdjF62vI3620hrBMm512hQmcQ/fU+aLOu/BEp5UYM9jnaQddLSf8/AXvMb9CuwuzmNLwYT+hDkTM+l9LKxbOBkw063dELpgxvFC/3oTR8rxKoGO40IfdjMW6+P0xa0EqIxwJLJ0oIpgW6MtpHTvK+A3Fs/R2JGHy4JswscI9il3hl3ZmOgq9YqyMKcj6Hasw8ucLotH8ZFblS5muIHdZWFOBcwOjOBVTj/BQzzFWkxFjGNV9JHl2BGfI+hMhl+6gSal0qYelCZRvjtjc2zTK+kHQAG/2Thsn8PGogP/ADZYqvRixhuIAAAAAElFTkSuQmCC" alt="Carrinho">
                    <span class="cart-count" id="cartCount"></span>
                </a>

                <span class="nome_usuario">{{ auth()->user()->name }}</span>
                <a href="{{ route('login.destroy') }}">SAIR</a>
            </div>
        </div>
    </nav>
</header>


        <!-- Modal -->
        <div class="modal fade" id="navbarModal" tabindex="-1" aria-labelledby="navbarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <div class="modal-body">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/#about">Sobre</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/lanches">Cardápio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/#menu">Favoritos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/#review">Avaliações</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/#address">Endereço</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Recupera o valor do carrinho do localStorage ou define como 0 se não houver
        let cartCount = parseInt(localStorage.getItem('cartCount')) || 0;

        const cartIcon = document.querySelector("#cartCount");
        const cartButton = document.querySelector(".add-to-cart");
        const cartIndicator = document.querySelector(".cart-icon");

        // Atualiza o contador do carrinho com o valor do localStorage
        cartIcon.textContent = cartCount;

        // Quando o botão de adicionar ao carrinho é clicado
        cartButton.addEventListener("click", function () {
            cartCount++;
            cartIcon.textContent = cartCount;
            cartIcon.style.display = "flex";
            animateCart();
            
            // Salva o novo valor do carrinho no localStorage
            localStorage.setItem('cartCount', cartCount);
        });

        // Função de animação do carrinho
        function animateCart() {
            cartIndicator.classList.add("animate");
            setTimeout(() => {
                cartIndicator.classList.remove("animate");
            }, 500);
        }
    });
</script>
    @else
    <header class="header">
        <nav class="navbar navbar-expand-lg custom-navbar">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="modal" data-bs-target="#navbarModal"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <a class="navbar-brand" href="#">
                    <!-- Logo, se necessário -->
                    <!-- <img src="./img/logo.png" alt="Logo" class="icone" style="max-width: 100px;"> -->
                </a>

                <div class="icons">
                    <form action="{{ route('pesquisar.lanches') }}" method="GET">
                        <div class="input-container">
                            <input 
                                type="text"
                                name="pesquisar"
                                placeholder="Pesquise algo..." 
                                class="input" 
                                value="{{ request('pesquisar') }}"
                            >
                            <button type="submit" class="icon-button">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon">
                                    <path d="M7.25007 2.38782C8.54878 2.0992 10.1243 2 12 2C13.8757 2 15.4512 2.0992 16.7499 2.38782C18.06 2.67897 19.1488 3.176 19.9864 4.01358C20.824 4.85116 21.321 5.94002 21.6122 7.25007C21.9008 8.54878 22 10.1243 22 12C22 13.8757 21.9008 15.4512 21.6122 16.7499C21.321 18.06 20.824 19.1488 19.9864 19.9864C19.1488 20.824 18.06 21.321 16.7499 21.6122C15.4512 21.9008 13.8757 22 12 22C10.1243 22 8.54878 21.9008 7.25007 21.6122C5.94002 21.321 4.85116 20.824 4.01358 19.9864C3.176 19.1488 2.67897 18.06 2.38782 16.7499C2.0992 15.4512 2 13.8757 2 12C2 10.1243 2.0992 8.54878 2.38782 7.25007C2.67897 5.94002 3.176 4.85116 4.01358 4.01358C4.85116 3.176 5.94002 2.67897 7.25007 2.38782ZM9 11.5C9 10.1193 10.1193 9 11.5 9C12.8807 9 14 10.1193 14 11.5C14 12.8807 12.8807 14 11.5 14C10.1193 14 9 12.8807 9 11.5ZM11.5 7C9.01472 7 7 9.01472 7 11.5C7 13.9853 9.01472 16 11.5 16C12.3805 16 13.202 15.7471 13.8957 15.31L15.2929 16.7071C15.6834 17.0976 16.3166 17.0976 16.7071 16.7071C17.0976 16.3166 17.0976 15.6834 16.7071 15.2929L15.31 13.8957C15.7471 13.202 16 12.3805 16 11.5C16 9.01472 13.9853 7 11.5 7Z"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                    <button class="btn_entrar" onclick="window.location.href='{{ url('login') }}'">login</button>
                </div>

            </div>
        </nav>
    </header>

    <!-- Modal -->
    <div class="modal fade" id="navbarModal" tabindex="-1" aria-labelledby="navbarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <div class="modal-body">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/#about">Sobre</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/lanches">Cardápio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/#menu">Favoritos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/#review">Avaliações</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/#address">Endereço</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endif

<main>
    @yield('content')
</main>

</body>
</html>
