
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{url('/css/style2.css')}}">
<title>Cadastro</title>
</head>
<body>
    <div class="cont">
        <div class="img">

        </div>
    <div class="contente">
        <div class="cabeçalho">
            <h1 class="text">Seus dados </h1>
            <p>Digite suas informações para se registrar e obter benefícios infinitos</p>
       </div>


        <form id="cadastroForm" method="POST" action="{{ route('cliente.store') }}" enctype="multipart/form-data">
         @csrf
            <input type="text" id="nome" name="nome" placeholder="Nome">
            <p class="error" id="errorNome"></p>

            <input type="text" id="email" name="email" placeholder="E-mail">
            <p class="error" id="errorEmail"></p>


            <input type="date" id="dataNasc" name="dataNasc" placeholder="Data de nascimento">
            <p class="error" id="errorDataNasc"></p>


            <input type="text" id="password" name="password" placeholder="Senha">
            <p class="error" id="errorPassword"></p>

            
            <button class="button" type="submit">Cadastrar-se</button>
        </form>
    </div>
</div>

<script>
        document.getElementById('cadastroForm').addEventListener('submit', function(event) {
            let isValid = true;

            // Limpar mensagens de erro
            document.querySelectorAll('.error').forEach(el => el.textContent = "");

            const nome = document.getElementById('nome').value.trim();
            const email = document.getElementById('email').value.trim();
            const dataNasc = document.getElementById('dataNasc').value;
            const password = document.getElementById('password').value.trim();

            // Validação do nome
            if (nome === '') {
                document.getElementById('errorNome').textContent = "O campo nome é obrigatório.";
                isValid = false;
            }

            // Validação do e-mail
            if (email === '') {
                document.getElementById('errorEmail').textContent = "O campo e-mail é obrigatório.";
                isValid = false;
            } else if (!/^\S+@\S+\.\S+$/.test(email)) {
                document.getElementById('errorEmail').textContent = "Digite um e-mail válido.";
                isValid = false;
            }

            // Validação da data de nascimento
            if (dataNasc === '') {
                document.getElementById('errorDataNasc').textContent = "O campo data de nascimento é obrigatório.";
                isValid = false;
            }

            // Validação da senha
            if (password === '') {
                document.getElementById('errorPassword').textContent = "O campo senha é obrigatório.";
                isValid = false;
            } else if (password.length < 6) {
                document.getElementById('errorPassword').textContent = "A senha deve ter pelo menos 6 caracteres.";
                isValid = false;
            }

            if (!isValid) {
                event.preventDefault(); // Impede o envio do formulário se houver erros
            }
        });
    </script>

</body>
</html>


