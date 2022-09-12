<?php

namespace App\Http\Livewire\Backend\Artikel;

use App\Models\Artikel;
use Livewire\Component;

class Index extends Component
{
    public $getArtikel, $select, $checkRole;
    public $kategori_field, $user_field;

    public function mount()
    {
        $this->checkRole  = auth()->user()->getRoleNames()[0];
        if ($this->checkRole == 'anggota' or $this->checkRole == null) {
            abort(404);
        }
    }
    public function render()
    {


        if ($this->checkRole == 'petugas') {
            $this->getArtikel = Artikel::with('user')
                ->where('user_id', auth()->user()->id)
                ->latest()->get();
        } else if ($this->checkRole == 'super admin') {
            $this->getArtikel = Artikel::with('user')->latest()->get();
        }
        return view('livewire.backend.artikel.index');
    }

    public function deleteArtikel($id)
    {
        $artikel = Artikel::findOrfail($id);
        $artikel->delete();
        $this->emitSuccess('Berhasil menghapus artikel ');
    }
    public function emitSuccess($pesan)
    {
        $this->emit('success', ['pesan' => $pesan]);
    }

    public function changeStatus($value, $id)
    {
        $artikel = Artikel::findOrfail($id);
        $artikel->update([
            'active' => $value
        ]);
    }
}