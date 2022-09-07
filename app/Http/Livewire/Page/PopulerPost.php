<?php

namespace App\Http\Livewire\Page;

use App\Models\Artikel;
use Livewire\Component;

class PopulerPost extends Component
{

    public function render()
    {
        $artikelavg = Artikel::all()->avg('visitor');
        $artikel = Artikel::where('visitor', '>=', $artikelavg)->where('active', 1)->latest()->get()->take(5);
        return view('livewire.page.populer-post', compact('artikel'));
    }
}