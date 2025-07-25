<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Lanche</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body class="bg-gray-100 flex h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white p-6">
        <h1 class="text-2xl font-bold">🍔 RandomBurguer</h1>
        <nav class="mt-6">
            <ul class="space-y-2">
                <li><a href="{{ url('/admin') }}" class="block py-2 px-4 hover:bg-gray-700 rounded">Dashboard</a></li>
                <li><a href="{{ url('/pedidos') }}" class="block py-2 px-4 hover:bg-gray-700 rounded">Pedidos</a></li>
                <li><a href="{{ url('/clientesCadastrados') }}" class="block py-2 px-4 hover:bg-gray-700 rounded">Clientes</a></li>
                <li><a href="{{ url('/registerLanche') }}" class="block py-2 px-4 bg-gray-400 rounded">Registrar Lanches</a></li>
                <li><a href="{{ url('/lanchesCadastrados') }}" class="block py-2 px-4 hover:bg-gray-400 rounded">Lanches</a></li>
            </ul>
        </nav>
    </aside>
    
    <main class="flex-1 p-4 w-[80%]">
        <h2 class="text-2xl font-semibold">Editar Lanche {{ $lanche->nomeLanche }}</h2>

        <div class="flex justify-center items-center w-full p-3">
        <div class="max-w-4xl w-full bg-white p-6 rounded-lg shadow-md">
        <!-- Alteração do método para PUT (atualizar) -->
        <form method="post" action="{{ route('lanche.update', $lanche->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
                
                <div class="mb-4 text-center">
                    <h3 class="text-lg font-bold bg-primary text-white p-2 rounded">INFORMAÇÕES DO LANCHE</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                    <div class="flex flex-col items-center">
                        <!-- Exibe a imagem atual do lanche ou a imagem padrão -->
                        <img id="preview" src="{{ $lanche->fotoLanche ? url('img/lanches/' . $lanche->fotoLanche) : url('/img/sub2.jpg') }}" alt="Imagem do produto" class="rounded-lg w-full h-48 object-cover border border-gray-300">
                        <label for="fotoLanche" class="btn btn-light mt-2">Carregar Imagem</label>
                        <input type="file" id="fotoLanche" name="fotoLanche" accept="image/*" class="hidden">
                    </div>
                    <div class="md:col-span-2">
                        <div class="mb-3">
                            <label for="nomeLanche" class="form-label">Nome:</label>
                            <!-- Preenche o nome do lanche no campo de entrada -->
                            <input type="text" class="form-control" name="nomeLanche" id="nomeLanche" value="{{ old('nomeLanche', $lanche->nomeLanche) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="descLanche" class="form-label">Descrição:</label>
                            <!-- Preenche a descrição do lanche no campo de entrada -->
                            <textarea class="form-control" name="descLanche" id="descLanche">{{ old('descLanche', $lanche->descLanche) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="valorLanche" class="form-label">Preço:</label>
                            <!-- Preenche o preço do lanche no campo de entrada -->
                            <input type="text" class="form-control" step="0.01" min="0" name="valorLanche" id="valorLanche" value="{{ old('valorLanche', $lanche->valorLanche) }}" placeholder="Ex: 12.5" required>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success px-4 py-2">Atualizar Produto</button>
                </div>
            </form>
        </div>
        </div>
    </main>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        

        // Atualizar a imagem de pré-visualização quando o usuário selecionar uma imagem
        document.getElementById('fotoLanche').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('preview');
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>
