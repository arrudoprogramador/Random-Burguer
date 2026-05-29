<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração de Lanches</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">

        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white p-6">
            <h1 class="text-2xl font-bold">🍔 RandomBurguer</h1>
            <nav class="mt-6">
                <ul>
                    <a href="{{url('/admin')}}"><li class="py-2 px-4 hover:bg-gray-400 rounded mt-2 cursor-pointer">Dashboard</li></a>
                    <a href="{{url('pedidos')}}"><li class="py-2 px-4 hover:bg-gray-700 rounded mt-2 cursor-pointer">Pedidos</li></a>
                    <a href="{{url('clientesCadastrados')}}"><li class="py-2 px-4 hover:bg-gray-700 rounded mt-2 cursor-pointer">Clientes</li></a>
                    <a href="{{url('registerLanche')}}"><li class="py-2 px-4 hover:bg-gray-700 rounded mt-2 cursor-pointer">Registrar Lanches</li></a>
                    <a href="{{url('lanchesCadastrados')}}"><li class="py-2 px-4 bg-gray-400 rounded mt-2 cursor-pointer">Lanches</li></a>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 w-[80%]">
            <h1 class="text-3xl font-semibold mb-4">Lista de Lanches Cadastrados</h1>
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <!-- Formulário de Pesquisa -->
                <div class="icons-left">
                    <form method="GET" action="{{ route('pesquisar.lanches2') }}" class="d-flex">
                        <!-- Input de Pesquisa com largura aumentada -->
                        <input type="text" name="pesquisar" placeholder="Pesquisar por lanches" value="{{ request('pesquisar2') }}" class="form-control w-100 me-2" style="max-width: 600px;">
                        <button type="submit" class="btn btn-primary">Pesquisar</button>
                    </form>
                </div>

                <!-- Cadastrar Novo Lanche -->
                <div class="icons-right">
                    <a href="{{ url('registerLanche') }}" class="btn btn-success btn-lg">+</a>
                </div>
            </div>

            <!-- Tabela de Lanches -->
            <div class="overflow-x-auto bg-white p-4 rounded-lg shadow-md">
                <table class="table table-striped table-bordered w-full">
                    <thead>
                        <tr>
                            <th>Imagem</th>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Preço</th>
                            <th>Editar</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lanches as $l)
                            <tr>
                            
                            <td><img src="{{ url('/img/lanches/' . $l->imagem) }}" alt="Imagem do lanche" width="100" height="100"></td>
                           
                            <td>{{ $l->nome }}</td>
                                <td>{{ $l->descricao }}</td>
                                <td>R$ {{ number_format($l->preco, 2, ',', '.') }}</td> <!-- Formatação do preço -->
                                <td>
                                    <form action="{{ route('lanche.edit', $l->id) }}">
                                        @csrf
                                        
                                        <button type="submit" class="text-yellow-600 hover:text-red-800">Editar</button>
                                    </form>
                                
                                </td>
                                <td>
                                    <form action="{{ route('lanches.destroy', $l->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</body>
</html>
