<?php

namespace App\Http\Livewire\Page;

use App\Models\Galery as ModelsGalery;
use Livewire\Component;


class Galery extends Component
{
    public $galery;
    public function render()
    {
        $this->galery = ModelsGalery::latest()->get();
        return view('livewire.page.galery')->layout('user.app');
    }
}