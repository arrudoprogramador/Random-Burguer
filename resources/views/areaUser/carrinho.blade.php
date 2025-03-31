@extends('areaUser.layouts.app')

@section('content')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{url('/css/carrinho.css')}}">

    <title>Carrinho</title>
</head>
<body>
    <div class="container">
        <div class="contente">
            <div class="box1">
                <div class="titlee">Meu carrinho</div>
                <p class="p">Itens</p>
                @if(session('carrinho'))
                    <table>
                        <thead>
                            <tr>
                                <th>Imagem</th>
                                <th>Nome</th>
                                <th>Preço</th>
                                <th>Quantidade</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Exemplo de um item -->
                            @foreach(session('carrinho') as $id => $item)
                            <tr>
                                <td><img src="{{ url('/img/lanches/' . $item['imagem']) }}" alt="Imagem do produto" class="produto-imagem" width="50"></td>
                                <td>{{ $item['nome'] }}</td>
                                <td>R$ {{ number_format($item['preco'], 2, ',', '.') }}</td>
                                <td>
                                    <input type="number" value="{{ $item['quantidade'] }}" min="1" class="quantidade">
                                </td>
                                <td>
                                    <form action="{{ route('carrinho.remover', $id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Remover</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Seu carrinho está vazio.</p>
                @endif
            </div>
            
            <div class="paibox">
                <div class="box2">
                    <div class="titlee">Comprar</div>
                    <div class="card_content">
                        <div class="box2_viado">
                            <p>Itens: {{ count(session('carrinho')) }}</p>
                        </div>
                        <div class="box2_viado">
                            <p>Desconto:</p>
                            <p>_</p>
                        </div>
                    </div>
                    <div class="card_footer">
                        <div class="box2_viado">
                            <p>Total a pagar:</p>
                        </div>
                    </div>
                </div>
                <button class="btn" type="submit">Continuar a compra &rarr;</button>
            </div>
        </div>
    </div>
</body>
</html>

@endsection