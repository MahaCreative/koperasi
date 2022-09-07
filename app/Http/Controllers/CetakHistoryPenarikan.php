<?php

namespace App\Http\Controllers;

use App\Models\DetailPenarikanSimpanan;
use App\Models\ProfileKoperasi;
use Illuminate\Http\Request;

class CetakHistoryPenarikan extends Controller
{
    public function index()
    {

        // dd($tanggal, $sampai);
        $profile = ProfileKoperasi::first();
        // dd($profile);
        $histori = session('data');
        // dd($histori);
        return view('cetak.cetak-histori-penarikan-simpanan', compact('histori', 'profile'));
    }

    public function hitoriPembayaran()
    {
        $profile = ProfileKoperasi::first();
        // dd($profile);
        $histori = session('data');
        // dd($histori);
        return view('cetak.cetak-histori-pembayaran-pinjaman', compact('histori', 'profile'));
    }
}