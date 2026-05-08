{{-- resources/views/dokters/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
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

        <section class="bg-gray-50 dark:bg-gray-900 py-3 sm:py-5">
            <div class="px-4 mx-auto max-w-screen-2xl lg:px-12">
                <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                    <div class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
                        <div class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                            <button type="button" class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                                <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                </svg>
                                <a href="{{ route('dokters.create') }}" class="btn btn-primary">Tambah Dokter</a>
                            </button>

                            {{-- Tombol Hapus --}}
                            <button id="delete-selected" type="button" class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800 hidden">
                                <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                </svg>
                                Hapus Dokter Terpilih
                            </button>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <form id="deleteForm" action="{{ route('dokters.destroy', ['dokter' => 'ID_PLACEHOLDER']) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus dokter ini?')">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="dokter_id" id="dokter_id">
                        </form>
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="p-4">
                                        <div class="flex items-center">
                                            <input id="checkbox-all" type="checkbox" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="checkbox-all" class="sr-only">checkbox</label>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-4 py-3">ID Dokter</th>
                                    <th scope="col" class="px-4 py-3">Nama</th>
                                    <th scope="col" class="px-4 py-3">Role</th>
                                    <th scope="col" class="px-4 py-3">NIP</th>
                                    <th scope="col" class="px-4 py-3">Alamat</th>
                                    <th scope="col" class="px-4 py-3">Tanggal Lahir</th>
                                    <th scope="col" class="px-4 py-3">NIK</th>
                                    <th scope="col" class="px-4 py-3">No HP</th>
                                    <th scope="col" class="px-4 py-3">Jadwal Praktik</th>
                                    <th scope="col" class="px-4 py-3">Pendapatan Dokter</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dokters as $dokter)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="w-4 p-4">
                                        <div class="flex items-center">
                                            <input id="checkbox-{{ $dokter->id_dokter }}" type="checkbox" class="dokter-checkbox w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" data-id="{{ $dokter->id_dokter }}">
                                            <label for="checkbox-{{ $dokter->id_dokter }}" class="sr-only">checkbox</label>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">{{ $dokter->id_dokter }}</td>
                                    <td class="px-4 py-3">
                                        <a href="{{ route('dokters.show', $dokter->id_dokter) }}" class="text-blue-500 hover:underline">
                                            {{ $dokter->nama_dokter }}
                                        </a>
                                    </td>
                                    <td class="px-4 py-3">Dokter</td>
                                    <td class="px-4 py-3">{{ $dokter->nip }}</td>
                                    <td class="px-4 py-3">{{ $dokter->alamat }}</td>
                                    <td class="px-4 py-3">{{ $dokter->tanggal_lahir }}</td>
                                    <td class="px-4 py-3">{{ $dokter->nik }}</td>
                                    <td class="px-4 py-3">{{ $dokter->nohp }}</td>
                                    <td class="px-4 py-3">{{ $dokter->jadwalpraktik }}</td>
                                    <td class="px-4 py-3">{{ number_format($dokter->pendapatan_dokter, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
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
    </script>

</x-app-layout>