<div>
    @component('components.snippets.modals',
        ['title' => 'Tambah Simpanan', 'idModals' => 'modalsLarge', 'sizeModals' => $sizeModals])
        @if ($activity == 'Buat simpanan')
            @can('create simpanan user')
                <div class="card">
                    <form action="" wire:submit.prevent="tambahSimpanan()">
                        <div class="flex justify-between">
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
                            <div>
                                <label for="">Kode Simpanan</label>
                                <input wire:model='kode_simpanan'
                                    class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2 bg-gray-200"
                                    type="text" name="" id="" placeholder="Kode Simpanan" disabled>
                            </div>
                        </div>
                        <div class="w-full flex flex-col capitalize">
                            <label for="">Jenis Simpanan</label>
                            <select wire:change="pilihJenis($event.target.value)" wire:model="jenis_simpanan"
                                class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                                name="" id="">
                                <option value="" selected disabled>--Pilih Jenis Simpanan--</option>
                                @forelse ($jenisSimpanan as $jenis)
                                    <option value="{{ $jenis->id }}">{{ $jenis->jenis_simpanan }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="w-full flex flex-col">
                            <label for="">Besar Simpanan</label>
                            <input wire:model="besar_simpanan"
                                class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                                name="" id="" type="number" disabled />
                        </div>
                        <button type="submit" data-bs-toggle="modal" data-bs-target="#modalsLarge"
                            class="border border-gray-400/50 shadow rounded-md p-2 hover:cursor-pointer hover:bg-gray-500/50 hover:text-white transition duration-300 ease-in">Tambah
                            Simpanan</button>
                    </form>
                </div>
            @endcan
        @elseif ($activity == 'tarik simpanan')
            @can('tarik simpanan user')
                <div class="card">
                    <div class="card-header">
                        <h3>Penarikan Dana Simpanan</h3>
                    </div>
                    <div class="card-body p-2">
                        <form action="" wire:submit.prevent="tarikSimpanan()">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputBorder">Total Simpanan</label>
                                <input wire:model="total_simpanan" type="text" name="" id=""
                                    class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                                    disabled>
                                @error('total_simpanan')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputBorder">Jumlah Penarikan</label>
                                <input wire:keyup="changePenarikan()" wire:model="jumlah_penarikan" type="text"
                                    name="" id=""
                                    class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                                    placeholder="Jumlah Penarikan">
                                @error('jumlah_penarikan')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputBorder">Sisa Simpanan</label>
                                <input wire:model="sisa_simpanan" type="text" name="" id=""
                                    class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                                    disabled>
                                @error('sisa_simpanan')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-block btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            @endcan
        @elseif ($activity == 'lihat penarikan')
            <div
                class="border lg:text-base text-sm border-gray-400/50 shadow-md shadow-gray-500/50 rounded-md p-3 my-2 overflow-x-auto">
                <div class="flex lg:flex-row flex-col justify-between gap-y-2">
                    <div class="flex gap-x-2">
                        <button data-bs-toggle="modal" data-bs-target="#modalsLarge"
                            class="border border-gray-400/50 shadow rounded-md p-2 hover:cursor-pointer hover:bg-gray-500/50 hover:text-white transition duration-300 ease-in">
                            Export PDF</button>


                    </div>
                    <div class="flex gap-x-2  items-center justify-end">
                        <button type="submit" data-bs-toggle="modal" data-bs-target="#modalsLarge"
                            class="border border-gray-400/50 shadow   rounded-md p-2 hover:cursor-pointer hover:bg-gray-500/50 hover:text-white transition duration-300 ease-in">
                            Print</button>
                    </div>

                </div>

                {{-- Table --}}
                <div class="flex flex-col">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="overflow-x-auto bg-white">
                                <table class="min-w-full">
                                    <thead class="border-b border-gray-400/50">
                                        <tr>
                                            <th scope="col"
                                                class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                #
                                            </th>
                                            <th scope="col"
                                                class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                Tanggal Penarikan
                                            </th>
                                            <th scope="col"
                                                class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                Besar Simpanan
                                            </th>
                                            <th scope="col"
                                                class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                Besar Penarikan
                                            </th>
                                            <th scope="col"
                                                class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                Sisa Simpanan
                                            </th>
                                            <th scope="col"
                                                class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                Aksi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @if ($lihatDetailPenarikan)
                                            @forelse ($lihatDetailPenarikan->detail_penarikan_simpanan as $no => $item)
                                                <tr class="border-b border-gray-400/50">
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                        {{ $no + 1 }}
                                                    </td>
                                                    <td
                                                        class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                        {{ $item->tanggal_penarikan }}
                                                    </td>
                                                    <td
                                                        class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                        <p>Rp. {{ format_uang($item->jumlah_simpanan) }}</p>
                                                    </td>
                                                    <td
                                                        class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                        <p>Rp. {{ format_uang($item->jumlah_penarikan) }}</p>
                                                    </td>
                                                    <td
                                                        class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                        <p>Rp. {{ format_uang($item->sisa_simpanan) }}</p>
                                                    </td>
                                                    <td>


                                                        <button wire:click="delete({{ $item->id }})"
                                                            class="bg-red-400 text-white py-1 px-3 hover:cursor-pointer rounded-md hover:bg-red-500 duration-300 transition">Delete</button>
                                                    </td>
                                                </tr>
                                            @empty
                                            @endforelse
                                        @endif

                                    </tbody>
                                </table>
                                <div class="my-3">
                                    {{-- {{ $pinjamanUsers->links() }} --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endcomponent
    {{-- <x-snippets.modal-large>
        <div class="card">
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Saldo</th>
                            <th>Penarikan</th>
                            <th>Tanggal Penarikan</th>
                            <th>Sisa Saldo</th>
                            <th>Status Penarikan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($penarikan)
                            @forelse ($penarikan as $no => $item)
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $item->saldo }}</td>
                                    <td>{{ $item->penarikan }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td>{{ $item->sisa_saldo }}</td>
                                    <td>
                                        <select
                                            wire:change="changeSelectStatus($event.target.value, {{ $item->id }})"
                                            name="" id=""
                                            class="{{ $item->status_penarikan ? 'bg-success' : 'bg-danger' }}">
                                            <option value="" disabled selected>
                                                {{ $item->status_penarikan ? 'Di Setujui' : 'Belum Di Setujui' }}
                                            </option>
                                            <option value=0>Belum Di Setujui</option>
                                            <option value=1>Di Setujui</option>
                                        </select>
                                    </td>
                                    <td></td>
                                </tr>
                            @empty
                            @endforelse

                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </x-snippets.modal-large> --}}
    <div class="border-b border-emerald-400">
        <span><a href="{{ route('dashboard') }}">Dashboard /</a></span>
        <span><a class="text-emerald-400" href="{{ Request::url() }}">Simpanan Anggota</a></span>
    </div>
    <div class="border lg:text-base text-sm border-gray-400/50 shadow-md shadow-gray-500/50 rounded-md p-3 my-2">
        <div class="flex lg:flex-row flex-col justify-between gap-y-2">
            <div class="flex gap-x-2">
                @can('create simpanan user')
                    <button wire:click="$set('activity', 'Buat simpanan')" data-bs-toggle="modal"
                        data-bs-target="#modalsLarge"
                        class="border border-gray-400/50 shadow rounded-md p-2 hover:cursor-pointer hover:bg-gray-500/50 hover:text-white transition duration-300 ease-in">Tambah
                        Simpanan</button>
                @endcan
                <button data-bs-toggle="modal" data-bs-target="#modalsLarge"
                    class="border border-gray-400/50 shadow rounded-md p-2 hover:cursor-pointer hover:bg-gray-500/50 hover:text-white transition duration-300 ease-in">
                    Export PDF</button>
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
                <button type="submit" data-bs-toggle="modal" data-bs-target="#modalsLarge"
                    class="border border-gray-400/50 shadow   rounded-md p-2 hover:cursor-pointer hover:bg-gray-500/50 hover:text-white transition duration-300 ease-in">
                    Print</button>
            </div>

        </div>

        {{-- Table --}}
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-x-auto bg-white">
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
                                        Jenis Simpanan
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Besar Simpanan
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Petugas
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Keterangan
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Status
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Tanggal Menyimpan
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($simpananUser as $no => $item)
                                    <tr class="border-b border-gray-400/50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $no + 1 }}
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            {{ $item->profile->nama_lengkap }}
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <p>{{ $item->kode_simpanan }}</p>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <p>Rp. {{ format_uang($item->jenis_simpanan->jumlah) }}</p>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <p>{{ $item->petugas->username }}</p>
                                        </td>

                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            {{ $item->keterangan }}</td>

                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            @can('setujui pinjaman user')
                                                <select
                                                    wire:change="pilihSetuju($event.target.value, {{ $item->id }})"
                                                    class="rounded-md border text-white border-gray-400/50 p-1 {{ $item->status_simpanan ? 'bg-green-600 text-white' : 'bg-red-500 text-white' }}"
                                                    name="" id="">
                                                    <option value="{{ $item->status_simpanan }}" selected disabled>
                                                        {{ $item->status_simpanan ? 'Di setujui' : 'Belum di setujui' }}
                                                    </option>
                                                    <option value=0>Belum Di Setujui</option>
                                                    <option value=1>Di Setujui</option>
                                                </select>
                                            @endcan

                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            {{ $item->tanggal_simpanan }}</td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">

                                            @can('tarik simpanan user')
                                                @if ($item->status_simpanan !== 0)
                                                    @if ($item->keterangan != 'Simpanan Kosong')
                                                        <button data-bs-toggle="modal" data-bs-target="#modalsLarge"
                                                            wire:click="tarik({{ $item }}, 'tarik simpanan')"
                                                            class="bg-green-400 text-white py-1 px-3 hover:cursor-pointer rounded-md hover:bg-green-500 duration-300 transition">Tarik
                                                            Simpanan</button>
                                                    @endif
                                                @endif
                                            @endcan

                                            <button data-bs-toggle="modal" data-bs-target="#modalsLarge"
                                                wire:click="lihatPenarikan({{ $item }}, 'lihat penarikan')"
                                                class="bg-blue-400 text-white py-1 px-3 hover:cursor-pointer rounded-md hover:bg-blue-500 duration-300 transition">Lihat
                                                Penarikan</button>
                                            @can('delete simpanan user')
                                                <button wire:click="delete({{ $item->id }})"
                                                    class="bg-red-400 text-white py-1 px-3 hover:cursor-pointer rounded-md hover:bg-red-500 duration-300 transition">Delete</button>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                @endforelse

                            </tbody>
                        </table>
                        <div class="my-3">
                            {{-- {{ $pinjamanUsers->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $('#selectAnggota1').on('change', function() {
                @this.changeSelectAnggota(this.value);
                console.log(this.value);
            })
        </script>
    @endpush
</div>
