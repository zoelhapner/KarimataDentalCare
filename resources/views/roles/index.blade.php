<x-app-layout>

@section('content')

<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

            <div>
                <h1 class="text-2xl font-semibold text-gray-800">
                    Daftar Role
                </h1>

                <p class="text-sm text-gray-500 mt-1">
                    Kelola role dan permission pengguna
                </p>
            </div>

            
                <a href="{{ route('roles.create') }}"
                   class="inline-flex items-center justify-center px-4 py-2.5 bg-gray-900 hover:bg-gray-800 text-white rounded-xl shadow-sm transition">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5 mr-2"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M12 4v16m8-8H4" />
                    </svg>

                    Tambah Role Baru
                </a>

        </div>

        {{-- Card --}}
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

            {{-- Table --}}
            <div class="overflow-x-auto">

                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-gray-50">

                        <tr>

                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                No
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Nama Role
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Permission
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-100 bg-white">

                        @foreach ($roles as $role)

                            <tr class="hover:bg-gray-50 transition">

                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-800">
                                        {{ $role->name }}
                                    </div>
                                </td>

                                <td class="px-6 py-4">

                                    @if($role->permissions->count() > 0)

                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700">
                                            {{ $role->permissions->count() }} Permission
                                        </span>

                                    @else

                                        <span class="text-sm text-gray-400">
                                            Belum ada permission
                                        </span>

                                    @endif

                                </td>

                                <td class="px-6 py-4">

                                    <div class="flex items-center justify-center gap-2">

                                        {{-- Edit --}}
                                        <a href="{{ route('roles.edit', $role->id) }}"
                                           class="inline-flex items-center px-3 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-lg transition">

                                            <i class="ti ti-edit text-sm"></i>

                                        </a>

                                        {{-- Delete --}}
                                        <form action="{{ route('roles.destroy', $role->id) }}"
                                              method="POST"
                                              onsubmit="return confirmDelete(event)">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="inline-flex items-center px-3 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition">

                                                <i class="ti ti-trash text-sm"></i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>
</div>

{{-- MODAL --}}
<div id="editPermissionsModal"
     class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/50">

    <div class="flex items-center justify-center min-h-screen p-4">

        <div class="bg-white rounded-2xl shadow-xl w-full max-w-5xl">

            {{-- Header --}}
            <div class="flex items-center justify-between px-6 py-4 border-b">

                <div>
                    <h2 class="text-xl font-semibold text-gray-800">
                        Kelola Permission
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Role:
                        <span id="roleName" class="font-medium text-gray-700"></span>
                    </p>
                </div>

                <button type="button"
                        onclick="closePermissionsModal()"
                        class="text-gray-400 hover:text-gray-600 text-2xl">

                    &times;

                </button>

            </div>

            {{-- Body --}}
            <form id="permissionsForm">

                @csrf

                <input type="hidden" name="role_id" id="roleId">

                <div class="p-6 max-h-[70vh] overflow-y-auto">

                    @foreach ($permissions as $moduleName => $modulePermissions)

                        <div class="border border-gray-200 rounded-2xl mb-5 overflow-hidden">

                            {{-- Module Header --}}
                            <div class="bg-gray-50 px-5 py-3 flex items-center justify-between">

                                <h3 class="font-semibold text-gray-700">
                                    {{ $moduleName ?? 'Tanpa Grup' }}
                                </h3>

                                <button type="button"
                                        class="btn-select-module text-sm text-blue-600 hover:text-blue-800"
                                        data-module="{{ \Illuminate\Support\Str::slug($moduleName) }}">

                                    Pilih Semua

                                </button>

                            </div>

                            {{-- Permissions --}}
                            <div class="p-5">

                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                                    @foreach ($modulePermissions as $perm)

                                        <label class="flex items-center space-x-3">

                                            <input type="checkbox"
                                                   class="permission-checkbox module-{{ \Illuminate\Support\Str::slug($moduleName) }} rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                                   id="perm-{{ $perm->id }}"
                                                   name="permissions[]"
                                                   value="{{ $perm->id }}">

                                            <span class="text-sm text-gray-700">
                                                {{ $perm->name }}
                                            </span>

                                        </label>

                                    @endforeach

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

                {{-- Footer --}}
                <div class="flex items-center justify-end gap-3 px-6 py-4 border-t bg-gray-50">

                    <button type="button"
                            onclick="closePermissionsModal()"
                            class="px-4 py-2 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-100 transition">

                        Batal

                    </button>

                    <button type="button"
                            id="savePermissionsBtn"
                            class="px-5 py-2 bg-gray-900 hover:bg-gray-800 text-white rounded-xl transition">

                        Simpan Perubahan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

</x-app-layout>