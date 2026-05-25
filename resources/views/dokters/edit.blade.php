{{-- resources/views/dokters/edit.blade.php --}}  
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Dokter') }}
        </h2>
    </x-slot>

    {{-- <div class="container mx-auto mt-4">
        <form action="{{ route('dokters.update', $dokter) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
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
                    value="{{ old('email', $dokter->user->email) }}">
                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('password') border-red-500 @enderror"
                    value="{{ old('password', $dokter->user->password) }}">
                @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="bg-white shadow-sm rounded-2xl border border-gray-200 p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div>
                            <label class="block mb-2 text-sm text-black-400">
                                NIK
                            </label>

                            <input type="text"
                                name="nik"
                                value="{{ old('nik', $dokter->nik) }}"
                                class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block mb-2 text-sm text-black-400">
                                Nama Dokter
                            </label>

                            <input type="text"
                                name="nama_dokter"
                                value="{{ old('nama_dokter', $dokter->nama_dokter) }}"
                                class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block mb-2 text-sm text-black-400">
                                NIP
                            </label>

                            <input type="text"
                                name="nip"
                                value="{{ old('nip', $dokter->nip) }}"
                                class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block mb-2 text-sm text-black-400">
                                Tanggal Lahir
                            </label>

                            <input type="date"
                                name="tanggal_lahir"
                                value="{{ old('tanggal_lahir', $dokter->tanggal_lahir) }}"
                                class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block mb-2 text-sm text-black-400">
                                No HP
                            </label>

                            <input type="text"
                                name="nohp"
                                value="{{ old('nohp', $dokter->nohp) }}"
                                class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block mb-2 text-sm text-black-400">
                                Jadwal Praktik
                            </label>

                            <input type="text"
                                name="jadwalpraktik"
                                value="{{ old('jadwalpraktik', $dokter->jadwalpraktik) }}"
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
                                class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">{{ old('alamat', $dokter->alamat) }}</textarea>
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
    <div class="min-h-screen bg-gray-100 py-10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white shadow-xl rounded-2xl overflow-hidden">

                <div class="bg-gradient-to-r from-blue-600 to-cyan-500 px-8 py-6">
                    <h2 class="text-2xl text-white">
                        Ubah Data Dokter
                    </h2>
                    <p class="text-blue-100 mt-1 text-sm">
                        Ubah informasi dokter dengan benar
                    </p>
                </div>
                <div class="p-8">
                    @if ($errors->any())
                        <div class="mb-6 rounded-lg bg-red-100 border border-red-300 text-red-700 p-4">
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('dokters.update', $dokter) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            {{-- <div>
                                <label class="block text-sm text-black-400 mb-2">
                                    Email
                                </label>

                                <input type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition @error('email') border-red-500 @enderror">

                                @error('email')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm text-black-400 mb-2">
                                    Password
                                </label>

                                <input type="password"
                                    name="password"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition @error('password') border-red-500 @enderror">

                                @error('password')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div> --}}

                            <div>
                                <label class="block text-sm text-black-400 mb-2">
                                    NIK
                                </label>

                                <input type="text"
                                    name="nik"
                                    value="{{ old('nik', $dokter->nik) }}"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
                            </div>

                            <div>
                                <label class="block text-sm text-black-400 mb-2">
                                    Nama Dokter
                                </label>

                                <input type="text"
                                    name="nama_dokter"
                                    value="{{ old('nama_dokter', $dokter->nama_dokter) }}"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
                            </div>

                            <div>
                                <label class="block text-sm text-black-400 mb-2">
                                    NIP
                                </label>

                                <input type="text"
                                    name="nip"
                                    value="{{ old('nip', $dokter->nip) }}"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
                            </div>

                            <div>
                                <label class="block text-sm text-black-400 mb-2">
                                    Tanggal Lahir
                                </label>

                                <input type="date"
                                    name="tanggal_lahir"
                                    value="{{ old('tanggal_lahir', $dokter->tanggal_lahir) }}"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
                            </div>

                            <div>
                                <label class="block text-sm text-black-400 mb-2">
                                    No HP
                                </label>

                                <input type="text"
                                    name="nohp"
                                    value="{{ old('nohp', $dokter->nohp) }}"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
                            </div>

                            <div class="md:col-span-2">

                                <label class="block text-sm font-semibold text-gray-800 mb-4">
                                    Jadwal Praktik
                                </label>

                                @php
                                    $days = [
                                        'senin' => 'Senin',
                                        'selasa' => 'Selasa',
                                        'rabu' => 'Rabu',
                                        'kamis' => 'Kamis',
                                        'jumat' => 'Jumat',
                                        'sabtu' => 'Sabtu',
                                        'minggu' => 'Minggu',
                                    ];
                                @endphp

                                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm">

                                    @foreach($days as $key => $label)

                                        <div class="schedule-row border-b border-gray-100 last:border-b-0 px-5 py-4">

                                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                                                {{-- LEFT --}}
                                                <div class="flex items-center gap-4">

                                                    <label class="relative inline-flex items-center cursor-pointer">

                                                        <input type="checkbox"
                                                            class="sr-only peer toggle-day"
                                                            data-target="{{ $key }}"
                                                            name="jadwal[{{ $key }}][aktif]"
                                                            value="1"
                                                            {{ old("jadwal.$key.aktif", $dokter->jadwalpraktikbaru[$key]['aktif'] ?? false) ? 'checked' : '' }}>

                                                        <div class="w-11 h-6 bg-gray-300 rounded-full peer
                                                            peer-checked:bg-green-500
                                                            after:content-['']
                                                            after:absolute
                                                            after:top-[2px]
                                                            after:left-[2px]
                                                            after:bg-white
                                                            after:border-gray-300
                                                            after:border
                                                            after:rounded-full
                                                            after:h-5
                                                            after:w-5
                                                            after:transition-all
                                                            peer-checked:after:translate-x-full">
                                                        </div>

                                                    </label>

                                                    <div>
                                                        <h4 class="text-sm font-semibold text-gray-800">
                                                            {{ $label }}
                                                        </h4>

                                                        <p class="text-xs text-gray-500">
                                                            Atur jam praktik dokter
                                                        </p>
                                                    </div>

                                                </div>

                                                {{-- RIGHT --}}
                                                <div class="schedule-time flex items-center gap-3"
                                                    id="schedule-{{ $key }}">

                                                    <input type="time"
                                                        name="jadwal[{{ $key }}][buka]"
                                                        value="{{ old("jadwal.$key.buka", $dokter->jadwalpraktikbaru[$key]['buka'] ?? '') }}"
                                                        class="rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">

                                                    <span class="text-gray-400 font-medium">
                                                        —
                                                    </span>

                                                    <input type="time"
                                                        name="jadwal[{{ $key }}][tutup]"
                                                        value="{{ old("jadwal.$key.tutup", $dokter->jadwalpraktikbaru[$key]['tutup'] ?? '') }}"
                                                        class="rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">

                                                    <span class="status-text text-sm font-medium text-green-600">
                                                        Buka
                                                    </span>

                                                </div>

                                                {{-- CLOSED --}}
                                                <div class="closed-text hidden text-sm font-medium text-red-500"
                                                    id="closed-{{ $key }}">
                                                    Tutup
                                                </div>

                                            </div>

                                        </div>

                                    @endforeach

                                </div>

                            </div>

                        </div>

                        <div class="mt-6">
                            <label class="block text-sm text-black-400 mb-2">
                                Alamat
                            </label>

                            <textarea name="alamat"
                                    rows="3"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition">{{ old('alamat', $dokter->alamat) }}</textarea>
                        </div>
                        <div class="mt-5">

                            <h3 class="text-lg text-black-400 mb-4">
                                Informasi Lokasi
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                                <div>
                                    <label class="block mb-2 text-sm text-black-400">
                                        Provinsi
                                    </label>

                                    <select name="province_id"
                                            id="province"
                                            class="select2 w-full rounded-xl border-gray-300 @error('province_id') border-red-500 @enderror">
                                        <option value="">Pilih Provinsi</option>
                                        @foreach($provinces as $province)
                                            <option value="{{ $province->id }}"
                                                {{ $dokter->province_id == $province->id ? 'selected' : '' }}>
                                                {{ $province->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('province_id')
                                        <p class="mt-2 text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block mb-2 text-sm text-black-400">
                                        Kota / Kabupaten
                                    </label>

                                    <select name="city_id"
                                            id="city"
                                            class="select2 w-full rounded-xl border-gray-300 @error('city_id') border-red-500 @enderror">

                                        <option value="">Pilih Kota</option>
                                        @foreach($cities as $city)
                                            <option value="{{ $city->id }}"
                                                {{ $dokter->city_id == $city->id ? 'selected' : '' }}>
                                                {{ $city->name }}
                                            </option>
                                        @endforeach

                                    </select>

                                    @error('city_id')
                                        <p class="mt-2 text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block mb-2 text-sm text-black-400">
                                        Kecamatan
                                    </label>

                                    <select name="district_id"
                                            id="district"
                                            class="select2 w-full rounded-xl border-gray-300 @error('district_id') border-red-500 @enderror">

                                        <option value="">Pilih Kecamatan</option>
                                        @foreach($districts as $district)
                                            <option value="{{ $district->id }}"
                                                {{ $dokter->district_id == $district->id ? 'selected' : '' }}>
                                                {{ $district->name }}
                                            </option>
                                        @endforeach

                                    </select>

                                    @error('district_id')
                                        <p class="mt-2 text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block mb-2 text-sm text-black-400">
                                        Kelurahan
                                    </label>

                                    <select name="sub_district_id"
                                            id="sub_district"
                                            class="select2 w-full rounded-xl border-gray-300 @error('village_id') border-red-500 @enderror">
                                        <option value="">Pilih Kelurahan</option>
                                        @foreach($subDistricts as $sub_district)
                                            <option value="{{ $sub_district->id }}"
                                                {{ $dokter->sub_district_id == $sub_district->id ? 'selected' : '' }}>
                                                {{ $sub_district->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('sub_district_id')
                                        <p class="mt-2 text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block mb-2 text-sm text-black-400">
                                        Kode Pos
                                    </label>
                                    <select name="postal_code_id"
                                            id="postal_code"
                                            class="select2 w-full rounded-xl border-gray-300 @error('village_id') border-red-500 @enderror">
                                        <option value="">Pilih Kode Pos</option>
                                        @foreach($postalCodes as $postal_code)
                                            <option value="{{ $postal_code->id }}"
                                                {{ $dokter->postal_code_id == $postal_code->id ? 'selected' : '' }}>
                                                {{ $postal_code->postal_code }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('postal_code')
                                        <p class="mt-2 text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                            </div>

                        </div>

                        <div class="mt-8 flex justify-end gap-3">

                            <a href="{{ route('dokters.index') }}"
                            class="px-5 py-3 rounded-xl border border-gray-300 text-black-400 hover:bg-gray-100 transition">
                                Batal
                            </a>

                            <button type="submit"
                                    class="px-6 py-3 rounded-xl bg-blue-600 text-white shadow-md hover:bg-blue-700 transition">
                                Simpan Data
                            </button>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
$(document).ready(function () {

    $('.select2').select2({
        width: '100%'
    });

    let oldProvince     = "{{ old('province_id') }}";
    let oldCity         = "{{ old('city_id') }}";
    let oldDistrict     = "{{ old('district_id') }}";
    let oldSubDistrict  = "{{ old('sub_district_id') }}";
    let oldPostalCode   = "{{ old('postal_code_id') }}";

    function loadCities(provinceId, selected = null) {

        if (!provinceId) return;

        $('#city').html('<option>Loading...</option>');

        $.get('/api/cities/' + provinceId, function (data) {

            $('#city').empty()
                .append('<option value="">-- Pilih kota --</option>');

            $.each(data, function (i, city) {

                $('#city').append(`
                    <option value="${city.id}"
                        ${selected == city.id ? 'selected' : ''}>
                        ${city.name}
                    </option>
                `);

            });

            $('#city').trigger('change.select2');

        });

    }

    function loadDistricts(cityId, selected = null) {

        if (!cityId) return;

        $('#district').html('<option>Loading...</option>');

        $.get('/api/districts/' + cityId, function (data) {

            $('#district').empty()
                .append('<option value="">-- Pilih kecamatan --</option>');

            $.each(data, function (i, district) {

                $('#district').append(`
                    <option value="${district.id}"
                        ${selected == district.id ? 'selected' : ''}>
                        ${district.name}
                    </option>
                `);

            });

            $('#district').trigger('change.select2');

        });

    }

    function loadSubDistricts(districtId, selected = null) {

        if (!districtId) return;

        $('#sub_district').html('<option>Loading...</option>');

        $.get('/api/sub_districts/' + districtId, function (data) {

            $('#sub_district').empty()
                .append('<option value="">-- Pilih kelurahan --</option>');

            $.each(data, function (i, subDistrict) {

                $('#sub_district').append(`
                    <option value="${subDistrict.id}"
                        ${selected == subDistrict.id ? 'selected' : ''}>
                        ${subDistrict.name}
                    </option>
                `);

            });

            $('#sub_district').trigger('change.select2');

        });

    }

    function loadPostalCodes(subDistrictId, selected = null) {

        if (!subDistrictId) return;

        $('#postal_code').html('<option>Loading...</option>');

        $.get('/api/postal_codes/' + subDistrictId, function (data) {

            $('#postal_code').empty()
                .append('<option value="">-- Pilih kode pos --</option>');

            $.each(data, function (i, postalCode) {

                $('#postal_code').append(`
                    <option value="${postalCode.id}"
                        ${selected == postalCode.id ? 'selected' : ''}>
                        ${postalCode.postal_code}
                    </option>
                `);

            });

            $('#postal_code').trigger('change.select2');

        });

    }

    $('#province').change(function () {

        let provinceId = $(this).val();

        loadCities(provinceId);

        $('#district').html('<option value="">-- Pilih kecamatan --</option>');
        $('#sub_district').html('<option value="">-- Pilih kelurahan --</option>');
        $('#postal_code').html('<option value="">-- Pilih kode pos --</option>');

    });

    $('#city').change(function () {

        let cityId = $(this).val();

        loadDistricts(cityId);

        $('#sub_district').html('<option value="">-- Pilih kelurahan --</option>');
        $('#postal_code').html('<option value="">-- Pilih kode pos --</option>');

    });

    $('#district').change(function () {

        let districtId = $(this).val();

        loadSubDistricts(districtId);

        $('#postal_code').html('<option value="">-- Pilih kode pos --</option>');

    });

    $('#sub_district').change(function () {

        let subDistrictId = $(this).val();

        loadPostalCodes(subDistrictId);

    });

    if (oldProvince) {

        loadCities(oldProvince, oldCity);

        setTimeout(function () {

            if (oldCity) {

                loadDistricts(oldCity, oldDistrict);

            }

        }, 500);

        setTimeout(function () {

            if (oldDistrict) {

                loadSubDistricts(oldDistrict, oldSubDistrict);

            }

        }, 1000);

        setTimeout(function () {

            if (oldSubDistrict) {

                loadPostalCodes(oldSubDistrict, oldPostalCode);

            }
        }, 1500);
    }
});
</script>
<script>

    document.querySelectorAll('.toggle-day').forEach(toggle => {

        function updateState() {

            const target = toggle.dataset.target;

            const schedule = document.getElementById(`schedule-${target}`);
            const closed = document.getElementById(`closed-${target}`);

            if(toggle.checked) {

                schedule.classList.remove('hidden');
                closed.classList.add('hidden');

            } else {

                schedule.classList.add('hidden');
                closed.classList.remove('hidden');

            }

        }

        updateState();

        toggle.addEventListener('change', updateState);

    });

</script>