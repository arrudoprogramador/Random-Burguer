@extends('areaUser.layouts.app')

@section('content')

    <link rel="stylesheet" href="{{ url('/css/carrinho.css') }}">

    <title>Carrinho</title>

    <div class="container">
        <div class="contente">
            <div class="box1">
                <div class="titlee">Meu carrinho</div>
                <p class="p">Itens</p>

                @php
                    $total = 0;
                @endphp

                @if(session('carrinho') && count(session('carrinho')) > 0)
                    <table>
                        <thead>
                            <tr>
                                <th>Imagem</th>
                                <th>Nome</th>
                                <th>Preço</th>
                                <th>Quantidade</th>
                                <th>Subtotal</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0;
                            @endphp

                            @foreach(session('carrinho') as $id => $item)
                                @php
                                    $subtotal = $item['preco'] * $item['quantidade'];
                                    $total += $subtotal;
                                @endphp
                                <tr>
                                    <td><img src="{{ url('/img/lanches/' . $item['imagem']) }}" alt="Imagem do produto" class="produto-imagem" width="50"></td>
                                    <td>{{ $item['nome'] }}</td>
                                    <td>R$ {{ number_format($item['preco'], 2, ',', '.') }}</td>
                                    <td>
                                        <form action="{{ route('carrinho.atualizar', $id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="number" name="quantidade" value="{{ $item['quantidade'] }}" min="1" class="quantidade">
                                            <button type="submit" class="btn btn-primary">Atualizar</button>
                                        </form>
                                    </td>
                                    <td>R$ {{ number_format($subtotal, 2, ',', '.') }}</td>
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
                    <div class="titlee">Resumo da Compra</div>
                    <div class="card_content">
                        <div class="box2_viado">
                            <p>Itens: {{ session('carrinho') ? count(session('carrinho')) : 0 }}</p>
                        </div>
                    </div>
                    <div class="card_footer">
                        <div class="box2_viado">
                            <p>Total a pagar:</p>
                            <p>R$ {{ number_format($total, 2, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
                <button class="btn" type="submit">Continuar a compra &rarr;</button>
            </div>
        </div>
    </div>

@endsection
