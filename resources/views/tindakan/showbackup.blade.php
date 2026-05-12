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


        <form action="{{ route('tindakan.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="dokter_id" class="block text-gray-700">Dokter:</label>
                <select name="dokter_id" id="dokter_id" class="w-full" required>

                    <option value="">Pilih Dokter</option>

                    @foreach ($dokters as $dokter)
                        <option value="{{ $dokter->id_dokter }}">
                            {{ $dokter->nama_dokter }}
                        </option>
                    @endforeach

                </select>
            </div>

            <div class="mb-4">
                <label for="pasien_id" class="block text-gray-700">Pasien:</label>
                    <select name="pasien_id" id="pasien_id" class="w-full" required>
                        <option value="">Pilih Pasien</option>
                    </select>
            </div>
                {{-- <select name="pasien_id" id="pasien_id" class="w-full border border-gray-300 rounded-lg p-2" required>
                    <option value="">Pilih Pasien</option>
                    @foreach ($pasiens as $pasien)
                        <option value="{{ $pasien->id_pasien }}">{{ $pasien->nama_pasien }}</option>
                    @endforeach
                </select> --}}

            <div class="mb-4">
                <label for="tanggal_visit" class="block text-gray-700">Tanggal Visit:</label>
                <input type="date" name="tanggal_visit" id="tanggal_visit" class="w-full border border-gray-300 rounded-lg p-2" required>
            </div>

            <div class="mb-4">
                <label for="jam" class="block text-gray-700">Jam:</label>
                <input type="time" name="jam" id="jam" class="w-full border border-gray-300 rounded-lg p-2" required>
            </div>

            <div class="mb-4">
                <label for="tindakan" class="block text-gray-700">Tindakan Umum:</label>
                <textarea name="tindakan" id="tindakan" class="w-full border border-gray-300 rounded-lg p-2"></textarea>
            </div>

            <div class="mb-4">
                <label for="pemakaian_obat" class="block text-gray-700">Pemakaian Obat:</label>
                <textarea name="pemakaian_obat" id="pemakaian_obat" class="w-full border border-gray-300 rounded-lg p-2"></textarea>
            </div>

            <div class="mb-4">
                <label for="tindak_lanjut" class="block text-gray-700">Tindak Lanjut:</label>
                <textarea name="tindak_lanjut" id="tindak_lanjut" class="w-full border border-gray-300 rounded-lg p-2"></textarea>
            </div>

            <div class="mb-4">
                <label for="kasus" class="block text-gray-700">Kasus:</label>
                <div id="kasus-fields">
                    <div class="flex items-center mb-2 kasus-item">
                        <input type="text" name="kasus[]" class="flex-1 border border-gray-300 rounded-lg p-2 mr-2" placeholder="Kasus" required>
                        <input type="text" name="diagnosa[]" class="flex-1 border border-gray-300 rounded-lg p-2 mr-2" placeholder="Diagnosa" required>
                        <input type="text" name="tindakan_khusus[]" class="flex-1 border border-gray-300 rounded-lg p-2 mr-2" placeholder="Tindakan">
                        <input type="number" name="biaya[]" class="flex-1 border border-gray-300 rounded-lg p-2 mr-2" placeholder="Biaya" required>
                        <button type="button" class="remove-kasus bg-red-500 text-white px-2 py-1 rounded">Hapus</button>
                    </div>
                </div>
                <button type="button" id="add-kasus" class="btn btn-secondary">Tambah Kasus</button>
            </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-primary-700 hover:bg-primary-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Simpan
                    </button>
                    <a href="{{ route('tindakan.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                        Batal
                    </a>
                </div>
        </form>