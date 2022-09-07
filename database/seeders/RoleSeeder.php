<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(
            [
                [
                    'name' => 'super admin',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'petugas',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'anggota',
                    'guard_name' => 'web'
                ],
            ]

        );
    }
}