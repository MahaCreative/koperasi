<?php

namespace App\Http\Livewire\Page\Artikel;

use App\Models\Artikel;
use App\Models\Iklan;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public function render()
    {
        $iklan = Iklan::latest()->get()->take(2);
        $artikel = Artikel::with('user')->where('active', true)->latest()->paginate(5);

        return view('livewire.page.artikel.index', compact('iklan', 'artikel'))->layout('user.app');
    }
}