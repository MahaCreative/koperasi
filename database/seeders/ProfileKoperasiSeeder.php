<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileKoperasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profile_koperasis')->insert([
            'nama_koperasi' => 'Koperasi Berkah',
            'nama_perusahaan' => '',
            'badan_hukum' => '123.21445.22254.10',
            'alamat' => 'Jl Poros Malunda',
            'kota' => 'Malunda',
            'provinsi' => 'Sulawesi Barat',
            'kode_pos' => '91515',
            'no_telp' => '082194255717',
            'fax' => '',
            'nama_pimpinan' => '',
            'nama_bendahara' => '',
            'nama_sekretaris' => '',
            'logo' => '',
        ]);
    }
}