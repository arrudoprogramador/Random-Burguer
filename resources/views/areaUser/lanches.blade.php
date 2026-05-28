@extends('areaUser.layouts.app')

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ url('/css/lanches.css') }}">
    <title>Cardápio de Lanches</title>
</head>
<body>



<!-- <header class="header">
        <nav class="navbar navbar-expand-lg custom-navbar">
            <div class="container-fluid">
                
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/">Home</a>
                        </li>
                        
                    </ul>
                </div>

                @if(isset($lanches) && $lanches->isNotEmpty())
                <form method="GET" action="{{ route('pesquisar.lanches') }}">
                    <input type="text" name="pesquisar" placeholder="Pesquisar Lanches" value="{{ request('pesquisar') }}">
                    <button type="submit">Pesquisar</button>
                </form> 

                <div class="icons"> 
                <a href="{{url('/carrinho') }}"><img width="30" height="30" src="https://img.icons8.com/?size=100&id=59997&format=png&color=ffffff" alt=""></a>
                </div>
            </div>
        </nav>
    </header> -->

    <div class="home-container">
    <img src="{{ asset('img/bg 9.jpg') }}" alt="Imagem de fundo" class="background-image">
    <div class="textos">
    <h1 class="text">Melhores lanches somente aqui!!</h1>
    </div>
    </div>

    <section class="menu" id="menu">
        <h2 class="title">Nosso <span>cardápio</span></h2>
        
            <div class="box-container1">
            @foreach($lanches as $l)
                <a href="{{ route('lanche.show', ['id' => $l->id]) }}" class="card">
                    <div class="box">
                        <img src="{{ url('/img/lanches/' . $l->fotoLanche) }}" alt="Imagem do lanche">
                        <h3>{{ $l->nomeLanche }}</h3>
                        <div class="price">
                            R$ {{ number_format($l->valorLanche, 2, ',', '.') }}
                        </div>
                        
                    </div>
                </a>
            @endforeach
            </div>


        @else
        <!-- Ícones adicionais -->
        <form method="GET" action="{{ route('pesquisar.lanches') }}">
                    <input type="text" name="pesquisar" placeholder="Pesquisar Lanches" value="{{ request('pesquisar') }}">
                    <button type="submit">Pesquisar</button>
                </form> 

                <div class="icons"> 
                    <img width="30" height="30" src="https://img.icons8.com/?size=100&id=59997&format=png&color=ffffff" alt="">
                </div>
            </div>
        </nav>
    </header>

    <section class="menu" id="menu">
        <h2 class="title">Nosso <span>cardápio</span></h2>

       
            <div class="box-container">
            <div class="box">
            <p class="mt-5">Nenhum lanche encontrado.</p>
        @endif
    </section>

</body>
</html>
