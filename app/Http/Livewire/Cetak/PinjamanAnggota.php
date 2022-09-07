<?php

namespace App\Http\Livewire\Cetak;

use App\Models\ProfileKoperasi;
use Livewire\Component;

class PinjamanAnggota extends Component
{

    public function render()
    {
        $koperasi = ProfileKoperasi::first();

        return view('livewire.cetak.pinjaman-anggota', compact('koperasi'))->layout('layouts.cetak');
    }
}