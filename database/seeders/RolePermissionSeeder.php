<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        DB::table('model_has_roles')->truncate();
        DB::table('role_has_permissions')->truncate();
        DB::table('model_has_permissions')->truncate();

        Permission::truncate();
        Role::truncate();

        $permissions = [

            'tambah data user',
            'lihat daftar user',
            'ubah data user',
            'hapus data user',

            'tambah data role',
            'lihat daftar role',
            'ubah data role',
            'hapus data role',

            'tambah data dokter',
            'lihat data dokter',
            'lihat daftar dokter',
            'ubah data dokter',
            'hapus data dokter',

            'lihat daftar obat',
            'tambah data obat',
            'lihat data obat',
            'ubah data obat',
            'hapus data obat',

            'lihat daftar pasien',
            'tambah data pasien',
            'lihat data pasien',
            'ubah data pasien',
            'hapus data pasien',
        ];

        foreach ($permissions as $permission) {

            if (str_contains($permission, 'dokter')) {
                $module = 'Dokter';
            } elseif (str_contains($permission, 'obat')) {
                $module = 'Obat';
            } elseif (str_contains($permission, 'pasien')) {
                $module = 'Pasien';
            } elseif (str_contains($permission, 'user')) {
                $module = 'User';
            } elseif (str_contains($permission, 'role')) {
                $module = 'Role';
            } else {
                $module = 'Lainnya';
            }

            Permission::create([
                'name' => $permission,
                'guard_name' => 'web',
                'modules' => $module,
            ]);
        }

        $manager = Role::create([
            'name' => 'Manager',
            'guard_name' => 'web',
        ]);

        $admin = Role::create([
            'name' => 'Admin',
            'guard_name' => 'web',
        ]);

        $dokter = Role::create([
            'name' => 'Dokter',
            'guard_name' => 'web',
        ]);


        $manager->syncPermissions(Permission::all());

        $admin->syncPermissions([
            'lihat daftar dokter',
            'tambah data dokter',
            'ubah data dokter',

            'lihat daftar pasien',
            'tambah data pasien',
            'ubah data pasien',

            'lihat daftar obat',
            'tambah data obat',
            'ubah data obat',
        ]);

        $dokter->syncPermissions([
            'lihat daftar pasien',
            'lihat data pasien',

            'lihat daftar obat',
            'lihat data obat',

            'lihat daftar dokter',
            'lihat data dokter',
        ]);
    }
}