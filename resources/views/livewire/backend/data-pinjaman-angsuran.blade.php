<div>
    @section('title')
        Data-Pinjaman
    @endsection
    <div class="border-b border-emerald-400">
        <span><a href="{{ route('dashboard') }}">Dashboard /</a></span>
        <span><a class="text-emerald-400" href="{{ Request::url() }}">Data Pinjaman </a></span>
    </div>
    <div class="grid grid-cols-2 gap-x-2 my-2 gap-y-3">
        <div class="rounded-md shadow-md shadow-gray-500/50 overflow-hidden">
            <div class="bg-orange-400 flex justify-between p-2">
                <p class="text-white">Limit Pinjaman</p>
                <i
                    class="bi bi-dash-square-fill hover:text-gray-600 hover:cursor-pointer text-white text-[14pt] font-bold"></i>
            </div>
            <div class="border p-2">
                @can('create data pinjaman')
                    <form class="flex flex-col gap-y-1"
                        wire:submit.prevent="{{ $statusEditLimit ? 'updatePinjaman' : 'submitPinjaman' }}">
                        @csrf
                        <label for="">Limit Pinjaman</label>
                        <input wire:keyup="pressLimit" wire:model='limit_pinjaman' type="text" name=""
                            id="" class="border rounded-md p-2 border-gray-400">
                        <button type="submit"
                            class="border border-gray-400 shadow-md hover:cursor-pointer hover:bg-gray-400 hover:text-white rounded-md">{{ $statusEditLimit ? 'Update' : 'Submit' }}</button>
                    </form>
                @endcan
                {{-- Table --}}
                <div class="flex flex-col">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="overflow-x-auto">
                                <table class="min-w-full">
                                    <thead class="border-b">
                                        <tr>
                                            <th scope="col"
                                                class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                #
                                            </th>
                                            <th scope="col"
                                                class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                Limit Pinjaman
                                            </th>
                                            <th scope="col"
                                                class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                Aksi
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($dataPinjaman as $no => $pinjaman)
                                            <tr class="border-b">
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ $no + 1 }}
                                                </td>
                                                <td
                                                    class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                    Rp. {{ format_uang($pinjaman->pinjaman) }}
                                                </td>
                                                <td
                                                    class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                    @can('edit data pinjaman')
                                                        <button wire:click="editLimit({{ $pinjaman }})"
                                                            class="bg-orange-400 text-white py-1 px-3 hover:cursor-pointer rounded-md hover:bg-orange-500 duration-300 transition">Edit</button>
                                                    @endcan
                                                    @can('delete data pinjaman')
                                                        <button wire:click="deleteLimit({{ $pinjaman->id }})"
                                                            class="bg-red-400 text-white py-1 px-3 hover:cursor-pointer rounded-md hover:bg-red-500 duration-300 transition">Delete</button>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        {{-- Durasi --}}
        <div class="rounded-md shadow-md shadow-gray-500/50 overflow-hidden">
            <div class="bg-orange-400 flex justify-between p-2">
                <p class="text-white">Durasi Pinjaman</p>
                <i
                    class="bi bi-dash-square-fill hover:text-gray-600 hover:cursor-pointer text-white text-[14pt] font-bold"></i>
            </div>
            @can('create data pinjaman')
                <div class="border p-2">
                    <form class="flex flex-col gap-y-1"
                        wire:submit.prevent="{{ $statusEditDurasi ? 'updateDurasi' : 'submitDurasi' }}">
                        @csrf
                        <label for="">Durasi Pembayaran</label>
                        <input wire:model='durasiPembayaran' type="number" name="" id=""
                            class="border rounded-md p-2 border-gray-400">
                        <button type="submit"
                            class="border border-gray-400 shadow-md hover:cursor-pointer hover:bg-gray-400 hover:text-white rounded-md">{{ $statusEditDurasi ? 'Update' : 'Submit' }}</button>
                    </form>
                </div>
            @endcan
            {{-- Table --}}
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-x-auto">
                            <table class="min-w-full">
                                <thead class="border-b">
                                    <tr>
                                        <th scope="col"
                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            #
                                        </th>
                                        <th scope="col"
                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            Durasi Pembayaran
                                        </th>
                                        <th scope="col"
                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            Aksi
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($dataDurasi as $no => $durasi)
                                        <tr class="border-b">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $no + 1 }}
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                {{ $durasi->durasi_angsuran }} X
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                @can('edit data pinjaman')
                                                    <button wire:click="editDurasi({{ $durasi }})"
                                                        class="bg-orange-400 text-white py-1 px-3 hover:cursor-pointer rounded-md hover:bg-orange-500 duration-300 transition">Edit</button>
                                                @endcan
                                                @can('delete data pinjaman')
                                                    <button wire:click="deleteDurasi({{ $durasi->id }})"
                                                        class="bg-red-400 text-white py-1 px-3 hover:cursor-pointer rounded-md hover:bg-red-500 duration-300 transition">Delete</button>
                                                @endcan
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Detail --}}
        <div class="rounded-md shadow-md shadow-gray-500/50 overflow-hidden col-span-2">
            <div class="bg-orange-400 flex justify-between p-2">
                <p class="text-white">Detail Pinjaman</p>
                <i
                    class="bi bi-dash-square-fill hover:text-gray-600 hover:cursor-pointer text-white text-[14pt] font-bold"></i>
            </div>
            @can('create data pinjaman')
                <div class="border p-2">
                    <form class="grid grid-cols-1 lg:grid-cols-4 gap-y-2 gap-x-2 shadow-md py-2"
                        wire:submit.prevent="{{ $statusEditDetail ? 'updateDetail' : 'submitDetail' }}">
                        @csrf
                        <div class="flex flex-col">
                            <label for="">Limit Pinjaman</label>
                            <select wire:model="data_pinjaman_id" class="border rounded-md p-2 border-gray-400"
                                name="" id="">
                                <option value="">--Pilih Limit Pinjaman--</option>
                                @forelse ($dataPinjaman as $pinjaman)
                                    <option value="{{ $pinjaman->id }}">{{ format_uang($pinjaman->pinjaman) }}</option>
                                @empty
                                @endforelse
                            </select>
                            @error('data_pinjaman_id')
                                <p class="text-red-500 italic text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col">
                            <label for="">Durasi Angsuran</label>
                            <select wire:model="data_angsuran_id" class="border rounded-md p-2 border-gray-400"
                                name="" id="">
                                <option value="">--Pilih Durasi Angsuran--</option>
                                @forelse ($dataDurasi as $durasi)
                                    <option value="{{ $durasi->id }}">{{ format_uang($durasi->durasi_angsuran) }}
                                    </option>
                                @empty
                                @endforelse
                            </select>
                            @error('data_angsuran_id')
                                <p class="text-red-500 italic text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label for="">Angsuran</label>
                            <input wire:keyup="keyAngsuran" wire:model="angsuran"
                                class="border rounded-md p-2 border-gray-400" type="number" name=""
                                id="">
                            @error('angsuran')
                                <p class="text-red-500 italic text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label for="">Simpanan</label>
                            <input wire:keyup="keySimpanan" wire:model="simpanan"
                                class="border rounded-md p-2 border-gray-400" type="number">
                            @error('simpanan')
                                <p class="text-red-500 italic text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit"
                            class="border col-span-4 border-gray-400 shadow-md hover:cursor-pointer hover:bg-gray-400 hover:text-white rounded-md">{{ $statusEditDetail ? 'Update' : 'Submit' }}</button>
                    </form>
                </div>
            @endcan
            {{-- Table --}}
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-x-auto">
                            <table class="min-w-full">
                                <thead class="border-b">
                                    <tr>
                                        <th scope="col"
                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            #
                                        </th>
                                        <th scope="col"
                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            Limit Pinjaman
                                        </th>
                                        <th scope="col"
                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            Durasi Angsuran
                                        </th>
                                        <th scope="col"
                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            Angsuran
                                        </th>
                                        <th scope="col"
                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            Simpanan
                                        </th>
                                        <th scope="col"
                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($detail as $no => $item)
                                        <tr class="border-b">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $no + 1 }}
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                Rp. {{ format_uang($item->data_pinjaman->pinjaman) }}
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                {{ $item->data_angsuran->durasi_angsuran }} X
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                Rp. {{ format_uang($item->angsuran) }}
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                Rp. {{ format_uang($item->simpanan) }}
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">


                                                @if (count($item->pinjaman_user) == 0)
                                                    @can('edit data pinjaman')
                                                        <button wire:click="editDetail({{ $item }})"
                                                            class="bg-orange-400 text-white py-1 px-3 hover:cursor-pointer rounded-md hover:bg-orange-500 duration-300 transition">Edit</button>
                                                    @endcan
                                                    @can('delete data pinjaman')
                                                        <button wire:click="deleteDetail({{ $item->id }})"
                                                            class="bg-red-400 text-white py-1 px-3 hover:cursor-pointer rounded-md hover:bg-red-500 duration-300 transition">Delete</button>
                                                    @endcan
                                                @endif

                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
