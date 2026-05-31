<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | RandomBurguer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>
    <style>
      .chart-container {
    position: relative;
    margin: auto;
    height: 300px; /* ou 250px, menor */
    width: 100%;
}

    </style>
</head>
<body class="bg-gray-100">
<div class="flex h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white p-6">
        <h1 class="text-2xl font-bold">🍔 RandomBurguer</h1>
        <nav class="mt-6">
            <ul class="space-y-2">
                <li><a href="{{ url('/admin') }}" class="block py-2 px-4 bg-gray-400 rounded hover:bg-gray-700">Dashboard</a></li>
                <li><a href="{{ url('pedidos') }}" class="block py-2 px-4 hover:bg-gray-700 rounded">Pedidos</a></li>
                <li><a href="{{ url('clientesCadastrados') }}" class="block py-2 px-4 hover:bg-gray-700 rounded">Clientes</a></li>
                <li><a href="{{ url('registerLanche') }}" class="block py-2 px-4 hover:bg-gray-700 rounded">Registrar Lanches</a></li>
                <li><a href="{{ url('lanchesCadastrados') }}" class="block py-2 px-4 hover:bg-gray-700 rounded">Lanches</a></li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    
</body>
</html>