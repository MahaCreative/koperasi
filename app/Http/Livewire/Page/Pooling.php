<?php

namespace App\Http\Livewire\Page;

use App\Models\Pooling as ModelsPooling;
use Livewire\Component;

class Pooling extends Component
{
    public $poolingStatus = false;
    public $listeners = ['poolingHandler' => 'pooling'];
    public function render()
    {
        return view('livewire.page.pooling')->layout('user.app');
    }

    public function suka()
    {
        $pooling = ModelsPooling::create(['status' => true]);
        $this->poolingStatus = false;
    }
    public function tidaksuka()
    {
        $pooling = ModelsPooling::create(['status' => false]);
        $this->poolingStatus = false;
    }
}