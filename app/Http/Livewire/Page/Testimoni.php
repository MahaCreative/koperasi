<?php

namespace App\Http\Livewire\Page;

use App\Models\Testimoni as ModelsTestimoni;
use Livewire\Component;

class Testimoni extends Component
{
    public function render()
    {
        $testimoni = ModelsTestimoni::with('user')->latest()->get();
        // dd($testimoni);
        return view('livewire.page.testimoni', compact('testimoni'));
    }
}