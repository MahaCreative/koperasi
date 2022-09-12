<?php

use App\Http\Controllers\CetaKAnggotaKoperasi;
use App\Http\Controllers\CetakHistoryPenarikan;
use App\Http\Controllers\cetakPembayaran;
use App\Http\Controllers\CetakPinjamanAnggota;
use App\Http\Livewire\Backend\AnggotaKoperasi;
use App\Http\Livewire\Backend\Artikel\Create;
use App\Http\Livewire\Backend\Artikel\Edit;
use App\Http\Livewire\Backend\Artikel\Index;
use App\Http\Livewire\Backend\Dashboard;

use App\Http\Livewire\Backend\DataPinjamanAngsuran;
use App\Http\Livewire\Backend\History\PembayaranPinjaman;
use App\Http\Livewire\Backend\History\PenarikanSimpanan;
use App\Http\Livewire\Backend\Jabatan;
use App\Http\Livewire\Backend\JenisSimpanan;
use App\Http\Livewire\Backend\PageSetting\AboutSetting;
use App\Http\Livewire\Backend\PageSetting\GalerySetting;
use App\Http\Livewire\Backend\PageSetting\HomeSetting;
use App\Http\Livewire\Backend\PageSetting\IklanSetting;
use App\Http\Livewire\Backend\Pesan\ManageKomentar;
use App\Http\Livewire\Backend\Pesan\ManageKontakKami;
use App\Http\Livewire\Backend\Pesan\ManageTestimoni;
use App\Http\Livewire\Backend\Petugas;
use App\Http\Livewire\Backend\PinjamanUser;
use App\Http\Livewire\Backend\ProfileKoperasi;
use App\Http\Livewire\Backend\ProfileUser;
use App\Http\Livewire\Backend\Simpanan;
use App\Http\Livewire\Cetak\PinjamanAnggota;
use App\Http\Livewire\Kategori;
use App\Http\Livewire\Login;
use App\Http\Livewire\Page\About;
use App\Http\Livewire\Page\Artikel\Index as ArtikelIndex;
use App\Http\Livewire\Page\Artikel\Search;
use App\Http\Livewire\Page\Artikel\View;
use App\Http\Livewire\Page\Artikel\ViewKategori;
use App\Http\Livewire\Page\ContakKami;
use App\Http\Livewire\Page\Galery;
use App\Http\Livewire\Page\Home;
use App\Http\Livewire\Pekerjaan;
use App\Http\Livewire\Register;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('', Home::class)->name('home');
Route::get('about', About::class)->name('about');
Route::get('kontak-kami', ContakKami::class);
Route::get('galery', Galery::class)->name('galery');

Route::get('artikel', ArtikelIndex::class)->name('user-artikel');
Route::get('artikel/{slug}', View::class)->name('artikel-view');
Route::get('artikel/search/{cari}', Search::class)->name('artikel-search');
Route::get('artikel/kategori/{cari}', ViewKategori::class)->name('kategori-view');
Route::get('kontak-kami', ContakKami::class)->name('kontak-kami');
Route::get('login', Login::class)->name('login');
Route::get('register', Register::class)->name('register');

Route::middleware('auth')->group(function () {

    Route::get('logout', function () {

        Auth::logout();
        return redirect()->route('login');
    })->name('logout');


    Route::get('profile-user', ProfileUser::class)->name('profile-user');
    Route::get('dashboard', Dashboard::class)->name('dashboard');
    Route::get('profile-koperasi', ProfileKoperasi::class)->name('profile-koperasi');

    // Master Data
    Route::get('data-pinjaman', DataPinjamanAngsuran::class)->name('data-pinjaman');
    Route::get('jenis-simpanan', JenisSimpanan::class)->name('jenis-simpanan');
    Route::get('anggota-koperasi', AnggotaKoperasi::class)->name('anggota-koperasi');


    Route::get('pinjaman-anggota', PinjamanUser::class)->name('pinjaman-anggota');
    Route::get('cetak-pinjaman-anggota', PinjamanAnggota::class)->name('cetak-pinjaman-anggota');


    Route::get('simpanan-anggota', Simpanan::class)->name('simpanan-anggota');

    Route::get('petugas', Petugas::class)->name('petugas');

    // Setting
    Route::get('home-setting', HomeSetting::class)->name('home-setting');
    Route::get('about-setting', AboutSetting::class)->name('about-setting');
    Route::get('galery-setting', GalerySetting::class)->name('galery-setting');
    Route::get('iklan-setting', IklanSetting::class)->name('iklan-setting');

    Route::get('admin-artikel', Index::class)->name('admin-artikel');
    Route::get('admin-create-artikel', Create::class)->name('create-artikel');
    Route::get('admin-edit-artikel/{artikel}', Edit::class)->name('artikel-edit');
    Route::get('admin-kategori', Kategori::class)->name('admin-kategori');

    Route::get('manage-komentar', ManageKomentar::class)->name('manage-komentar');
    Route::get('manage-kontak-kami', ManageKontakKami::class)->name('manage-kontak-kami');
    Route::get('manage-testimoni', ManageTestimoni::class)->name('manage-testimoni');

    Route::get('pekerjaan', Pekerjaan::class)->name('pekerjaan');
    Route::get('jabatan', Jabatan::class)->name('jabatan');

    Route::get('histori-penarikan-simpanan', PenarikanSimpanan::class)->name('histori-penarikan-simpanan');
    Route::get('cetak-histori-penarikan-simpanan', [CetakHistoryPenarikan::class, 'index'])->name('cetak-histori-penarikan-simpanan');

    Route::get('histori-pembayaran-pinjaman', PembayaranPinjaman::class)->name('histori-pembayaran-pinjaman');
    Route::get('cetak-histori-pembayaran-pinjaman', [CetakHistoryPenarikan::class, 'hitoriPembayaran'])->name('cetak-histori-pembayaran-pinjaman');
    Route::get('cetak-anggota-koperasi', [CetaKAnggotaKoperasi::class, 'index'])->name('cetak-anggota-koperasi');
    Route::get('cetak-pinjaman-anggota', [CetakPinjamanAnggota::class, 'index'])->name('cetak-pinjaman-anggota');
    Route::get('cetak-pembayaran-pinjaman', [cetakPembayaran::class, 'index'])->name('cetak-pembayaran');
});