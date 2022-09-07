<div class="overflow-hidden">
    @component('components.snippets.modals',
        ['title' => 'Tambah Anggota Koperasi', 'idModals' => 'modalsLarge', 'sizeModals' => 'modal-default'])
        {{-- @can('create anggota koperasi') --}}
        <form action="" wire:submit.prevent="{{ $editStatus ? 'updateHandler' : 'submitHandler' }}" class="">
            @csrf
            <div class="flex flex-col">
                <label for="">Jenis Jabatan</label>
                <input class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2" type="text"
                    wire:model='jabatan_field' placeholder="nama">
                @error('jabatan_field')
                    <p class="text-red-500 italic text-sm">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit"
                class="border border-gray-400/50 shadow rounded-md p-2 hover:cursor-pointer hover:bg-gray-500/50 hover:text-white transition duration-300 ease-in">{{ $editStatus ? 'Update' : 'Submit' }}</button>
        </form>
        {{-- @endcan --}}
    @endcomponent

    <div class="border-b border-emerald-400">
        <span><a href="{{ route('dashboard') }}">Dashboard /</a></span>
        <span><a class="text-emerald-400" href="{{ Request::url() }}">Jenis Jabatan </a></span>
    </div>
    {{-- BTN TAMBAH --}}
    <div class="border border-gray-400/50 shadow-md shadow-gray-500/50 rounded-md p-3 my-2">
        <div class="flex justify-between">
            <div class="flex gap-x-2">
                {{-- @can('create anggota koperasi') --}}
                <button type="submit" data-bs-toggle="modal" data-bs-target="#modalsLarge"
                    class="border border-gray-400/50 shadow rounded-md p-2 hover:cursor-pointer hover:bg-gray-500/50 hover:text-white transition duration-300 ease-in">Tambah
                    Jenis Jabatan</button>
                {{-- @endcan --}}
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
                                        Jenis Jabatan
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Aksi
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($jabatan as $no => $item)
                                    <tr class="border-b border-gray-400/50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $no + 1 }}
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            {{ $item->jabatan }}
                                        </td>


                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            {{-- @can('edit anggota koperasi') --}}
                                            <button data-bs-toggle="modal" data-bs-target="#modalsLarge"
                                                wire:click="edit({{ $item }})"
                                                class="bg-orange-400 text-white py-1 px-3 hover:cursor-pointer rounded-md hover:bg-orange-500 duration-300 transition">Edit</button>
                                            {{-- @endcan --}}
                                            {{-- @can('delete anggota koperasi') --}}
                                            <button wire:click="delete({{ $item->id }})"
                                                class="bg-red-400 text-white py-1 px-3 hover:cursor-pointer rounded-md hover:bg-red-500 duration-300 transition">Delete</button>
                                            {{-- @endcan --}}
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
