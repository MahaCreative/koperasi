<?php

namespace App\Http\Controllers;

use App\Models\ProfileKoperasi;
use Illuminate\Http\Request;

class CetakPinjamanAnggota extends Controller
{
    public function index()
    {
        $profile = ProfileKoperasi::first();
        $data = session('data');
        // dd($data);

        $print = $data['data'];
        // dd($print);
        return view('cetak.cetak-pinjaman-anggota', compact('profile', 'print'));
    }
}