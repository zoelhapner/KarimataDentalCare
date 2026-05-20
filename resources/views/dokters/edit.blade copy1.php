{{-- resources/views/dokters/edit.blade.php --}}  
<x-app-layout>  
    <x-slot name="header">  
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">  
            {{ __('Edit Dokter') }}  
        </h2>  
    </x-slot>  
  
    <div class="py-12">  
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">  
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">  
                <div class="p-6 bg-white border-b border-gray-200">  
                    <form action="{{ route('dokters.update', $dokter) }}" method="POST">  
                        @csrf  
                        @method('PUT')  
                        <div class="form-group">  
                            <label for="user_id">User ID</label>  
                            <input type="text" name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror" value="{{ old('user_id', $dokter->user_id) }}">  
                            @error('user_id')  
                                <div class="invalid-feedback">{{ $message }}</div>  
                            @enderror  
                        </div>  
                        <div class="form-group">  
                            <label for="nama_dokter">Nama Dokter</label>  
                            <input type="text" name="nama_dokter" id="nama_dokter" class="form-control @error('nama_dokter') is-invalid @enderror" value="{{ old('nama_dokter', $dokter->nama_dokter) }}">  
                            @error('nama_dokter')  
                                <div class="invalid-feedback">{{ $message }}</div>  
                            @enderror  
                        </div>  
                        <div class="form-group">  
                            <label for="role">Role</label>  
                            <input type="text" name="role" id="role" class="form-control @error('role') is-invalid @enderror" value="{{ old('role', $dokter->role) }}">  
                            @error('role')  
                                <div class="invalid-feedback">{{ $message }}</div>  
                            @enderror  
                        </div>  
                        <div class="form-group">  
                            <label for="nip">NIP</label>  
                            <input type="text" name="nip" id="nip" class="form-control @error('nip') is-invalid @enderror" value="{{ old('nip', $dokter->nip) }}">  
                            @error('nip')  
                                <div class="invalid-feedback">{{ $message }}</div>  
                            @enderror  
                        </div>  
                        <div class="form-group">  
                            <label for="alamat">Alamat</label>  
                            <input type="text" name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat', $dokter->alamat) }}">  
                            @error('alamat')  
                                <div class="invalid-feedback">{{ $message }}</div>  
                            @enderror  
                        </div>  
                        <div class="form-group">  
                            <label for="tanggal_lahir">Tanggal Lahir</label>  
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir', $dokter->tanggal_lahir) }}">  
                            @error('tanggal_lahir')  
                                <div class="invalid-feedback">{{ $message }}</div>  
                            @enderror  
                        </div>  
                        <div class="form-group">  
                            <label for="nik">NIK</label>  
                            <input type="text" name="nik" id="nik" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik', $dokter->nik) }}">  
                            @error('nik')  
                                <div class="invalid-feedback">{{ $message }}</div>  
                            @enderror  
                        </div>  
                        <div class="form-group">  
                            <label for="nohp">No HP</label>  
                            <input type="text" name="nohp" id="nohp" class="form-control @error('nohp') is-invalid @enderror" value="{{ old('nohp', $dokter->nohp) }}">  
                            @error('nohp')  
                                <div class="invalid-feedback">{{ $message }}</div>  
                            @enderror  
                        </div>  
                        <div class="form-group">  
                            <label for="penghasilan">Penghasilan</label>  
                            <input type="number" name="penghasilan" id="penghasilan" class="form-control @error('penghasilan') is-invalid @enderror" value="{{ old('penghasilan', $dokter->penghasilan) }}">  
                            @error('penghasilan')  
                                <div class="invalid-feedback">{{ $message }}</div>  
                            @enderror  
                        </div>  
                        <button type="submit" class="btn btn-primary">Simpan</button>  
                        <a href="{{ route('dokters.index') }}" class="btn btn-secondary">Kembali</a>  
                    </form>  
                </div>  
            </div>  
        </div>  
    </div> 
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('dokters.store') }}" method="POST" class="space-y-6">
                        @csrf
                                @if ($errors->any())
                                <div class="bg-red-500 text-white p-4 rounded mb-4">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('email') border-red-500 @enderror"
                                value="{{ old('email') }}">
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <input type="password" name="password" id="password" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('password') border-red-500 @enderror"
                                value="{{ old('password') }}">
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                            <input type="text" name="nik" id="nik" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('nik') border-red-500 @enderror"
                                value="{{ old('nik') }}">
                            @error('nik')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>


                        <div>
                            <label for="nama_dokter" class="block text-sm font-medium text-gray-700">Nama Dokter</label>
                            <input type="text" name="nama_dokter" id="nama_dokter" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('nama_dokter') border-red-500 @enderror"
                                value="{{ old('nama_dokter') }}">
                            @error('nama_dokter')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        
                        <div>
                            <label for="nip" class="block text-sm font-medium text-gray-700">NIP</label>
                            <input type="text" name="nip" id="nip" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('nip') border-red-500 @enderror"
                                value="{{ old('nip') }}">
                            @error('nip')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                            <input type="text" name="alamat" id="alamat" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('alamat') border-red-500 @enderror"
                                value="{{ old('alamat') }}">
                            @error('alamat')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('tanggal_lahir') border-red-500 @enderror"
                                value="{{ old('tanggal_lahir') }}">
                            @error('tanggal_lahir')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                       
                        <div>
                            <label for="nohp" class="block text-sm font-medium text-gray-700">No HP</label>
                            <input type="text" name="nohp" id="nohp" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('nohp') border-red-500 @enderror"
                                value="{{ old('nohp') }}">
                            @error('nohp')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="jadwalpraktik" class="block text-sm font-medium text-gray-700">Jadwal Praktik</label>
                            <input type="text" name="jadwalpraktik" id="jadwalpraktik" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('nohp') border-red-500 @enderror"
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
    {{-- <div class="container mx-auto mt-4">

        <form action="{{ route('dokters.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="bg-white shadow-sm rounded-2xl border border-gray-200 p-6">

                <div class="mb-6">
                    <p class="text-sm text-black-400 mt-1">
                        Input data dokter
                    </p>
                </div>

                @if ($errors->any())
                    <div class="mb-5 rounded-xl bg-red-50 border border-red-200 p-4">
                        <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div>
                        <label class="block mb-2 text-sm text-black-400">
                            Email
                        </label>

                        <input type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('email') border-red-500 @enderror">

                        @error('email')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-sm text-black-400">
                            Password
                        </label>

                        <input type="password"
                            name="password"
                            class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('password') border-red-500 @enderror">

                        @error('password')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-sm text-black-400">
                            NIK
                        </label>

                        <input type="text"
                            name="nik"
                            value="{{ old('nik') }}"
                            class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block mb-2 text-sm text-black-400">
                            Nama Dokter
                        </label>

                        <input type="text"
                            name="nama_dokter"
                            value="{{ old('nama_dokter') }}"
                            class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block mb-2 text-sm text-black-400">
                            NIP
                        </label>

                        <input type="text"
                            name="nip"
                            value="{{ old('nip') }}"
                            class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block mb-2 text-sm text-black-400">
                            Tanggal Lahir
                        </label>

                        <input type="date"
                            name="tanggal_lahir"
                            value="{{ old('tanggal_lahir') }}"
                            class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block mb-2 text-sm text-black-400">
                            No HP
                        </label>

                        <input type="text"
                            name="nohp"
                            value="{{ old('nohp') }}"
                            class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block mb-2 text-sm text-black-400">
                            Jadwal Praktik
                        </label>

                        <input type="text"
                            name="jadwalpraktik"
                            value="{{ old('jadwalpraktik') }}"
                            placeholder="Senin - Jumat, 08:00 - 14:00"
                            class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    </div>

                </div>

                <div class="mt-5">
                    <label class="block mb-2 text-sm text-black-400">
                        Alamat
                    </label>

                    <textarea name="alamat"
                            rows="3"
                            class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">{{ old('alamat') }}</textarea>
                </div>
            </div>
            <div class="flex items-center justify-end gap-3">

                <a href="{{ route('dokters.index') }}"
                class="px-5 py-2.5 rounded-xl border border-gray-300 text-black-700 hover:bg-gray-100 transition">
                    Batal
                </a>

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl shadow-sm transition">
                    Simpan
                </button>

            </div>

        </form>

    </div> --}}