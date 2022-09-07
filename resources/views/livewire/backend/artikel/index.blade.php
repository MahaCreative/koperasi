<div>
    <div class="border-b border-emerald-400">
        <span><a href="{{ route('dashboard') }}">Dashboard /</a></span>
        <span><a class="text-emerald-400" href="{{ Request::url() }}">Artikel </a></span>
    </div>
    <div class="">
        <div class="border border-gray-400/50 shadow-md shadow-gray-500/50 rounded-md p-3 my-2">
            <div class="flex justify-between">
                <div class="">
                    <h3 class="card-title">Data Artikel</h3>
                </div>
                <div class="">
                    <a class="border border-gray-400/50 shadow rounded-md p-2 hover:cursor-pointer hover:bg-gray-500/50 hover:text-white transition duration-300 ease-in"
                        href="{{ route('create-artikel') }}">Tambah
                        Artikel</a>
                </div>
            </div>
        </div>

        <div class="flex flex-col border border-gray-400/50 shadow-md shadow-gray-500/50 rounded-md p-3 my-2">
            <div class="overflow-x-auto sm:-mx-6 lg:mx-2">
                <div class="flex justify-between">
                    <div class="flex gap-x-2">
                        @can('create anggota koperasi')
                            <button type="submit" data-bs-toggle="modal" data-bs-target="#modalsLarge"
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
                        @can('cetak anggota koperasi')
                            <button type="submit" data-bs-toggle="modal" data-bs-target="#modalsLarge"
                                class="border border-gray-400/50 shadow rounded-md p-2 hover:cursor-pointer hover:bg-gray-500/50 hover:text-white transition duration-300 ease-in">Tambah
                                Export PDF</button>
                        @endcan
                    </div>
                    <div class="flex gap-x-2   items-center">
                        <input wire:model='search' type="text" placeholder="Search..."
                            class="border border-gray-400/50 rounded-md px-2 py-1 mb-2">
                        <button type="submit" data-bs-toggle="modal" data-bs-target="#modalsLarge"
                            class="border border-gray-400/50 shadow   rounded-md p-2 hover:cursor-pointer hover:bg-gray-500/50 hover:text-white transition duration-300 ease-in">
                            Print</button>
                    </div>

                </div>
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="border-b border-gray-400/50">
                                <tr>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        #
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Judul Artikel
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Edit By
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Kategori
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Total Di Lihat
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Tanggal Buat
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Status Active
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Aksi
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($getArtikel as $no => $item)
                                    <tr class="border-b border-gray-400/50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $no + 1 }}
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            {{ $item->judul }}</a>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <div class="flex flex-col gap-y-1">
                                                <span
                                                    class="border-b border-gray-400/50 bg-green-500 inline rounded-md px-2 text-white text-sm">
                                                    {{ $item->user->username }}</span>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $item->kategori->judul }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $item->visitor }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $item->created_at->diffForhumans() }}
                                        </td>


                                        @hasrole('super admin')
                                            <td>
                                                <select wire:change="changeStatus($event.target.value, {{ $item->id }})"
                                                    name="" id=""
                                                    class="{{ $item->active ? 'bg-green-500' : 'bg-red-500' }}">
                                                    <option value="" selected>
                                                        {{ $item->active ? 'Aktif' : 'Belum Aktif' }}
                                                    </option>
                                                    <option value=1>Aktif</option>
                                                    <option value=0>Belum Aktif</option>
                                                </select>
                                            </td>
                                        @endhasrole
                                        @hasrole('petugas')
                                            <td>
                                                <p class="badge {{ $item->active ? 'bg-green-500' : 'bg-red-500' }}">
                                                    {{ $item->active ? 'Aktif' : 'Belum Aktif' }}</p>
                                            </td>
                                        @endhasrole
                                        <td>
                                            @can('edit pinjaman user')
                                                <a href="{{ route('artikel-edit', $item->id) }}"
                                                    class="bg-orange-400 text-white py-1 px-3 hover:cursor-pointer rounded-md hover:bg-orange-500 duration-300 transition">Edit</a>
                                            @endcan
                                            @can('delete pinjaman user')
                                                <button wire:click="deleteArtikel({{ $item->id }})"
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
