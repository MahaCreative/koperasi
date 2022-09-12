<?php

namespace App\Http\Controllers;

use App\Models\ProfileKoperasi;
use Illuminate\Http\Request;
use Nette\Utils\Json;

class CetaKAnggotaKoperasi extends Controller
{
    public function index()
    {
        $profile = ProfileKoperasi::first();
        $data = session('data');
        // dd($data);

        $print = $data['data'];
        // dd($print);
        return view('cetak.cetak-anggota-koperasi', compact('profile', 'print'));
    }
}