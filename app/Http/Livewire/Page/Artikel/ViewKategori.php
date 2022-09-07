<?php

namespace App\Http\Livewire\Page\Artikel;

use App\Models\Artikel;
use App\Models\Kategori;
use Livewire\Component;

class ViewKategori extends Component
{
    public $kategori;
    public function mount($cari)
    {
        $this->kategori = Kategori::where('slug', $cari)->get();
    }

    public function render()
    {
        $artikel = Artikel::with('user')->where('kategori_id', $this->kategori[0]['id'])->paginate();
        // dd($artikel);
        return view('livewire.page.artikel.viewkategori', compact('artikel'))->layout('user.app');
    }
}