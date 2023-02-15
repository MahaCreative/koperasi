<?php

namespace App\Http\Livewire\Components;

use App\Models\DataAngsuran;
use App\Models\DataPinjaman;
use App\Models\DetailDataPinjaman;
use Livewire\Component;

class Pinjaman extends Component
{
    public $pinjaman, $durasi;
    public $detailDataPinjaman;
    public $selectPinjaman, $selectDurasi, $valselectPinjaman, $valselectDurasi;
    public $detailPinjaman, $detailAngsuran;
    public $pinjamanId, $durasiId = '';
    public $totalTerima, $totalBayar, $simpanan;
    public function render()
    {
        $this->pinjaman = DataPinjaman::latest()->get();
        $this->durasi = DataAngsuran::latest()->get();
        $this->detailDataPinjaman = DetailDataPinjaman::with('data_pinjaman','data_angsuran')->latest()->get();
        $minPinjaman = DataPinjaman::all()->min('pinjaman');
        $maxPinjaman = DataPinjaman::all()->max('pinjaman');
        $minDurasi = DataAngsuran::all()->min('durasi_angsuran');
        $maxDurasi = DataAngsuran::all()->max('durasi_angsuran');


        $this->select();
        return view('livewire.components.pinjaman', compact('minPinjaman', 'maxPinjaman', 'minDurasi', 'maxDurasi'));
    }
    public function changePinjaman($value)
    {
        if ($this->selectPinjaman !== null) {
            $pinjaman = DataPinjaman::findOrfail($value);
            $this->valselectPinjaman = $pinjaman->pinjaman;
            $this->pinjamanId = $pinjaman->id;
        }
    }

    public function changeDurasi($value)
    {
        if ($this->selectDurasi !== null) {
            $pinjaman = DataAngsuran::findOrfail($value);
            $this->valselectDurasi = $pinjaman->durasi_angsuran;
            $this->durasiId = $pinjaman->id;
        }
    }
    public function select()
    {
        if ($this->pinjamanId !== '' and $this->durasiId !== '') {
            $this->detailPinjaman = DetailDataPinjaman::where('data_pinjaman_id', $this->pinjamanId)->where('data_angsuran_id', $this->durasiId)->first();
            // dd($this->detailPinjaman->simpanan);
            $this->totalTerima = $this->valselectPinjaman - $this->detailPinjaman->simpanan;
            $this->totalBayar = $this->detailPinjaman->angsuran;
            $this->simpanan = $this->detailPinjaman->simpanan;
            // dd($this->totalTerima);
        }
    }
}