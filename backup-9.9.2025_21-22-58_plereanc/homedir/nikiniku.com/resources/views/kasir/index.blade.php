<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaksi Kasir') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-4">
        <section class="bg-gray-50 dark:bg-gray-900 py-3 sm:py-5">
            <div class="px-4 mx-auto max-w-screen-2xl lg:px-12">
                <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                    {{-- Tabel Transaksi --}}
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-4 py-3">Tanggal</th>
                                    <th scope="col" class="px-4 py-3">Dokter</th>
                                    <th scope="col" class="px-4 py-3">Pasien</th>
                                    <th scope="col" class="px-4 py-3">Total Biaya</th>
                                    <th scope="col" class="px-4 py-3">Dibayar</th>
                                    <th scope="col" class="px-4 py-3">Kembalian</th>
                                    <th scope="col" class="px-4 py-3">Metode Pembayaran</th>
                                    <th scope="col" class="px-4 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksi as $kasir)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-4 py-3">{{ $kasir->tindakan->tanggal_visit }}</td>
                                    <td class="px-4 py-3">{{ $kasir->tindakan->dokter->nama_dokter ?? 'N/A' }}</td> <!-- Menggunakan relasi dokter -->
                                    <td class="px-4 py-3">{{ $kasir->tindakan->pasien->nama_pasien ?? 'N/A' }}</td> <!-- Menggunakan relasi pasien -->
                                    <td class="px-4 py-3">{{ number_format($kasir->total_biaya, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3">{{ number_format($kasir->dibayar, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3">{{ number_format($kasir->kembalian, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3">{{ $kasir->metode_pembayaran }}</td>
                                    <td class="px-4 py-3">
                                        <div class="flex space-x-2">
                                            {{-- Tombol Detail --}}
                                            <a href="{{ route('kasir.show', $kasir->id) }}"
                                                class="px-4 py-2 text-sm font-medium text-white bg-blue-700 hover:bg-blue-800 rounded-lg focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                Detail
                                            </a>
                                            {{-- Tombol Bayar --}}
                                            <a href="{{ route('kasir.edit', $kasir->id) }}"
                                                class="px-4 py-2 text-sm font-medium text-white bg-green-700 hover:bg-green-800 rounded-lg focus:ring-4 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                                Bayar
                                            </a>
                                            {{-- Tombol Print Nota --}}
                                            <a href="{{ route('kasir.print', $kasir->id) }}" target="_blank" 
                                                class="px-4 py-2 text-sm font-medium text-white bg-yellow-500 hover:bg-yellow-600 rounded-lg focus:ring-4 focus:ring-yellow-300 dark:bg-yellow-400 dark:hover:bg-yellow-500 dark:focus:ring-yellow-600">
                                                Print Nota
                                            </a>
                                        </div>
                                    </td>
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