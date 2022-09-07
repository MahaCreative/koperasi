<?php

namespace App\Http\Livewire\Page;

use App\Models\About as ModelsAbout;
use App\Models\ProfileKoperasi;
use Livewire\Component;

class About extends Component
{
    public $about;
    public $profile;

    public function updateAbout($value)
    {
        $this->about = $value;
    }

    public function mount()
    {
        $this->profile = ProfileKoperasi::first();
        $this->about = ModelsAbout::latest()->take(1)->first();
        // dd($this->about);
    }
    public function render()
    {
        return view('livewire.page.about')->layout('user.app');
    }
}