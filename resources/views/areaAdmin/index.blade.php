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
    <main class="flex-1 p-8 overflow-y-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Dashboard</h1>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-gray-500 text-sm font-medium">Total Arrecadado</h3>
                <p class="text-2xl font-bold text-gray-800">R$ {{ number_format($totalArrecadado, 2, ',', '.') }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-gray-500 text-sm font-medium">Total de Pedidos</h3>
                <p class="text-2xl font-bold text-gray-800">{{ $totalPedidos ?? '0' }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-gray-500 text-sm font-medium">Lanche Mais Vendido</h3>
                @if($maisVendido)
                    <p class="text-2xl font-bold text-gray-800">{{ $maisVendido->nomeLanche }}</p>
                    <p class="text-gray-600">{{ $maisVendido->quant_vendas }} vendas</p>
                @else
                    <p class="text-gray-600">Nenhum lanche cadastrado.</p>
                @endif
            </div>
        </div>

        <!-- Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Vendas por Lanche</h3>
                <div class="chart-container h-64 max-h-64">
                    <canvas id="barChart"></canvas>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Top Lanches Mais Vendidos</h3>
                <div id="pieChart" style="height: 300px;"></div>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white p-6 rounded-lg shadow mt-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Todos os Lanches e suas Vendas</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Lanche</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Vendas</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($vendasLanches as $vendasLanche)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $vendasLanche->nomeLanche }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $vendasLanche->quant_vendas }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const lanchesData = @json($vendasLanches);
        const topLanchesData = @json($topLanches);

        // Bar Chart
        const barCtx = document.getElementById('barChart').getContext('2d');
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: lanchesData.map(l => l.nomeLanche),
                datasets: [{
                    label: 'Quantidade de Vendas',
                    data: lanchesData.map(l => l.quant_vendas),
                    backgroundColor: 'rgba(79, 70, 229, 0.7)',
                    borderColor: 'rgba(79, 70, 229, 1)',
                    borderWidth: 1
                }]
            },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 50 // <- aqui muda para 50
                    }
                }
            }
        }

        });

        // Pie Chart
            const pieChart = echarts.init(document.getElementById('pieChart'));
            pieChart.setOption({
                tooltip: {
                    trigger: 'item',
                    formatter: '{a} <br/>{b}: {c} ({d}%)'
                },
                
                series: [{
                    name: 'Vendas',
                    type: 'pie',
                    radius: '60%', // pizza tradicional
                    avoidLabelOverlap: false,
                    itemStyle: {
                        borderRadius: 5,
                        borderColor: '#fff',
                        borderWidth: 1
                    },
                    label: {
                        show: true,
                        position: 'outside'
                    },
                    emphasis: {
                        label: {
                            show: false,
                            fontSize: 16,
                            fontWeight: 'bold'
                        }
                    },
                    labelLine: {
                        show: true
                    },
                    data: topLanchesData.map(item => ({
                        value: item.quant_vendas,
                        name: item.nomeLanche
                    }))
                }]
            })
        });
</script>
</body>
</html>