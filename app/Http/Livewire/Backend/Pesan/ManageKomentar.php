<?php

namespace App\Http\Livewire\Backend\Pesan;

use App\Models\Komentar;
use Livewire\Component;

class ManageKomentar extends Component
{
    public $komentar, $select;
    public $cari = '';

    public $checkRole;
    public function mount()
    {
        $this->checkRole  = auth()->user()->getRoleNames()[0];
        if ($this->checkRole == 'anggota') {
            abort(404);
        }
    }


    public function render()
    {
        if ($this->cari === '') {
            $this->komentar = Komentar::join('users', 'users.id', 'komentars.user_id')
                ->join('artikels', 'artikels.id', 'komentars.artikel_id')
                ->select('users.username', 'komentars.*', 'artikels.judul', 'artikels.slug as artikelslug')->get();
        } else {
            $this->komentar = Komentar::join('users', 'users.id', 'komentars.user_id')
                ->join('artikels', 'artikels.id', 'komentars.artikel_id')
                ->select('users.username', 'komentars.*', 'artikels.judul', 'artikels.slug as artikelslug')
                ->orWhere('artikels.judul', 'like', '%' . $this->cari . '%')
                ->orWhere('users.username', 'like', '%' . $this->cari . '%')
                ->get();
        }
        return view('livewire.backend.pesan.manage-komentar');
    }
    public function delete($item)
    {
        $komentar = Komentar::findOrfail($item);
        $komentar->delete();
        session()->flash('message', 'Sukses Menghapus Data');
    }

    public function change($item, $id)
    {

        $komentar = Komentar::findOrfail($id);

        $komentar->update(['status' => $item]);
    }
}