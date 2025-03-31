@extends('areaUser.layouts.app')

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{url('/css/app.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">


    <title>Home</title>
</head>

<body>

    
    <div class="home-container">
    <img src="{{ asset('img/fundo.jpg') }}" alt="Imagem de fundo" class="background-image">
        <section id="#home">
            <div class="navegação">
            <div class="itens">
                <p class="text_nav">Cárdapio</p>
                <p class="text_nav">Favoritos</p>
                <p class="text_nav">localização</p>
            </div>
            <div class="content">
                <p class="h3">Como você quer seu pedido hoje?</p>
                <button class="btn_principal">
                        <img width="20" height="20" src="https://img.icons8.com/3d-fluency/94/location.png" alt="location"/>
                    <p class="text_button">Compre agora</p>
                </button>            
            </div>
            </div>
        </section>
    </div>



    <section class="menu" id="menu">
        <h2 class="title">lanches <span>Favoritos</span></h2>

        <div class="box-container1">
            <div class="box">
            <img src="{{ asset('img/lanches/2.jpg') }}" alt="item-2">
                <div class="card_footer">
                <h3>lanche1</h3>
                </div>
            </div>
            <div class="box">
            <img src="{{ asset('img/lanches/1.jpg') }}" alt="item-2">
            <h3>lanche2</h3>
                <!-- <div class="price">R$ 50,99 <span>R$ 100,99</span></div> -->
                <!-- <a href="#" class="btn">Adicione ao carrinho</a> -->
            </div>
            <div class="box">
            <img src="{{ asset('img/lanches/3.jpg') }}" alt="item-2">
                <h3>lanche3</h3>
                <!-- <div class="price">R$ 25,99 <span>R$ 50,99</span></div> -->
                <!-- <a href="#" class="btn">Adicione ao carrinho</a> -->
            </div>
            <div class="box">
            <img src="{{ asset('img/lanches/4.jpg') }}" alt="item-2">
                <h3>lanche4</h3>
                <!-- <div class="price">R$ 25,99 <span>R$ 50,99</span></div> -->
                <!-- <a href="#" class="btn">Adicione ao carrinho</a> -->
            </div>
        </div>

        <div class="ver">
        <a href="./lanches"><p class="text_ver">Ver Mais</p></a>
        </div>
    </section>

    <section class="about" id="about">
        <h2 class="title">Sobre<span> Nós</span> </h2>
        <div class="opa">
            <div class="a1">
            <img src="{{asset('img/entrega.png')}}" alt="qq">
                <p class="text">Solicite a entrega ou retire seu pedido no local de sua preferência.
</p>
            </div>
            <div class="a2">
            <img src="{{asset('img/promo.png')}}" alt="qq">
                <p class="text">Cadastre-se e aproveite as vantagens e promoções exclusivas!</p>
            </div>
            <div class="a3">
            <img src="{{asset('img/feliz.png')}}" alt="qq">
                <p class="text">A experiência RandomBurguer, totalmente pensada para você!
</p>
            </div>

        </section>


        <section class="review" id="review">
    <h2 class="title">Nossos clientes</h2>

    <div class="box-container">
        <!-- Cliente 1 -->
        <div class="box">
            <p>"O lanche estava incrível! Super saboroso e bem preparado. Com certeza voltarei para mais!"</p>
            <img src="./img/pic-1.png" alt="foto cliente" class="user">
            <h3>Matheus Silva</h3>
            <div class="stars">
                <!-- Estrelas amarelas -->
                <img width="30" height="30" src="https://img.icons8.com/?size=100&id=7856&format=png&color=ffd700" alt="star">
                <img width="30" height="30" src="https://img.icons8.com/?size=100&id=7856&format=png&color=ffd700" alt="star">
                <img width="30" height="30" src="https://img.icons8.com/?size=100&id=7856&format=png&color=ffd700" alt="star">
                <img width="30" height="30" src="https://img.icons8.com/?size=100&id=7856&format=png&color=ffd700" alt="star">
                <img width="30" height="30" src="https://img.icons8.com/?size=100&id=102459&format=png&color=ffd700" alt="star">
            </div>
        </div>

        <!-- Cliente 2 -->
        <div class="box">
            <p>"Adorei o atendimento e a qualidade do lanche! Uma ótima experiência, definitivamente recomendo!"</p>
            <img src="./img/pic-2.png" alt="foto cliente" class="user">
            <h3>Joana Goes</h3>
            <div class="stars">
                <!-- Estrelas amarelas -->
                <img width="30" height="30" src="https://img.icons8.com/?size=100&id=7856&format=png&color=ffd700" alt="star">
                <img width="30" height="30" src="https://img.icons8.com/?size=100&id=7856&format=png&color=ffd700" alt="star">
                <img width="30" height="30" src="https://img.icons8.com/?size=100&id=7856&format=png&color=ffd700" alt="star">
                <img width="30" height="30" src="https://img.icons8.com/?size=100&id=7856&format=png&color=ffd700" alt="star">
                <img width="30" height="30" src="https://img.icons8.com/?size=100&id=7856&format=png&color=ffd700" alt="star">
            </div>
        </div>

        <!-- Cliente 3 -->
        <div class="box">
            <p>"Simplesmente maravilhoso! O sabor do lanche é único e super bem equilibrado. Vale cada mordida!"</p>
            <img src="./img/pic-3.png" alt="foto cliente" class="user">
            <h3>Cristiano Fernando</h3>
            <div class="stars">
                <!-- Estrelas amarelas -->
                <img width="30" height="30" src="https://img.icons8.com/?size=100&id=7856&format=png&color=ffd700" alt="star">
                <img width="30" height="30" src="https://img.icons8.com/?size=100&id=7856&format=png&color=ffd700" alt="star">
                <img width="30" height="30" src="https://img.icons8.com/?size=100&id=7856&format=png&color=ffd700" alt="star">
                <img width="30" height="30" src="https://img.icons8.com/?size=100&id=7856&format=png&color=ffd700" alt="star">
                <img width="30" height="30" src="https://img.icons8.com/?size=100&id=102459&format=png&color=ffd700" alt="star">
            </div>
        </div>
    </div>
</section>

            </div>
        </div>
    </section>

    <section class="address" id="address">
        <h2 class="title"> Nosso <span>Endereço</span></h2>
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3656.0745712571147!2d-46.72411590814592!3d-23.601658400289445!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce57e46315cceb%3A0x9b0e0fe1faf2d837!2sDuckbill%20Cookies%20%26%20Coffee%20Morumbi%20(SPFC)!5e0!3m2!1spt-BR!2sbr!4v1733876899232!5m2!1spt-BR!2sbr"
            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>

        <df-messenger
  intent="WELCOME"
  chat-title="BM"
  agent-id="fda08696-c405-4ff3-8e3a-401608ef7426"
  language-code="pt"
></df-messenger>


<div class="register">
    <div class="content">
        <h3>Nossa missão é levar o melhor atendimento.</h3>
        <h2 class="font_register">Faça igual aos clientes acima, após as compras nos avalie.</h2>
        </div>
</div>

<footer class="text-white text-center py-4">
    <div class="container">
    <!-- <img src="./img/logo.png" alt="Logo" class="icone" style="max-width: 100px;"> -->

        <div class="footer_row">
            <div class="col-md-4">
                <ul class="list_footer">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Cardápio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#menu">Favoritos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#review">Avaliações</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#address">Endereço</a>
                    </li>
                </ul>
            </div>

            <hr>
            
            </div>
            <div class="col-md-4">
                <h5>Redes Sociais</h5>
                <ul class="list-unstyled">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50" viewBox="0,0,256,256">
<g fill="#333" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.12,5.12)"><path d="M16,3c-7.16752,0 -13,5.83248 -13,13v18c0,7.16752 5.83248,13 13,13h18c7.16752,0 13,-5.83248 13,-13v-18c0,-7.16752 -5.83248,-13 -13,-13zM16,5h18c6.08648,0 11,4.91352 11,11v18c0,6.08648 -4.91352,11 -11,11h-18c-6.08648,0 -11,-4.91352 -11,-11v-18c0,-6.08648 4.91352,-11 11,-11zM37,11c-1.10457,0 -2,0.89543 -2,2c0,1.10457 0.89543,2 2,2c1.10457,0 2,-0.89543 2,-2c0,-1.10457 -0.89543,-2 -2,-2zM25,14c-6.06329,0 -11,4.93671 -11,11c0,6.06329 4.93671,11 11,11c6.06329,0 11,-4.93671 11,-11c0,-6.06329 -4.93671,-11 -11,-11zM25,16c4.98241,0 9,4.01759 9,9c0,4.98241 -4.01759,9 -9,9c-4.98241,0 -9,-4.01759 -9,-9c0,-4.98241 4.01759,-9 9,-9z"></path></g></g>
</svg>                    
<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50" viewBox="0,0,256,256">
<g fill="#333" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.12,5.12)"><path d="M25,3c-12.13844,0 -22,9.86156 -22,22c0,11.01913 8.12753,20.13835 18.71289,21.72852l1.14844,0.17383v-17.33594h-5.19727v-3.51953h5.19727v-4.67383c0,-2.87808 0.69065,-4.77363 1.83398,-5.96289c1.14334,-1.18926 2.83269,-1.78906 5.18359,-1.78906c1.87981,0 2.61112,0.1139 3.30664,0.19922v2.88086h-2.44727c-1.38858,0 -2.52783,0.77473 -3.11914,1.80664c-0.59131,1.03191 -0.77539,2.264 -0.77539,3.51953v4.01758h6.12305l-0.54492,3.51953h-5.57812v17.36523l1.13477,-0.1543c10.73582,-1.45602 19.02148,-10.64855 19.02148,-21.77539c0,-12.13844 -9.86156,-22 -22,-22zM25,5c11.05756,0 20,8.94244 20,20c0,9.72979 -6.9642,17.7318 -16.15625,19.5332v-12.96875h5.29297l1.16211,-7.51953h-6.45508v-2.01758c0,-1.03747 0.18982,-1.96705 0.50977,-2.52539c0.31994,-0.55834 0.62835,-0.80078 1.38477,-0.80078h4.44727v-6.69141l-0.86719,-0.11719c-0.59979,-0.08116 -1.96916,-0.27148 -4.43945,-0.27148c-2.7031,0 -5.02334,0.73635 -6.625,2.40234c-1.60166,1.66599 -2.39258,4.14669 -2.39258,7.34961v2.67383h-5.19727v7.51953h5.19727v12.9043c-9.04433,-1.91589 -15.86133,-9.84626 -15.86133,-19.4707c0,-11.05756 8.94244,-20 20,-20z"></path></g></g>
</svg>                    
<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50" viewBox="0,0,256,256">
<g fill="#333" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.12,5.12)"><path d="M9,4c-2.75042,0 -5,2.24958 -5,5v32c0,2.75042 2.24958,5 5,5h32c2.75042,0 5,-2.24958 5,-5v-32c0,-2.75042 -2.24958,-5 -5,-5zM9,6h32c1.67158,0 3,1.32842 3,3v32c0,1.67158 -1.32842,3 -3,3h-32c-1.67158,0 -3,-1.32842 -3,-3v-32c0,-1.67158 1.32842,-3 3,-3zM26.04297,10c-0.5515,0.00005 -0.99887,0.44655 -1,0.99805c0,0 -0.01098,4.87522 -0.02148,9.76172c-0.0053,2.44325 -0.01168,4.88902 -0.01562,6.73047c-0.00394,1.84145 -0.00586,3.0066 -0.00586,3.10352c0,1.81526 -1.64858,3.29883 -3.52734,3.29883c-1.86379,0 -3.35156,-1.48972 -3.35156,-3.35352c0,-1.86379 1.48777,-3.35156 3.35156,-3.35156c0.06314,0 0.1904,0.02075 0.4082,0.04688c0.28415,0.03406 0.56927,-0.05523 0.78323,-0.24529c0.21396,-0.19006 0.33624,-0.46267 0.33591,-0.74885v-4.20117c-0.00005,-0.528 -0.41054,-0.965 -0.9375,-0.99805c-0.15583,-0.0098 -0.35192,-0.0293 -0.58984,-0.0293c-5.24953,0 -9.52734,4.27782 -9.52734,9.52734c0,5.24953 4.27782,9.52734 9.52734,9.52734c5.24938,0 9.52734,-4.27782 9.52734,-9.52734v-9.04883c1.45461,1.16341 3.26752,1.90039 5.26953,1.90039c0.27306,0 0.53277,-0.01618 0.78125,-0.03906c0.51463,-0.04749 0.90832,-0.47927 0.9082,-0.99609v-4.66992c0.0003,-0.52448 -0.40463,-0.9601 -0.92773,-0.99805c-3.14464,-0.22561 -5.65141,-2.67528 -5.97852,-5.79102c-0.05305,-0.50925 -0.48214,-0.89619 -0.99414,-0.89648zM27.04102,12h2.28125c0.72678,3.2987 3.30447,5.8144 6.63672,6.44531v2.86523c-2.13887,-0.10861 -4.01749,-1.1756 -5.12305,-2.85742c-0.24284,-0.36962 -0.69961,-0.53585 -1.12322,-0.40877c-0.4236,0.12708 -0.71344,0.51729 -0.71272,0.95955v11.53516c0,4.16848 -3.35873,7.52734 -7.52734,7.52734c-4.16848,0 -7.52734,-3.35887 -7.52734,-7.52734c0,-4.00052 3.12077,-7.17588 7.05469,-7.43164v2.17578c-2.71358,0.25252 -4.87891,2.47904 -4.87891,5.25586c0,2.94421 2.40735,5.35352 5.35156,5.35352c2.92924,0 5.52734,-2.30609 5.52734,-5.29883c0,0.04892 0.00186,-1.25818 0.00586,-3.09961c0.0039,-1.84143 0.01037,-4.28722 0.01563,-6.73047c0.0094,-4.3869 0.0177,-7.91447 0.01953,-8.76367z"></path></g></g>
</svg>            
                </div>
        
        <div class="mt-4">
            <p>&copy; 2025 RandomBurguer. Todos os direitos reservados.</p>
        </div>
    </div>
</footer>

</body>

</html>