<?php

namespace App\Http\Livewire\Backend;

use App\Models\Pekerjaan;
use App\Models\ProfileUser as ModelsProfileUser;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProfileUser extends Component
{
    use WithFileUploads;
    public $view = 'profil';
    public $username, $email, $photo, $password, $password_confirmation, $photoUrl;
    public $profileUser, $checkPassword;
    public $nik, $no_kk, $nama_lengkap, $tempat_lahir, $ttl, $no_telp, $alamat, $kecamatan, $kelurahan, $kabupaten, $provinsi, $pekerjaan_id;
    protected $rules = [
        'nik' => 'required|max:16|min:16',
        'no_kk' => 'required|max:16|min:16',
        'nama_lengkap' => 'required',
        'tempat_lahir' => 'required',
        'ttl' => 'required|before:now',
        'no_telp' => 'required',
        'alamat' => 'required',
        'kabupaten' => 'required',
        'provinsi' => 'required',

    ];

    protected $messages = [
        'nik.required' => 'nik tidak boleh kosong',
        'no_kk.required' => 'no_kk tidak boleh kosong',
        'nama_lengkap.required' => 'nama_lengkap tidak boleh kosong',
        'tempat_lahir.required' => 'tempat_lahir tidak boleh kosong',
        'ttl.required' => 'ttl tidak boleh kosong',
        'no_telp.required' => 'no_telp tidak boleh kosong',
        'alamat.required' => 'alamat tidak boleh kosong',
        'kabupaten.required' => 'kabupaten tidak boleh kosong',
        'provinsi.required' => 'provinsi tidak boleh kosong',
        'nik.max' => 'Nik maximal 16 angka',
        'no_kk.max' => 'No KK maximal 16 angka',
        'nik.min' => 'Nik minimal 16 angka',
        'no_kk.min' => 'No KK minimal 16 angka',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $this->profileUser = ModelsProfileUser::where('user_id', auth()->user()->id)->first();
        if ($this->profileUser) {
            $this->nik = $this->profileUser->nik;
            $this->no_kk = $this->profileUser->no_kk;
            $this->nama_lengkap = $this->profileUser->nama_lengkap;
            $this->tempat_lahir = $this->profileUser->tempat_lahir;
            $this->ttl = $this->profileUser->ttl;
            $this->no_telp = $this->profileUser->no_telp;
            $this->alamat = $this->profileUser->alamat;
            $this->kecamatan = $this->profileUser->kecamatan;
            $this->kelurahan = $this->profileUser->kelurahan;
            $this->kabupaten = $this->profileUser->kabupaten;
            $this->provinsi = $this->profileUser->provinsi;
            $this->pekerjaan_id = $this->profileUser->pekerjaan_id;


            // $this->photo = auth()->user()->photo
        }
        $this->email = auth()->user()->email;
        $this->username = auth()->user()->username;
        $this->photoUrl = auth()->user()->takeImage;
    }

    public function render()
    {
        $pekerjaan = Pekerjaan::all();
        return view('livewire.backend.profile-user', compact('pekerjaan'));
    }

    public function setView($set)
    {
        $this->view = $set;
    }

    public function submitHandler()
    {

        $this->profileUser = ModelsProfileUser::where('user_id', auth()->user()->id)->first();
        if ($this->profileUser) {
            $this->profileUser->update([
                'user_id' => auth()->user()->id,
                'nik' => $this->nik,
                'no_kk' => $this->no_kk,
                'nama_lengkap' => $this->nama_lengkap,
                'tempat_lahir' => $this->tempat_lahir,
                'ttl' => $this->ttl,
                'no_telp' => $this->no_telp,
                'alamat' => $this->alamat,
                'kecamatan' => $this->kecamatan,
                'kelurahan' => $this->kelurahan,
                'kabupaten' => $this->kabupaten,
                'provinsi' => $this->provinsi,
                'pekerjaan_id' => $this->pekerjaan_id,

            ]);
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'Berhasil menambah data',
                'text' => ''
            ]);
        } else {
            $this->profileUser = ModelsProfileUser::create([
                'user_id' => auth()->user()->id,
                'nik' => $this->nik,
                'no_kk' => $this->no_kk,
                'nama_lengkap' => $this->nama_lengkap,
                'tempat_lahir' => $this->tempat_lahir,
                'ttl' => $this->ttl,
                'no_telp' => $this->no_telp,
                'alamat' => $this->alamat,
                'kecamatan' => $this->kecamatan,
                'kelurahan' => $this->kelurahan,
                'kabupaten' => $this->kabupaten,
                'provinsi' => $this->provinsi,
                'pekerjaan_id' => $this->pekerjaan_id,
            ]);
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'Berhasil menambah data',
                'text' => ''
            ]);
        }
    }

    public function submitHandlerAkun()
    {
        $this->validate([
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'photo' => 'required|image',
        ]);

        $photoUrl = $this->photo ? $this->photo->store('images/photo') : $this->photoUrl;
        $user = User::where('id', auth()->user()->id)->first();
        if ($this->password == $this->password_confirmation) {
            $user->update([
                'username' => $this->username,
                'password' => bcrypt($this->password),
                'thumbnail' => $photoUrl,
            ]);
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