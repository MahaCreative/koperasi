<?php

namespace App\Http\Controllers;

use App\Models\ProfileKoperasi;
use Illuminate\Http\Request;

class cetakPembayaran extends Controller
{
    public function index()
    {
        $profile = ProfileKoperasi::first();
        $lihatpembayaran = session('data');
        // dd($lihatpembayaran);
        return view('cetak.cetak-pembayaran', compact('lihatpembayaran', 'profile'));
    }
}