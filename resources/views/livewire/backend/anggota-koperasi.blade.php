<div class="overflow-hidden">
    @component('components.snippets.modals',
        ['title' => 'Tambah Anggota Koperasi', 'idModals' => 'modalsLarge', 'sizeModals' => 'modal-xl'])
        @if ($viewModals === 'tambah-anggota')
            @can('create anggota')
                <form action="" wire:submit.prevent="{{ $editStatus ? 'updateHandler' : 'submitHandler' }}"
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2">
                    @csrf
                    <div class="flex flex-col">
                        <label for="">Nama Lengkap</label>
                        <input class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2" type="text"
                            wire:model='nama_lengkap' placeholder="nama">
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
                            class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2 " name=""
                            id="select2">

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



                    <button type="submit"
                        class="border border-gray-400/50 shadow rounded-md p-2 hover:cursor-pointer hover:bg-gray-500/50 hover:text-white transition duration-300 ease-in">{{ $editStatus ? 'Update' : 'Submit' }}</button>
                </form>
            @endcan
        @else
            <form class="grid grid-cols-4" wire:submit.prevent="submitHandlerAkun">
                <label class="col-span-1 flex items-center" for="">Username</label>
                <div class="col-span-3">
                    <input wire:model="username"
                        class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                        type="text">

                    @error('username')
                        <p class="text-red-500 italic text-sm font-light">{{ $message }}</p>
                    @enderror
                </div>
                <label class="col-span-1 flex items-center" for="">Email</label>
                <div class="col-span-3">
                    <input wire:model="email"
                        class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                        type="text">

                    @error('email')
                        <p class="text-red-500 italic text-sm font-light">{{ $message }}</p>
                    @enderror
                </div>
                <label class="col-span-1 flex items-center" for="">Password</label>
                <div class="col-span-3">
                    <input wire:model="password"
                        class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                        type="text">

                    @error('password')
                        <p class="text-red-500 italic text-sm font-light">{{ $message }}</p>
                    @enderror
                </div>
                <label class="col-span-1 flex items-center" for="">Konfirmasi Password</label>
                <div class="col-span-3">
                    <input wire:model="password_confirmation"
                        class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                        type="text">

                </div>


                <div class="flex gap-x-2">
                    <button type="submit"
                        class="border uppercaseborder-gray-400/50 shadow rounded-md p-2 hover:cursor-pointer hover:bg-gray-500/50 hover:text-white transition duration-300 ease-in">Save</button>

                </div>
            </form>
        @endif
    @endcomponent

    <div class="border-b border-emerald-400">
        <span><a href="{{ route('dashboard') }}">Dashboard /</a></span>
        <span><a class="text-emerald-400" href="{{ Request::url() }}">Anggota Koperasi </a></span>
    </div>
    {{-- BTN TAMBAH --}}
    <div class="border border-gray-400/50 shadow-md shadow-gray-500/50 rounded-md p-3 my-2">
        <div class="flex justify-between">
            <div class="flex gap-x-2">
                @can('create anggota')
                    <button wire:click="displayModals('tambah-anggota','')" type="submit" data-bs-toggle="modal"
                        data-bs-target="#modalsLarge"
                        class="border border-gray-400/50 shadow rounded-md p-2 hover:cursor-pointer hover:bg-gray-500/50 hover:text-white transition duration-300 ease-in">Tambah
                        Anggota Koperasi</button>
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
            <div class="flex gap-x-2   items-center">
                <input wire:model='search' type="text" placeholder="Search..."
                    class="border border-gray-400/50 rounded-md px-2 py-1 mb-2">
                <button type="submit" wire:click="print({{ $data }})"
                    class="border border-gray-400/50 shadow   rounded-md p-2 hover:cursor-pointer hover:bg-gray-500/50 hover:text-white transition duration-300 ease-in">
                    Print</button>
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
                                        Nik & KK
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Tempat Tanggal Lahir
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        No. Telp
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Pekerjaan
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Alamat
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Aksi
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($profileUser as $no => $item)
                                    <tr class="border-b border-gray-400/50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $no + 1 }}
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            {{ $item->nama_lengkap }}
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <div class="flex flex-col gap-y-1">
                                                <span
                                                    class="border-b border-gray-400/50 bg-green-500 inline rounded-md px-2 text-white text-sm">
                                                    NIK:
                                                    {{ $item->nik }}</span>
                                                <p
                                                    class="border-b border-gray-400/50 bg-green-500 inline rounded-md px-2 text-white text-sm">
                                                    KK :{{ $item->no_kk }}</p>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            <p>{{ $item->tempat_lahir }}, {{ $item->ttl }}</p>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            <p>{{ $item->no_telp }}</p>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            <p>{{ $item->pekerjaan->pekerjaan }}</p>
                                        </td>
                                        <td>
                                            <div class="flex flex-col gap-y-1">
                                                <p>{{ $item->alamat }}</p>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $item->pinjaman_user }}
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            @can('edit anggota')
                                                <button data-bs-toggle="modal" data-bs-target="#modalsLarge"
                                                    wire:click="edit({{ $item }})"
                                                    class="bg-orange-400 text-white py-1 px-3 hover:cursor-pointer rounded-md hover:bg-orange-500 duration-300 transition">Edit</button>
                                            @endcan
                                            @can('delete anggota')
                                                <button wire:click="delete({{ $item->id }})"
                                                    class="bg-red-400 text-white py-1 px-3 hover:cursor-pointer rounded-md hover:bg-red-500 duration-300 transition">Delete</button>
                                            @endcan
                                            <button type="submit" data-bs-toggle="modal"
                                                data-bs-target="#modalsLarge"
                                                wire:click="displayModals('buat-akun', {{ $item->id }})"
                                                class="bg-cyan-400 text-white py-1 px-3 hover:cursor-pointer rounded-md hover:bg-cyan-500 duration-300 transition">Buat
                                                Akun</button>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse

                            </tbody>
                            {{ $profileUser->links() }}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
