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
</x-app-layout>  
