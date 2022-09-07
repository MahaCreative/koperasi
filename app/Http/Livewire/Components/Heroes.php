<?php

namespace App\Http\Livewire\Components;

use App\Models\Heroes as ModelsHeroes;
use Livewire\Component;

class Heroes extends Component
{
    public $heroes;
    public function render()
    {
        $this->heroes = ModelsHeroes::first();
        return view('livewire.components.heroes');
    }
}