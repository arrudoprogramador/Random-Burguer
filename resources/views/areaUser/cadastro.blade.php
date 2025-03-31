@extends('areaUser.layouts.app')

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{url('/css/style2.css')}}">
<title>Cadastro</title>
</head>
<body>
    <div class="con">
        <div class="img">
            
        </div>
    <div class="contente">
        <div class="cabeçalho">
            <h1 class="text">Seus dados </h1>
            <p >Digite suas informações para se registrar e obter benefícios infinitos</p>
       </div>


        <form id="cadastroForm" method="POST" action="{{ route('cliente.store') }}" enctype="multipart/form-data">
         @csrf
            <input type="text1" id="nome" name="nome" placeholder="Nome" require>

            <input type="text1" id="email" name="email" placeholder="E-mail" require>

            <input type="date" id="dataNasc" name="dataNasc" placeholder="Data de nascimento" require>


            <input type="text1" id="password" name="password" placeholder="Senha" require>

            
            <button class="button" type="submit">Cadastrar-se</button>
        </form>
    </div>
</div>



</body>
</html>

@endsection
