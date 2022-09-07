<?php

namespace App\Http\Livewire\Backend\Artikel;

use App\Models\Artikel;
use App\Models\Kategori;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;
    public $artikel, $thumbnailAwal;
    public $judul, $varkategori, $kontent, $thumbnail;

    protected $rules = [
        'judul' => 'required',
        'varkategori' => 'required',
        'kontent' => 'required',
        'thumbnail' => 'required|image'
    ];
    public function mount(Artikel $artikel)
    {
        $this->artikel = $artikel->with('kategori')->first();

        $this->judul = $this->artikel->judul;
        $this->varkategori = $this->artikel->kategori_id;
        $this->kontent = $this->artikel->kontent;
        $this->thumbnail = $this->artikel->thumbnail;
    }
    public function render()
    {
        $kategori = Kategori::all();
        return view('livewire.backend.artikel.edit', compact('kategori'));
    }
    public function selectKategori($item)
    {
        $this->varkategori = $item;
    }
    public function submitHandler()
    {
        $this->validate();
        $thumbnailUrl =  $this->thumbnail->store('public/images/artikel/blog');
        $this->artikel->update([
            'kategori_id' => $this->varkategori,
            'judul' => $this->judul,
            'kontent' => $this->kontent,
            'thumbnail' => $thumbnailUrl,
            'status_preview' => 'publish',
        ]);
        $this->judul = '';
        $this->kontent = '';
        $this->thumbnail = '';
        $this->info('mengedit');
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