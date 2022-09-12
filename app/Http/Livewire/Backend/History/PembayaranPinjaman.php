<?php

namespace App\Http\Livewire\Backend\History;

use App\Models\DetailPembayaranUser;
use Illuminate\Support\Facades\DB;
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
            $this->histori = $this->query()->get();
        } else if ($this->checkRole == 'petugas') {
            $this->histori = $this->query()->where('pinjaman_users.petugas_id', auth()->user()->id)->get();
        } else if ($this->checkRole == 'anggota') {
            $this->histori = $this->query()
                ->where('pinjaman_users.profile_user_id', auth()->user()->profile->id)
                ->get();

            // dd($this->histori);
        }
    }
    public function render()
    {
        if ($this->dari_tanggal == '' or $this->sampai_tanggal) {
            if ($this->checkRole == 'super admin') {
                $this->histori = $this->query()->get();
            } else if ($this->checkRole == 'petugas') {
                $this->histori = $this->query()->where('pinjaman_users.petugas_id', auth()->user()->id)->get();
            } else if ($this->checkRole == 'anggota') {
                $this->histori = $this->query()
                    ->where('pinjaman_users.profile_user_id', auth()->user()->profile->id)
                    ->get();
            }
        } else {
            if ($this->checkRole == 'super admin') {
                $this->histori = $this->query()->whereDate('detail_pembayaran_users.created_at', '>', $this->dari_tanggal)
                    ->whereOr('detail_pembayaran_users.created_at', '<=', $this->sampai_tanggal)->get();
            } else if ($this->checkRole == 'petugas') {
                $this->histori = $this->query()
                    ->whereDate('detail_pembayaran_users.created_at', '>', $this->dari_tanggal)->where('pinjaman_users.petugas_id', auth()->user()->id)->get();
            } else if ($this->checkRole == 'anggota') {
                $this->histori = $this->query()
                    ->whereOr('detail_pembayaran_users.created_at', '<=', $this->sampai_tanggal)
                    ->where('pinjaman_users.profile_user_id', auth()->user()->profile->id)
                    ->get();
            }
        }

        return view('livewire.backend.history.pembayaran-pinjaman');
    }

    public function query()
    {

        return DB::table('detail_pembayaran_users')
            ->join('pembayaran_users', 'pembayaran_users.id', '=', 'detail_pembayaran_users.pembayaran_user_id')
            ->join('pinjaman_users', 'pinjaman_users.id', '=', 'pembayaran_users.pinjaman_user_id')
            ->join('detail_data_pinjamen', 'detail_data_pinjamen.id', '=', 'pinjaman_users.detail_data_pinjaman_id')
            ->join('data_pinjamen', 'data_pinjamen.id', 'detail_data_pinjamen.data_pinjaman_id')
            ->join('profile_users', 'profile_users.id', '=', 'pinjaman_users.profile_user_id')
            ->join('users', 'users.id', '=', 'pinjaman_users.petugas_id');
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
        // if ($this->checkRole == 'super admin') {
        //     $this->histori = $this->query()
        //         ->whereDate('created_at', '>', $this->dari_tanggal)
        //         ->whereOr('tanggal_penarikan', '<=', $this->sampai_tanggal)->get();
        // } else if ($this->checkRole == 'petugas') {
        //     $this->histori = $this->query()
        //         ->whereDate('created_at', '>', $this->dari_tanggal)
        //         ->whereOr('tanggal_penarikan', '<=', $this->sampai_tanggal)->where('pinjaman_users.petugas_id', auth()->user()->id)->get();
        // } else if ($this->checkRole == 'anggota') {
        //     $this->histori = $this->query()
        //         ->whereDate('created_at', '>', $this->dari_tanggal)
        //         ->whereOr('tanggal_penarikan', '<=', $this->sampai_tanggal)
        //         ->where('pinjaman_users.profile_user_id', auth()->user()->profile->id)
        //         ->get();
        // }
        // dd($this->histori);
    }

    public function print($value)
    {
        $this->showModal = $value;
        return redirect()->route('cetak-histori-pembayaran-pinjaman')->with('data', $this->histori);
    }
}