<?php

namespace App\Http\Livewire;

use App\Models\Kategori as ModelsKategori;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Kategori extends Component
{
    public $editStatus = false;
    public $judul, $getId;
    public $kategori;
    public $checkRole;
    public function mount()
    {
        $this->checkRole  = auth()->user()->getRoleNames()[0];
        if ($this->checkRole == 'anggota' or $this->checkRole == null) {
            abort(404);
        }
    }

    public function render()
    {
        $this->kategori = DB::table('kategoris')->get();
        // dd($this->kategori);
        return view('livewire.kategori');
    }

    public function submitHandler()
    {
        $this->validate([
            'judul' => 'required|min:6'
        ]);
        $slug = \Str::slug($this->judul);
        $this->kategori = ModelsKategori::create([
            'slug' => $slug,
            'judul' => $this->judul,
            'user_id' => auth()->user()->id
        ]);
        $this->judul = '';
        $this->info('menambah');
    }

    public function editKategori($value)
    {
        $this->editStatus = true;
        $kategori = ModelsKategori::findOrfail($value);
        $this->judul = $kategori->judul;
        $this->getId = $kategori->id;
    }

    public function updateHandler()
    {
        $this->editStatus = true;
        $this->kategori = ModelsKategori::findOrfail($this->getId);
        $this->kategori->update([
            'judul' => $this->judul
        ]);
        $this->info('mengedit');
        $this->judul = '';
    }

    public function delete($id)
    {
        $this->kategori = ModelsKategori::findOrfail($id);
        $this->kategori->artikel()->delete();
        $this->kategori->delete();
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