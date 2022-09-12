<div class="lg:grid lg:grid-cols-5 px-4 gap-x-3">
    @section('title')
        Iklan Setting
    @endsection
    <div class="w-full lg:col-span-4 py-3">
        <div>
            <h3 class="text-lg text-primary2 font-bold">Iklan</h3>
        </div>
        <div>
            @if (session()->has('message'))
                <div
                    class="bg-primary2/50 border border-emerald-300 rounded-lg shadow-md p-2 my-2 flex justify-between items-center">
                    {{ session('message') }}
                    <span>x</span>
                </div>
            @endif
            <div class="flex justify-end">
                <div>
                    <label for="">Search</label>
                    <input wire:model="search"
                        class="py-1 px-3 border border-emerald-400 rounded-lg placeholder:text-emerald-400" type="text"
                        name="" id="" placeholder="Search..." wire:model="search">
                </div>
            </div>
            <div
                class="border rounded-lg max-h-[350px] overflow-auto bg-primary2 shadow-md border-gray-400/50 my-2 p-3 w-full">

                <table class="w-full ">
                    <thead class="border-b border-emerald-400/50">
                        <tr>
                            <th class="border-r border-emerald-400/50 text-left px-2">No</th>
                            <th class="border-r border-emerald-400/50 text-left px-2">Foto</th>
                            <th class="border-r border-emerald-400/50 text-left px-2">Nama Iklan</th>
                            <th class="border-r border-emerald-400/50 text-left px-2">Tanggal Awal</th>
                            <th class="border-r border-emerald-400/50 text-left px-2">Tanggal Akhir</th>
                            <th class="border-r border-emerald-400/50 text-left px-2">Keterangan</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($iklan as $no => $item)
                            <tr
                                class="duration-300 transition ease-in hover:even:bg-emerald-300/50 hover:odd:bg-slate-400/50  rounded-lg border-b shadow-md border-emerald-400/50 py-2 px-2">
                                <td class="py-2 text-left px-2">{{ $no + 1 }}</td>
                                <td class="py-2 text-left px-2">
                                    <img class="w-16 h-16" src="{{ asset($item->takeImage) }}" alt="">
                                </td>
                                <td class="py-2 text-left px-2">{{ $item->nama }}</td>
                                <td class="py-2 text-left px-2">{{ $item->tanggal_awal }}</td>
                                <td class="py-2 text-left px-2">{{ $item->tangal_akhir }}</td>
                                <td class="py-2 text-left px-2">{{ Str::limit($item->ket, 30) }}</td>
                                <td class="py-2 text-left px-2 flex items-end gap-x-1">

                                    {{-- @can('') --}}
                                    <button wire:click="edit({{ $item->id }})"
                                        class="rounded-lg py-1 px-2 bg-orange-400 duration-300 transition ease-in-out hover:bg-orange-500">Edit</button>
                                    <button type="button" wire:click="delete({{ $item->id }})"
                                        class="py-1 px-2 rounded-lg shadow bg-red-400 hover:bg-red-500 duration-300 transition">Delete</button>
                                    {{-- @endcan --}}
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="">

                </div>
            </div>
        </div>
    </div>

    <div class="w-full lg:col-span-1 py-3">
        <form action="" enctype="multipart/form-data"
            wire:submit.prevent="{{ $updateStatus ? 'updateHandler' : 'submitHandler()' }}">
            <div class="flex flex-col my-1">
                <label for="">Judul</label>
                <input type="text"
                    class="text-emerald-400 rounded-lg py-1 px-2 border border-emerald-300 placeholder:text-emerald-300"
                    type="text" placeholder="Nama Iklan" wire:model="judul">
                @error('judul')
                    <p class="text-xs text-red-600 italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex flex-col my-1">
                <label for="">keterangan</label>
                <textarea class="text-emerald-400 rounded-lg py-1 px-2 border border-emerald-300 placeholder:text-emerald-300"
                    type="text" placeholder="keterangan" wire:model="keterangan"></textarea>
            </div>
            <div class="flex flex-col my-1">
                <label for="">Tanggal Awal</label>
                <input type="date"
                    class="text-emerald-400 rounded-lg py-1 px-2 border border-emerald-300 placeholder:text-emerald-300"
                    type="text" placeholder="Tanggal Awal" wire:model="tanggal_awal" />
                @error('tanggal_awal')
                    <p class="text-xs text-red-600 italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex flex-col my-1">
                <label for="">Tanggal Akhir</label>
                <input type="date"
                    class="text-emerald-400 rounded-lg py-1 px-2 border border-emerald-300 placeholder:text-emerald-300"
                    type="text" placeholder="Tanggal Akhir" wire:model="tanggal_akhir" />
                @error('tanggal_akhir')
                    <p class="text-xs text-red-600 italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex flex-col my-1">
                <label for="">Foto</label>
                <input type="file"
                    class="text-emerald-400 rounded-lg py-1 px-2 border border-emerald-300 placeholder:text-emerald-300"
                    type="text" placeholder="Nama" wire:model="foto">
                @error('foto')
                    <p class="text-xs text-red-600 italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex items-center">
                @if ($foto)
                    <img class="shadow-sm border-2 hover:scale-110 duration-300 ease-in transition border-emerald-400/50 object-cover rounded-full lg:max-h-[200px] lg:max-w-[200px]"
                        src="{{ $foto->temporaryUrl() }}" alt="">
                @endif
            </div>
            <button
                class="text-white duration-300 transition ease-in bg-primary2 py-1 px-2 rounded-lg shadow-md hover:bg-emerald-400">
                {{ $updateStatus ? 'Update' : 'Create' }}
            </button>
            <button type="button" wire:click="$set('updateStatus', false)"
                class="text-white duration-300 transition ease-in bg-red-400 py-1 px-2 rounded-lg shadow-md hover:bg-red-500">
                Cancel
            </button>

        </form>
    </div>
</div>
