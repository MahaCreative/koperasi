<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();



        $user = User::create([
            'username' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('password')

        ]);
        $user2 = User::create([
            'username' => 'petugas',
            'email' => 'petugas@gmail.com',
            'password' => bcrypt('password')

        ]);
        $user3 = User::create([
            'username' => 'anggota',
            'email' => 'anggota@gmail.com',
            'password' => bcrypt('password')

        ]);

        $this->call([
            ProfileKoperasiSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            PekerjaanSeeder::class,
            ProfileSeeder::class
        ]);

        $user->assignRole('super admin');
        $user2->assignRole('petugas');
        $user3->assignRole('anggota');
        $role1 = Role::find(1);
        $role1->givePermissionTo([
            'create jenis simpanan',
            'edit jenis simpanan',
            'delete jenis simpanan',
            'create data pinjaman',
            'edit data pinjaman',
            'delete data pinjaman',
            // Data ANggota
            'lihat anggota',
            'create anggota',
            'edit anggota',
            'delete anggota',
            'cetak anggota',
            // Pinjaman User
            'create pinjaman user',
            'edit pinjaman user',
            'delete pinjaman user',
            'cetak pinjaman user',
            'setujui pinjaman user',
            'lunasi pinjaman user',
            // Simpanan
            'create simpanan user',
            'edit simpanan user',
            'delete simpanan user',
            'cetak simpanan user',
            'setujui simpanan user',
            'tarik simpanan user',
            // Akun Petugas
            'lihat akun petugas',
            'create akun petugas',
            'edit akun petugas',
            'delete akun petugas',
            // jabatan
            'create jenis jabatan',
            'edit jenis jabatan',
            'delete jenis jabatan',
            'create jabatan anggota',
            'edit jabatan anggota',
            'delete jabatan anggota',
        ]);
        $role2 = Role::find(2);
        $role2->givePermissionTo([
            // Anggota Koperasi

            'lihat anggota',
            'create anggota',
            'edit anggota',
            'delete anggota',
            'cetak anggota',

            // Pinjaman User
            'create pinjaman user',
            'edit pinjaman user',
            'cetak pinjaman user',

            // Simpanan User
            'create simpanan user',
            'edit simpanan user',
            'cetak simpanan user',
            'tarik simpanan user',
            // Akun Petugas
            'lihat akun petugas',

            'create jenis jabatan',
            'edit jenis jabatan',
            'delete jenis jabatan',

        ]);
    }
}