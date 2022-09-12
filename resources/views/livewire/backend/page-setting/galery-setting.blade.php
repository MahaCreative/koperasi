<div class="lg:grid lg:grid-cols-5 px-4 gap-x-3">
    @section('title')
        Galery Setting
    @endsection
    <div class="w-full lg:col-span-3 py-3">
        <h3 class="text-lg text-primary font-bold">Galery</h3>
        <section class="overflow-hidden text-gray-700 border border-gray-500/50 shadow-sm rounded-lg py-2">
            <div class="px-5 py-4">
                <div class="flex py-3  -m-1 md:-m-2 my-2">
                    @foreach ($galery as $item)
                        <div class="flex h-24 lg:h-40  w-24 lg:w-40  gap-x-2">
                            <div class="w-full p-1 md:p-2 ">
                                <div class="border-b border-emerald-400/50 border-dashed mb-2 flex justify-between">
                                    <h3 class="">{{ $item->judul }}</h3>

                                    <div class="flex gap-x-2">
                                        <p wire:click="delete({{ $item->id }})"
                                            class="hover:cursor-pointer text-gray-400 hover:text-red-600 duration-200 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                <path
                                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                            </svg>
                                        </p>
                                        <p wire:click="edit({{ $item->id }})"
                                            class="hover:cursor-pointer text-gray-400 hover:text-red-600 duration-200 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                            </svg>
                                        </p>
                                    </div>
                                </div>
                                <img alt="{{ $item->judul }}" href="/{{ $item->foto }}" alt="gallery"
                                    class="hover:scale-105 duration-300 transition block object-cover object-center w-full h-full rounded-lg"
                                    src="{{ asset($item->takeImage) }}">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
    <div class="w-full lg:col-span-2">
        <form action="" enctype="multipart/form-data"
            wire:submit.prevent="{{ $updateStatus ? 'updateHandler' : 'submitHandler()' }}">
            <div class="flex flex-col my-1">
                <label for="">Judul</label>
                <input type="text"
                    class="rounded-lg py-1 px-2 border border-emerald-300 placeholder:text-emerald-300" type="text"
                    placeholder="Nama" wire:model="judul">
                @error('judul')
                    <p class="text-xs text-red-600 italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex flex-col my-1">
                <label for="">Kontent</label>
                <textarea class="rounded-lg py-1 px-2 border border-emerald-300 placeholder:text-emerald-300" type="text"
                    placeholder="Kontent" wire:model="kontent"></textarea>
            </div>
            <div class="flex flex-col my-1">
                <label for="">Foto</label>
                <input type="file"
                    class="rounded-lg py-1 px-2 border border-emerald-300 placeholder:text-emerald-300" type="text"
                    placeholder="Nama" wire:model="logo">
                @error('logo')
                    <p class="text-xs text-red-600 italic">{{ $message }}</p>
                @enderror
            </div>
            <button
                class="text-white duration-300 transition ease-in bg-primary py-1 px-2 rounded-lg shadow-md hover:bg-emerald-400">{{ $updateStatus ? 'Update' : 'Submit' }}</button>
            @if ($updateStatus)
                <button wire:click="$set('updateStatus', false)" type="button"
                    class="text-white duration-300 transition ease-in bg-red-500 py-1 px-2 rounded-lg shadow-md hover:bg-red-400">Cancell</button>
            @endif
        </form>
    </div>
</div>
