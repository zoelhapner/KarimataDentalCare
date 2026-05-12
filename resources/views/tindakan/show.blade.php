<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-gray-800">
                Detail Tindakan
            </h2>

            <a href="{{ route('tindakan.index') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow transition">
                ← Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto px-4">

            {{-- Alert --}}
            @if(session('success'))
                <div class="mb-5 rounded-lg bg-green-100 border border-green-300 text-green-800 px-4 py-3">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Card Detail --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

                {{-- Header --}}
                <div class="bg-gradient-to-r from-blue-600 to-blue-500 px-6 py-5 text-white">
                    <h3 class="text-2xl font-bold">
                        {{ $tindakan->tindakan }}
                    </h3>

                    <p class="text-blue-100 mt-1">
                        Detail tindakan pasien
                    </p>
                </div>

                {{-- Content --}}
                <div class="p-6">

                    {{-- Informasi --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div class="bg-gray-50 rounded-xl p-4 border">
                            <p class="text-sm text-gray-500">Dokter</p>
                            <p class="font-semibold text-gray-800">
                                {{ $tindakan->dokter->nama_dokter ?? 'N/A' }}
                            </p>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-4 border">
                            <p class="text-sm text-gray-500">Pasien</p>
                            <p class="font-semibold text-gray-800">
                                {{ $tindakan->pasien->nama_pasien ?? 'N/A' }}
                            </p>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-4 border">
                            <p class="text-sm text-gray-500">Tanggal Visit</p>
                            <p class="font-semibold text-gray-800">
                                {{ \Carbon\Carbon::parse($tindakan->tanggal_visit)->format('d M Y') }}
                            </p>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-4 border">
                            <p class="text-sm text-gray-500">Jam</p>
                            <p class="font-semibold text-gray-800">
                                {{ $tindakan->jam }}
                            </p>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-4 border">
                            <p class="text-sm text-gray-500">Pemakaian Obat</p>
                            <p class="font-semibold text-gray-800">
                                {{ $tindakan->pemakaian_obat }}
                            </p>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-4 border">
                            <p class="text-sm text-gray-500">Tindak Lanjut</p>
                            <p class="font-semibold text-gray-800">
                                {{ $tindakan->tindak_lanjut }}
                            </p>
                        </div>

                    </div>

                    {{-- Table --}}
                    <div class="mt-8">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="text-lg font-bold text-gray-800">
                                Kasus Tindakan
                            </h4>
                        </div>

                        @if($tindakan->kasus->isEmpty())
                            <div class="bg-yellow-50 border border-yellow-200 text-yellow-700 rounded-xl p-4">
                                Belum ada kasus yang ditambahkan.
                            </div>
                        @else

                            <div class="overflow-x-auto border rounded-xl">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase">
                                                Kasus
                                            </th>

                                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase">
                                                Diagnosa
                                            </th>

                                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase">
                                                Tindakan
                                            </th>

                                            <th class="px-6 py-3 text-right text-xs font-bold text-gray-600 uppercase">
                                                Biaya
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody class="bg-white divide-y divide-gray-100">
                                        @foreach ($tindakan->kasus as $kasus)
                                            <tr class="hover:bg-gray-50 transition">
                                                <td class="px-6 py-4 font-medium text-gray-800">
                                                    {{ $kasus->kasus }}
                                                </td>

                                                <td class="px-6 py-4 text-gray-600">
                                                    {{ $kasus->diagnosa }}
                                                </td>

                                                <td class="px-6 py-4 text-gray-600">
                                                    {{ $kasus->tindakan_khusus }}
                                                </td>

                                                <td class="px-6 py-4 text-right font-semibold text-blue-700">
                                                    Rp {{ number_format($kasus->biaya, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        @endif
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>