<div class="overflow-hidden">
    @component('components.snippets.modals',
        ['title' => $titleModals, 'idModals' => 'modalsLarge', 'sizeModals' => 'modal-default'])
        @if ($showModal == 'filter')
            <form action="" class="w-full" wire:submit.prevent="filterData">
                <div class="flex flex-col">
                    <label for="">Dari Tanggal</label>
                    <input wire:model="dari_tanggal"
                        class="border text-sm lg:text-base border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                        type="date" name="" id="">
                </div>
                <div class="flex flex-col">
                    <label for="">Sampai Tanggal</label>
                    <input wire:model="sampai_tanggal"
                        class="border text-sm lg:text-base border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                        type="date" name="" id="">
                </div>
                <button type="Submit"
                    class="border text-sm lg:text-base border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2">Filter
                    Data</button>
            </form>
        @endif
    @endcomponent

    <div class="border-b border-emerald-400">
        <span><a href="{{ route('dashboard') }}">Dashboard /</a></span>
        <span><a class="text-emerald-400" href="{{ Request::url() }}">History Pembayaran Pinjaman </a></span>
    </div>
    <div class="border lg:text-base text-sm border-gray-400/50 shadow-md shadow-gray-500/50 rounded-md p-3 my-2">
        <div class="flex lg:flex-row flex-col justify-between gap-y-2">
            <div class="flex gap-x-2">

                {{-- <button wire:click='displaymodal()' type="submit" data-bs-toggle="modal" data-bs-target="#modalsLarge"
                    class="border border-gray-400/50 shadow rounded-md p-2 hover:cursor-pointer hover:bg-gray-500/50 hover:text-white transition duration-300 ease-in">
                    Export PDF</button> --}}

                <button wire:click.prevent='displaymodal("filter")' type="button" data-bs-toggle="modal"
                    data-bs-target="#modalsLarge"
                    class="border border-gray-400/50 shadow rounded-md p-2 hover:cursor-pointer hover:bg-gray-500/50 hover:text-white transition duration-300 ease-in">
                    Filter Berdasarkan Tanggal</button>

                {{-- <div>
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
                </div> --}}
            </div>
            <div class="flex gap-x-2  items-center justify-end">

                <button type="button" wire:click="print('filter')"
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
                                        Kode Pinjaman
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Besar Pinjaman
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Tanggal Pembayaran
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Besar Pembayaran
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Sisa Pinjaman
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Petugas Menangani
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                @if ($histori !== null)
                                    @forelse ($histori as $no => $item)
                                        <tr class="border-b border-gray-400/50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $no + 1 }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $item->nama_lengkap }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $item->kode_pinjaman }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">

                                                Rp.
                                                {{ format_uang($item->pinjaman) }}

                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $item->created_at }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                Rp. {{ format_uang($item->pembayaran) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                Rp. {{ format_uang($item->sisa_pinjaman) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $item->username }}
                                            </td>

                                        </tr>
                                    @empty
                                    @endforelse
                                @endif

                            </tbody>
                        </table>
                        <div class="my-3">
                            {{-- {{ $histori->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
