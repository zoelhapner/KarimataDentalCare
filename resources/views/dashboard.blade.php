<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- Dokter Dashboard Section -->
    @if(auth()->check() && session('user_role') == 'dokter')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden p-6">
                <div class="flex items-center space-x-4">
                    <div class="w-20 h-20 bg-gray-300 rounded-full flex items-center justify-center">
                        <svg class="w-10 h-10 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M5.121 17.804A9 9 0 1118.878 6.196M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl text-gray-900">Selamat Datang, <span
                                class="text-blue-600">{{ $dokter->nama_dokter }}</span></h2>
                        <p class="text-gray-500">NIP: {{ $dokter->nip }}</p>
                    </div>
                </div>

                <!-- Filter Periode untuk Dokter -->
                <form method="GET" action="{{ route('dashboard') }}" class="mt-4">
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700">Tanggal
                                Mulai</label>
                            <input type="date" id="start_date" name="start_date"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                value="{{ $startDate }}">
                        </div>
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700">Tanggal Akhir</label>
                            <input type="date" id="end_date" name="end_date"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                value="{{ $endDate }}">
                        </div>
                    </div>
                    <div class="mt-4 text-right">
                        <button type="submit" class="bg-gradient-to-r from-blue-500 to-blue-700 text-black px-6 py-2 rounded-lg hover:from-green-500 hover:to-green-700 transition-all focus:outline-none shadow-lg transform hover:scale-105">Terapkan Filter</button>
                    </div>
                </form>

                <!-- Information Section -->
                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="p-6 bg-gray-100 rounded-lg shadow-md">
                        <p class="text-gray-700 font-medium">Alamat</p>
                        <p class="text-gray-900">{{ $dokter->alamat }}</p>
                    </div>
                    <div class="p-6 bg-gray-100 rounded-lg shadow-md">
                        <p class="text-gray-700 font-medium">Jadwal Praktik</p>
                        <p class="text-gray-900">{{ $dokter->jadwalpraktik }}</p>
                    </div>
                    <div class="p-6 bg-blue-100 rounded-lg shadow-md">
                        <p class="text-blue-700 font-medium">Estimasi Pendapatan</p>
                        <p class="text-blue-900 font-bold text-xl">Rp{{ number_format($biaya) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Manager Dashboard Section -->
    @if(auth()->check() && session('user_role') == 'manager')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden p-6">
                <h2 class="text-xl font-medium text-gray-700">Selamat Datang, <span
                        class="text-blue-600">{{ auth()->user()->name }}</span></h2>
                <p class="font-medium text-gray-700">You're logged in as an {{ session('user_role') }}.</p>

                <!-- Filter Periode -->
                <form method="GET" action="{{ route('dashboard') }}" class="mt-6">
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700">Tanggal
                                Mulai</label>
                            <input type="date" id="start_date" name="start_date"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                value="{{ $startDate }}">
                        </div>
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700">Tanggal Akhir</label>
                            <input type="date" id="end_date" name="end_date"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                value="{{ $endDate }}">
                        </div>
                    </div>
                    <div class="mt-4 text-right">
                        <button type="submit" class="bg-gradient-to-r from-blue-500 to-blue-700 text-white px-6 py-2 rounded-lg hover:from-green-500 hover:to-green-700 transition-all focus:outline-none shadow-lg transform hover:scale-105">Terapkan Filter</button>
                    </div>
                </form>

                <!-- Estimasi Pendapatan Per Dokter Table -->
                <div class="mt-8">
                    <h3 class="text-xl font-medium text-gray-700">Estimasi Pendapatan Per Dokter</h3>
                    @if(isset($dokters) && $dokters->isNotEmpty())
                    <table class="min-w-full table-auto bg-white border rounded-lg shadow-md mt-4">
                        <thead class="bg-blue-400 text-black">
                            <tr>
                                <th class="px-4 py-3 text-left">Nama Dokter</th>
                                <th class="px-4 py-3 text-left">Estimasi Pendapatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dokters as $dokter)
                            <tr class="border-t">
                                <td class="px-4 py-3">{{ $dokter->nama_dokter }}</td>
                                <td class="px-4 py-3">Rp{{ number_format($dokter->biaya) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p class="font-medium text-gray-700 mt-4">Tidak ada data dokter yang tersedia.</p>
                    @endif
                </div>

                <!-- Grafik Pendapatan Klinik -->
                <div class="mt-8">
                    <h3 class="text-xl font-medium text-gray-700">Grafik Pendapatan Klinik</h3>
                    <canvas id="financialChart" width="400" height="200"></canvas>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                <script>
                    var chartLabels = @json($chartLabels); // Labels bulan
                    var chartData = @json($chartData); // Data pendapatan klinik

                    var ctx = document.getElementById('financialChart').getContext('2d');
                    var financialChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: chartLabels,
                            datasets: [{
                                label: 'Pendapatan Klinik (Rp)',
                                data: chartData,
                                borderColor: 'rgb(75, 192, 192)',
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                fill: true,
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                tooltip: {
                                    mode: 'index',
                                    intersect: false,
                                },
                            },
                            scales: {
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Bulan'
                                    }
                                },
                                y: {
                                    title: {
                                        display: true,
                                        text: 'Pendapatan (Rp)'
                                    },
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                </script>

            </div>
        </div>
    </div>
    @endif

</x-app-layout>