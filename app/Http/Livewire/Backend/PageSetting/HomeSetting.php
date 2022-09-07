<?php

namespace App\Http\Livewire\Backend\PageSetting;

use App\Http\Livewire\Components\Heroes;
use App\Models\CaraMeminjam;
use App\Models\CaraMeminjamDetail;
use App\Models\Heroes as ModelsHeroes;
use App\Models\Keunggulan;
use App\Models\Syarat;
use Livewire\Component;
use Livewire\WithFileUploads;

class HomeSetting extends Component
{
    use WithFileUploads;
    public $tag_line, $judul, $kontent, $logo;
    public $editHeroes = false;
    public $settingStatus = 'carameminjam';

    // Form Syarat
    public $caraJudul, $caraKontent;
    public $editCaraStatus = false;
    public $caraPinjaman, $getIdCara;

    // Form Keunggulan
    public $keunggulan;
    public $keunggulanStatusUpdate = false;
    public $keunggulanJudul, $keunggulanKontent, $keunggulanLogo, $getIdKeunggulan;

    // Form Syarat
    public $modelSyarat;
    public $updateSyaratStatus = false;
    public $syaratPeminjaman, $getIdSyarat;
    public function render()
    {
        $this->caraPinjaman = CaraMeminjam::with('cara_meminjam_detail')->latest()->get();
        $this->keunggulan = Keunggulan::latest()->get();
        $this->modelSyarat = Syarat::latest()->get();
        return view('livewire.backend.page-setting.home-setting');
    }
    public function selectHeroes()
    {
        $this->editHeroes = !$this->editHeroes;
        $heroes = ModelsHeroes::first();
        if ($heroes) {
            $this->tag_line = $heroes->tag_line;
            $this->judul = $heroes->judul;
            $this->kontent = $heroes->kontent;
        }
    }

    public function submitHeroes()
    {
        $this->validate([
            'tag_line' => 'required',
            'judul' => 'required',
            'kontent' => 'required',
            'logo' => 'required',
        ]);

        $logoUrl = $this->logo->store('public/images/logo');


        $heroes = ModelsHeroes::first();
        if ($heroes) {
            $heroes->delete();
            $heroes = ModelsHeroes::create([
                'tag_line' => $this->tag_line,
                'judul' => $this->judul,
                'kontent' => $this->kontent,
                'logo' => $logoUrl,
            ]);
        } else {
            $heroes = ModelsHeroes::create([
                'tag_line' => $this->tag_line,
                'judul' => $this->judul,
                'kontent' => $this->kontent,
                'logo' => $logoUrl,
            ]);
        }
    }

    public function setting($value)
    {
        $this->settingStatus = $value;
    }

    public function submitSyaratHandler()
    {
        $this->validate([
            'syaratPeminjaman' => 'required'
        ]);
        $syarat = Syarat::create([
            'syarat' => $this->syaratPeminjaman,
        ]);
        $this->syaratPeminjaman = '';
        $this->emitSuccess('Sukses Menambahkan Syarat');
    }

    public function editSyarat($data)
    {
        $this->updateSyaratStatus = true;
        $this->getIdSyarat = $data['id'];
        $this->syaratPeminjaman = $data['syarat'];
    }

    public function updateSyaratHandler()
    {
        $syarat = Syarat::findOrfail($this->getIdSyarat);
        $syarat->update([
            'syarat' => $this->syaratPeminjaman
        ]);
        $this->emitSuccess('Sukses mengedit data syarat');
        $this->syaratPeminjaman = '';
    }

    public function deleteSyarat($id)
    {
        $syarat = Syarat::findOrfail($id);
        $syarat->delete();
        $this->emitSuccess('Berhasil menghapus data syarat');
    }

    public function submitKeunggulanHandler()
    {
        $logoUrl = $this->keunggulanLogo->store('public/images/keunggulan');
        $this->validate([
            'keunggulanJudul' => 'required',
            'keunggulanKontent' => 'required',
            'keunggulanLogo' => 'required|image|mimes:png,jpg,jpeg',
        ]);
        $keunggulan = Keunggulan::create([
            'judul' => $this->keunggulanJudul,
            'kontent' => $this->keunggulanKontent,
            'logo' => $logoUrl,
        ]);
        $this->keunggulanJudul = '';
        $this->keunggulanKontent = '';
        $this->keunggulanLogo = '';
        $this->emitSuccess('Sukses menambahkan data keunggulan');
    }

    public function editKeunggulan($data)
    {
        $this->getIdKeunggulan = $data['id'];
        $this->keunggulanJudul = $data['judul'];
        $this->keunggulanKontent = $data['kontent'];
        $this->keunggulanLogo = $data['logo'];
        $this->keunggulanStatusUpdate = true;
    }

    public function updateKeunggulanHandler()
    {
        // dd($this->keunggulanLogo);
        $logoUrl = $this->keunggulanLogo->store('public/images/keunggulan');
        $keunggulan = Keunggulan::findOrfail($this->getIdKeunggulan);
        $keunggulan->update([
            'judul' => $this->keunggulanJudul,
            'kontent' => $this->keunggulanKontent,
            'logo' => $logoUrl,
        ]);
        $this->keunggulanStatusUpdate = false;
        $this->keunggulanJudul = '';
        $this->keunggulanKontent = '';
        $this->keunggulanLogo = '';
        $this->emitSuccess('Sukses mengedit data keunggulan');
    }

    public function deleteKeunggulan($id)
    {
        $keunggulan = Keunggulan::findOrfail($id);
        $keunggulan->delete();
        $this->emitSuccess('Berhasil menghapus data keunggulan');
    }



    public function submitCaraHandler()
    {
        $this->validate([
            'caraJudul' => 'required',
            'caraKontent' => 'required',
        ]);
        $cara = CaraMeminjam::create([
            'cara_pinjaman' => $this->caraJudul
        ]);
        $caraDetail = CaraMeminjamDetail::create([
            'cara_meminjam_id' => $cara->id,
            'keterangan' => $this->caraKontent,
        ]);
        $this->caraJudul = '';
        $this->caraKontent = '';
        $this->emitSuccess('Sukses menambahkan data cara meminjam');
    }

    public function editCara($data)
    {
        $this->getIdCara = $data['id'];
        $this->caraJudul = $data['cara_pinjaman'];
        // dd($data['cara_meminjam_detail']['keterangan']);
        $this->editCaraStatus = true;
        $this->caraKontent = $data['cara_meminjam_detail']['keterangan'];
    }

    public function updateCaraHandler()
    {
        $cara = CaraMeminjam::findOrfail($this->getIdCara);
        $cara->cara_meminjam_detail->update([
            'keterangan' => $this->caraKontent
        ]);
        $cara->update([
            'cara_pinjaman' => $this->caraJudul
        ]);
        $this->caraJudul = '';
        $this->caraKontent = '';
        $this->editCaraStatus = false;
        $this->emitSuccess('Berhasil mengedit data cara meminjam');
    }

    public function deleteCara($id)
    {
        $cara = CaraMeminjam::findOrfail($id);
        $cara->cara_meminjam_detail()->delete();
        $cara->delete();
        $this->emitSuccess('Sukses menghapus data cara meminjam');
    }

    public function emitSuccess($pesan)
    {
        $this->emit('success', ['pesan' => $pesan]);
    }
}