{{-- resources/views/tindakan/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Tindakan') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-4">
        {{-- Menampilkan pesan sukses jika ada --}}
        @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        <section class="bg-gray-50 py-5">
            <div class="px-4 mx-auto max-w-screen-2xl lg:px-12">
                <div class="relative overflow-hidden bg-white shadow-md">
                    <div class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
                        <div>
                            <h3 class="text-xl font-semibold">{{ $tindakan->tindakan }}</h3>
                            <p class="text-sm text-gray-500">Dokter: {{ $tindakan->dokter->nama_dokter ?? 'N/A' }}</p> <!-- Menggunakan relasi dokter -->
                            <p class="text-sm text-gray-500">Pasien: {{ $tindakan->pasien->nama_pasien ?? 'N/A' }}</p> <!-- Menggunakan relasi pasien -->
                            <p class="text-sm text-gray-500">Tanggal Visit: {{ \Carbon\Carbon::parse($tindakan->tanggal_visit)->format('d-m-Y') }}</p>
                            <p class="text-sm text-gray-500">Jam: {{ $tindakan->jam }}</p>
                            <p class="text-sm text-gray-500">Pemakaian Obat: {{ $tindakan->pemakaian_obat }}</p>
                            <p class="text-sm text-gray-500">Tindak Lanjut: {{ $tindakan->tindak_lanjut }}</p>
                        </div>
                    </div>

                    <div class="overflow-x-auto mt-6">
                        <h4 class="text-lg font-semibold">Kasus Tindakan:</h4>
                        @if($tindakan->kasus->isEmpty())
                        <p class="text-sm text-gray-500">Belum ada kasus yang ditambahkan.</p>
                        @else
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-4 py-3">Kasus</th>
                                    <th scope="col" class="px-4 py-3">Diagnosa</th>
                                    <th scope="col" class="px-4 py-3">Tindakan</th>
                                    <th scope="col" class="px-4 py-3">Biaya</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tindakan->kasus as $kasus)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-4 py-3">{{ $kasus->kasus }}</td>
                                    <td class="px-4 py-3">{{ $kasus->diagnosa }}</td>
                                    <td class="px-4 py-3">{{ $kasus->tindakan_khusus }}</td>
                                    <td class="px-4 py-3">{{ number_format($kasus->biaya, 2, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('tindakan.index') }}" class="btn btn-primary">Kembali ke Daftar Tindakan</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>