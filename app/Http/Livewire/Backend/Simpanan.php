<?php

namespace App\Http\Livewire\Backend;

use App\Models\DetailPenarikanSimpanan;
use App\Models\JenisSimpanan;
use App\Models\PenarikanSimpanan;
use App\Models\ProfileUser;
use App\Models\SimpananUser;
use Livewire\Component;

class Simpanan extends Component
{
    public $jenis_simpanan, $besar_simpanan, $idAnggota;
    public $showAnggota = false;
    public $searchAnggota, $checkRole, $profileUser;
    public $activity = 'Buat simpanan';

    public $total_simpanan, $jumlah_penarikan, $sisa_simpanan;

    public $tarikSimpanan, $simpananUserId, $lihatDetailPenarikan;

    public $sizeModals = 'modal-default';

    protected $rules = [];

    public function mount()
    {

        $this->checkRole  = auth()->user()->getRoleNames()[0];
        $simpanan = SimpananUser::latest()->get();

        $count = count($simpanan);
        $this->kode_simpanan = 'S00' . str_replace('-', '', now()->format('d-m')) . ($count + 1);
    }

    // public function updated($propertyName)
    // {
    //     $this->validateOnly($propertyName);
    // }


    public function render()
    {

        $jenisSimpanan = JenisSimpanan::latest()->get();

        if ($this->checkRole == 'super admin') {
            $simpananUser = SimpananUser::latest()->get();
            // dd($simpananUser);
        } else if ($this->checkRole == 'petugas') {
            $simpananUser = SimpananUser::where('petugas_id', auth()->user()->id)->latest()->get();
        } else if ($this->checkRole == 'anggota') {
            $simpananUser = SimpananUser::where('profile_user_id', auth()->user()->profile->id)->latest()->get();
        }
        return view('livewire.backend.simpanan', compact('jenisSimpanan', 'simpananUser'))->layout('layouts.app');
    }


    public function tarik($data, $value)
    {
        // dd($data);
        $this->activity = $value;
        $this->tarikSimpanan = PenarikanSimpanan::where('simpanan_user_id', $data['id'])->get();

        $this->simpananUserId = $data['id'];
        if (count($this->tarikSimpanan) == 0) {
            $this->total_simpanan = format_uang($data['pinjaman_user']['detail_data_pinjaman']['simpanan']);
        } else {
            $tarik = DetailPenarikanSimpanan::where('penarikan_simpanan_id', $this->tarikSimpanan[0]->id)->latest()->get()->take(1);
            if (count($tarik) > 0) {
                $this->total_simpanan = format_uang($tarik[0]->sisa_simpanan);
            } else {
                $this->total_simpanan = format_uang($data['jenis_simpanan']['jumlah']);
            }
        }
    }

    public function tarikSimpanan()
    {
        $data = PenarikanSimpanan::all();
        $countPenarikan = count($data);
        // dd(count($this->tarikSimpanan));
        if (count($this->tarikSimpanan) > 0) {
            $detailPenarikan = DetailPenarikanSimpanan::create([
                'penarikan_simpanan_id' => $this->tarikSimpanan[0]->id,
                'tanggal_penarikan' => now(),
                'jumlah_simpanan' => str_replace('.', '', $this->total_simpanan),
                'jumlah_penarikan' => str_replace('.', '', $this->jumlah_penarikan),
                'sisa_simpanan' => str_replace('.', '', $this->sisa_simpanan),
                'petugas_id' => auth()->user()->id,
            ]);
        } else {
            $penarikan = PenarikanSimpanan::create([
                'simpanan_user_id' => $this->simpananUserId,
                'kode_penarikan' => 'P00' . str_replace('-', '', now()->format('d-m')) . ($countPenarikan + 1),
            ]);
            $detailPenarikan = DetailPenarikanSimpanan::create([
                'penarikan_simpanan_id' => $penarikan->id,
                'tanggal_penarikan' => now(),
                'jumlah_simpanan' => str_replace('.', '', $this->total_simpanan),
                'jumlah_penarikan' => str_replace('.', '', $this->jumlah_penarikan),
                'sisa_simpanan' => str_replace('.', '', $this->sisa_simpanan),
                'petugas_id' => auth()->user()->id,
            ]);
        }
        if ($this->sisa_simpanan == 0) {
            $simpanan = SimpananUser::findOrfail($this->simpananUserId);
            $simpanan->update([
                'keterangan' => 'Simpanan Kosong'
            ]);
        }
        $this->total_simpanan = $this->sisa_simpanan;
        $this->sisa_simpanan = '';
        $this->jumlah_penarikan = '';
    }

    public function lihatPenarikan($data, $value)
    {
        $this->activity = $value;
        $this->sizeModals = 'modal-xl';
        $this->lihatDetailPenarikan = PenarikanSimpanan::where('simpanan_user_id', $data['id'])->first();
        // $getDetailPenarikan = DetailPenarikanSimpanan::where('penarikan_simpanan_user_id')

    }

    public function delete($id)
    {
        $r = SimpananUser::findOrfail($id);
        $r->penarikan_simpanan->detail_penarikan_simpanan()->delete();
        $r->penarikan_simpanan->delete();
        $r->delete();
    }

    public function changePenarikan()
    {
        if (str_replace('.', '', $this->jumlah_penarikan) > str_replace('.', '', $this->total_simpanan)) {
            $this->jumlah_penarikan = '';
        } else {
            if ($this->jumlah_penarikan !== '') {
                $format = str_replace('.', '', $this->jumlah_penarikan);
                // str_replace('.', '', $this->limit_pinjaman);
                $this->jumlah_penarikan = format_uang($format);

                $total = str_replace('.', '', $this->total_simpanan) - str_replace('.', '', $this->jumlah_penarikan);
                $this->sisa_simpanan = format_uang($total);
            }
        }
    }

    public function pilihSetuju($value, $id)
    {
        $simpanan = SimpananUser::findOrfail($id);
        $simpanan->update([
            'status_simpanan' => $value
        ]);
    }

    public function pilihJenis($value)
    {
        $simpanan = JenisSimpanan::findOrfail($value);
        $this->besar_simpanan = format_uang($simpanan->jumlah);
    }

    public function cariAnggota()
    {
        $this->showAnggota = true;
        if ($this->checkRole == 'super admin') {
            if ($this->searchAnggota == '') {
                $this->profileUser = ProfileUser::latest()->get();
            } else {
                $this->profileUser = ProfileUser::where('nama_lengkap', 'like', '%' . $this->searchAnggota . '%')->latest()->get();
            }
        } else if ($this->checkRole == 'petugas') {
            if ($this->searchAnggota == '') {
                $this->profileUser = ProfileUser::where('petugas_id', auth()->user()->id)->latest()->get();
            } else {
                $this->profileUser = ProfileUser::where('petugas_id', auth()->user()->id)->where('nama_lengkap', 'like', '%' . $this->searchAnggota . '%')->latest()->get();
            }
        }
    }
    public function pilihAnggota($data)
    {

        $this->searchAnggota = $data['nama_lengkap'];
        $this->idAnggota = $data['id'];
        $this->showAnggota = false;
    }

    public function resetPage()
    {
        $this->searchAnggota = '';
        $this->jenis_simpanan = '';
        $this->besar_simpanan = '';
        $simpanan = SimpananUser::latest()->get();

        $count = count($simpanan);
        $this->kode_simpanan = 'S00' . str_replace('-', '', now()->format('d-m')) . ($count + 1);
    }
}