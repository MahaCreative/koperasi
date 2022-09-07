<?php

namespace App\Http\Livewire\Backend\PageSetting;

use App\Models\Iklan;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class IklanSetting extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $judul, $keterangan, $tanggal_awal, $tanggal_akhir, $foto;
    public $search;
    public $select = 15;
    public $updateStatus = false;
    public $getId, $iklan;
    // public $iklan;
    protected $rules = [
        'judul' => 'required|min:6',
        'tanggal_awal' => 'required|after:tomorrow',
        'tanggal_akhir' => 'required|after:tanggal_awal',
        'foto' => 'required|image',

    ];

    public function hydrate()
    {
    }


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        if ($this->search === '') {
            $this->iklan = Iklan::latest()
                ->get();
        } else {
            $this->iklan = Iklan::where('nama', 'like', '%' . $this->search . '%')
                ->latest()
                ->get();
        }
        return view('livewire.backend.page-setting.iklan-setting');
    }
    public function submitHandler()
    {
        $this->validate();
        $fotoUrl = $this->foto ? $this->foto->storeAs('images/iklan', $this->foto->getClientOriginalName()) : null;
        $iklan = Iklan::create([
            'nama' => $this->judul,
            'ket' => $this->keterangan,
            'tanggal_awal' => $this->tanggal_awal,
            'tangal_akhir' => $this->tanggal_akhir,
            'foto' => $fotoUrl,
        ]);
        session()->flash('message', "Data berhasil ditambahkan");
    }

    public function delete($item)
    {
        $iklan = Iklan::findOrfail($item);
        $iklan->delete();
        session()->flash('message', "data Berhasil Dihapus");
    }

    public function edit($item)
    {
        $this->iklan = Iklan::findOrFail($item);
        $this->getId = $this->iklan->id;
        $this->judul = $this->iklan->nama;
        $this->keterangan = $this->iklan->ket;
        $this->tanggal_awal = $this->iklan->tanggal_awal;
        $this->tanggal_akhir = $this->iklan->tangal_akhir;
        $this->updateStatus = true;
    }
    public function updateHandler()
    {
        $fotoUrl = $this->foto ? $this->foto->storeAs('images/iklan', $this->foto->getClientOriginalName()) : null;
        $iklan = Iklan::findOrFail($this->getId);
        $iklan->update([
            'nama' => $this->judul,
            'ket' => $this->keterangan,
            'tanggal_awal' => $this->tanggal_awal,
            'tangal_akhir' => $this->tanggal_akhir,
            'foto' => $fotoUrl,
        ]);
        session()->flash('message', "Sukses megedit data");
    }
}