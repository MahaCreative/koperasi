<?php

namespace App\Http\Livewire\Backend;

use App\Models\Jabatan as ModelsJabatan;
use Livewire\Component;

class Jabatan extends Component
{
    public $editStatus = false;
    public $jabatan, $idJatan;
    public $jabatan_field;

    protected $rules = [
        'jabatan_field' => 'required|unique:jabatans,jabatan',
    ];

    protected $messages = [
        'jabatan_field.required' => 'jenis jabatan tidak boleh kosong',
        'jabatan_field.unique' => 'Tidak boleh sama dengan yang sudah ada',

    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        $this->jabatan = ModelsJabatan::latest()->get();
        return view('livewire.backend.jabatan');
    }
    public function submitHandler()
    {
        $this->validate();
        $this->jabatan = ModelsJabatan::create(['jabatan' => $this->jabatan_field]);
        $this->jabatan_field = '';
        $this->info('menambah');
    }

    public function edit($data)
    {
        $this->editStatus = true;
        $this->idJatan = $data['id'];
        $this->jabatan_field = $data['jabatan'];
    }

    public function updateHandler()
    {
        $this->jabatan = ModelsJabatan::findOrfail($this->idJatan);
        $this->jabatan->update(['jabatan' => $this->jabatan_field]);
        $this->editStatus = false;
        $this->jabatan_field = '';
        $this->info('mengedit');
    }

    public function delete($id)
    {
        $this->jabatan = ModelsJabatan::findOrfail($this->idJatan);
        $this->jabatan->delete();
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