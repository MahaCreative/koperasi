<?php

namespace App\Http\Livewire\Backend\Artikel;

use App\Models\Artikel;
use App\Models\Kategori;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    public $kategori;
    use WithFileUploads;
    public $judul, $varkategori, $kontent, $thumbnail;

    protected $rules = [
        'judul' => 'required',
        'varkategori' => 'required',
        'kontent' => 'required',
        'thumbnail' => 'required|image'
    ];
    public function render()
    {
        $this->kategori = Kategori::latest()->get();
        return view('livewire.backend.artikel.create');
    }
    public function submitHandler()
    {

        $thumbnailUrl =  $this->thumbnail->store('public/images/artikel/blog');
        $slug = \Str::slug($this->judul);
        $artikel = Artikel::create([
            'user_id' => auth()->user()->id,
            'kategori_id' => $this->varkategori,
            'judul' => $this->judul,
            'slug' => \Str::slug($this->judul),
            'kontent' => $this->kontent,
            'thumbnail' => $thumbnailUrl,
            'status_preview' => 'true'
        ]);
        $this->info('menambah');
        $this->resetPage();
    }

    public function resetPage()
    {
        $this->varkategori = '';
        $this->judul = '';
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