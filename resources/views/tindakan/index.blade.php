<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Tindakan') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-4">
        @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        <section class="bg-gray-50 py-5">
            <div class="px-4 mx-auto max-w-screen-2xl lg:px-12">
                <div class="relative overflow-hidden bg-white shadow-md">

                    <div
                        class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
                        {{-- Tombol Tambah Tindakan --}}
                        <div
                            class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                            <a href="{{ route('tindakan.create') }}"
                                class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-primary-700 hover:bg-blue-800 rounded-lg focus:ring-4 focus:ring-blue-300">
                                <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd"
                                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                </svg>
                                Tambah Tindakan
                            </a>
                        </div>

                        {{-- <div class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
                            
                            <form method="GET" action="{{ route('tindakan.index') }}" class="flex items-center space-x-2">
                                <input type="text" name="pasien_query" placeholder="Cari Pasien" class="p-2 border border-gray-300 rounded-lg" value="{{ request('pasien_query') }}">
                                <button id="searchTindakan" type="button" class="px-4 py-2 text-sm font-medium text-white bg-primary-700 hover:bg-blue-800 rounded-lg focus:ring-4 focus:ring-blue-300">
                                    Cari
                                </button>
                            </form>
                        </div> --}}
                        <div class="w-full md:w-80">
                            <input
                                type="text"
                                id="searchTindakan"
                                placeholder="Cari pasien / tindakan / dokter..."
                                class="w-full p-2.5 text-sm border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>

                    </div>

                    {{-- Tabel Tindakan --}}
                    <div class="overflow-x-auto">
                        <table id="tableTindakans" class="w-full text-sm text-left text-gray-500">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-4 py-3">No</th>
                                    <th scope="col" class="px-4 py-3">Nama Dokter</th>
                                    <th scope="col" class="px-4 py-3">Nama Pasien</th>
                                    <th scope="col" class="px-4 py-3">Tindakan</th>
                                    <th scope="col" class="px-4 py-3">Tanggal Visit</th>
                                    <th scope="col" class="px-4 py-3">Jam</th>
                                    <th scope="col" class="px-4 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($tindakans as $tindakan)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-4 py-3">{{ $tindakan->dokter->nama_dokter ?? 'N/A' }}</td>
                                    <!-- Menggunakan relasi dokter -->
                                    <td class="px-4 py-3">{{ $tindakan->pasien->nama_pasien ?? 'N/A' }}</td>
                                    <!-- Menggunakan relasi pasien -->
                                    <td class="px-4 py-3">{{ $tindakan->tindakan }}</td>
                                    <td class="px-4 py-3">{{ $tindakan->tanggal_visit }}</td>
                                    <td class="px-4 py-3">{{ $tindakan->jam }}</td>
                                    <td class="px-4 py-3">
                                        <div class="flex space-x-2">
                                            
                                            <a href="{{ route('tindakan.show', $tindakan->id) }}"
                                                class="px-4 py-2 text-sm font-medium text-white bg-primary-700 hover:bg-green-800 rounded-lg focus:ring-4 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                                Lihat
                                            </a>

                                            
                                            @if(session('user_role') == 'manager')
                                            <a href="{{ route('tindakan.edit', $tindakan->id) }}"
                                                class="px-4 py-2 text-sm font-medium text-white bg-yellow-500 hover:bg-yellow-600 rounded-lg focus:ring-4 focus:ring-yellow-300 dark:focus:ring-yellow-800 ">
                                                Edit
                                            </a>
                                            @endif

                                            
                                            @if(session('user_role') == 'manager')
                                                    <form action="{{ route('tindakan.destroy', $tindakan->id) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus tindakan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-4 py-2 text-sm font-medium text-white bg-red-700 hover:bg-red-800 rounded-lg focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                                Hapus
                                            </button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
    <script>
        $(function() {
            const table = $('#tableTindakans').DataTable({
                serverSide: true,
                processing: true,
                    ajax: {
                        url: "{{ route('tindakan.index') }}",
                    },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'nama_dokter', name: 'dokter.nama_dokter' },
                    { data: 'nama_pasien', name: 'pasien.nama_pasien' },
                    { data: 'tindakan', name: 'tindakan' },
                    { data: 'tanggal_visit', name: 'tanggal_visit' },
                    { data: 'jam', name: 'jam' },
                    { data: 'aksi', name: 'aksi', orderable: false, searchable: false },
                ],
                dom: 'lrtip',
                language: {
                    search: "",
                    searchPlaceholder: "Cari tindakan...",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                    infoEmpty: "Tidak ada data",
                    infoFiltered: "(difilter dari _MAX_ total data)",
                    zeroRecords: "Data tidak ditemukan",
                    paginate: {
                        first: "Awal",
                        last: "Akhir",
                        next: "›",
                        previous: "‹"
                    }
                },

                initComplete: function () {
                    const input = $('.dataTables_filter input');
                    input.removeClass('form-control-sm')
                        .addClass('form-control');
                }
            });

            $('#searchTindakan').on('keyup', function () {
                table.search(this.value).draw();
            });

            $('table').on('click', '.delete-tindakans', function () {

                const tindakanId = $(this).data('id');

                if (confirm('Yakin ingin menghapus data ini?')) {

                    $.ajax({

                        url: `/tindakan/${tindakanId}`,
                        method: 'DELETE',

                        data: {
                            _token: '{{ csrf_token() }}',
                        },

                        success: function (response) {

                            alert('Data berhasil dihapus');

                            table.ajax.reload(null, false);
                        },

                        error: function () {

                            alert('Terjadi kesalahan saat menghapus data');
                        }

                    });
                }
            });


           
        });
    </script>