<?php

namespace App\Http\Livewire\Backend\Pesan;

use App\Models\KontakKami;
use Livewire\Component;

class ManageKontakKami extends Component
{
    public $kontakKami, $count;
    public $select = '';
    public $search = '';
    public $statusShow = false;
    public $status_baca = [];
    public $selectId;
    public $showPesan;
    public function render()
    {

        $this->count = KontakKami::where('status_baca', false)->get()->count();
        if ($this->select === "" && $this->search === "") {
            $this->kontakKami = KontakKami::latest()->get();
        } else if ($this->select !== "" && $this->search === "") {
            $this->kontakKami = KontakKami::where('status_baca', $this->select)->latest()->get();
        } else if ($this->select === "" && $this->search !== "") {
            $this->kontakKami = KontakKami::where('namalengkap', 'like', '%' . $this->search . '%')->latest()->get();
        } else {
            $this->kontakKami = KontakKami::where('namalengkap', 'like', '%' . $this->search . '%')->where('status_baca', $this->select)->latest()->get();
        }
        return view('livewire.backend.pesan.manage-kontak-kami');
    }

    public function checked($value, $id)
    {

        $kontak = KontakKami::findOrfail($id);

        $kontak->status_baca = $value;
        $kontak->save();
    }

    public function delete($id)
    {
        $kontak = KontakKami::findOrfail($id);
        $kontak->delete();
    }

    public function selectData($id)
    {
        $this->selectId = $id;
        $this->statusShow = true;
        $this->showPesan = KontakKami::findOrfail($id);
    }
}