<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class Navbar extends Component
{
    public $search = '';
    public function render()
    {
        return view('livewire.components.navbar');
    }
    public function search($item)
    {
        // return redirect()
        return redirect()->route('artikel-search', $item);
    }
}