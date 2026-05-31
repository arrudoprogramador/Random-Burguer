<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                    <a href="{{url('/admin')}}"><li class="py-2 px-4 hover:bg-gray-700 rounded mt-2 cursor-pointer">Dashboard</li></a>
                    <a href="{{url('/pedidos')}}"><li class="py-2 px-4 hover:bg-gray-700 rounded mt-2 cursor-pointer">Pedidos</li></a>
                    <a href="{{url('/clientesCadastrados')}}"><li class="py-2 px-4 bg-gray-400 rounded mt-2 cursor-pointer">Clientes</li></a>
                    <a href="{{url('/registerLanche')}}"><li class="py-2 px-4 hover:bg-gray-700 rounded mt-2 cursor-pointer">Registrar Lanches</li></a>
                    <a href="{{url('lanchesCadastrados')}}"><li class="py-2 px-4 hover:bg-gray-700 rounded mt-2 cursor-pointer">Lanches</li></a>
                </ul>
            </nav>
        </aside>

    <!-- Main Content -->
    <main class="flex-grow-1 p-6">
            <h1 class="mb-4 text-3xl font-semibold">Lista de Clientes Cadastrados</h1>

            <!-- Formulário de Pesquisa -->
            <form method="GET" action="{{ route('admin.clientes.busca') }}" class="mb-4 d-flex">
                <input type="text" name="pesquisar" placeholder="Pesquisar por ID, nome ou email" value="{{ request('pesquisar') }}" class="form-control me-2" style="width: 300px;">
                <button type="submit" class="btn btn-primary">Pesquisar</button>
            </form>

            <!-- Tabela de Clientes -->
            @if($Cliente->isNotEmpty())
                <div class="overflow-x-auto bg-white p-4 rounded-lg shadow-sm">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Data de Nascimento</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Cliente as $c)
                                <tr>
                                    <td>{{ $c->id }}</td>
                                    <td>{{ $c->nome }}</td>
                                    <td>{{ $c->email }}</td>
                                    <td>{{ $c->dataNasc }}</td>
                                    <td>
                                    <form action="{{ route('admin.clientes.destroy', $c->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este cliente?');">
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
            @else
                <p class="mt-4">Nenhum cliente encontrado.</p>
            @endif
        </main>
    </div>

    <!-- Scripts Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
