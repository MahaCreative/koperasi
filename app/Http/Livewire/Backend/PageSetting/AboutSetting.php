<?php

namespace App\Http\Livewire\Backend\PageSetting;

use App\Http\Livewire\Page\About;
use App\Models\About as ModelsAbout;
use App\Models\ProfileKoperasi;
use Livewire\Component;

class AboutSetting extends Component
{
    public $kontent;
    public $status = 0;
    public $about;
    public $profile;

    public function hydrate($item)
    {
        $this->status = 'success';
    }

    public function mount()
    {

        // dd($this->about);
    }
    public function render()
    {
        // $this->about = About::latest()->take(1)->first();
        $this->profile = ProfileKoperasi::first();
        // dd($this->profile);
        return view('livewire.backend.page-setting.about-setting');
    }
    public function submitHandler()
    {

        $this->about = ModelsAbout::create(
            [
                'user_id' => auth()->user()->id,
                'kontent' => $this->kontent
            ]
        );
        $this->emit('success', ['pesan' => 'Sukses menambah data']);
    }
}