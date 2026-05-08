<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tindakan') }}
        </h2>
    </x-slot>

    <!-- Add Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <!-- Add jQuery and Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <div class="container mx-auto mt-4">
        <form action="{{ route('tindakan.update', $tindakan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="dokter_id" class="block text-gray-700">Dokter:</label>
                <select name="dokter_id" id="dokter_id" class="w-full border border-gray-300 rounded-lg p-2" required>
                    @foreach ($dokters as $dokter)
                    <option value="{{ $dokter->id_dokter }}" {{ $tindakan->dokter_id == $dokter->id_dokter ? 'selected' : '' }}>{{ $dokter->nama_dokter }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="pasien_id" class="block text-gray-700">Pasien:</label>
                <select name="pasien_id" id="pasien_id" class="w-full border border-gray-300 rounded-lg p-2" required>
                    @foreach ($pasiens as $pasien)
                        <option value="{{ $pasien->id_pasien }}" {{ $tindakan->pasien_id == $pasien->id_pasien ? 'selected' : '' }}>{{ $pasien->nama_pasien }}</option>
                    @endforeach
                </select>
            </div>

            <script>
                $(document).ready(function() {
                    var path = "{{ route('autocomplete-pasien') }}";

                    $('#pasien_id').select2({
                        placeholder: 'Cari Pasien',
                        ajax: {
                            url: path,
                            dataType: 'json',
                            delay: 250,
                            processResults: function(data) {
                                return {
                                    results: $.map(data, function(item) {
                                        return {
                                            text: item.nama_pasien,
                                            id: item.id_pasien
                                        }
                                    })
                                };
                            },
                            cache: true
                        }
                    });
                });
            </script>

            <div class="mb-4">
                <label for="tanggal_visit" class="block text-gray-700">Tanggal Visit:</label>
                <input type="date" name="tanggal_visit" id="tanggal_visit" class="w-full border border-gray-300 rounded-lg p-2" value="{{ $tindakan->tanggal_visit }}" required>
            </div>

            <div class="mb-4">
                <label for="jam" class="block text-gray-700">Jam:</label>
                <input type="time" name="jam" id="jam" class="w-full border border-gray-300 rounded-lg p-2" value="{{ $tindakan->jam }}" required>
            </div>

            <div class="mb-4">
                <label for="tindakan" class="block text-gray-700">Tindakan Umum:</label>
                <textarea name="tindakan" id="tindakan" class="w-full border border-gray-300 rounded-lg p-2">{{ $tindakan->tindakan }}</textarea>
            </div>

            <div class="mb-4">
                <label for="pemakaian_obat" class="block text-gray-700">Pemakaian Obat:</label>
                <textarea name="pemakaian_obat" id="pemakaian_obat" class="w-full border border-gray-300 rounded-lg p-2">{{ $tindakan->pemakaian_obat }}</textarea>
            </div>

            <div class="mb-4">
                <label for="tindak_lanjut" class="block text-gray-700">Tindak Lanjut:</label>
                <textarea name="tindak_lanjut" id="tindak_lanjut" class="w-full border border-gray-300 rounded-lg p-2">{{ $tindakan->tindak_lanjut }}</textarea>
            </div>

            <div class="mb-4">
                <label for="kasus" class="block text-gray-700">Kasus:</label>
                <div id="kasus-fields">
                    @foreach ($tindakan->kasus as $kasus)
                    <div class="flex items-center mb-2 kasus-item">
                        <input type="text" name="kasus[]" class="flex-1 border border-gray-300 rounded-lg p-2 mr-2" placeholder="Kasus" value="{{ $kasus->kasus }}" required>
                        <input type="text" name="diagnosa[]" class="flex-1 border border-gray-300 rounded-lg p-2 mr-2" placeholder="Diagnosa" value="{{ $kasus->diagnosa }}" required>
                        <input type="text" name="tindakan_khusus[]" class="flex-1 border border-gray-300 rounded-lg p-2 mr-2" placeholder="Tindakan Khusus" value="{{ $kasus->tindakan_khusus }}">
                        <input type="number" name="biaya[]" class="flex-1 border border-gray-300 rounded-lg p-2 mr-2" placeholder="Biaya" value="{{ $kasus->biaya }}" required>
                        <button type="button" class="remove-kasus bg-red-500 text-white px-2 py-1 rounded">Hapus</button>
                    </div>
                    @endforeach
                </div>
                <button type="button" id="add-kasus" class="btn btn-secondary">Tambah Kasus</button>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>

    <script>
        document.getElementById('add-kasus').addEventListener('click', function() {
            const container = document.getElementById('kasus-fields');
            const field = document.createElement('div');
            field.classList.add('flex', 'items-center', 'mb-2', 'kasus-item');
            field.innerHTML = `
                <input type="text" name="kasus[]" class="flex-1 border border-gray-300 rounded-lg p-2 mr-2" placeholder="Kasus" required>
                <input type="text" name="diagnosa[]" class="flex-1 border border-gray-300 rounded-lg p-2 mr-2" placeholder="Diagnosa" required>
                <input type="text" name="tindakan_khusus[]" class="flex-1 border border-gray-300 rounded-lg p-2 mr-2" placeholder="Tindakan Khusus">
                <input type="number" name="biaya[]" class="flex-1 border border-gray-300 rounded-lg p-2 mr-2" placeholder="Biaya" required>
                <button type="button" class="remove-kasus bg-red-500 text-white px-2 py-1 rounded">Hapus</button>
            `;
            container.appendChild(field);
        });

        document.getElementById('kasus-fields').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-kasus')) {
                e.target.parentElement.remove();
            }
        });
    </script>
</x-app-layout>