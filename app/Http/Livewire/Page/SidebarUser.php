<?php

namespace App\Http\Livewire\Page;

use App\Models\Artikel;
use App\Models\Iklan;
use App\Models\Kategori;
use Livewire\Component;

class SidebarUser extends Component
{
    public $iklan;
    public $aktegori;
    public $newPost;
    public function render()
    {
        $this->iklan = Iklan::latest()->get()->take(2);
        $this->kategori = Kategori::latest()->get();
        $this->newPost = Artikel::where('active', 1)->latest()->get()->take(5);
        return view('livewire.page.sidebar-user');
    }
}