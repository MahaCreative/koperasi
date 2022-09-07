<?php

namespace App\Http\Livewire\Page;

use App\Models\CaraMeminjam;
use App\Models\Keunggulan;
use App\Models\Syarat;
use Livewire\Component;

class Home extends Component
{
    public $caraPinjaman;
    public $keunggulan;
    public $modelSyarat;
    public $settingStatus = 'keunggulan';
    public function render()
    {
        $this->caraPinjaman = CaraMeminjam::with('cara_meminjam_detail')->latest()->get();
        $this->keunggulan = Keunggulan::latest()->get();
        $this->modelSyarat = Syarat::latest()->get();
        return view('livewire.page.home')->layout('layouts.front');
    }
    public function setting($value)
    {
        $this->settingStatus = $value;
    }
}