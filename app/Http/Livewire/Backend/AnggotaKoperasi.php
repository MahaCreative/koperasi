<?php

namespace App\Http\Livewire\Backend;

use App\Models\Pekerjaan;
use App\Models\ProfileUser;
use Livewire\Component;
use Livewire\WithPagination;

class AnggotaKoperasi extends Component
{
    use WithPagination;
    public $editStatus = false;
    public $idProfil;
    public $paginate;
    public $search;
    public $checkRole;
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
        $this->checkRole  = auth()->user()->getRoleNames()[0];
    }

    public function render()
    {
        $pekerjaan = Pekerjaan::all();

        if ($this->search == '') {
            if ($this->checkRole == 'super admin') {
                $profileUser = ProfileUser::latest()->paginate($this->paginate);
            } else  if ($this->checkRole == 'petugas') {
                $profileUser = ProfileUser::where('petugas_id', auth()->user()->id)->latest()->paginate($this->paginate);
            } else  if ($this->checkRole == 'super admin') {
            }
        } else {
            if ($this->checkRole == 'super admin') {

                $profileUser = ProfileUser::where('nama_lengkap', 'like', '%' . $this->search . '%')
                    ->orWhere('nik', 'like', '%' . $this->search . '%')
                    ->latest()->paginate($this->paginate);
            } else  if ($this->checkRole == 'petugas') {
                $profileUser = ProfileUser::where('petugas_id', auth()->user()->id)
                    ->where('nama_lengkap', 'like', '%' . $this->search . '%')
                    ->orWhere('nik', 'like', '%' . $this->search . '%')
                    ->latest()->paginate($this->paginate);
            } else  if ($this->checkRole == 'super admin') {
            }
        }

        return view('livewire.backend.anggota-koperasi', compact('pekerjaan', 'profileUser'));
    }

    public function submitHandler()
    {
        $this->validate();
        $profileUser = ProfileUser::create([

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
            'petugas_id' => auth()->user()->id,
            'pekerjaan_id' => $this->pekerjaan_id,
        ]);
        $this->resetPage();
        $this->info('menambah');
    }

    public function edit($data)
    {
        $this->nik = $data['nik'];
        $this->no_kk = $data['no_kk'];
        $this->nama_lengkap = $data['nama_lengkap'];
        $this->tempat_lahir = $data['tempat_lahir'];
        $this->ttl = $data['ttl'];
        $this->no_telp = $data['no_telp'];
        $this->alamat = $data['alamat'];
        $this->kecamatan = $data['kecamatan'];
        $this->kelurahan = $data['kelurahan'];
        $this->kabupaten = $data['kabupaten'];
        $this->provinsi = $data['provinsi'];
        $this->pekerjaan_id = $data['pekerjaan_id'];
        $this->idProfil = $data['id'];
        $this->editStatus = true;
    }

    public function updateHandler()
    {
        $profile = ProfileUser::findOrfail($this->idProfil);
        $profile->update([
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
            'petugas_id' => auth()->user()->id,
            'pekerjaan_id' => $this->pekerjaan_id,
        ]);
        $this->resetPage();
        $this->info('mengedit');
    }


    public function info($pesan)
    {
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => 'Berhasil ' . $pesan . ' data',
            'text' => ''
        ]);
    }

    public function resetPage()
    {
        $this->nik = '';
        $this->no_kk = '';
        $this->nama_lengkap = '';
        $this->tempat_lahir = '';
        $this->ttl = '';
        $this->no_telp = '';
        $this->alamat = '';
        $this->kecamatan = '';
        $this->kelurahan = '';
        $this->kabupaten = '';
        $this->provinsi = '';
        $this->pekerjaan_id = '';
        $this->idProfil = '';
        $this->editStatus = '';
    }

    public function delete($id)
    {
        $profile = ProfileUser::findOrfail($id);
        $profile->delete();
        $this->info('menghapus');
    }
}