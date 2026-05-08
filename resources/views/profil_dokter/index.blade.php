<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profil Dokter') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-4">
        <section class="bg-gray-50 dark:bg-gray-900 py-5 sm:py-7">
            <div class="px-4 mx-auto max-w-screen-lg lg:px-12">
                <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg p-6">
                    {{-- Informasi Dokter --}}
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Informasi Dokter</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Nama Dokter --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Dokter:</label>
                            <p class="text-lg font-semibold text-gray-800 dark:text-white">{{ $dokter->nama_dokter }}</p>
                        </div>

                        {{-- NIP Dokter --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">NIP:</label>
                            <p class="text-lg font-semibold text-gray-800 dark:text-white">{{ $dokter->nip }}</p>
                        </div>

                        {{-- Jadwal Praktik --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jadwal Praktik:</label>
                            <p class="text-lg font-semibold text-gray-800 dark:text-white">{{ $dokter->jadwalpraktik }}</p>
                        </div>

                        {{-- Total Penghasilan --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Total Penghasilan:</label>
                            <p class="text-lg font-semibold text-green-600 dark:text-green-400">Rp{{ number_format($totalPenghasilan, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                {{-- Detail Tindakan Dokter --}}
                <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg mt-6 p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Detail Tindakan</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-4 py-3">Tanggal</th>
                                    <th scope="col" class="px-4 py-3">Pasien</th>
                                    <th scope="col" class="px-4 py-3">Biaya Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tindakan as $item)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-4 py-3">{{ $item->tanggal_visit }}</td>
                                        <td class="px-4 py-3">{{ $item->nama_pasien }}</td>
                                        <td class="px-4 py-3">Rp{{ number_format($item->total_biaya, 0, ',', '.') }}</td>
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
