<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | RandomBurguer</title>
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
                    <a href="{{url('/admin')}}"><li class="py-2 px-4 bg-gray-400 rounded mt-2 cursor-pointer">Dashboard</li></a>
                    <a href="{{url('clientesCadastrados')}}"><li class="py-2 px-4 hover:bg-gray-700 rounded mt-2 cursor-pointer">Clientes</li></a>
                    <a href="{{url('registerLanche')}}"><li class="py-2 px-4 hover:bg-gray-700 rounded mt-2 cursor-pointer">Registrar Lanches</li></a>
                    <a href="{{url('lanchesCadastrados')}}"><li class="py-2 px-4 hover:bg-gray-700 rounded mt-2 cursor-pointer">Lanches</li></a>

                </ul>
            </nav>
        </aside>
        
        
        <!-- Main Content -->
        <main class="flex-1 p-5 w-[80%]">
            <h2 class="text-2xl font-semibold">Dashboard</h2>
            
            <div class="grid grid-cols-3 gap-4 mt-6 w-full">
                <!-- Card 1 -->
                <div class="bg-white p-5 rounded-lg shadow-md w-full h-34">
                    <h3 class="text-md font-medium">Total de Pedidos</h3>
                    <p class="text-xl font-bold">1,230</p>
                </div>
                
                <!-- Card 2 -->
                <div class="bg-white p-4 rounded-lg shadow-md w-full h-34">
                    <h3 class="text-md font-medium">Faturamento</h3>
                    <p class="text-xl font-bold">R$ 45,320</p>
                </div>
                
                <!-- Card 3 -->
                <div class="bg-white p-4 rounded-lg shadow-md w-full h-34">
                    <h3 class="text-md font-medium">Clientes Ativos</h3>
                    <p class="text-xl font-bold">850</p>
                </div>
            </div>
            
            <!-- Gráficos -->
            <div class="mt-6 bg-white p-4 rounded-lg shadow-md w-full h-64">
                <h3 class="text-md font-medium mb-2">Pedidos Mensais</h3>
                <canvas id="ordersChart"></canvas>
            </div>
        </main>
    </div>

    <script>
        const ctx = document.getElementById('ordersChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun'],
                datasets: [{
                    label: 'Pedidos',
                    data: [120, 150, 180, 200, 230, 250],
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
</body>
</html>
