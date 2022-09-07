<?php

namespace App\Http\Livewire;

use App\Models\ProfileKoperasi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    public $username, $email, $password, $password_confirmation;
    public $profile;
    public $checkPassword;
    protected $rules = [
        'email' => 'required|min:3|email|unique:users,email',
        'password' => 'required|min:6|alpha_num',
        'username' => 'unique:users,username|min:6|required|alpha_num',

    ];
    public function render()
    {
        $this->profile = ProfileKoperasi::first();
        return view('livewire.register')->layout('layouts.apps');
    }
    public function submitHandler()
    {

        $this->validate();
        if ($this->password == $this->password_confirmation) {
            $user = User::create([
                'email' => $this->email,
                'username' => $this->username,
                'password' => Hash::make($this->password),
            ]);
            $user->assignRole('anggota');
            Auth::login($user);
            return redirect()->route('dashboard');
        }
    }
    public function typePassword()
    {

        if ($this->password == $this->password_confirmation) {
            $this->checkPassword = true;
        } else {
            $this->checkPassword = false;
        }
    }
}