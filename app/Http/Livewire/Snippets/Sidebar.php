<?php

namespace App\Http\Livewire\Snippets;

use App\Models\ProfileKoperasi;
use Livewire\Component;

class Sidebar extends Component
{
    public $checkRole, $profile;

    public function mount()
    {
        $this->checkRole  = auth()->user()->getRoleNames()[0];
    }
    public function render()
    {
        $this->profile = ProfileKoperasi::first();
        return view('livewire.snippets.sidebar');
    }
}