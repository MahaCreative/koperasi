<div class="overflow-hidden">
    @component('components.snippets.modals',
        ['title' => 'Tambah Anggota Koperasi', 'idModals' => 'modalsLarge', 'sizeModals' => 'modal-xl'])
        <form wire:submit.prevent="{{ $statusEdit ? 'updateHandler' : 'submitHandler' }}">
            @csrf
            <div class="input-group mb-3">
                <input wire:model="username" type="text"
                    class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2" type="text"
                    placeholder="username">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
            </div>
            @error('username')
                <p class="text-red-500 italic text-sm">{{ $message }}</p>
            @enderror
            <div class="input-group mb-3">
                <input wire:model="email" type="email"
                    class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2" type="text"
                    placeholder="Email">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            @error('email')
                <p class="text-red-500 italic text-sm">{{ $message }}</p>
            @enderror
            <div class="input-group mb-3">
                <input wire:model="password" type="password"
                    class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2" type="text"
                    placeholder="Password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            @error('password')
                <p class="text-red-500 italic text-sm">{{ $message }}</p>
            @enderror
            <div class="input-group mb-3">
                <input wire:model="password_confirmation" type="password"
                    class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2" type="text"
                    placeholder="Retype password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            @error('username')
                <p class="text-red-500 italic text-sm">{{ $message }}</p>
            @enderror
            <div class="row">
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class=" border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                        type="text">Register Petugas</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
    @endcomponent

    <div class="border-b border-emerald-400">
        <span><a href="{{ route('dashboard') }}">Dashboard /</a></span>
        <span><a class="text-emerald-400" href="{{ Request::url() }}">Akun Petugas </a></span>
    </div>
    {{-- BTN TAMBAH --}}

    <div class="border border-gray-400/50 shadow-md shadow-gray-500/50 rounded-md p-3 my-2">
        <div class="flex justify-between">
            <div class="flex gap-x-2">

                @can('create akun petugas')
                    <button type="submit" data-bs-toggle="modal" data-bs-target="#modalsLarge"
                        class="border border-gray-400/50 shadow rounded-md p-2 hover:cursor-pointer hover:bg-gray-500/50 hover:text-white transition duration-300 ease-in">Tambah
                        Akun Petugas</button>
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
                {{-- @can('cetak anggota koperasi')
                    <button type="submit" data-bs-toggle="modal" data-bs-target="#modalsLarge"
                        class="border border-gray-400/50 shadow rounded-md p-2 hover:cursor-pointer hover:bg-gray-500/50 hover:text-white transition duration-300 ease-in">Tambah
                        Export PDF</button>
                @endcan --}}
            </div>
            <div class="flex gap-x-2   items-center">
                {{-- <input wire:model='search' type="text" placeholder="Search..."
                    class="border border-gray-400/50 rounded-md px-2 py-1 mb-2"> --}}
                {{-- <button type="submit" data-bs-toggle="modal" data-bs-target="#modalsLarge"
                    class="border border-gray-400/50 shadow   rounded-md p-2 hover:cursor-pointer hover:bg-gray-500/50 hover:text-white transition duration-300 ease-in">
                    Print</button> --}}
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
                                        User name
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Email
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Nama Petugas
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Aksi
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($petugas as $no => $item)
                                    <tr class="border-b border-gray-400/50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $no + 1 }}
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            {{ $item->username }}
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            {{ $item->email }}
                                        </td>

                                        @if ($item->profile)
                                            <td>
                                                {{ $item->profile->nama }}
                                            </td>
                                        @else
                                            <td>
                                                <p class="badge bg-danger">Profile belum dibuat</p>
                                            </td>
                                        @endif

                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            @can('edit akun petugas')
                                                <button data-bs-toggle="modal" data-bs-target="#modalsLarge"
                                                    wire:click="edit({{ $item }})"
                                                    class="bg-orange-400 text-white py-1 px-3 hover:cursor-pointer rounded-md hover:bg-orange-500 duration-300 transition">Edit</button>
                                            @endcan
                                            @can('delete akun petugas')
                                                <button wire:click="delete({{ $item->id }})"
                                                    class="bg-red-400 text-white py-1 px-3 hover:cursor-pointer rounded-md hover:bg-red-500 duration-300 transition">Delete</button>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                @endforelse

                            </tbody>
                            {{-- {{ $profileUser->links() }} --}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
