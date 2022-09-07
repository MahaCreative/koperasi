<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert(
            [
                // Jenis Simpanan
                [
                    'name' => 'create jenis simpanan',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'edit jenis simpanan',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'delete jenis simpanan',
                    'guard_name' => 'web'
                ],

                // Data Pinjaman
                [
                    'name' => 'create data pinjaman',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'edit data pinjaman',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'delete data pinjaman',
                    'guard_name' => 'web'
                ],
                // Anggota Koperasi
                [
                    'name' => 'lihat anggota',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'create anggota',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'edit anggota',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'delete anggota',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'cetak anggota',
                    'guard_name' => 'web'
                ],

                // Petugas

                [
                    'name' => 'lihat akun petugas',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'create akun petugas',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'edit akun petugas',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'delete akun petugas',
                    'guard_name' => 'web'
                ],

                // Pinjaman User
                [
                    'name' => 'create pinjaman user',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'edit pinjaman user',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'delete pinjaman user',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'cetak pinjaman user',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'setujui pinjaman user',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'lunasi pinjaman user',
                    'guard_name' => 'web'
                ],
                // Simpanan User
                [
                    'name' => 'create simpanan user',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'edit simpanan user',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'delete simpanan user',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'cetak simpanan user',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'setujui simpanan user',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'tarik simpanan user',
                    'guard_name' => 'web'
                ],
                // Jabatan
                [
                    'name' => 'create jenis jabatan',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'edit jenis jabatan',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'delete jenis jabatan',
                    'guard_name' => 'web'
                ],

                // Jabatan Anggota
                [
                    'name' => 'create jabatan anggota',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'edit jabatan anggota',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'delete jabatan anggota',
                    'guard_name' => 'web'
                ],




            ]

        );
    }
}