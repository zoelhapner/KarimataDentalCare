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
        // Reset cache permission
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Kosongkan tabel pivot dulu
        DB::table('model_has_roles')->truncate();
        DB::table('role_has_permissions')->truncate();
        DB::table('model_has_permissions')->truncate();

        // Kosongkan role & permission
        Permission::truncate();
        Role::truncate();

        /*
        |--------------------------------------------------------------------------
        | Permissions
        |--------------------------------------------------------------------------
        */

        $permissions = [

            // USER
            'tambah data user',
            'lihat daftar user',
            'ubah data user',
            'hapus data user',

            // ROLE
            'tambah data role',
            'lihat daftar role',
            'ubah data role',
            'hapus data role',

            // DOKTER
            'tambah data dokter',
            'lihat data dokter',
            'lihat daftar dokter',
            'ubah data dokter',
            'hapus data dokter',

            // OBAT
            'lihat daftar obat',
            'tambah data obat',
            'lihat data obat',
            'ubah data obat',
            'hapus data obat',

            // PASIEN
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

        /*
        |--------------------------------------------------------------------------
        | Roles
        |--------------------------------------------------------------------------
        */

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

        /*
        |--------------------------------------------------------------------------
        | Permission Role
        |--------------------------------------------------------------------------
        */

        // Manager = semua akses
        $manager->syncPermissions(Permission::all());

        // Admin
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

        // Dokter
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

        // Role::where('name', 'Komisaris')->first()->syncPermissions([]);
        // Role::where('name', 'Tukang')->first()->syncPermissions([]);
        // Role::where('name', 'Kontraktor')->first()->syncPermissions([]);

        // Buat contoh user + role
        // \App\Models\User::factory()->create([
        //     'fullname' => 'Komisaris',
        //     'email' => 'komisaris@gmail.com',
        //     'password' => Hash::make('12345678'),
        // ])->assignRole('Komisaris');

        // \App\Models\User::factory()->create([
        //     'fullname' => 'Manager Administrasi',
        //     'email' => 'manageradm@example.com',
        //     'password' => Hash::make('12345678'),
        // ])->assignRole('Manager Administrasi');

        // \App\Models\User::factory()->create([
        //     'fullname' => 'Manager Teknik',
        //     'email' => 'managerteknik@gmail.com',
        //     'password' => Hash::make('12345678'),
        // ])->assignRole('Manager Teknik');

        // \App\Models\User::factory()->create([
        //     'fullname' => 'Spv Marketing',
        //     'email' => 'spvmarketing@gmail.com',
        //     'password' => Hash::make('12345678'),
        // ])->assignRole(['Spv Marketing']);

        // \App\Models\User::factory()->create([
        //     'fullname' => 'Spv Finance',
        //     'email' => 'spvfinance@gmail.com',
        //     'password' => Hash::make('12345678'),
        // ])->assignRole(['Spv Finance']);
        // \App\Models\User::factory()->create([
        //     'fullname' => 'Spv Arsitek',
        //     'email' => 'spvarsitek@gmail.com',
        //     'password' => Hash::make('12345678'),
        // ])->assignRole(['Spv Arsitek']);
        // \App\Models\User::factory()->create([
        //     'fullname' => 'Spv Sipil',
        //     'email' => 'spvsipil@gmail.com',
        //     'password' => Hash::make('12345678'),
        // ])->assignRole(['Spv Sipil']);
        // \App\Models\User::factory()->create([
        //     'fullname' => 'Staff Marketing',
        //     'email' => 'staffmarketing@gmail.com',
        //     'password' => Hash::make('12345678'),
        // ])->assignRole(['Staff Marketing']);
        // \App\Models\User::factory()->create([
        //     'fullname' => 'Staff Finance',
        //     'email' => 'stafffinance@gmail.com',
        //     'password' => Hash::make('12345678'),
        // ])->assignRole(['Staff Finance']);

        // \App\Models\User::factory()->create([
        //     'fullname' => 'Staff HRD',
        //     'email' => 'staffhrd@gmail.com',
        //     'password' => Hash::make('12345678'),
        // ])->assignRole(['Staff HRD']);

        // \App\Models\User::factory()->create([
        //     'fullname' => 'Quality Control',
        //     'email' => 'qc@gmail.com',
        //     'password' => Hash::make('12345678'),
        // ])->assignRole(['QC']);

        // \App\Models\User::factory()->create([
        //     'fullname' => 'Estimator',
        //     'email' => 'estimator@gmail.com',
        //     'password' => Hash::make('12345678'),
        // ])->assignRole(['Estimator']);

        // \App\Models\User::factory()->create([
        //     'fullname' => 'Investor',
        //     'email' => 'investor@gmail.com',
        //     'password' => Hash::make('12345678'),
        // ])->assignRole(['Investor']);

        // \App\Models\User::factory()->create([
        //     'fullname' => 'Tukang',
        //     'email' => 'worker@gmail.com',
        //     'password' => Hash::make('12345678'),
        // ])->assignRole(['Tukang']);

        // \App\Models\User::factory()->create([
        //     'fullname' => 'Mitra Kontraktor',
        //     'email' => 'mitrak@gmail.com',
        //     'password' => Hash::make('12345678'),
        // ])->assignRole(['Mitra Kontraktor']);

        // \App\Models\User::factory()->create([
        //     'fullname' => 'Mitra Supplier',
        //     'email' => 'mitras@gmail.com',
        //     'password' => Hash::make('12345678'),
        // ])->assignRole(['Mitra Supplier']);

        // \App\Models\User::factory()->create([
        //     'fullname' => 'Mitra Arsitek',
        //     'email' => 'mitraa@gmail.com',
        //     'password' => Hash::make('12345678'),
        // ])->assignRole(['Mitra Arsitek']);

        // \App\Models\User::factory()->create([
        //     'fullname' => 'pasien',
        //     'email' => 'pasien@gmail.com',
        //     'password' => Hash::make('12345678'),
        // ])->assignRole(['pasien']);

        // \App\Models\User::factory()->create([
        //     'fullname' => 'Affiliator',
        //     'email' => 'affiliator@gmail.com',
        //     'password' => Hash::make('12345678'),
        // ])->assignRole(['Affiliator']);
