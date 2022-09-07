<?php

namespace App\Http\Livewire\Backend;

use App\Models\JenisSimpanan as ModelsJenisSimpanan;
use Livewire\Component;

class JenisSimpanan extends Component
{
    public $jenisSimpanan, $idJenis;
    public $jenis_simpanan, $jumlah;
    public $editStatus = false;

    protected $rules = [
        'jenis_simpanan' => 'required|unique:jenis_simpanans,jenis_simpanan',
        'jumlah' => 'required|min:4|max:9',
    ];

    protected $messages = [
        'jenis_simpanan.required' => 'Jenis simpanan tidak boleh kosong',
        'jumlah.required' => 'besar simpanan tidak boleh kosong',
        'jumlah.min' => 'besar simpanan tidak boleh lebih kecil dari 4 Digit',
        'jumlah.max' => 'besar simpanan tidak boleh lebih besar dari 8 Digit',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        $this->jenisSimpanan = ModelsJenisSimpanan::latest()->get();

        return view('livewire.backend.jenis-simpanan');
    }

    public function submitHandler()
    {
        $this->validate();
        $this->jenisSimpanan = ModelsJenisSimpanan::create([
            'jenis_simpanan' => $this->jenis_simpanan,
            'jumlah' => str_replace('.', '', $this->jumlah),
        ]);
        $this->jenis_simpanan = '';
        $this->jumlah = '';
        $this->info('menambah');
    }

    public function edit($data)
    {
        // dd($data);
        $this->jenis_simpanan = $data['jenis_simpanan'];
        $this->jumlah = $data['jumlah'];
        $this->idJenis = $data['id'];
        $this->editStatus = true;
    }

    public function updateHandler()
    {
        $this->validate();
        $this->jenisSimpanan = ModelsJenisSimpanan::findOrfail($this->idJenis);
        $this->jenisSimpanan->update([
            'jenis_simpanan' => $this->jenis_simpanan,
            'jumlah' => str_replace('.', '', $this->jumlah),
        ]);
        $this->jenis_simpanan = '';
        $this->jumlah = '';
        $this->info('mengedit');
    }


    public function delete($id)
    {
        $this->jenisSimpanan = ModelsJenisSimpanan::findOrfail($id);
        $this->jenisSimpanan->delete();
        $this->info('menghapus');
    }


    public function keyJumlah()
    {
        if ($this->jumlah !== '') {
            $format = str_replace('.', '', $this->jumlah);
            // str_replace('.', '', $this->limit_pinjaman);
            $this->jumlah = format_uang($format);
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