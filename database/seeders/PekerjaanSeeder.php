<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PekerjaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pekerjaans')->insert([
            ['pekerjaan' => 'Petani'],
            ['pekerjaan' => 'Pencuri'],
            ['pekerjaan' => 'Pegawai']
        ]);
    }
}