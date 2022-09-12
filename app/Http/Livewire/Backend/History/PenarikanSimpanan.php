<?php

namespace App\Http\Livewire\Backend\History;

use App\Models\DetailDataPinjaman;
use App\Models\DetailPenarikanSimpanan;
use Illuminate\Support\Facades\DB;
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
        // $this->histori = DetailPenarikanSimpanan::latest()->get()->take($this->paginate);

        // dd($this->histori);
    }
    public function render()
    {
        if ($this->dari_tanggal == '' or $this->sampai_tanggal) {
            if ($this->checkRole == 'super admin') {
                $this->histori = $this->query()
                    ->get();
            } else if ($this->checkRole == 'petugas') {
                $this->histori = $this->query()
                    ->where('simpanan_users.petugas_id', auth()->user()->id)
                    ->get();
            } else if ($this->checkRole == 'anggota') {
                $this->histori = $this->query()
                    ->where('simpanan_users.profile_user_id', auth()->user()->profile->id)
                    ->get();
            }
        } else {
            if ($this->checkRole == 'super admin') {
                $this->histori = $this->query()
                    ->whereDate('detail_penarikan_simpanans.tanggal_penarikan', '>', $this->dari_tanggal)
                    ->whereOr('detail_penarikan_simpanans.tanggal_penarikan', '<=', $this->sampai_tanggal)
                    ->get();
            } else if ($this->checkRole == 'petugas') {
                $this->histori = $this->query()
                    ->whereDate('detail_penarikan_simpanans.tanggal_penarikan', '>', $this->dari_tanggal)
                    ->whereOr('detail_penarikan_simpanans.tanggal_penarikan', '<=', $this->sampai_tanggal)
                    ->where('simpanan_users.petugas_id', auth()->user()->id)
                    ->get();
            } else if ($this->checkRole == 'anggota') {
                $this->histori = $this->query()
                    ->whereDate('detail_penarikan_simpanans.tanggal_penarikan', '>', $this->dari_tanggal)
                    ->whereOr('detail_penarikan_simpanans.tanggal_penarikan', '<=', $this->sampai_tanggal)
                    ->where('simpanan_users.profile_user_id', auth()->user()->profile->id)
                    ->get();
            }
        }
        return view('livewire.backend.history.penarikan-simpanan');
    }

    public function query()
    {
        return DB::table('detail_penarikan_simpanans')
            ->join('penarikan_simpanans', 'detail_penarikan_simpanans.penarikan_simpanan_id', '=', 'penarikan_simpanans.id')
            ->join('simpanan_users', 'simpanan_users.id', 'penarikan_simpanans.simpanan_user_id')
            ->join('pinjaman_users', 'pinjaman_users.id', 'simpanan_users.pinjaman_user_id')
            ->join('detail_data_pinjamen', 'pinjaman_users.detail_data_pinjaman_id', 'detail_data_pinjamen.id')
            ->join('profile_users', 'simpanan_users.profile_user_id', '=', 'profile_users.id')
            ->join('users', 'users.id', '=', 'simpanan_users.petugas_id');
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