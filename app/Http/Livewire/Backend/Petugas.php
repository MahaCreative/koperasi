<?php

namespace App\Http\Livewire\Backend;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Petugas extends Component
{
    public $username, $email, $password, $password_confirmation;
    public $petugas, $petugasId;
    public $statusEdit = false;
    protected $rules = [
        'email' => 'required|min:3|email|unique:users,email',
        'password' => 'required|min:6|alpha_num',
        'username' => 'unique:users,username|min:6|required|alpha_num',

    ];
    public function render()
    {
        $this->petugas = User::with('profile')->whereHas('roles', function ($query) {
            $query->where('name', '!=', 'anggota');
        })->get();
        // dd($this->petugas[0]->profile['nama']);
        return view('livewire.backend.petugas');
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function submitHandler()
    {

        if ($this->password == $this->password_confirmation) {
            $this->validate();
            $user = User::create([
                'email' => $this->email,
                'username' => $this->username,
                'password' => Hash::make($this->password),
            ]);
            $user->assignRole('petugas');
            $this->emit('success', ['pesan' => 'Berhasil mengedit petugas']);
        }
    }

    public function edit($data)
    {
        $this->petugasId = $data['id'];
        $this->username = $data['username'];
        $this->email = $data['email'];
        $this->statusEdit = true;
    }
    public function updateHandler()
    {
        $petugas = User::findOrfail($this->petugasId);
        $petugas->update([
            'email' => $this->email,
            'username' => $this->username,
            'password' => Hash::make($this->password),
        ]);
        $this->emit('success', ['pesan' => 'Berhasil mengedit petugas']);
    }
    public function delete($id)
    {
        $petugas = User::findOrfail($id);
        $petugas->delete();
        $this->emit('success', ['pesan' => 'Berhasil menghapus petugas']);
    }
}