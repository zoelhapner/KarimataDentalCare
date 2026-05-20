{{-- resources/views/dokters/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl text-black-400 leading-tight">
            {{ __('Daftar Dokter') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-4">
        {{-- Menampilkan pesan sukses jika ada --}}
        @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        <section class="bg-gray-100 py-5">

            <div class="px-4 mx-auto max-w-screen-2xl lg:px-12">

                <div class="overflow-hidden bg-white border border-gray-200 shadow-sm rounded-2xl">

                    {{-- HEADER --}}
                    <div class="flex flex-col gap-4 px-6 py-5 border-b border-gray-200 lg:flex-row lg:items-center lg:justify-between">

                        <div>
                            {{-- <h1 class="text-2xl font-bold text-black-800">
                                Data Dokter
                            </h1> --}}

                            <p class="mt-1 text-sm text-black-400">
                                Daftar seluruh dokter Karimata Dental Care
                            </p>
                        </div>

                        <div class="flex items-center gap-3">

                            {{-- Tambah --}}
                            <a href="{{ route('dokters.create') }}"
                                class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-primary-700 hover:bg-blue-800 rounded-lg focus:ring-4 focus:ring-blue-300">

                                <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd"
                                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                </svg>

                                Tambah Dokter
                            </a>

                            {{-- Delete --}}
                            <button id="delete-selected"
                                type="button"
                                class="hidden inline-flex items-center px-4 py-2.5 text-sm font-medium text-white transition bg-red-500 rounded-xl hover:bg-red-600">

                                <svg class="w-4 h-4 mr-2"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M19 7L5 7M10 11V17M14 11V17M6 7L7 19C7.1 20.1 7.9 21 9 21H15C16.1 21 16.9 20.1 17 19L18 7M9 7V4C9 3.4 9.4 3 10 3H14C14.6 3 15 3.4 15 4V7" />
                                </svg>

                                Hapus Dokter
                            </button>

                        </div>
                    </div>

                    {{-- TABLE --}}
                    <div class="overflow-x-auto">

                        <form id="deleteForm"
                            action="{{ route('dokters.destroy', ['dokter' => 'ID_PLACEHOLDER']) }}"
                            method="POST">

                            @csrf
                            @method('DELETE')

                            <input type="hidden"
                                name="dokter_id"
                                id="dokter_id">
                        </form>

                        <table id="tableDokters" class="w-full text-sm text-left text-black-400">

                            <thead class="text-xs tracking-wider text-black-400 uppercase bg-gray-50 border-b border-gray-200">

                                <tr>

                                    <th class="p-4">
                                        <input id="checkbox-all"
                                            type="checkbox"
                                            class="w-4 h-4 text-blue-600 border-gray-300 rounded">
                                    </th>

                                    <th class="px-6 py-4">No</th>
                                    <th class="px-6 py-4">Nama</th>
                                    <th class="px-6 py-4">Role</th>
                                    <th class="px-6 py-4">NIP</th>
                                    <th class="px-6 py-4">Alamat</th>
                                    <th class="px-6 py-4">Tanggal Lahir</th>
                                    <th class="px-6 py-4">NIK</th>
                                    <th class="px-6 py-4">No HP</th>
                                    <th class="px-6 py-4">Jadwal Praktik</th>
                                    <th class="px-6 py-4">Pendapatan</th>
                                    <th class="px-6 py-4">Aksi</th>
                                </tr>

                            </thead>

                            <tbody class="divide-y divide-gray-100 bg-white">
                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </section>
    </div>

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.dokter-checkbox');
            const deleteButton = document.getElementById('delete-selected');
            const deleteForm = document.getElementById('deleteForm');
            const dokterIdInput = document.getElementById('dokter_id');
            let selectedDokterId = null;

            // Handle checkbox change
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const dokterId = this.getAttribute('data-id');

                    if (this.checked) {
                        selectedDokterId = dokterId;
                        deleteButton.classList.remove('hidden'); // Show delete button
                        dokterIdInput.value = selectedDokterId;
                        deleteForm.action = deleteForm.action.replace('ID_PLACEHOLDER', dokterId);
                    } else {
                        selectedDokterId = null;
                        deleteButton.classList.add('hidden'); // Hide delete button
                    }
                });
            });

            // Handle delete selected form
            deleteButton.addEventListener('click', function() {
                if (selectedDokterId) {
                    if (confirm('Apakah Anda yakin ingin menghapus dokter ini?')) {
                        deleteForm.submit();
                    }
                }
            });
        });
    </script> --}}

</x-app-layout>
    <script>
        $(function() {
            const table = $('#tableDokters').DataTable({
                serverSide: true,
                processing: true,
                ajax: '{{ route("dokters.index") }}',
                columns: [
                    { data: 'checkbox', name: 'checkbox',
                        orderable: false,
                        searchable: false
                    },

                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },

                    { data: 'nama_dokter', name: 'nama_dokter' },
                    { data: 'role', name: 'role' },
                    { data: 'nip', name: 'nip' },
                    { data: 'alamat', name: 'alamat' },
                    { data: 'tanggal_lahir', name: 'tanggal_lahir' },
                    { data: 'nik', name: 'nik' },
                    { data: 'nohp', name: 'nohp' },
                    { data: 'jadwalpraktik', name: 'jadwalpraktik' },
                    { data: 'penghasilan', name: 'penghasilan' },

                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false,
                        searchable: false
                    }
                ],
                language: {
                    search: "",
                    searchPlaceholder: "Cari dokter...",
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

            // Delete user functionally
            $('table').on('click', '.delete-pasiens', function () {
            const projectId = $(this).data('id');

            Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Data akan hilang secara permanen.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'

            }).then((result) => {

                if (result.isConfirmed) {
                    $.ajax({

                        url: `/projects/${projectId}`,
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}',
                        },

                        success: function (response) {
                            if (response.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Data Proyek telah dihapus.',
                                    timer: 2000,
                                    showConfirmButton: false
                            });

                        table.ajax.reload(null, false); // refresh datatable
                        } else {

                            Swal.fire('Gagal', response.message || 'Tidak bisa menghapus data.', 'error');
                        }
                        },

                    error: function () {

                    Swal.fire('Error', 'Terjadi kesalahan saat menghapus.', 'error');
                    }

                    });
                }
            });
            });


           
        });
    </script>
    <script>
        $(document).ready(function () {

            let selectedDokterId = null;

            // Checkbox change
            $(document).on('change', '.row-checkbox', function () {

                if ($(this).is(':checked')) {

                    $('.row-checkbox').not(this).prop('checked', false);

                    selectedDokterId = $(this).val();

                    $('#delete-selected').removeClass('hidden');

                    $('#dokter_id').val(selectedDokterId);

                    let action = "{{ route('dokters.destroy', ':id') }}";

                    action = action.replace(':id', selectedDokterId);

                    $('#deleteForm').attr('action', action);

                } else {

                    selectedDokterId = null;

                    $('#delete-selected').addClass('hidden');
                }
            });

            // Delete button
            $('#delete-selected').click(function () {

                if (!selectedDokterId) return;

                if (confirm('Apakah Anda yakin ingin menghapus dokter ini?')) {

                    $('#deleteForm').submit();
                }
            });

        });
    </script>
    <style>
    #tableDokters tbody tr {
        transition: 0.2s;
    }

    #tableDokters tbody tr:hover {
        background: #f9fafb;
    }
    </style>