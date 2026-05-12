<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Tindakan') }}
        </h2>
    </x-slot>

    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" /> --}}

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script> --}}

    <div class="container mx-auto mt-4">
        <form action="{{ route('tindakan.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="bg-white shadow-sm rounded-2xl border border-gray-200 p-6">

                <div class="mb-6">
                    {{-- <h2 class="text-2xl font-bold text-gray-800">
                        Tambah Tindakan
                    </h2> --}}

                    <p class="text-sm text-gray-500 mt-1">
                        Input data tindakan pasien
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div>
                        <label for="dokter_id" class="block mb-2 text-sm font-semibold text-gray-700">
                            Dokter
                        </label>

                        <select name="dokter_id"
                                id="dokter_id"
                                class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                required>

                            <option value="">Pilih Dokter</option>

                            @foreach ($dokters as $dokter)
                                <option value="{{ $dokter->id_dokter }}">
                                    {{ $dokter->nama_dokter }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="pasien_id" class="block mb-2 text-sm font-semibold text-gray-700">
                            Pasien
                        </label>

                        <select name="pasien_id"
                                id="pasien_id"
                                class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                required>

                            <option value="">Pilih Pasien</option>
                        </select>
                    </div>

                    <div>
                        <label for="tanggal_visit" class="block mb-2 text-sm font-semibold text-gray-700">
                            Tanggal Visit
                        </label>

                        <input type="date"
                            name="tanggal_visit"
                            id="tanggal_visit"
                            class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                            required>
                    </div>

                    <div>
                        <label for="jam" class="block mb-2 text-sm font-semibold text-gray-700">
                            Jam
                        </label>

                        <input type="time" name="jam" id="jam" class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                </div>

                <div class="mt-6 space-y-5">

                    <div>
                        <label for="tindakan" class="block mb-2 text-sm font-semibold text-gray-700">
                            Tindakan Umum
                        </label>

                        <textarea name="tindakan" id="tindakan" rows="3" class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500"></textarea>
                    </div>

                    <div>
                        <label for="pemakaian_obat" class="block mb-2 text-sm font-semibold text-gray-700">
                            Pemakaian Obat
                        </label>

                        <textarea name="pemakaian_obat" id="pemakaian_obat" rows="3" class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500"></textarea>
                    </div>

                    <div>
                        <label for="tindak_lanjut" class="block mb-2 text-sm font-semibold text-gray-700">
                            Tindak Lanjut
                        </label>

                        <textarea name="tindak_lanjut" id="tindak_lanjut" rows="3" class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500"></textarea>
                    </div>

                </div>
            </div>

            {{-- Kasus --}}
            <div class="bg-white shadow-sm rounded-2xl border border-gray-200 p-6">

                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">
                            Kasus Tindakan
                        </h3>

                        <p class="text-sm text-gray-500">
                            Tambahkan detail kasus pasien
                        </p>
                    </div>

                    <button type="button" id="add-kasus" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl transition">
                        + Tambah Kasus
                    </button>
                </div>

                <div id="kasus-fields" class="space-y-4">

                    <div class="kasus-item border border-gray-200 rounded-2xl p-4 bg-gray-50">

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

                            <input type="text" name="kasus[]" placeholder="Kasus" class="rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500" required>

                            <input type="text"
                                name="diagnosa[]"
                                placeholder="Diagnosa"
                                class="rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                required>

                            <input type="text"
                                name="tindakan_khusus[]"
                                placeholder="Tindakan"
                                class="rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                            <input type="text"
                                name="biaya[]"
                                placeholder="Biaya"
                                class="rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                required>

                        </div>

                        <div class="mt-4 text-right">
                            <button type="button"
                                    class="remove-kasus bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl transition">
                                Hapus
                            </button>
                        </div>

                    </div>

                </div>
            </div>

            {{-- Footer --}}
            <div class="flex items-center justify-end gap-3">

                <a href="{{ route('tindakan.index') }}"
                class="px-5 py-2.5 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-100 transition">
                    Batal
                </a>

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2.5 rounded-xl shadow-sm transition">
                    Simpan
                </button>

            </div>

        </form>
    </div>

    <script>
        function formatRupiah(value) {
            value = value.replace(/[^\d]/g, '');

            return new Intl.NumberFormat('id-ID').format(value);
        }

        function attachRupiahFormat(input) {

            input.addEventListener('input', function() {

                let cursorPos = this.selectionStart;
                let oldLength = this.value.length;

                this.value = formatRupiah(this.value);

                let newLength = this.value.length;

                cursorPos = cursorPos + (newLength - oldLength);

                this.setSelectionRange(cursorPos, cursorPos);
            });

        }

        document.querySelectorAll('input[name="biaya[]"]').forEach(input => {
            attachRupiahFormat(input);
        });
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
            const newBiayaInput = field.querySelector('input[name="biaya[]"]');

            attachRupiahFormat(newBiayaInput);
        });

        document.getElementById('kasus-fields').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-kasus')) {
                e.target.parentElement.remove();
            }
        });
    </script>
</x-app-layout>
            <script>
            $(document).ready(function () {
                $('#dokter_id').select2({
                    placeholder: 'Pilih Dokter',
                    width: '100%'
                });
                $('#pasien_id').select2({

                    placeholder: 'Pilih Pasien',
                    allowClear: true,
                    width: '100%',

                    ajax: {

                        url: "{{ route('autocomplete-pasien') }}",
                        dataType: 'json',
                        delay: 250,

                        data: function (params) {
                            return {
                                q: params.term
                            };
                        },

                        processResults: function (data) {

                            return {
                                results: $.map(data, function (item) {

                                    return {
                                        id: item.id_pasien,
                                        text: item.nama_pasien
                                    }

                                })
                            };
                        },

                        cache: true
                    }
                });

            });
            </script>
            {{-- <script>
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
            </script> --}}