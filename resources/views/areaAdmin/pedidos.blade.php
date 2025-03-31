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
                    <a href="{{url('/pedidos')}}"><li class="py-2 px-4 bg-gray-400 rounded mt-2 cursor-pointer">Pedidos</li></a>
                    <a href="{{url('/clientesCadastrados')}}"><li class="py-2 px-4 hover:bg-gray-700 rounded mt-2 cursor-pointer">Clientes</li></a>
                    <a href="{{url('/registerLanche')}}"><li class="py-2 px-4 hover:bg-gray-400 rounded mt-2 cursor-pointer">Registrar Lanches</li></a>
                    <a href="{{url('lanchesCadastrados')}}"><li class="py-2 px-4 hover:bg-gray-700 rounded mt-2 cursor-pointer">Lanches</li></a>

                </ul>
            </nav>
        </aside>




</body>
</html>