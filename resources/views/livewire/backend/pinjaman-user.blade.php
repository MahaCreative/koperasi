<div class="overflow-hidden">
    @component('components.snippets.modals',
        ['title' => $titleModal, 'idModals' => 'modalsLarge', 'sizeModals' => 'modal-xl'])

        @if ($statusView === 'pengajuan pinjaman')
            @can('create pinjaman user')
                <form action="" wire:submit.prevent="{{ $editStatus ? 'updateHandler' : 'submitHandler' }}" class="">
                    @csrf
                    <div class="flex flex-col">
                        <div class="grid grid-cols-2 gap-x-4">
                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-x-2">
                                @if ($checkRole == 'petugas' or $checkRole == 'super admin')
                                    <div class="flex flex-col relative text-sm lg:text-base">
                                        <label for="">Pilih Anggota</label>
                                        <input wire:keyup="cariAnggota()" wire:model="searchAnggota"
                                            class="border text-sm lg:text-base border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                                            type="text" name="" id="" placeholder="Masukkan Nama Anggota">
                                        <div
                                            class="absolute text-sm lg:text-base top-12 my-1 {{ $showAnggota ? '' : 'hidden' }} bg-white w-full shadow-md border  shadow-gray-500/50 border-gray-400/50">
                                            @if ($profileUser)
                                                @foreach ($profileUser as $item)
                                                    <p wire:click="pilihAnggota({{ $item }})"
                                                        class="hover:bg-blue-400 p-2 duration-300 transition ease-in-out hover:cursor-pointer">
                                                        {{ $item->nama_lengkap }}</p>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                <div class="text-sm lg:text-base">
                                    <label for="">Pilih Pinjaman</label>
                                    <select wire:change="pilih()" wire:model="pilihPinjaman"
                                        class="text-sm lg:text-base w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                                        name="" id="">
                                        <option value="" selected>--Pilih Pinjaman--</option>
                                        @foreach ($dataPinjaman as $item)
                                            <option value="{{ $item->id }}">{{ $item->pinjaman }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="text-sm lg:text-base">
                                    <label for="">Pilih Durasi Angsuran</label>
                                    <select wire:change="pilih()" wire:model="pilihAngsuran"
                                        class="text-sm lg:text-base w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                                        name="" id="">
                                        <option value="" selected>--Pilih Durasi--</option>
                                        @foreach ($dataAngsuran as $item)
                                            <option value="{{ $item->id }}">{{ $item->durasi_angsuran }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="border border-gray-400/50 shadow rounded-md p-2 ">
                            <h4 class="border-b border-gray-400 my-2 font-bold">Detail Pinjaman</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-2">
                                <div class="flex flex-col">
                                    <label for="">Jumlah Pinjaman</label>
                                    <input
                                        class="w-full border border-gray-400/50 bg-gray-200 rounded-md px-2 py-1 flex items-center mb-2"
                                        type="text" wire:model='detailJumlahPinjaman' placeholder="" disabled>
                                    @error('detailJumlahPinjaman')
                                        <p class="text-red-500 italic text-sm">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="flex flex-col">
                                    <label for="">Durasi Pinjaman</label>
                                    <input
                                        class="w-full border border-gray-400/50 bg-gray-200 rounded-md px-2 py-1 flex items-center mb-2"
                                        type="text" wire:model='detailDurasi' placeholder="" disabled>
                                    @error('detailDurasi')
                                        <p class="text-red-500 italic text-sm">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="flex flex-col">
                                    <label for="">Angsuran</label>
                                    <input
                                        class="w-full border border-gray-400/50 bg-gray-200 rounded-md px-2 py-1 flex items-center mb-2"
                                        type="text" wire:model='detailAngsuran' placeholder="" disabled>
                                    @error('detailAngsuran')
                                        <p class="text-red-500 italic text-sm">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="flex flex-col">
                                    <label for="">Simpanan</label>
                                    <input
                                        class="w-full border border-gray-400/50 bg-gray-200 rounded-md px-2 py-1 flex items-center mb-2"
                                        type="text" wire:model='detailSimpanan' placeholder="" disabled>
                                    @error('detailSimpanan')
                                        <p class="text-red-500 italic text-sm">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="flex flex-col lg:col-span-4">
                                    <label for="">Total Diterima</label>
                                    <input
                                        class="w-full border border-gray-400/50 bg-gray-200 rounded-md px-2 py-1 flex items-center mb-2"
                                        type="text" wire:model='detailTotalTerima' placeholder="" disabled>
                                    @error('detailTotalTerima')
                                        <p class="text-red-500 italic text-sm">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2">
                            <div class="flex flex-col">
                                <label for="">Nama Lengkap</label>
                                <input class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                                    type="text" wire:model='nama_lengkap' placeholder="nama">
                                @error('nama_lengkap')
                                    <p class="text-red-500 italic text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex flex-col">
                                <label for="">NIK</label>
                                <input class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                                    type="text" wire:model='nik' placeholder="NIK">
                                @error('nik')
                                    <p class="text-red-500 italic text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex flex-col">
                                <label for="">No KK</label>
                                <input class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                                    type="text" wire:model='no_kk' placeholder="No KK">
                                @error('no_kk')
                                    <p class="text-red-500 italic text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex flex-col">
                                <label for="">Tempat Lahir</label>
                                <input class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                                    type="text" wire:model='tempat_lahir' placeholder="Tempat Lahir">
                                @error('tempat_lahir')
                                    <p class="text-red-500 italic text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex flex-col">
                                <label for="">Tanggal Lahir</label>
                                <input class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                                    type="date" wire:model='ttl' placeholder="Tanggal Lahir">
                                @error('ttl')
                                    <p class="text-red-500 italic text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex flex-col">
                                <label for="">No Telp</label>
                                <input class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                                    type="number" wire:model='no_telp' placeholder="Nomor Telp">
                                @error('no_telp')
                                    <p class="text-red-500 italic text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex flex-col">
                                <label for="">Alamat</label>
                                <textarea wire:model='alamat' class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                                    name="" id="" cols="30" rows="1"></textarea>
                                @error('alamat')
                                    <p class="text-red-500 italic text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex flex-col">
                                <label for="">Kecamatan</label>
                                <input class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                                    type="text" wire:model='kecamatan' placeholder="Kecamatan">
                                @error('kecamatan')
                                    <p class="text-red-500 italic text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex flex-col">
                                <label for="">Kelurahan</label>
                                <input class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                                    type="text" wire:model='kelurahan' placeholder="Kelurahan">
                                @error('kelurahan')
                                    <p class="text-red-500 italic text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex flex-col">
                                <label for="">Kabupaten</label>
                                <input class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                                    type="text" wire:model='kabupaten' placeholder="Kabupaten">
                                @error('kabupaten')
                                    <p class="text-red-500 italic text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex flex-col">
                                <label for="">Provinsi</label>
                                <input class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                                    type="text" wire:model='provinsi' placeholder="Provinsi">
                                @error('provinsi')
                                    <p class="text-red-500 italic text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex flex-col">
                                <label for="">Pekerjaan</label>
                                <select wire:model='pekerjaan_id'
                                    class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2 "
                                    name="" id="select2">

                                    @forelse ($pekerjaan as $item)
                                        <option class="" value="{{ $item->id }}">{{ $item->pekerjaan }}
                                        </option>
                                    @empty
                                    @endforelse
                                </select>
                                @error('provinsi')
                                    <p class="text-red-500 italic text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit"
                        class="border border-gray-400/50 shadow rounded-md p-2 hover:cursor-pointer hover:bg-gray-500/50 hover:text-white transition duration-300 ease-in">{{ $editStatus ? 'Update' : 'Submit' }}</button>
                </form>
            @endcan
        @endif
        @if ($statusView === 'bayar pinjaman')
            <form action="" wire:submit.prevent="submitBayar" class="">
                @csrf
                <div
                    class="shadow-md shadow-gray-500/50 rounded-md border border-gray-400/50 p-2 text-sm text-gray-400 italic capitalize">
                    <div class="flex justify-between">
                        <div class="">
                            <div class="grid grid-cols-2 gap-2">
                                <p>Nama Peminjam </p>
                                <p>: {{ $namaPeminjam }}</p>
                            </div>
                            <div class="grid grid-cols-2 gap-2">
                                <p>Total Pinjaman </p>
                                <p>: Rp. {{ format_uang($totalPinjaman) }}</p>
                            </div>
                            <div class="grid grid-cols-2 gap-2">
                                <p>Total Angsuran </p>
                                <p>: Rp. {{ format_uang($totalAngsuran) }}</p>
                            </div>
                            <div class="grid grid-cols-2 gap-2">
                                <p>Tanggal Pembayaran </p>
                                <p>: {{ now()->format('d-m-Y') }}</p>
                            </div>
                        </div>
                        <div>
                            <label for="">Kode Pembayaran</label>
                            <input type="text" disabled wire:model="kode_pembayaran"
                                class="border text-sm lg:text-base border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2">
                        </div>
                    </div>
                </div>
                <div
                    class="shadow-md shadow-gray-500/50 rounded-md border border-gray-400/50 p-2 text-sm italic capitalize ">
                    <div class="md:grid-cols-2 lg:grid-cols-5 grid grid-cols-1 gap-x-2 overflow-auto">
                        <div>
                            <label for="">Angsuran Ke {{ $angsuran_ke }}</label>
                            <input type="text" disabled wire:model="angsuran_ke"
                                class="border  bg-gray-400/50 text-sm w-full lg:text-base border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2">
                        </div>
                        <div>
                            <label for="">Total Angsuran</label>
                            <input type="text" disabled wire:model="detail_totalAngsuran"
                                class="border  bg-gray-400/50 text-sm w-full lg:text-base border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2">
                        </div>
                        <div>
                            <label for="">Besar Pembayaran</label>
                            <input wire:keyup="bayar_change()" autofocus type="text" focus
                                wire:model="besar_pembayaran"
                                class="border text-sm w-full lg:text-base border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2">
                        </div>
                        <div>
                            <label for="">Sisa Angsuran</label>
                            <input type="text" disabled wire:model="sisa_angsuran"
                                class="border  bg-gray-400/50 text-sm w-full lg:text-base border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2">
                        </div>
                        <div class="">
                            <label for="">Status Angsuran ke {{ $angsuran_ke }}</label>
                            <input type="text" disabled wire:model="status_angsuran"
                                class="border  bg-gray-400/50 text-sm w-full lg:text-base border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2">
                        </div>
                        <div class="">
                            <label for="">Pinjaman</label>
                            <input type="text" disabled wire:model="detail_pinjaman"
                                class="border  bg-gray-400/50 text-sm w-full lg:text-base border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2">
                        </div>
                        <div class="">
                            <label for="">Sisa Pinjaman Sebelumnya</label>
                            <input type="text" disabled wire:model="sisa_pinjaman_sebelumnya"
                                class="border  bg-gray-400/50 text-sm w-full lg:text-base border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2">
                        </div>
                        <div>
                            <label for="">Besar Pembayaran</label>
                            <input autofocus type="text" disabled wire:model="besar_pembayaran"
                                class="border text-sm w-full lg:text-base border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2">
                        </div>
                        <div class="">
                            <label for="">Sisa Pinjaman</label>
                            <input type="text" disabled wire:model="detail_sisa_pinjaman"
                                class="border  bg-gray-400/50 text-sm w-full lg:text-base border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2">
                        </div>
                    </div>

                </div>
                <button type="submit"
                    class="border border-gray-400/50 shadow rounded-md p-2 hover:cursor-pointer hover:bg-gray-500/50 hover:text-white transition duration-300 ease-in">
                    Submit</button>
            </form>
        @endif
        @if ($statusView === 'lihat pembayaran pinjaman')
            <div class="border lg:text-base text-sm border-gray-400/50 shadow-md shadow-gray-500/50 rounded-md p-3 my-2">
                {{-- Table --}}
                <div class="border-b border-gray-600/50 py-3 w-full">
                    <p>Nama Pinjaman :<span
                            class="font-bold text-right">{{ $lihatpembayaran->profile->nama_lengkap }}</span></p>
                    <p>Kode Pinjaman :<span class="font-bold text-right">{{ $lihatpembayaran->kode_pinjaman }}</span></p>
                    <p>Tanggal Pinjaman :<span
                            class="font-bold text-right">{{ $lihatpembayaran->tanggal_pengajuan }}</span></p>
                </div>
                <div class="flex flex-col">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="overflow-x-auto">
                                <table class="min-w-full">
                                    <thead class="border-b border-gray-400/50">
                                        <tr>
                                            <th scope="col"
                                                class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                #
                                            </th>
                                            <th scope="col"
                                                class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                Nama
                                            </th>
                                            <th scope="col"
                                                class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                Kode Pembayaran
                                            </th>
                                            <th scope="col"
                                                class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                Tanggal Pembayaran
                                            </th>
                                            <th scope="col"
                                                class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                Pinjaman
                                            </th>
                                            <th scope="col"
                                                class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                Total Pembayaran
                                            </th>
                                            <th scope="col"
                                                class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                Sisa Pinjaman
                                            </th>
                                            <th scope="col"
                                                class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                Petugas
                                            </th>
                                            <th scope="col"
                                                class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                Aksi
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $nor = 0;
                                        $count = count($lihatpembayaran->pembayaran_user->detail_pembayaran_user); ?>

                                        @foreach ($lihatpembayaran->pembayaran_user->detail_pembayaran_user()->get() as $no => $item)
                                            <?php $nor = $no + 1; ?>
                                            <tr class="border-b border-gray-400/50">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ $nor }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ $lihatpembayaran->profile->nama_lengkap }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ $lihatpembayaran->pembayaran_user->kode_pembayaran }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ $item->created_at->format('Y-m-d') }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    Rp. {{ format_uang($item->total_pinjaman) }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    Rp. {{ format_uang($item->pembayaran) }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    Rp. {{ format_uang($item->sisa_pinjaman) }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ $item->user->username }} </td>
                                                @if ($nor == $count)
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                        @can('delete pinjaman user')
                                                            <button data-bs-dismiss="modal"
                                                                wire:click="deletePembayaran({{ $item->id }})"
                                                                class="bg-red-400 text-white py-1 px-3 hover:cursor-pointer rounded-md hover:bg-red-500 duration-300 transition">Delete</button>
                                                        @endcan
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <div class="my-3">
                                    {{ $pinjamanUsers->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    @endcomponent

    <div class="border-b border-emerald-400">
        <span><a href="{{ route('dashboard') }}">Dashboard /</a></span>
        <span><a class="text-emerald-400" href="{{ Request::url() }}">Pinjaman Anggota </a></span>
    </div>
    <div class="border lg:text-base text-sm border-gray-400/50 shadow-md shadow-gray-500/50 rounded-md p-3 my-2">
        <div class="flex lg:flex-row flex-col justify-between gap-y-2">
            <div class="flex gap-x-2">
                @can('create pinjaman user')
                    <button wire:click="bayarPinjaman('pengajuan pinjaman', '')" type="submit" data-bs-toggle="modal"
                        data-bs-target="#modalsLarge"
                        class="border border-gray-400/50 shadow rounded-md p-2 hover:cursor-pointer hover:bg-gray-500/50 hover:text-white transition duration-300 ease-in">Tambah
                        Pinjaman</button>
                @endcan

                <div>
                    <Label>Filter</Label>
                    <select
                        class="border border-gray-400/50 shadow rounded-md p-2 hover:cursor-pointer hover:bg-gray-500/50 hover:text-white transition duration-300 ease-in"
                        name="" id="" wire:model='paginate'>
                        <option value="1">10</option>
                        <option value="2">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="all">Lihat Semua</option>
                    </select>
                </div>

            </div>
            <div class="flex gap-x-2  items-center justify-end">
                <input wire:model='search' type="text" placeholder="Search..."
                    class="border border-gray-400/50 rounded-md px-2 py-1 mb-2">
            </div>

        </div>

        {{-- Table --}}
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="border-b border-gray-400/50">
                                <tr>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        #
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Nama
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Kode Pinjaman
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Pinjaman
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Angsuran
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Simpanan
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Status
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Tanggal Pengajuan
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Aksi
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pinjamanUsers as $no => $item)
                                    <tr class="border-b border-gray-400/50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $no + 1 }}
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            {{ $item->profile->nama_lengkap }}
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <p>{{ $item->kode_pinjaman }}</p>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <p>Besar Pinjaman : Rp.
                                                {{ format_uang($item->detail_data_pinjaman->data_pinjaman->pinjaman) }}
                                            </p>
                                            <p>Durasi Pembayaran :
                                                {{ format_uang($item->detail_data_pinjaman->data_angsuran->durasi_angsuran) }}
                                                X</p>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <p>
                                                Rp. {{ format_uang($item->detail_data_pinjaman->angsuran) }} </p>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <p>
                                                Rp. {{ format_uang($item->detail_data_pinjaman->simpanan) }} </p>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            @can('setujui pinjaman user')
                                                <select
                                                    class="rounded-md border text-white border-gray-400/50 p-1 {{ $item->status_pinjaman ? 'bg-green-600 text-white' : 'bg-red-500 text-white' }}"
                                                    name="" id=""
                                                    wire:change="changeStatusPinjaman($event.target.value, {{ $item->id }})">
                                                    <option value="{{ $item->status_pinjaman }}" selected disabled>
                                                        {{ $item->status_pinjaman ? 'Di setujui' : 'Belum di setujui' }}
                                                    </option>
                                                    <option value=0>Belum Di Setujui</option>
                                                    <option value=1>Di Setujui</option>
                                                </select>
                                            @endcan
                                            @can('lunasi pinjaman user')
                                                <select
                                                    class="rounded-md border border-gray-400/50 p-1 {{ $item->status_lunas ? 'bg-green-600 text-white' : 'bg-red-500 text-white' }}"
                                                    class="mx-2" name="" id="">
                                                    <option value="{{ $item->status_lunas }}" selected disabled>
                                                        {{ $item->status_lunas ? 'Lunas' : 'Belum Lunas' }}</option>
                                                    <option value=0>Belum Lunas</option>
                                                    <option value=1>Lunas</option>
                                                </select>
                                            @endcan
                                        </td>
                                        <td>{{ $item->tanggal_pengajuan }}</td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            @if ($item->status_lunas == 0 and $item->status_pinjaman == 1)
                                                @can('edit pinjaman user')
                                                    <button data-bs-toggle="modal" data-bs-target="#modalsLarge"
                                                        wire:click="bayarPinjaman('bayar pinjaman', {{ $item }})"
                                                        class="bg-orange-400 text-white py-1 px-3 hover:cursor-pointer rounded-md hover:bg-orange-500 duration-300 transition">Bayar
                                                        Pinjaman</button>
                                                @endcan
                                            @endif
                                            @if ($item->pembayaran_user !== null)
                                                <button data-bs-toggle="modal" data-bs-target="#modalsLarge"
                                                    wire:click="bayarPinjaman('lihat pembayaran pinjaman', {{ $item->id }})"
                                                    class="bg-orange-400 text-white py-1 px-3 hover:cursor-pointer rounded-md hover:bg-orange-500 duration-300 transition">Lihat
                                                    Pembayaran Pinjaman</button>
                                            @endif
                                            @if ($item->status_pinjaman == false)
                                                @can('edit pinjaman user')
                                                    <button data-bs-toggle="modal" data-bs-target="#modalsLarge"
                                                        wire:click="edit({{ $item }})"
                                                        class="bg-orange-400 text-white py-1 px-3 hover:cursor-pointer rounded-md hover:bg-orange-500 duration-300 transition">Edit</button>
                                                @endcan
                                                @can('delete pinjaman user')
                                                    <button wire:click="delete({{ $item->id }})"
                                                        class="bg-red-400 text-white py-1 px-3 hover:cursor-pointer rounded-md hover:bg-red-500 duration-300 transition">Delete</button>
                                                @endcan
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                @endforelse

                            </tbody>
                        </table>
                        <div class="my-3">
                            {{ $pinjamanUsers->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
