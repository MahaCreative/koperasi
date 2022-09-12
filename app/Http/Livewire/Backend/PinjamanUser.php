<?php

namespace App\Http\Livewire\Backend;

use App\Models\DataAngsuran;
use App\Models\DataPinjaman;
use App\Models\DetailDataPinjaman;
use App\Models\DetailPembayaranUser;
use App\Models\Pekerjaan;
use App\Models\PembayaranUser;
use App\Models\PinjamanUser as ModelsPinjamanUser;
use App\Models\ProfileUser;
use App\Models\SimpananUser;
use Livewire\Component;
use Livewire\WithPagination;

class PinjamanUser extends Component
{
    use WithPagination;
    public $editStatus = false;
    public $profileUser, $checkRole;
    public $searchAnggota;
    public $nik, $no_kk, $nama_lengkap, $tempat_lahir, $ttl, $no_telp, $alamat, $kecamatan, $kelurahan, $kabupaten, $provinsi, $pekerjaan_id;
    public $detailJumlahPinjaman, $detailDurasi, $detailAngsuran, $detailSimpanan, $detailTotalTerima;
    public $showAnggota = false;
    public $pilihAngsuran = '';
    public $pilihPinjaman = '';
    public $kode_pinjaman, $idPinjaman, $idProfile;
    public $idAnggota;
    public $paginate;
    public $search = '';
    public $idDetailDataPinjaman;
    public $statusView = 'pengajuan pinjaman';
    public $titleModal = 'Tambah Pinjaman';

    // var Pembayran
    public $namaPeminjam, $totalPinjaman, $totalAngsuran, $kode_pembayaran;
    public $angsuran_ke, $detail_totalAngsuran, $besar_pembayaran, $sisa_angsuran, $detail_sisa_pinjaman, $status_angsuran;
    public $detail_pinjaman, $sisa_pinjaman_sebelumnya, $getPinjamanId;
    public $CheckPembayaran;

    // Lihat Pembayaran
    public $lihatpembayaran;
    public $dataCetak = [];
    public function mount()
    {


        $this->checkRole  = auth()->user()->getRoleNames()[0];

        $pinjaman = ModelsPinjamanUser::latest()->get();
        $count = count($pinjaman);
        $this->kode_pinjaman = 'F' . str_replace('-', '', now()->format('d-m')) . '00' . ($count + 1);
    }



    public function render()
    {
        $pekerjaan = Pekerjaan::latest()->get();
        $dataPinjaman = DataPinjaman::latest()->get();
        $dataAngsuran = DataAngsuran::latest()->get();
        $detailPinjaman  = DetailDataPinjaman::latest()->get();

        if ($this->checkRole == 'super admin') {
            if ($this->search == '') {
                $pinjamanUsers = ModelsPinjamanUser::with(['profile', 'detail_data_pinjaman' => function ($query) {
                    $query->with('data_angsuran', 'data_pinjaman');
                }])->latest()->paginate($this->paginate);
            } else {
                $pinjamanUsers = ModelsPinjamanUser::with(['profile', 'detail_data_pinjaman' => function ($query) {
                    $query->with('data_angsuran', 'data_pinjaman');
                }])
                    ->join('profile_users', 'profile_users.id', '=', 'pinjaman_users.profile_user_id')
                    ->where('profile_users.nama_lengkap', 'like', '%' . $this->search . '%')
                    ->select('profile_users.nama_lengkap as nama', 'pinjaman_users.*')
                    ->latest()->paginate($this->paginate);
            }
        } else if ($this->checkRole == 'petugas') {
            if ($this->search == '') {
                $pinjamanUsers = ModelsPinjamanUser::where('petugas_id', auth()->user()->id)->with(['profile', 'detail_data_pinjaman' => function ($query) {
                    $query->with('data_angsuran', 'data_pinjaman');
                }])->latest()->paginate($this->paginate);
            } else {
                $pinjamanUsers = ModelsPinjamanUser::with(['profile', 'detail_data_pinjaman' => function ($query) {
                    $query->with('data_angsuran', 'data_pinjaman');
                }])
                    ->where('petugas_id', auth()->user()->id)
                    ->join('profile_users', 'profile_users.id', '=', 'pinjaman_users.profile_user_id')
                    ->where('profile_users.nama_lengkap', 'like', '%' . $this->search . '%')
                    ->select('profile_users.nama_lengkap as nama', 'pinjaman_users.*')
                    ->latest()->paginate($this->paginate);
            }
        } else if ($this->checkRole == 'anggota') {
            if ($this->search == '') {
                // dd(auth()->user()->profile()->get());
                $pinjamanUsers = ModelsPinjamanUser::where('profile_user_id', auth()->user()->profile->id)->with(['profile', 'detail_data_pinjaman' => function ($query) {
                    $query->with('data_angsuran', 'data_pinjaman');
                }])->latest()->paginate($this->paginate);
            } else {
                $pinjamanUsers = ModelsPinjamanUser::with(['profile', 'detail_data_pinjaman' => function ($query) {
                    $query->with('data_angsuran', 'data_pinjaman');
                }])
                    ->where('profile_id', auth()->user()->id)
                    ->join('profile_users', 'profile_users.id', '=', 'pinjaman_users.profile_user_id')
                    ->where('profile_users.nama_lengkap', 'like', '%' . $this->search . '%')
                    ->select('profile_users.nama_lengkap as nama', 'pinjaman_users.*')
                    ->latest()->paginate($this->paginate);
            }
        }
        $this->data = json_encode($pinjamanUsers);
        return view('livewire.backend.pinjaman-user', compact('pekerjaan', 'dataPinjaman', 'dataAngsuran', 'pinjamanUsers'), ['data' => $this->data]);
    }
    public function print($value)
    {
        return redirect()->route('cetak-pinjaman-anggota')->with(['data' => $value]);
    }

    public function printPembayaran()
    {
        // dd($this->lihatpembayaran);
        return redirect()->route('cetak-pembayaran')->with(['data' => $this->lihatpembayaran]);
    }
    public function changeStatusPinjaman($value, $id)
    {
        $pinjaman = ModelsPinjamanUser::findOrfail($id);
        $pinjaman->update(['status_pinjaman' => $value]);
    }

    public function changeStatusLunasPinjaman($value, $id)
    {
        $pinjaman = ModelsPinjamanUser::findOrfail($id);
        if ($value == false) {
            $pinjaman->pembayaran_user->detail_pembayaran_user()->delete();
            $pinjaman->pembayaran_user->delete();
            $pinjaman->simpanan_user->delete();
            $pinjaman->update(['status_lunas' => false]);
        } else {
            $pinjaman->update(['status_lunas' => true]);
            $countPembayaran = PembayaranUser::all();
            $this->kode_pembayaran = 'BY00' . str_replace('-', '', now()->format('d-m')) . (count($countPembayaran) + 1);

            $s = SimpananUser::all();
            $count = count($s);
            // dd($count);
            $simpanan = SimpananUser::create([
                'pinjaman_user_id' => $pinjaman->id,
                'profile_user_id' => $pinjaman->profile_user_id,
                'petugas_id' => $pinjaman->petugas_id,
                'kode_simpanan' => 'S00' . str_replace('-', '', now()->format('d-m')) . ($count + 1),
                'tanggal_simpanan' => now()
            ]);

            if ($pinjaman->pembayaran_user) {
                $s = count($pinjaman->pembayaran_user->detail_pembayaran_user);

                $pinjaman->pembayaran_user->detail_pembayaran_user()->create([
                    'pinjaman_user_id' => $pinjaman->id,
                    'pembayaran_user_id' => $pinjaman->pembayaran_user->id,
                    'angsuran_ke' => 1,
                    'total_pinjaman' => $pinjaman->detail_data_pinjaman->data_pinjaman->pinjaman,
                    'pembayaran' => $pinjaman->pembayaran_user->detail_pembayaran_user[$s - 1]->sisa_pinjaman,
                    'sisa_pinjaman' => 0,
                    'satus_angsuran_ke' => 'melunasi pinjaman',
                    'petugas_id' => auth()->user()->id,
                ]);
            } else {
                $pembayaran = $pinjaman->pembayaran_user()->create([
                    'kode_pembayaran' => $this->kode_pembayaran,
                    'pinjaman_user_id' => $this->getPinjamanId,
                    'keterangan' => '',
                    'petugas_id' => auth()->user()->id,
                ]);

                $pembayaran->detail_pembayaran_user()->create([
                    'pinjaman_user_id' => $pinjaman->id,
                    'pembayaran_user_id' => $pembayaran->id,
                    'angsuran_ke' => 1,
                    'total_pinjaman' => $pinjaman->detail_data_pinjaman->data_pinjaman->pinjaman,
                    'pembayaran' => $pinjaman->detail_data_pinjaman->data_pinjaman->pinjaman,
                    'sisa_pinjaman' => 0,
                    'satus_angsuran_ke' => 'melunasi pinjaman',
                    'petugas_id' => auth()->user()->id,
                ]);
            }
        }
    }

    public function pilihAnggota($data)
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
        $this->searchAnggota = $data['nama_lengkap'];
        $this->showAnggota = false;
        $this->idAnggota = $data['id'];
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

    public function pilih()
    {
        if ($this->pilihAngsuran !== '' and $this->pilihPinjaman !== '') {
            $detail = DetailDataPinjaman::with('data_pinjaman', 'data_angsuran')->where('data_pinjaman_id', $this->pilihPinjaman)
                ->where('data_angsuran_id', $this->pilihAngsuran)->first();
            $this->idDetailDataPinjaman = $detail->id;
            $this->detailJumlahPinjaman = format_uang($detail->data_pinjaman->pinjaman);
            $this->detailDurasi = $detail->data_angsuran->durasi_angsuran;
            $this->detailAngsuran = format_uang($detail->angsuran);
            $this->detailSimpanan = format_uang($detail->simpanan);
            $total = str_replace('.', '', $this->detailJumlahPinjaman) - str_replace('.', '', $this->detailSimpanan);
            $this->detailTotalTerima = format_uang($total);
        } else if ($this->pilihAngsuran !== '' or $this->pilihPinjaman !== '') {
            $this->detailJumlahPinjaman = '';
            $this->detailDurasi = '';
            $this->detailAngsuran = '';
            $this->detailSimpanan = '';
            $this->detailTotalTerima = '';
        }
    }

    public function submitHandler()
    {
        if ($this->idAnggota !== null) {
            $pinjaman = ModelsPinjamanUser::create([
                'kode_pinjaman' => $this->kode_pinjaman,
                'profile_user_id' => $this->idAnggota,
                'detail_data_pinjaman_id' => $this->idDetailDataPinjaman,
                'petugas_id' => auth()->user()->id,
                'tanggal_pengajuan' => now()->format('Y-m-d'),
            ]);
        }
        $this->resetPage();
        $this->info('menambah');
    }

    public function edit($data)
    {

        $this->kode_pinjaman = $data['kode_pinjaman'];
        $this->searchAnggota = $data['profile']['nama_lengkap'];
        $this->pilihAngsuran = $data['detail_data_pinjaman']['data_angsuran_id'];
        $this->pilihPinjaman = $data['detail_data_pinjaman']['data_pinjaman_id'];
        $this->detailJumlahPinjaman = format_uang($data['detail_data_pinjaman']['data_pinjaman']['pinjaman']);
        $this->detailDurasi = $data['detail_data_pinjaman']['data_angsuran']['durasi_angsuran'];
        $this->detailAngsuran = format_uang($data['detail_data_pinjaman']['angsuran']);
        $this->detailSimpanan = format_uang($data['detail_data_pinjaman']['simpanan']);
        $total = str_replace('.', '', $this->detailJumlahPinjaman) - str_replace('.', '', $this->detailSimpanan);
        $this->detailTotalTerima = format_uang($total);
        $this->nik = $data['profile']['nik'];
        $this->no_kk = $data['profile']['no_kk'];
        $this->nama_lengkap = $data['profile']['nama_lengkap'];
        $this->tempat_lahir = $data['profile']['tempat_lahir'];
        $this->ttl = $data['profile']['ttl'];
        $this->no_telp = $data['profile']['no_telp'];
        $this->alamat = $data['profile']['alamat'];
        $this->kecamatan = $data['profile']['kecamatan'];
        $this->kelurahan = $data['profile']['kelurahan'];
        $this->kabupaten = $data['profile']['kabupaten'];
        $this->provinsi = $data['profile']['provinsi'];
        $this->pekerjaan_id = $data['profile']['pekerjaan_id'];
        $this->idProfil = $data['profile']['id'];
        $this->editStatus = true;
        $this->idPinjaman = $data['id'];
        $this->idProfile = $data['profile']['id'];
        $this->idDetailDataPinjaman = $data['detail_data_pinjaman']['id'];
        $this->titleModal = 'pengajuan pinjaman';
        $this->statusView = 'pengajuan pinjaman';
    }

    public function updateHandler()
    {
        $pinjamanUsers = ModelsPinjamanUser::findOrfail($this->idPinjaman);
        $pinjamanUsers->update([
            'kode_pinjaman' => $this->kode_pinjaman,
            'detail_data_pinjaman_id' => $this->idDetailDataPinjaman,
            'petugas_id' => auth()->user()->id,
        ]);
        $this->resetPage();
        $this->info('meengedit');
        $this->editStatus = false;
    }

    // Pembayaran Pinjaman

    public function submitPinjaman()
    {
    }





    public function bayarPinjaman($value, $item)
    {

        if ($value == 'pengajuan pinjaman') {
            $this->titleModal = 'pengajuan pinjaman';
            $this->statusView = 'pengajuan pinjaman';
        } else if ($value == 'bayar pinjaman') {
            $this->besar_pembayaran = '';
            $this->titleModal = 'bayar pinjaman';
            $this->statusView = 'bayar pinjaman';

            $this->namaPeminjam = $item['profile']['nama_lengkap'];
            $this->totalPinjaman = $item['detail_data_pinjaman']['data_pinjaman']['pinjaman'];
            $this->totalAngsuran = $item['detail_data_pinjaman']['angsuran'];
            $this->detail_pinjaman = format_uang($item['detail_data_pinjaman']['data_pinjaman']['pinjaman']);
            $this->detail_totalAngsuran = format_uang($item['detail_data_pinjaman']['angsuran']);
            $this->CheckPembayaran = PembayaranUser::where('pinjaman_user_id', $item['id'])->first();
            $this->getPinjamanId = $item['id'];
            $countPembayaran = PembayaranUser::all();
            if ($this->CheckPembayaran) {
                $detail = DetailPembayaranUser::where('pembayaran_user_id', $this->CheckPembayaran->id)->latest()->get()->take(1);

                if (count($detail) > 0) {
                    $this->angsuran_ke = $detail[0]->angsuran_ke + 1;
                    $this->sisa_pinjaman_sebelumnya = $detail[0]->sisa_pinjaman;
                } else {
                    $this->angsuran_ke = '1';
                    $this->sisa_pinjaman_sebelumnya = format_uang($item['detail_data_pinjaman']['data_pinjaman']['pinjaman']);
                }
            } else {
                $this->angsuran_ke = '1';

                $this->sisa_pinjaman_sebelumnya = format_uang($item['detail_data_pinjaman']['data_pinjaman']['pinjaman']);
            }
            $this->kode_pembayaran = 'BY00' . str_replace('-', '', now()->format('d-m')) . (count($countPembayaran) + 1);
        } else if ($value == 'lihat pembayaran pinjaman') {
            $this->titleModal = 'Lihat pembayaran pinjaman';
            $this->statusView = 'lihat pembayaran pinjaman';

            $this->lihatpembayaran = ModelsPinjamanUser::findOrfail($item);
        }
    }

    public function bayar_change()
    {

        if ($this->besar_pembayaran !== '') {
            $format = str_replace('.', '', $this->besar_pembayaran);
            // str_replace('.', '', $this->limit_pinjaman);

            $this->besar_pembayaran = format_uang($format);
            $this->sisa_angsuran = format_uang(str_replace('.', '', $this->detail_totalAngsuran) - str_replace('.', '', $this->besar_pembayaran));
            $this->detail_sisa_pinjaman = format_uang(str_replace('.', '', $this->sisa_pinjaman_sebelumnya) - str_replace('.', '', $this->besar_pembayaran));

            if ($this->sisa_angsuran == 0) {
                $this->status_angsuran = 'Full';
            } else if ($this->sisa_angsuran > 0) {
                $this->status_angsuran = 'Separuh';
            } else if ($this->sisa_angsuran < 0) {
                $this->status_angsuran = 'Lengkapi Pembayaran Sebelumnya';
            }
        }
    }

    public function submitBayar()
    {

        if ($this->CheckPembayaran) {
            $detail = DetailPembayaranUser::create([
                'pinjaman_user_id' => $this->getPinjamanId,
                'pembayaran_user_id' => $this->CheckPembayaran->id,
                'angsuran_ke' => $this->angsuran_ke,
                'total_pinjaman' => str_replace('.', '', $this->sisa_pinjaman_sebelumnya),
                'pembayaran' => str_replace('.', '', $this->besar_pembayaran),
                'sisa_pinjaman' => str_replace('.', '', $this->detail_sisa_pinjaman),
                'satus_angsuran_ke' => $this->status_angsuran,
                'petugas_id' => auth()->user()->id,
            ]);
        } else {
            $bayar = PembayaranUser::create([
                'kode_pembayaran' => $this->kode_pembayaran,
                'pinjaman_user_id' => $this->getPinjamanId,
                'keterangan' => '',
                'petugas_id' => auth()->user()->id,
            ]);
            $detail = DetailPembayaranUser::create([
                'pinjaman_user_id' => $this->getPinjamanId,
                'pembayaran_user_id' => $bayar->id,
                'angsuran_ke' => $this->angsuran_ke,
                'total_pinjaman' => str_replace('.', '', $this->sisa_pinjaman_sebelumnya),
                'pembayaran' => str_replace('.', '', $this->besar_pembayaran),
                'sisa_pinjaman' => str_replace('.', '', $this->detail_sisa_pinjaman),
                'satus_angsuran_ke' => $this->status_angsuran,
                'petugas_id' => auth()->user()->id,
            ]);
        }
        if ($this->detail_sisa_pinjaman == 0) {
            $pinjamanUser = ModelsPinjamanUser::findOrfail($this->getPinjamanId);
            $pinjamanUser->update(['status_lunas' => true]);
            $s = SimpananUser::all();
            $count = count($s);
            // dd($count);
            $simpanan = SimpananUser::create([
                'pinjaman_user_id' => $this->getPinjamanId,
                'profile_user_id' => $pinjamanUser->profile_user_id,
                'petugas_id' => auth()->user()->id,
                'kode_simpanan' => 'S00' . str_replace('-', '', now()->format('d-m')) . ($count + 1),
                'tanggal_simpanan' => now()
            ]);
        }
        $this->sisa_pinjaman_sebelumnya = $this->detail_sisa_pinjaman;
        $this->sisa_angsuran = '';
        $this->besar_pembayaran = '';
        $this->detail_sisa_pinjaman = '';
        $this->status_angsuran = '';
        $this->angsuran_ke = $this->angsuran_ke + 1;
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => 'Berhasil melakukan pembayaran',
            'text' => ''
        ]);
    }



    public function resetPage()
    {
        $this->kode_pinjaman = '';
        $this->searchAnggota = '';
        $this->pilihAngsuran = '';
        $this->pilihPinjaman = '';
        $this->detailJumlahPinjaman = '';
        $this->detailDurasi = '';
        $this->detailAngsuran = '';
        $this->detailSimpanan = '';
        $this->detailTotalTerima = '';
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
        $this->idPinjaman = '';
        $this->idProfile = '';
        $pinjaman = ModelsPinjamanUser::latest()->get();
        $count = count($pinjaman);
        $this->kode_pinjaman = 'F' . str_replace('-', '', now()->format('d-m')) . '00' . ($count + 1);
    }

    public function delete($id)
    {
        $pinjamanUsers = ModelsPinjamanUser::findOrfail($id);
        $pinjamanUsers->delete();
        $this->info('menghapus');
    }

    public function deletePembayaran($id)
    {
        $detail = DetailPembayaranUser::findOrfail($id);
        $detail->pinjaman_user->update(['status_lunas' => false]);
        $detail->delete();
        $this->info('menghapus');
    }

    public function btnPrint($value)
    {
        dd($value);
        return redirect()->route('cetak-pinjaman-anggota')->with(['data' => $this->dataCetak]);
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