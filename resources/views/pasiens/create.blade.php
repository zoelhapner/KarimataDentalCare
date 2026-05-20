{{-- resources/views/pasiens/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl text-black-200 leading-tight">
            {{ __('Tambah Pasien') }}
        </h2>
    </x-slot>
    <div class="min-h-screen bg-gray-100 py-10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white shadow-xl rounded-2xl overflow-hidden">

                <div class="bg-gradient-to-r from-blue-600 to-cyan-500 px-8 py-6">
                    <h2 class="text-2xl text-white">
                        Tambah Data Pasien
                    </h2>
                    <p class="text-blue-100 mt-1 text-sm">
                        Lengkapi informasi pasien dengan benar
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

                    <form action="{{ route('pasiens.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm text-black-400 mb-2">
                                    Nama Pasien
                                </label>

                                <input type="text"
                                    name="nama_pasien"
                                    value="{{ old('nama_pasien') }}"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
                                @error('nama_pasien')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block mb-2 text-sm text-black-400">
                                    Jenis Kelamin
                                </label>

                                <select name="jenis_kelamin"
                                        class="select2 w-full rounded-xl border-gray-300 @error('province_id') border-red-500 @enderror">

                                    <option value="">Pilih Jenis Kelamin</option>

                                    <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>
                                        Laki-laki
                                    </option>
                                    <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>
                                        Perempuan
                                    </option>

                                </select>

                                @error('jenis_kelamin')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm text-black-400 mb-2">
                                    NIK
                                </label>

                                <input type="text"
                                    name="nik"
                                    value="{{ old('nik') }}"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
                                @error('nik')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm text-black-400 mb-2">
                                    No HP:
                                </label>

                                <input type="tel"
                                    name="nohp"
                                    value="{{ old('nohp') }}"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
                                @error('nohp')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm text-black-400 mb-2">
                                    Profesi
                                </label>

                                <input type="text"
                                    name="profesi"
                                    value="{{ old('profesi') }}"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
                                @error('profesi')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm text-black-400 mb-2">
                                    Alergi
                                </label>

                                <input type="text"
                                    name="alergi"
                                    value="{{ old('alergi') }}"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
                                @error('alergi')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        <div class="mt-6">
                            <label class="block text-sm text-black-400 mb-2">
                                Alamat Pasien
                            </label>

                            <textarea name="alamat"
                                    rows="3"
                                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition">{{ old('alamat') }}</textarea>
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

                                        @foreach ($provinces as $province)
                                            <option value="{{ $province->id }}"
                                                {{ old('province_id') == $province->id ? 'selected' : '' }}>
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
                                    </select>

                                    @error('postal_code_id')
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