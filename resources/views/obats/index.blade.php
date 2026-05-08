<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Obat') }}
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
                                <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                </svg>
                                <a href="{{ route('obats.create') }}" class="btn btn-primary">Tambah Obat</a>
                            </button>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-4 py-3">ID</th>
                                    <th scope="col" class="px-4 py-3">Nama Obat</th>
                                    <th scope="col" class="px-4 py-3">Merk</th>
                                    <th scope="col" class="px-4 py-3">Ukuran</th>
                                    <th scope="col" class="px-4 py-3">Harga Beli</th>
                                    <th scope="col" class="px-4 py-3">Tanggal Beli</th>
                                    <th scope="col" class="px-4 py-3">Supplier</th>
                                   {{--  <th scope="col" class="px-4 py-3">Aksi</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($obats as $obat)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-4 py-3">{{ $obat->id_obat }}</td>
                                        <td class="px-4 py-3">{{ $obat->nama_obat }}</td>
                                        <td class="px-4 py-3">{{ $obat->merk }}</td>
                                        <td class="px-4 py-3">{{ $obat->ukuran }}</td>
                                        <td class="px-4 py-3">Rp{{ number_format($obat->harga_beli, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3">{{ $obat->tanggal_beli }}</td>
                                        <td class="px-4 py-3">{{ $obat->supplier }}</td>
                                   {{--      <td class="px-4 py-3 flex space-x-2">
                                            <a href="{{ route('obats.edit', $obat->id) }}" class="text-blue-600 hover:underline">Edit</a>
                                            <form action="{{ route('obats.destroy', $obat->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus obat ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                            </form>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="p-4">
                       
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
