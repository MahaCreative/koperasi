<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PinjamanUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kode_pinjaman' => 'ff00' . rand(1, 999),
            'profile_user_id' => rand(1, 2),
            'detail_data_pinjaman_id' => rand(1, 3),
            'petugas_id' => rand(1, 3),
            'status_pinjaman' => true,
            'status_lunas' => false,
            'tanggal_pengajuan' => $this->faker->date(),
        ];
    }
}