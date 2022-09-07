<?php

namespace App\Http\Livewire\Backend\History;

use App\Models\DetailPembayaranUser;
use Livewire\Component;

class PembayaranPinjaman extends Component
{
    public $checkRole;
    public $paginate = 15;
    public $showModal = 'filter';
    public $titleModals = 'Filter Data Histori';
    public $dari_tanggal, $sampai_tanggal = '';
    public $histori;
    public function mount()
    {

        $this->checkRole  = auth()->user()->getRoleNames()[0];
        if ($this->checkRole == 'super admin') {
            $this->histori = DetailPembayaranUser::latest()->get()->take($this->paginate);
        } else if ($this->checkRole == 'anggota') {
            $this->histori = DetailPembayaranUser::with(['pinjaman_user' => function ($query) {
                $query->where('profile_user_id', auth()->user()->id)->get();
            }])->latest()->get()->take($this->paginate);
        }
    }
    public function render()
    {
        return view('livewire.backend.history.pembayaran-pinjaman');
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
        $this->histori = DetailPembayaranUser::whereDate('created_at', '>', $this->dari_tanggal)
            ->whereOr('tanggal_penarikan', '<=', $this->sampai_tanggal)
            ->latest()->get();
        // dd($this->histori);
    }

    public function print($value)
    {
        $this->showModal = $value;
        return redirect()->route('cetak-histori-pembayaran-pinjaman')->with('data', $this->histori);
    }
}