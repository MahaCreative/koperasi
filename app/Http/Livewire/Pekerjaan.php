<?php

namespace App\Http\Livewire;

use App\Models\Pekerjaan as ModelsPekerjaan;
use Livewire\Component;

class Pekerjaan extends Component
{
    public $editStatus = false;
    public $pekerjaan, $pekerjaan_field, $idPekerjaan;
    protected $rules = [
        'pekerjaan_field' => 'required|unique:pekerjaans,pekerjaan',
    ];

    protected $messages = [
        'pekerjaan_field.required' => 'Jenis pekerjaan tidak boleh kosong',
        'pekerjaan_field.unique' => 'Tidak boleh sama dengan yang sudah ada',

    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {

        $this->pekerjaan = ModelsPekerjaan::latest()->get();
        return view('livewire.pekerjaan');
    }

    public function submitHandler()
    {
        $this->validate();
        $this->pekerjaan = ModelsPekerjaan::create(['pekerjaan' => $this->pekerjaan_field]);
        $this->pekerjaan_field = '';
        $this->info('menambah');
    }
    public function edit($data)
    {
        $this->editStatus = true;
        $this->idPekerjaan = $data['id'];
        $this->pekerjaan_field = $data['pekerjaan'];
    }

    public function updateHandler()
    {
        $this->pekerjaan = ModelsPekerjaan::findOrfail($this->idPekerjaan);
        $this->pekerjaan->update(['pekerjaan' => $this->pekerjaan_field]);
        $this->pekerjaan_field = '';
        $this->editStatus = false;
        $this->info('mengedit');
    }

    public function delete($id)
    {
        $this->pekerjaan = ModelsPekerjaan::findOrfail($id);
        $this->pekerjaan->delete();
        $this->info('menghapus');
    }

    public function info($pesan)
    {
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => 'Berhasil ' . $pesan . ' data',
            'text' => ''
        ]);
    }
}