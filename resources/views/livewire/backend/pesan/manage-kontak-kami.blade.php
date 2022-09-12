<div class="pt-6 px-3 lg:px-6 w-full ">
    @section('title')
        Manage Kontak Kami
    @endsection
    <div class="border-emerald-400 border-b w-full  ">
        <h3 class="text-2xl font-bold text-primary2">Manage Kontak Kami</h3>
    </div>
    <div class=" bg-primary2 flex justify-between gap-x-3 px-2 py-1 my-2 rounded-md shadow-md">
        <p class="text-xs italic text-white">Pesan Yang Belum Dibaca :</p>
        <p class="text-xs italic text-white">{{ $count }}</p>
    </div>
    @if ($showPesan)
        <div class="{{ $statusShow ? '' : 'hidden' }} bg-primary2 px-2 py-1 my-2 rounded-md shadow-md">
            <div class="flex justify-between px-3 gap-x-3 w-full">
                <p class="text-base italic text-white border-b w-full border-whiten capitalize">Show Pesan :
                    {{ $showPesan->namalengkap }}</p>
                <p wire:click="$set('statusShow', false)"
                    class="text-right font-bold text-red-400 hover:cursor-pointer hover:text-red-600">X</p>
            </div>
            <div class="flex justify-between px-3 gap-x-3">

                <p class="text-base italic text-white">{{ $showPesan->subjek }}</p>
            </div>
        </div>
    @endif
    <div class="lg:flex-row flex-col flex my-3 px-2 gap-y-2 lg:justify-between lg:px-3 lg:items-center">
        <div class="text-primary2 flex items-center gap-x-3 ">
            <label for="" class="lg:block hidden">Status</label>
            <select wire:model="select" class="py-1 px-3 rounded-lg border border-emerald-400 " name=""
                id="">
                <option value="">Pilih Status</option>
                <option value='1'>Dibaca</option>
                <option value='0'>Belum Dibaca</option>
            </select>
        </div>
        <input placeholder="Cari..." wire:model="search" type="text"
            class="rounded-lg py-1 px-3 border border-emerald-400 placeholder:text-primary2">
    </div>
    <div class="rounded-lg w-full shadow-md overflow-auto">
        <table class="capitalize py-3 w-full ">
            <thead class="border rounded-lg shadow bg-primary2">
                <tr>
                    <td>No</td>
                    <td>Nama Lengkap</td>
                    <td>email</td>
                    <td>telp</td>
                    <td>Status</td>
                    <td>subjek</td>
                    <td class="text-right px-3">Aksi</td>
                </tr>
            </thead>
            <tbody>
                @forelse ($kontakKami as $no => $item)
                    <tr wire:click="selectData({{ $item->id }})"
                        class="@if ($item->id === $selectId) bg-primary2 @endif  hover:cursor-pointer hover:bg-primary2 hover:shadow-md hover:bg-opacity-40">
                        <td class="">1</td>
                        <td class="">{{ $item->namalengkap }}</td>
                        <td class="">{{ $item->email }}</td>
                        <td class="">{{ $item->telp }}</td>
                        <td class="text-center">
                            <input wire:change="checked($event.target.checked, {{ $item->id }})"
                                {{ $item->status_baca ? 'checked' : '' }} class="text-center accent-cyan-500"
                                type="checkbox" name="" id="" value="">

                        </td>
                        <td class="max-w-[100px]">{{ Str::limit($item->subjek, 30, '...') }}
                        </td>
                        <td class=" max-w-[75px] text-right px-3">
                            <button wire:click="delete({{ $item->id }})"
                                class="py-1 rounded-lg shadow-md px-2 bg-red-400">Delete</button>
                        </td>
                    </tr>

                @empty
                @endforelse
            </tbody>
        </table>
    </div>
</div>
