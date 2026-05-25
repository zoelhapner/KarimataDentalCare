<x-app-layout>

<div class="py-6">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

            {{-- Header --}}
            <div class="bg-primary-700 px-8 py-6 flex items-center justify-between">

                <div>

                    <h2 class="text-2xl font-semibold text-white">
                        Edit Role
                    </h2>

                    <p class="text-blue-100 mt-1 text-sm">
                        Ubah role dan permission pengguna
                    </p>

                </div>

                <a href="{{ route('roles.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-xl transition">

                    <i class="ti ti-arrow-left mr-2"></i>

                    Kembali

                </a>

            </div>

            {{-- Body --}}
            <div class="p-8">

                <form action="{{ route('roles.update', $role->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    {{-- Error --}}
                    @if ($errors->any())

                        <div class="mb-6 rounded-xl bg-red-50 border border-red-200 p-4">

                            <div class="text-red-700 font-medium mb-2">
                                Terjadi Kesalahan:
                            </div>

                            <ul class="list-disc list-inside text-sm text-red-600 space-y-1">

                                @foreach ($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                    @endif

                    {{-- Form --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Nama Role --}}
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama Role
                            </label>

                            <input type="text"
                                   name="name"
                                   value="{{ old('name', $role->name) }}"
                                   class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                   placeholder="Masukkan nama role"
                                   required>

                            @error('name')

                                <p class="text-red-500 text-sm mt-2">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                    </div>

                    {{-- Divider --}}
                    <div class="border-t border-gray-200 my-8"></div>

                    {{-- Permission Title --}}
                    <div class="mb-6">

                        <h3 class="text-lg font-semibold text-gray-800 flex items-center">

                            <i class="ti ti-lock mr-2 text-blue-600"></i>

                            Permissions Berdasarkan Modul

                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Ubah permission sesuai kebutuhan role
                        </p>

                    </div>

                    @php
                        $groupedPermissions = $permissions->groupBy('modules');
                    @endphp

                    {{-- Permissions --}}
                    <div class="space-y-6">

                        @foreach ($groupedPermissions as $moduleName => $modulePermissions)

                            <div class="border border-gray-200 rounded-2xl overflow-hidden">

                                {{-- Module Header --}}
                                <div class="bg-gray-50 px-5 py-4 flex items-center justify-between border-b border-gray-200">

                                    <div class="flex items-center">

                                        <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center mr-3">

                                            <i class="ti ti-folder"></i>

                                        </div>

                                        <div>

                                            <h4 class="font-semibold text-gray-800">
                                                {{ $moduleName ?? 'Tanpa Modul' }}
                                            </h4>

                                            <p class="text-xs text-gray-500">
                                                {{ $modulePermissions->count() }} Permission
                                            </p>

                                        </div>

                                    </div>

                                    <button type="button"
                                            class="btn-select-module text-sm px-4 py-2 bg-white border border-gray-300 hover:bg-gray-100 rounded-xl transition"
                                            data-module="{{ \Illuminate\Support\Str::slug($moduleName) }}">

                                        Pilih Semua

                                    </button>

                                </div>

                                {{-- Permission List --}}
                                <div class="p-5">

                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                                        @foreach ($modulePermissions as $perm)

                                            <label class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-gray-50 cursor-pointer transition">

                                                <input
                                                    type="checkbox"
                                                    name="permissions[]"
                                                    value="{{ $perm->name }}"
                                                    id="perm-{{ $perm->id }}"
                                                    class="permission-checkbox module-{{ \Illuminate\Support\Str::slug($moduleName) }} rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                                    {{ $role->hasPermissionTo($perm->name) ? 'checked' : '' }}>

                                                <span class="ml-3 text-sm text-gray-700">
                                                    {{ ucfirst($perm->name) }}
                                                </span>

                                            </label>

                                        @endforeach

                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </div>

                    {{-- Footer --}}
                    <div class="flex justify-end mt-8">

                        <button type="submit"
                                class="inline-flex items-center px-6 py-3 bg-primary-700 hover:bg-blue-800 text-white font-medium rounded-xl shadow-sm transition">

                            <i class="ti ti-device-floppy mr-2"></i>

                            Simpan Perubahan

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>
</x-app-layout>

<script>
$(document).ready(function() {
    $('.select2').select2({
        placeholder: "-- Pilih --",
        width: '100%'
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn-select-module').forEach(btn => {
        btn.addEventListener('click', function() {
            const moduleSlug = this.dataset.module;
            const checkboxes = document.querySelectorAll(`.module-${moduleSlug}`);
            const allChecked = Array.from(checkboxes).every(cb => cb.checked);
            checkboxes.forEach(cb => cb.checked = !allChecked);
            this.textContent = allChecked ? 'Pilih Semua' : 'Batalkan Semua';
        });
    });
});
</script>