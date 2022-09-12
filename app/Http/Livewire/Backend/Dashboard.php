<?php

namespace App\Http\Livewire\Backend;

use App\Http\Livewire\Backend\PinjamanUser as BackendPinjamanUser;
use App\Models\Artikel;
use App\Models\DataPinjaman;
use App\Models\PinjamanUser;
use App\Models\ProfileUser;
use App\Models\SimpananUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboard extends Component
{
    public $pinjaman, $simpanan;
    public $statusViewModal = 'modalFilterPinjaman';
    public $titleModals = 'Filter Pinjaman';
    public $from_date = '';
    public $to_date = '';

    public function render()
    {
        $this->pinjaman = $this->query()
            ->whereBetween(DB::raw('DATE(pinjaman_users.created_at)'), array(Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()))
            ->get();
        $this->simpanan = $this->querySimpanan()
            ->whereBetween(DB::raw('DATE(simpanan_users.created_at)'), array(Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()))
            ->get();

        $data = json_encode($this->pinjaman);
        $data2 = json_encode($this->simpanan);
        $pinjamanCount = PinjamanUser::where('status_pinjaman', true)->count();
        $pinjamanBelumLunas = PinjamanUser::where('status_pinjaman', true)->where('status_lunas', false)->count();
        $pinjamanLunas = PinjamanUser::where('status_pinjaman', true)->where('status_lunas', true)->count();
        $rupiahPinjaman = DB::table('pinjaman_users')->join('detail_data_pinjamen', 'pinjaman_users.detail_data_pinjaman_id', '=', 'detail_data_pinjamen.id')
            ->join('data_pinjamen', 'detail_data_pinjamen.data_pinjaman_id', '=', 'data_pinjamen.id')
            ->where('pinjaman_users.status_pinjaman', true)
            ->sum('data_pinjamen.pinjaman');
        $anggota = ProfileUser::count();

        $simpananCount = SimpananUser::where('status_simpanan', true)->count();
        $simpananRupiah = DB::table('simpanan_users')->join('pinjaman_users', 'pinjaman_users.id', '=', 'simpanan_users.pinjaman_user_id')
            ->join('detail_data_pinjamen', 'pinjaman_users.detail_data_pinjaman_id', '=', 'detail_data_pinjamen.id')
            ->where('simpanan_users.status_simpanan', true)
            ->sum('detail_data_pinjamen.simpanan');

        $artikelCount = Artikel::where('active', true)->count();
        $artikelVisitor = Artikel::where('active', true)->sum('visitor');

        return view('livewire.backend.dashboard', compact(
            'data',
            'anggota',
            'pinjamanLunas',
            'pinjamanBelumLunas',
            'pinjamanCount',
            'rupiahPinjaman',
            'simpananCount',
            'simpananRupiah',
            'artikelCount',
            'artikelVisitor',
        ));
    }

    public function query()
    {
        return DB::table('pinjaman_users')->join('detail_data_pinjamen', 'pinjaman_users.detail_data_pinjaman_id', '=', 'detail_data_pinjamen.id')
            ->join('data_pinjamen', 'detail_data_pinjamen.data_pinjaman_id', '=', 'data_pinjamen.id')
            ->select(
                DB::raw("DATE_FORMAT(pinjaman_users.created_at, '%d-%m-%Y') as tanggal"),
                DB::raw('sum(data_pinjamen.pinjaman) as pinjaman')
            )
            ->orderBy('pinjaman_users.created_at')
            ->groupBy(DB::raw("DATE_FORMAT(pinjaman_users.created_at, '%d-%m-%Y')"));
    }

    public function querySimpanan()
    {
        return DB::table('simpanan_users')->join('pinjaman_users', 'pinjaman_users.id', '=', 'simpanan_users.pinjaman_user_id')
            ->join('detail_data_pinjamen', 'pinjaman_users.detail_data_pinjaman_id', '=', 'detail_data_pinjamen.id')
            ->select(
                DB::raw("DATE_FORMAT(simpanan_users.created_at, '%d-%m-%Y') as tanggal"),
                DB::raw('sum(detail_data_pinjamen.simpanan) as simpanan')
            )
            ->orderBy('simpanan_users.created_at')
            ->groupBy(DB::raw("DATE_FORMAT(simpanan_users.created_at, '%d-%m-%Y')"));
    }

    public function filterSimpanan()
    {
        // if ($this->from_date == '' and $this->to_date == '') {
        //     $this->simpanan = $this->querySimpanan()
        //         ->whereBetween(DB::raw('DATE(simpanan_users.created_at)'), array(Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()))
        //         ->get();
        // } else if ($this->from_date !== '' and $this->to_date == '') {
        //     $this->simpanan = $this->querySimpanan()
        //         ->whereBetween(DB::raw('DATE(simpanan_users.created_at)'), array($this->from_date, Carbon::now()->endOfMonth()))
        //         ->get();
        // } else if ($this->from_date !== '' and $this->to_date !== '') {
        //     $this->simpanan = $this->querySimpanan()
        //         ->whereBetween(DB::raw('DATE(simpanan_users.created_at)'), array($this->from_date, $this->to_date))
        //         ->get();
        // }
        // $this->dispatchBrowserEvent('updateGrafikSimpanan', ['data' => $this->simpanan]);
    }

    public function filterPinjaman()
    {

        if ($this->from_date == '' and $this->to_date == '') {
            $this->pinjaman = $this->query()
                ->whereBetween(DB::raw('DATE(pinjaman_users.created_at)'), array(Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()))
                ->get();
        } else if ($this->from_date !== '' and $this->to_date == '') {
            $this->pinjaman = $this->query()
                ->whereBetween(DB::raw('DATE(pinjaman_users.created_at)'), array($this->from_date, Carbon::now()->endOfMonth()))
                ->get();
        } else if ($this->from_date !== '' and $this->to_date !== '') {
            $this->pinjaman = $this->query()
                ->whereBetween(DB::raw('DATE(pinjaman_users.created_at)'), array($this->from_date, $this->to_date))
                ->get();
        }
        $this->dispatchBrowserEvent('updatedGrafikPinjaman', ['data' => $this->pinjaman]);
    }

    public function fiewModal($value)
    {
        $this->statusViewModal = $value;
        if ($this->statusViewModal == 'modalFilterPinjaman') {
            $this->titleModals = 'Filter Pinjaman';
        } else if ($this->statusViewModal == 'modalFilterSimpanan') {
            $this->titleModals = 'Filter Simpanan';
        }
    }
}