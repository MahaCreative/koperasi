<?php

namespace App\Http\Livewire\Page\Artikel;

use App\Models\Artikel;
use Livewire\Component;

class Search extends Component
{
    public $artikel;

    public function mount($cari)
    {
        $this->artikel = Artikel::with('user')->where('judul', 'like', '%' . $cari . '%')->where('active', true)
            ->get();
    }

    public function render()
    {
        return view('livewire.page.artikel.search')->layout('user.app');
    }
}