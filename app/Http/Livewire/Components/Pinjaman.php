<?php

namespace App\Http\Livewire\Components;

use App\Models\DataAngsuran;
use App\Models\DataPinjaman;
use Livewire\Component;

class Pinjaman extends Component
{
    public $pinjaman, $durasi;
    public $selectPinjaman, $selectDurasi, $valselectPinjaman, $valselectDurasi;

    public function render()
    {
        $this->pinjaman = DataPinjaman::latest()->get();
        $this->durasi = DataAngsuran::latest()->get();
        $minPinjaman = DataPinjaman::all()->min('pinjaman');
        $maxPinjaman = DataPinjaman::all()->max('pinjaman');
        $minDurasi = DataAngsuran::all()->min('durasi_angsuran');
        $maxDurasi = DataAngsuran::all()->max('durasi_angsuran');
        return view('livewire.components.pinjaman', compact('minPinjaman', 'maxPinjaman', 'minDurasi', 'maxDurasi'));
    }
    public function changePinjaman($value)
    {
        if ($this->selectPinjaman !== null) {
            $pinjaman = DataPinjaman::findOrfail($value);
            $this->valselectPinjaman = $pinjaman->pinjaman;
        }
    }
    public function changeDurasi($value)
    {
        if ($this->selectDurasi !== null) {
            $pinjaman = DataAngsuran::findOrfail($value);
            $this->valselectDurasi = $pinjaman->durasi_angsuran;
        }
    }
}