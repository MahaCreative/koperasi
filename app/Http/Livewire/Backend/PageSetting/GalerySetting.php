<?php

namespace App\Http\Livewire\Backend\PageSetting;

use App\Models\Galery;
use Livewire\Component;
use Livewire\WithFileUploads;

class GalerySetting extends Component
{
    use WithFileUploads;
    public $judul, $kontent, $logo;
    public $galery;
    public $getFoto;
    public $updateStatus = false;
    public $urlFoto;
    protected $rules = [
        'judul' => 'required|alpha_num',
        'logo' => 'required|image',
    ];

    public function updated($propertyName)
    {
        $this->galery = Galery::all();
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        $this->galery = Galery::all();
        return view('livewire.backend.page-setting.galery-setting');
    }
    public function submitHandler()
    {
        $this->validate();

        $logoUrl = $this->logo->store('images/galery');

        $this->galery = Galery::create([
            'judul' => $this->judul,
            'kontent' => $this->kontent,
            'slug' => \Str::slug($this->judul),
            'foto' => $logoUrl,
        ]);
        $this->resetPage();
    }

    public function resetPage()
    {
        $this->judul = '';
        $this->kontent = '';
        $this->logo = '';
    }

    public function delete($id)
    {
        $galery = Galery::findOrfail($id);
        $galery->delete();
    }

    public function edit($id)
    {
        $this->getFoto = Galery::findOrfail($id);
        $this->judul = $this->getFoto->judul;
        $this->kontent = $this->getFoto->kontent;
        $this->urlFoto = $this->getFoto->foto;
        $this->updateStatus = true;
    }

    public function updateHandler()
    {

        if ($this->logo == null) {
            $logoUrl = $this->urlFoto;
        } else {
            $logoUrl = $this->logo->storeAs('images/profilkoperasi', $this->logo->getClientOriginalName());
        }

        $this->getFoto->update([
            'judul' => $this->judul,
            'kontent' => $this->kontent,
            'slug' => \Str::slug($this->judul),
            'foto' => $logoUrl,
        ]);
        $this->resetPage();
    }
}