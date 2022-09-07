<?php

namespace App\Http\Livewire\Backend\Pesan;

use App\Models\Testimoni;
use Livewire\Component;

class ManageTestimoni extends Component
{
    public $testimoni, $getTesti;
    public $statusForm = false;
    public $updateStatus = false;
    public $testimoniField;

    public function render()
    {
        $this->testimoni = Testimoni::latest()->get();
        return view('livewire.backend.pesan.manage-testimoni');
    }


    public function submitHandler()
    {
        $this->validate([
            'testimoniField' => 'required'
        ]);
        $testimoni = Testimoni::create([
            'user_id' => auth()->user()->id,
            'testimoni' => $this->testimoniField,
            'status' => false,
        ]);
        session()->flash('message', 'Sukses menambahkan testimoni');
    }

    public function edit($item)
    {

        $this->updateStatus = true;
        $this->statusForm = !$this->statusForm;
        $this->getTesti = Testimoni::findOrfail($item);
        $this->testimoniField = $this->getTesti->testimoni;
    }

    public function updateHandler()
    {

        $this->validate([
            'testimoniField' => 'required'
        ]);
        $this->getTesti->testimoni = $this->testimoniField;
        $this->getTesti->save();
        session()->flash('message', 'Sukses mengedit testimoni');
    }

    public function delete($item)
    {
        $getTesti = Testimoni::findOrfail($item);
        $getTesti->delete();
        session()->flash('message', 'Sukses menghapus testimoni');
    }

    public function changeSelect($item, $id)
    {
        $getTesti = Testimoni::findOrfail($id);
        $getTesti->status = $item;
        $getTesti->save();
    }
}