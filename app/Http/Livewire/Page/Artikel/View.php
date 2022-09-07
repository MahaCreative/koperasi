<?php

namespace App\Http\Livewire\Page\Artikel;

use App\Models\Artikel;
use Livewire\Component;

class View extends Component
{
    public $artikel;
    public function mount($slug)
    {
        $this->artikel = Artikel::where('active', true)->where('slug', $slug)->get()->take(1);
        // dd($this->artikel);

        if (count($this->artikel) == 0) {
            abort(404);
        }

        $this->artikel[0]['visitor'] = $this->artikel[0]['visitor'] + 1;
        $this->artikel[0]->save();
    }
    public function render()
    {

        return view('livewire.page.artikel.view')->layout('user.app');
    }
}