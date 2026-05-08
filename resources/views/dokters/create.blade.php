{{-- resources/views/dokters/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Dokter') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <form action="{{ route('dokters.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                            <input type="email" name="email" id="email" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:text-gray-200 focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('email') border-red-500 @enderror"
                                value="{{ old('email') }}">
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                            <input type="password" name="password" id="password" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:text-gray-200 focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('password') border-red-500 @enderror"
                                value="{{ old('password') }}">
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="nik" class="block text-sm font-medium text-gray-700 dark:text-gray-300">NIK</label>
                            <input type="text" name="nik" id="nik" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:text-gray-200 focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('nik') border-red-500 @enderror"
                                value="{{ old('nik') }}">
                            @error('nik')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>


                        <div>
                            <label for="nama_dokter" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Dokter</label>
                            <input type="text" name="nama_dokter" id="nama_dokter" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:text-gray-200 focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('nama_dokter') border-red-500 @enderror"
                                value="{{ old('nama_dokter') }}">
                            @error('nama_dokter')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        
                        <div>
                            <label for="nip" class="block text-sm font-medium text-gray-700 dark:text-gray-300">NIP</label>
                            <input type="text" name="nip" id="nip" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:text-gray-200 focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('nip') border-red-500 @enderror"
                                value="{{ old('nip') }}">
                            @error('nip')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="alamat" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat</label>
                            <input type="text" name="alamat" id="alamat" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:text-gray-200 focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('alamat') border-red-500 @enderror"
                                value="{{ old('alamat') }}">
                            @error('alamat')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:text-gray-200 focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('tanggal_lahir') border-red-500 @enderror"
                                value="{{ old('tanggal_lahir') }}">
                            @error('tanggal_lahir')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                       
                        <div>
                            <label for="nohp" class="block text-sm font-medium text-gray-700 dark:text-gray-300">No HP</label>
                            <input type="text" name="nohp" id="nohp" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:text-gray-200 focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('nohp') border-red-500 @enderror"
                                value="{{ old('nohp') }}">
                            @error('nohp')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="jadwalpraktik" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jadwal Praktik</label>
                            <input type="text" name="jadwalpraktik" id="jadwalpraktik" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:text-gray-200 focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('nohp') border-red-500 @enderror"
                                value="{{ old('jadwalpraktik') }}">
                            @error('jadwalpraktik')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                     
                        <div class="flex justify-end">
                            <button type="submit" 
                                class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
