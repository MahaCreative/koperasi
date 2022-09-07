<div class="overflow-hidden">
    @component('components.snippets.modals',
        ['title' => 'Tambah Anggota Koperasi', 'idModals' => 'modalsLarge', 'sizeModals' => 'modal-xl'])
        <form action="" wire:submit.prevent="{{ $editStatus ? 'updateHandler' : 'submitHandler' }}" class="">
            @csrf
            <div class="flex flex-col">
                <label for="">Judul Kategori</label>
                <input class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2" type="text"
                    wire:model='judul'>
                @error('judul')
                    <p class="text-red-500 italic text-sm">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit"
                class="border border-gray-400/50 shadow rounded-md p-2 hover:cursor-pointer hover:bg-gray-500/50 hover:text-white transition duration-300 ease-in">{{ $editStatus ? 'Update' : 'Submit' }}</button>
        </form>
    @endcomponent
    <div class="border-b border-emerald-400">
        <span><a href="{{ route('dashboard') }}">Dashboard /</a></span>
        <span><a class="text-emerald-400" href="{{ Request::url() }}">Kategori</a></span>
    </div>
    <div class="border border-gray-400/50 shadow-md shadow-gray-500/50 rounded-md p-3 my-2">
        <button type="submit" data-bs-toggle="modal" data-bs-target="#modalsLarge"
            class="border border-gray-400/50 shadow rounded-md p-2 hover:cursor-pointer hover:bg-gray-500/50 hover:text-white transition duration-300 ease-in">Tambah
            Tambah Kategori</button>

        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="border-b">
                                <tr>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        #
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Kategori
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Aksi
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kategori as $no => $item)
                                    <tr class="border-b">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $no + 1 }}
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            {{ $item->judul }}
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">

                                            <a type="button" data-bs-toggle="modal" data-bs-target="#modalsLarge"
                                                wire:click="editKategori({{ $item->id }})"
                                                class="bg-orange-400 text-white py-1 px-3 hover:cursor-pointer rounded-md hover:bg-orange-500 duration-300 transition">Edit</a>
                                            <button wire:click="delete({{ $item->id }})"
                                                class="bg-red-400 text-white py-1 px-3 hover:cursor-pointer rounded-md hover:bg-red-500 duration-300 transition">Delete</button>

                                        </td>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
