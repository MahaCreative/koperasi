<?php

namespace App\Http\Livewire\Backend\History;

use App\Models\DetailDataPinjaman;
use App\Models\DetailPenarikanSimpanan;
use Livewire\Component;
use Livewire\WithPagination;

class PenarikanSimpanan extends Component
{
    // use WithPagination;
    public $checkRole;
    public $paginate = 15;
    public $showModal = 'filter';
    public $titleModals = 'Filter Data Histori';
    public $dari_tanggal, $sampai_tanggal = '';
    public $histori;
    public function mount()
    {
        $this->checkRole  = auth()->user()->getRoleNames()[0];
        $this->histori = DetailPenarikanSimpanan::latest()->get()->take($this->paginate);
    }
    public function render()
    {


        // dd($histori)

        return view('livewire.backend.history.penarikan-simpanan');
    }

    public function displaymodal($value)
    {
        $this->showModal = $value;

        if ($this->showModal == 'filter') {
            $this->titleModals = 'Filter Data History';
        }
    }

    public function filterData()
    {
        $this->histori = DetailPenarikanSimpanan::whereDate('tanggal_penarikan', '>', $this->dari_tanggal)
            ->whereOr('tanggal_penarikan', '<=', $this->sampai_tanggal)
            ->latest()->get();
        // dd($this->histori);
    }

    public function print($value)
    {
        $this->showModal = $value;
        return redirect()->route('cetak-histori-penarikan-simpanan')->with('data', $this->histori);
    }
}