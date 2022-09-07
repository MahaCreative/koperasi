<?php

namespace App\Http\Livewire\Page;

use App\Models\KontakKami;
use App\Models\ProfileKoperasi;
use Livewire\Component;

class ContakKami extends Component
{
    public $nama, $email, $telp, $subjek, $profil;
    protected $rules = [
        'nama' => 'required|min:6',
        'email' => 'required|email',
        'telp' => 'required|numeric',
        'subjek' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        $this->profil = ProfileKoperasi::first();
        return view('livewire.page.contak-kami')->layout('user.app');
    }

    public function submitHandler()
    {
        $userId = null;
        if (auth()->user()) {
            $userId = auth()->user()->id;
        }
        $this->validate();
        // $userId = ;
        $kontak = KontakKami::create([
            'user_id' => $userId,
            'namalengkap' => $this->nama,
            'email' => $this->email,
            'telp' => $this->telp,
            'subjek' => $this->subjek,
        ]);
        if ($kontak) {
            session()->flash('message', 'berhasil mengirim pesan, silahkan menunggu konfirmasi dari petugas');
        } else {
            session()->flash('error', 'Gagal mengirim pesan');
        }
    }
}