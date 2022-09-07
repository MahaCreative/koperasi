<?php

namespace App\Http\Livewire\Backend;

use App\Models\ProfileKoperasi as ModelsProfileKoperasi;
use Illuminate\Http\Client\Request;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProfileKoperasi extends Component
{
    use WithFileUploads;

    public $alamat, $nama_koperasi, $nama_perusahaan, $badan_hukum, $kota, $provinsi, $kode_pos, $no_telp, $fax, $nama_pimpinan, $nama_bendahara, $nama_sekretaris, $logo, $logoUrl;

    public $profileKoperasi;
    protected $rules = [
        'nama_koperasi' => ['required',],
        'kota' => ['required'],
        'provinsi' => ['required'],
        'no_telp' => ['required'],
        // 'logo' => ['required', 'image'],

    ];

    protected $messages = [
        'nama_koperasi.required' => 'nama_koperasi tidak boleh kosong',
        'kota.required' => 'kota tidak boleh kosong',
        'provinsi.required' => 'provinsi tidak boleh kosong',
        'no_telp.required' => 'no_telp tidak boleh kosong',
        'logo.required' => 'logo tidak boleh kosong',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $this->profileKoperasi = ModelsProfileKoperasi::first();
        $this->alamat = $this->profileKoperasi->alamat;
        $this->nama_koperasi = $this->profileKoperasi->nama_koperasi;
        $this->nama_perusahaan = $this->profileKoperasi->nama_perusahaan;
        $this->badan_hukum = $this->profileKoperasi->badan_hukum;
        $this->kota = $this->profileKoperasi->kota;
        $this->provinsi = $this->profileKoperasi->provinsi;
        $this->kode_pos = $this->profileKoperasi->kode_pos;
        $this->no_telp = $this->profileKoperasi->no_telp;
        $this->fax = $this->profileKoperasi->fax;
        $this->nama_pimpinan = $this->profileKoperasi->nama_pimpinan;
        $this->nama_bendahara = $this->profileKoperasi->nama_bendahara;
        $this->nama_sekretaris = $this->profileKoperasi->nama_sekretaris;
        $this->logoUrl = $this->profileKoperasi->logo;
        // dd(Request::path());


    }

    public function render()
    {
        return view('livewire.backend.profile-koperasi');
    }

    public function submitHandler()
    {
        $this->validate();
        $this->profileKoperasi = ModelsProfileKoperasi::first();

        $logoUrl = $this->logo ? $this->logo->store('Images/ProfileKoperasi/') : $this->logoUrl;
        $this->profileKoperasi->update([
            'alamat' => $this->alamat,
            'nama_koperasi' => $this->nama_koperasi,
            'nama_perusahaan' => $this->nama_perusahaan,
            'badan_hukum' => $this->badan_hukum,
            'kota' => $this->kota,
            'provinsi' => $this->provinsi,
            'kode_pos' => $this->kode_pos,
            'no_telp' => $this->no_telp,
            'fax' => $this->fax,
            'nama_pimpinan' => $this->nama_pimpinan,
            'nama_bendahara' => $this->nama_bendahara,
            'nama_sekretaris' => $this->nama_sekretaris,
            'logo' => $logoUrl,
        ]);
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => 'Berhasil menambah data',
            'text' => ''
        ]);
    }
}