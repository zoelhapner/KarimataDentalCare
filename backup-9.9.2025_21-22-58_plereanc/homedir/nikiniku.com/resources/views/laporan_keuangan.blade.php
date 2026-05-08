<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan Keuangan') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-4">
        <section class="bg-gray-50 dark:bg-gray-900 py-3 sm:py-5">
            <div class="px-4 mx-auto max-w-screen-2xl lg:px-12">
                <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                    {{-- Form Filter Tanggal --}}
                    <div class="p-4">
                        <form method="GET" class="flex flex-col md:flex-row items-center space-y-3 md:space-y-0 md:space-x-4">
                            <div class="flex flex-col">
                                <label for="start_date" class="text-sm font-medium text-gray-700 dark:text-gray-300">Mulai Tanggal:</label>
                                <input type="date" id="start_date" name="start_date" value="{{ $startDate }}"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <div class="flex flex-col">
                                <label for="end_date" class="text-sm font-medium text-gray-700 dark:text-gray-300">Sampai Tanggal:</label>
                                <input type="date" id="end_date" name="end_date" value="{{ $endDate }}"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-primary-700 hover:bg-blue-800 rounded-lg focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Tampilkan
                            </button>
                        </form>
                    </div>

                    {{-- Ringkasan Keuangan --}}
                    <div class="p-4 border-t border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Total Pemasukan:
                            <span class="text-blue-600">Rp{{ number_format($totalPemasukan, 0, ',', '.') }}</span>
                        </h3>
                        <h4 class="text-md font-medium text-gray-600 dark:text-gray-300 mt-2">Pembagian:</h4>
                        <ul class="list-disc pl-6 mt-2">
                            <li class="text-gray-700 dark:text-gray-400">Dokter (40%):
                                <span class="text-green-600">Rp{{ number_format($dokterShare, 0, ',', '.') }}</span>
                            </li>
                            <li class="text-gray-700 dark:text-gray-400">Klinik (60%):
                                <span class="text-green-600">Rp{{ number_format($klinikShare, 0, ',', '.') }}</span>
                            </li>
                        </ul>
                    </div>

                    {{-- Tabel Detail Transaksi --}}
                    <div class="overflow-x-auto p-4">
                        <h4 class="text-md font-medium text-gray-600 dark:text-gray-300 mb-4">Detail Transaksi:</h4>
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-4 py-3">Nama Dokter Yang Menangani</th>
                                    <th scope="col" class="px-4 py-3">Total Transaksi</th>
                                    <th scope="col" class="px-4 py-3">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksi as $item)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-4 py-3">{{ $item->tindakan->dokter->nama_dokter }}</td>
                                    <td class="px-4 py-3">Rp{{ number_format($item->total_biaya, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3">{{ $item->created_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Estimasi Pendapatan Dokter --}}
                    <div class="overflow-x-auto p-4">
                        <h4 class="text-md font-medium text-gray-600 dark:text-gray-300 mb-4">Estimasi Pendapatan Dokter:</h4>
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-4 py-3">Nama Dokter</th>
                                    <th scope="col" class="px-4 py-3">Estimasi Pendapatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dokters as $dokter)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-4 py-3">{{ $dokter->nama_dokter }}</td>
                                    <td class="px-4 py-3">Rp{{ number_format($dokter->biaya, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>