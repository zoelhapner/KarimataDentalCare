<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Manager',
                'email' => 'manager@klinikgigi.com',
                'password' => bcrypt('password'), // Ganti dengan password yang sesuai
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kasir',
                'email' => 'kasir@klinikgigi.com',
                'password' => bcrypt('password'), // Ganti dengan password yang sesuai
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        
        DB::table('admins')->insert([
            [
                'user_id' => 1, // Pastikan user_id ini ada di tabel users
                'nama_admin' => 'Manager',
                'role' => 'manager',
                'nip' => '123456789',
                'alamat' => 'Jl. Contoh Alamat No. 1',
                'tanggal_lahir' => '1990-01-01',
                'nik' => '1234567890123456',
                'nohp' => '081234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2, // Pastikan user_id ini ada di tabel users
                'nama_admin' => 'Kasir',
                'role' => 'Kasir',
                'nip' => '123456789',
                'alamat' => 'Jl. Contoh Alamat No. 2',
                'tanggal_lahir' => '1990-01-02',
                'nik' => '1234567890123457',
                'nohp' => '081234567891',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // [
            //     'user_id' => 3, // Pastikan user_id ini ada di tabel users
            //     'nama_admin' => 'Admin Apoteker',
            //     'role' => 'Apoteker',
            //     'nip' => '123456789',
            //     'alamat' => 'Jl. Contoh Alamat No. 3',
            //     'tanggal_lahir' => '1990-01-03',
            //     'nik' => '1234567890123458',
            //     'nohp' => '081234567892',
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'user_id' => 4, // Pastikan user_id ini ada di tabel users
            //     'nama_admin' => 'Admin Dokter',
            //     'role' => 'Dokter',
            //     'nip' => '123456789',
            //     'alamat' => 'Jl. Contoh Alamat No. 4',
            //     'tanggal_lahir' => '1990-01-04',
            //     'nik' => '1234567890123459',
            //     'nohp' => '081234567893',
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
        ]);
    }
}
