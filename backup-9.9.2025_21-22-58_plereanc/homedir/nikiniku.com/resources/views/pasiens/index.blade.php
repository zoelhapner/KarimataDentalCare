{{-- resources/views/pasiens/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Pasien') }}
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
                    <div
                        class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
                        <div
                            class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                            <button type="button"
                                class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                                <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd"
                                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                </svg>
                                <a href="{{ route('pasiens.create') }}" class="btn btn-primary">Tambah Pasien</a>
                            </button>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-4 py-3">ID</th>
                                    <th scope="col" class="px-4 py-3">Nama</th>
                                    <th scope="col" class="px-4 py-3">Jenis Kelamin</th>
                                    <th scope="col" class="px-4 py-3">Alamat</th>
                                    <th scope="col" class="px-4 py-3">Profesi</th>
                                    <th scope="col" class="px-4 py-3">NIK</th>
                                    <th scope="col" class="px-4 py-3">No HP</th>
                                    <th scope="col" class="px-4 py-3">Alergi</th>
                                    <th scope="col" class="px-4 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pasiens as $pasien)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-4 py-3">{{ $pasien->id_pasien }}</td>
                                        <td class="px-4 py-3">{{ $pasien->nama_pasien }}</td>
                                        <td class="px-4 py-3">{{ $pasien->jenis_kelamin }}</td>
                                        <td class="px-4 py-3">{{ $pasien->alamat_pasien }}</td>
                                        <td class="px-4 py-3">{{ $pasien->profesi }}</td>
                                        <td class="px-4 py-3">{{ $pasien->nik }}</td>
                                        <td class="px-4 py-3">{{ $pasien->nohp }}</td>
                                        <td class="px-4 py-3">{{ $pasien->alergi }}</td>
                                        <td class="px-4 py-3 flex space-x-2">
                                            {{-- Tombol Edit --}}
                                            <a href="{{ route('pasiens.edit', $pasien->id_pasien) }}"
                                                class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-yellow-500 hover:bg-yellow-600 rounded-lg focus:ring-4 focus:ring-yellow-300 dark:focus:ring-yellow-800">
                                                Edit
                                            </a>

                                            {{-- Tombol Hapus --}}
                                            {{-- <form action="{{ route('pasiens.destroy', $pasien->id_pasien) }}" method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus pasien ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-red-700 hover:bg-red-800 rounded-lg focus:ring-4 focus:ring-red-300 dark:focus:ring-red-800">
                                                    Hapus
                                                </button>
                                            </form> --}}
                                        </td>
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