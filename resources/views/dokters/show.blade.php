<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Detail Dokter') }}
        </h2>
    </x-slot>

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
                        <h2 class="text-2xl font-semibold text-gray-900">{{ $dokter->nama_dokter }}</h2>
                        <p class="text-gray-500">NIP: {{ $dokter->nip }}</p>
                    </div>
                </div>

                <!-- Filter Periode untuk Dokter -->
                <form method="GET" action="{{ route('dokters.show', $dokter->id_dokter) }}" class="mt-4">
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

                <!-- Informasi Dokter -->
                <div class="mt-6 grid grid-cols-1 lg:grid-cols-3 gap-6">

                    {{-- LEFT CONTENT --}}
                    <div class="lg:col-span-2 space-y-6">

                        {{-- ALAMAT --}}
                        <div class="p-6 bg-gray-50 rounded-2xl border border-gray-200 shadow-sm">

                            <h3 class="text-lg font-semibold text-gray-800 mb-2">
                                Alamat
                            </h3>

                            <p class="text-gray-700 leading-relaxed">
                                {{ $dokter->alamat }}
                            </p>

                        </div>

                        {{-- STATUS --}}
                        @php
                            $today = strtolower(now()->locale('id')->dayName);
                            $todaySchedule = $dokter->jadwalpraktikbaru[$today] ?? null;
                            $isOpenNow = false;
                            if ($todaySchedule && ($todaySchedule['aktif'] ?? false)) {
                                $now = now()->format('H:i');
                                $isOpenNow =
                                    $now >= $todaySchedule['buka'] &&
                                    $now <= $todaySchedule['tutup'];
                            }
                        @endphp

                        <div class="flex items-center">
                            @if($isOpenNow)
                                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-green-100 text-green-700 text-sm font-semibold">
                                    <span class="w-2 h-2 rounded-full bg-green-500"></span>
                                    Buka Sekarang
                                </div>
                            @else
                                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-red-100 text-red-700 text-sm font-semibold">
                                    <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                    Tutup
                                </div>
                            @endif
                        </div>

                        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm">
                            <div class="px-5 py-4 border-b border-gray-100 bg-gray-50">
                                <h3 class="font-semibold text-gray-800">
                                    Jadwal Praktik
                                </h3>
                                <p class="text-sm text-gray-500 mt-1">
                                    Jam operasional dokter
                                </p>
                            </div>
                            @php
                                $days = [
                                    'senin' => 'Senin',
                                    'selasa' => 'Selasa',
                                    'rabu' => 'Rabu',
                                    'kamis' => 'Kamis',
                                    'jumat' => 'Jumat',
                                    'sabtu' => 'Sabtu',
                                    'minggu' => 'Minggu',
                                ];
                            @endphp
                            @foreach($days as $key => $label)
                                @php
                                    $jadwal = $dokter->jadwalpraktikbaru[$key] ?? null;
                                @endphp
                                <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100 last:border-b-0 hover:bg-gray-50 transition">
                                    <div class="font-medium text-gray-700">
                                        {{ $label }}
                                    </div>
                                    @if($jadwal && ($jadwal['aktif'] ?? false))
                                        <div class="flex items-center gap-3">
                                            <span class="text-gray-800 font-medium">
                                                {{ $jadwal['buka'] }} - {{ $jadwal['tutup'] }}
                                            </span>
                                            <span class="w-2 h-2 rounded-full bg-green-500"></span>
                                        </div>
                                    @else
                                        <div class="flex items-center gap-3">
                                            <span class="text-red-500 font-medium">
                                                Tutup
                                            </span>
                                            <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <div class="p-6 bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl border border-blue-200 shadow-sm sticky top-6">
                            <p class="text-blue-700 font-semibold mb-2">
                                Estimasi Pendapatan
                            </p>
                            <h2 class="text-3xl font-bold text-blue-900">
                                Rp{{ number_format($penghasilanDokter, 0, ',', '.') }}
                            </h2>
                            <p class="mt-3 text-sm text-blue-700">
                                Berdasarkan total tindakan pada periode yang dipilih.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>