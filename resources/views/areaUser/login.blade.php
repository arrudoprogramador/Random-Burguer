

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
    <link rel="stylesheet" href="{{url('/css/style3.css')}}">

</head>

<body>


@if(auth()->check())
    {{ auth()->user()->name }} <a href="{{route('login.destroy')}}">SAIR</a>
@else
    @if(session('success'))
        <span class="text-success">{{ session('success') }}</span>
    @endif

    @if(session('error'))
        <span class="text-danger">{{ session('error') }}</span>
    @endif
    <div class="contain">
    <div class="img">
             <img src="{{ url('img/yeloow.png') }}" alt="Tela de cadastro"> 
    </div>
    <div class="content">

        <form method="post" action="{{ route('login.store') }}">
            @csrf
            <div class="cabeçalho" >
            <h1 class="text">Que alegria te ver novamente por aqui!</h1>
            <p class="p">Insira seus dados e aproveite benefícios infinitos</p>
       </div>
                <!-- Campo de email -->
                <input class="input_text" type="text" value="{{ old('email') }}" name="email" id="email" placeholder="E-mail" required>
                @if($errors->has('email'))
                    <div class="text-danger">{{ $errors->first('email') }}</div>
                @endif
                
                <!-- Campo de senha -->
                <input type="password" name="password" id="senha" placeholder="Senha" required>
                @if($errors->has('password'))
                    <div class="text-danger">{{ $errors->first('password') }}</div>
                @endif

            <button type="submit">Entrar</button>
            <a href="/cadastro"><p class="esqueceu">Não tem nenhuma conta?</p></a>
        </form>
    </div>
    </div>
@endif
</body>
</html>
