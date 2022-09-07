<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profile_users')->insert([
            [

                'nik' => 7306071701980005,
                'no_kk' => 7306071701980005,
                'nama_lengkap' => 'Guntur Madjid',
                'tempat_lahir' => 'Makassar',
                'ttl' => '1998-01-17',
                'no_telp' => '082194255717',
                'alamat' => 'Jl Diponegoro',
                'kecamatan' => 'Mamuju',
                'kelurahan' => 'Karema',
                'kabupaten' => 'Mamuju',
                'provinsi' => 'Sulawesi Barat',
                'pekerjaan_id' => 1,
                'petugas_id' => 2,
            ],
            [

                'nik' => 7306071701980006,
                'no_kk' => 7306071701980006,
                'nama_lengkap' => 'Rahmat',
                'tempat_lahir' => 'Makassar',
                'ttl' => '1998-01-17',
                'no_telp' => '082194255718',
                'alamat' => 'Jl Diponegoro',
                'kecamatan' => 'Mamuju',
                'kelurahan' => 'Karema',
                'kabupaten' => 'Mamuju',
                'provinsi' => 'Sulawesi Barat',
                'pekerjaan_id' => 1,
                'petugas_id' => 2,
            ],
            [

                'nik' => 7306071701980007,
                'no_kk' => 7306071701980007,
                'nama_lengkap' => 'Mosa',
                'tempat_lahir' => 'Makassar',
                'ttl' => '1998-01-17',
                'no_telp' => '082194255717',
                'alamat' => 'Jl Diponegoro',
                'kecamatan' => 'Mamuju',
                'kelurahan' => 'Karema',
                'kabupaten' => 'Mamuju',
                'provinsi' => 'Sulawesi Barat',
                'pekerjaan_id' => 1,
                'petugas_id' => 2,
            ]
        ]);
    }
}