<?php

namespace App\Http\Livewire\Backend;

use App\Models\DataAngsuran;
use App\Models\DataPinjaman;
use App\Models\DetailDataPinjaman;
use Livewire\Component;

class DataPinjamanAngsuran extends Component
{

    public $limit_pinjaman, $idLimit;
    public $statusEditLimit = false;

    public $durasiPembayaran, $idDurasi;
    public $statusEditDurasi = false;

    public $simpanan, $angsuran, $data_pinjaman_id, $data_angsuran_id, $idDetail;
    public $statusEditDetail = false;


    public $dataPinjaman, $dataDurasi, $detail;


    public function render()
    {
        $this->dataPinjaman = DataPinjaman::latest()->get();
        $this->dataDurasi = DataAngsuran::latest()->get();
        $this->detail = DetailDataPinjaman::latest()->get();
        return view('livewire.backend.data-pinjaman-angsuran');
    }

    public function submitPinjaman()
    {

        $this->dataPinjaman = DataPinjaman::create([
            'pinjaman' => str_replace('.', '', $this->limit_pinjaman)
        ]);
        $this->limit_pinjaman = '';
        $this->info('menambah');
    }

    public function editLimit($data)
    {
        $this->limit_pinjaman = format_uang($data['pinjaman']);
        $this->idLimit = $data['id'];
        $this->statusEditLimit = true;
    }

    public function updatePinjaman()
    {
        $this->dataPinjaman = DataPinjaman::where('id', $this->idLimit)->first();
        $this->dataPinjaman->update([
            'pinjaman' => str_replace('.', '', $this->limit_pinjaman)
        ]);
        $this->statusEditLimit = false;
        $this->limit_pinjaman = '';
        $this->info('mengedit');
    }

    public function deleteLimit($id)
    {
        $this->dataPinjaman = DataPinjaman::where('id', $id)->first();
        $this->dataPinjaman->detail_pinjaman()->delete();
        $this->dataPinjaman->delete();
        $this->info('menghapus');
    }

    public function submitDurasi()
    {
        $durasi = DataAngsuran::create(
            ['durasi_angsuran' => $this->durasiPembayaran]
        );
        $this->info('menambah');
        $this->durasiPembayaran = '';
    }
    public function editDurasi($data)
    {
        $this->durasiPembayaran = $data['durasi_angsuran'];
        $this->statusEditDurasi = true;
        $this->idDurasi = $data['id'];
    }
    public function updateDurasi()
    {
        $dataDurasi = DataAngsuran::where('id', $this->idDurasi)->first();
        $dataDurasi->update(['durasi_angsuran' => $this->durasiPembayaran]);
        $this->durasiPembayaran = '';
        $this->info('mengedit');
        $this->statusEditDurasi = false;
    }
    public function deleteDurasi($id)
    {
        $this->dataDurasi = DataAngsuran::where('id', $id)->first();
        $this->dataDurasi->detail_pinjaman()->delete();
        $this->dataDurasi->delete();
        $this->info('menghaous');
    }

    public function submitDetail()
    {
        $ceck = DetailDataPinjaman::where('data_pinjaman_id', $this->data_pinjaman_id)
            ->where('data_angsuran_id', $this->data_angsuran_id)->first();
        $this->validate([
            'data_pinjaman_id' => 'required',
            'data_angsuran_id' => 'required',
            'simpanan' => 'required|min:5|max:9',
            'angsuran' => 'required|min:5|max:9',
        ]);
        if ($ceck == null) {
            $this->detail = DetailDataPinjaman::create([
                'data_pinjaman_id' => $this->data_pinjaman_id,
                'data_angsuran_id' => $this->data_angsuran_id,
                'simpanan' => str_replace('.', '', $this->simpanan),
                'angsuran' => str_replace('.', '', $this->angsuran),

            ]);
            $this->data_pinjaman_id = '';
            $this->data_angsuran_id = '';
            $this->simpanan = '';
            $this->angsuran = '';
        } else {
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'title' => 'Data pinjaman sudah ada',
                'text' => ''
            ]);
        }
    }

    public function editDetail($data)
    {
        $this->idDetail = $data['id'];
        $this->data_angsuran_id = $data['data_angsuran_id'];
        $this->data_pinjaman_id = $data['data_pinjaman_id'];
        $this->angsuran = format_uang($data['angsuran']);
        $this->simpanan = format_uang($data['simpanan']);
        $this->statusEditDetail = true;
    }

    public function updateDetail()
    {
        $this->statusEditDetail = false;
        $this->validate([
            'data_pinjaman_id' => 'required',
            'data_angsuran_id' => 'required',
            'simpanan' => 'required|min:5|max:20',
            'angsuran' => 'required|min:5|max:20',
        ]);
        $this->detail = DetailDataPinjaman::where('id', $this->idDetail)->first();
        $this->detail->update([
            'data_pinjaman_id' => $this->data_pinjaman_id,
            'data_angsuran_id' => $this->data_angsuran_id,
            'simpanan' => str_replace('.', '', $this->simpanan),
            'angsuran' => str_replace('.', '', $this->angsuran),
        ]);
        $this->data_pinjaman_id = '';
        $this->data_angsuran_id = '';
        $this->simpanan = '';
        $this->angsuran = '';
    }



    public function deleteDetail($id)
    {
        $this->detail = DetailDataPinjaman::where('id', $id)->first();
        $this->detail->delete();
        $this->info('menghapus');
    }







    // Fungsi Merubah Input Menjadi Rupiah
    public function pressLimit()
    {
        if ($this->limit_pinjaman !== '') {
            $format = str_replace('.', '', $this->limit_pinjaman);
            // str_replace('.', '', $this->limit_pinjaman);
            $this->limit_pinjaman = format_uang($format);
        }
    }

    public function keyAngsuran()
    {
        if ($this->angsuran !== '') {
            $format = str_replace('.', '', $this->angsuran);
            // str_replace('.', '', $this->limit_pinjaman);
            $this->angsuran = format_uang($format);
        }
    }

    public function keySimpanan()
    {
        if ($this->simpanan !== '') {
            $format = str_replace('.', '', $this->simpanan);
            // str_replace('.', '', $this->limit_pinjaman);
            $this->simpanan = format_uang($format);
        }
    }


    public function info($pesan)
    {
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => 'Berhasil ' . $pesan . ' data',
            'text' => ''
        ]);
    }
}