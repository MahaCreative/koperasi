<?php

namespace App\Http\Livewire;

use App\Models\ProfileKoperasi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Login extends Component
{
    public  $email, $password, $password_confirmation;
    public $checkPassword;
    protected $rules = [
        'email' => 'required|min:3|email|unique:users,email',
        'password' => 'required|min:6|alpha_num',

    ];
    public function render()
    {
        $profile = ProfileKoperasi::first();
        return view('livewire.login', compact('profile'))->layout('layouts.apps');
    }
    public function loginHandler()
    {
        $attr =  $this->validate([
            'password' => 'required',
            'email' => 'required|email',
        ]);
        $user = User::whereEmail($this->email)->first();
        if (Auth::attempt($attr)) {
            redirect()->route('dashboard');
        }


        throw ValidationException::withMessages([
            'email' => 'Mungkin Email Yang Anda Masukkan Salah?',
            'password' => 'Pasword anda salah'
        ]);
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