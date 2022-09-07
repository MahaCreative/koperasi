<div>

    <div class="grid grid-cols-4 p-3 gap-x-2 ">
        <div wire:click="selectHeroes"
            class="col-span-4 md:col-span-3 shadow-sm border py-2 hover:border hover:cursor-pointer">
            @livewire('components.heroes')
        </div>
        <div class="col-span-4 md:col-span-1 p-3 {{ $editHeroes ? 'block' : 'hidden' }}">
            <form action="" wire:submit.prevent='submitHeroes'>
                @csrf
                <div class="flex flex-col justify-between">
                    <label for="">Tag Line</label>
                    <input wire:model="tag_line" type="text" name="" id=""
                        class="text-sm lg:text-base w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2">
                    @error('tag_line')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex flex-col justify-between">
                    <label for="">Judul</label>
                    <input wire:model="judul" type="text" name="" id=""
                        class="text-sm lg:text-base w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2">
                    @error('judul')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex flex-col justify-between">
                    <label for="">Kontent</label>
                    <textarea wire:model="kontent" name="" id="" cols="30" rows="3"></textarea>
                    @error('kontent')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex flex-col justify-between">
                    <label for="">Logo</label>
                    <input wire:model="logo" type="file" name="" id=""
                        class="text-sm lg:text-base w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2">
                    @error('logo')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit"
                    class="border border-gray-400 shadow-md hover:cursor-pointer hover:bg-gray-400 hover:text-white rounded-md">Submit</button>
            </form>
        </div>
    </div>
    <div class="grid grid-cols-4 p-3 gap-x-2 ">
        <div class="col-span-4 shadow-sm border py-2 hover:border hover:cursor-pointer">
            @livewire('components.pinjaman')
        </div>
    </div>
    <div class="grid grid-cols-4 p-3 gap-x-2">
        <div class="col-span-4 md:col-span-3">
            <section id="syaratKetentuan">
                <div class="container hover:border hover:border-b-gray-400 hover:cursor-pointer items-center">
                    <div class="menu ">
                        <div class="flex flex-col md:flex-row justify-between w-full items-center">
                            <div wire:click="setting('keunggulan')"
                                class="mx-5 w-1/3 px-3 accordion  hover:text-white py-1 hover:cursor-pointer hover:bg-primary2 rounded-lg duration-300 ease-in transition-all font-bold text-[10pt] flex items-center justify-center text-center @if ($settingStatus === 'keunggulan') {{ 'bg-primary2' }} @else {{ '   ' }} @endif">
                                Keunggulan</div>
                            <div wire:click="setting('syarat')"
                                class="mx-5 w-1/3 px-3 accordion hover:text-white py-1 hover:cursor-pointer hover:bg-primary2 rounded-lg duration-300 ease-in transition-all font-bold text-[10pt] flex items-center justify-center text-center @if ($settingStatus === 'syarat') {{ 'bg-primary2' }} @else {{ '  ' }} @endif">
                                Syarat Meminjam</div>
                            <div wire:click="setting('carameminjam')"
                                class="mx-5 w-1/3 px-3 accordion hover:text-white py-1 hover:cursor-pointer hover:bg-primary2 rounded-lg duration-300 ease-in transition-all font-bold text-[10pt] flex items-center justify-center text-center @if ($settingStatus === 'carameminjam') {{ 'bg-primary2' }} @else {{ ' ' }} @endif">
                                Cara Meminjam</div>
                        </div>
                    </div>
                    <div class="p-6 lg:p-12 mt-5 flex w-full">
                        <div id="keunggulan"
                            class="duration-300 transition-all w-full ease-in accordionTab @if ($settingStatus === 'keunggulan') {{ 'flex' }}
                        @else
                            {{ 'hidden' }} @endif tab-links">
                            <div
                                class=" lg:grid lg:grid-cols-3 justify-center items-center w-full duration-300 transition">
                                @forelse ($keunggulan as $item)
                                    <div class="gap-y-4 text-center flex flex-col items-center justify-center w-full">
                                        <div class="flex items-end gap-x-5">
                                            <p wire:click="editKeunggulan({{ $item }})"
                                                class="hover:bg-orange-500 rounded-md hover:cursor-pointer hover:p-2 duration-300 transition">
                                                Edit</p>
                                            <p class="hover:bg-red-500 rounded-md hover:cursor-pointer hover:p-2 duration-300 transition"
                                                wire:click="deleteKeunggulan({{ $item->id }})">X</p>
                                        </div>
                                        <img src="{{ asset($item->takeImage) }}" width="100px" alt="">
                                        <h3 class="font-bold text-primary2">{{ $item->judul }}</h3>
                                        <p class="font-light text-secondary">{{ $item->kontent }}</p>
                                    </div>
                                @empty
                                @endforelse
                            </div>
                        </div>
                        <div id="syarat"
                            class=" duration-300 transition-all ease-in accordionTab @if ($settingStatus === 'syarat') {{ 'flex' }}
                        @else
                        {{ 'hidden' }} @endif tab-links">
                            <div class="flex justify-center items-center lg:text[34pt] text-primary2 font-bold mb-2">
                                Syarat
                                Pengajuan Pinjaman</div>
                            <div class=" flex flex-wrap justify-between px-10 w-full duration-300 transition">
                                <div class="hidden lg:w-1/2 lg:flex items-center justify-center">
                                    <img src="dist/gambar/Wavy_Bus-14_Single-02.jpg" width="300px" alt="">
                                </div>
                                <div class="w-full lg:w-1/2 flex items-center justify-center">
                                    <div class="flex flex-col w-full">
                                        @forelse ($modelSyarat as $item)
                                            <div
                                                class="flex items-center justify-center my-2 text-[12pt] lg:text-[20pt] gap-x-6 text-primary2 font-extralight">
                                                <span class="text-[14pt]">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="26"
                                                        height="26" fill="currentColor"
                                                        class="fill-current bi bi-check-circle text-[25pt]"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                        <path
                                                            d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                                                    </svg>
                                                </span>
                                                <p>{{ $item->syarat }}</p>
                                            </div>
                                            <div class="flex justify-between">
                                                <p wire:click="editSyarat({{ $item }})"
                                                    class="hover:bg-orange-500 rounded-md hover:cursor-pointer hover:p-2 duration-300 transition">
                                                    Edit</p>
                                                <p class="hover:bg-red-500 rounded-md hover:cursor-pointer hover:p-2 duration-300 transition"
                                                    wire:click="deleteSyarat({{ $item->id }})">X</p>
                                            </div>

                                        @empty
                                            <div class="w-full bg-primary2">
                                                <p class="text-white text-center">Syarat Masih Kosong</p>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="carameminjam"
                            class="w-full items-center duration-300 transition-all ease-in accordionTab @if ($settingStatus === 'carameminjam') {{ 'flex' }}
                    @else
                    {{ 'hidden' }} @endif tab-links">
                            <div
                                class=" flex flex-col gap-y-4 md:flex-row justify-between px-10 w-full duration-300 transition  items-center">
                                <div class="w-full md:w-96">
                                    @forelse ($caraPinjaman as $item)
                                        <div class="flex relative gap-3 my-2 w-full">
                                            <div class="px-3 flex items-center border  rounded-full ">1</div>
                                            <div class="border border-emerald-400 rounded-md p-2 w-full">
                                                <div>
                                                    <div class="flex justify-between">
                                                        <h3 class="font-semibold">{{ $item->cara_pinjaman }}</h3>
                                                        <div class="flex gap-x-2">
                                                            <p wire:click="editCara({{ $item }})"
                                                                class="duration-300 transition ease-in-out  hover:bg-orange-500 rounded-md hover:p-2">
                                                                edit</p>
                                                            <p wire:click="deleteCara({{ $item->id }})"
                                                                class="duration-300 transition ease-in-out  hover:bg-red-500 rounded-md hover:p-2">
                                                                x</p>
                                                        </div>
                                                    </div>
                                                    <p>{{ $item->cara_meminjam_detail->keterangan }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                    @endforelse

                                </div>
                                <div class="flex justify-end">
                                    <img class="md:w-20 lg:w-40" src="{{ asset('gambar/Untitled-1.png') }}"
                                        alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-span-4 md:col-span-1">
            <div
                class="card p-2 @if ($settingStatus === 'keunggulan') {{ 'flex' }}
            @else
                {{ 'hidden' }} @endif">
                <form action=""
                    wire:submit.prevent="{{ $keunggulanStatusUpdate ? 'updateKeunggulanHandler' : 'submitKeunggulanHandler' }}">
                    @csrf
                    <div class="flex flex-col justify-between">
                        <label for="">Judul</label>
                        <input placeholder="Judul" wire:model="keunggulanJudul" type="text"
                            class="text-sm lg:text-base w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2">
                        @error('keunggulanJudul')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col justify-between">
                        <label for="">Kontent</label>
                        <input placeholder="Kontent" wire:model="keunggulanKontent" type="text"
                            class="text-sm lg:text-base w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2">
                        @error('keunggulanKontent')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col justify-between">
                        <label for="">Logo</label>
                        <input wire:model="keunggulanLogo" type="file"
                            class="text-sm lg:text-base w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2">
                        @error('keunggulanLogo')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit"
                        class="border border-gray-400 shadow-md hover:cursor-pointer hover:bg-gray-400 hover:text-white rounded-md">Submit</button>
                </form>
            </div>
            <div
                class="card p-2 @if ($settingStatus === 'syarat') {{ 'flex' }}
            @else
                {{ 'hidden' }} @endif">
                <form action=""
                    wire:submit.prevent="{{ $updateSyaratStatus ? 'updateSyaratHandler' : 'submitSyaratHandler' }}">
                    @csrf
                    <div class="flex flex-col justify-between">
                        <label for="">Syarat Peminjaman</label>
                        <input wire:model="syaratPeminjaman" type="text" name="" id=""
                            class="text-sm lg:text-base w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                            placeholder="Syarat">
                        @error('syaratPeminjaman')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <button
                        class="border border-gray-400 shadow-md hover:cursor-pointer hover:bg-gray-400 hover:text-white rounded-md">Submit</button>
                </form>
            </div>
            <div
                class="card p-2 @if ($settingStatus === 'carameminjam') {{ 'flex flex-col' }}
            @else
                {{ 'hidden' }} @endif">
                <div class="card-header">
                    <p>Form Cara Pinjaman</p>
                </div>
                <form action=""
                    wire:submit.prevent="{{ $editCaraStatus ? 'updateCaraHandler' : 'submitCaraHandler()' }}">
                    @csrf
                    <div class="">
                        <label for="">Judul</label>
                        <input placeholder="Judul" wire:model="caraJudul" type="text"
                            class="text-sm lg:text-base w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2">
                        @error('caraJudul')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="">
                        <label for="">Kontent</label>
                        <input placeholder="Kontent" wire:model="caraKontent" type="text"
                            class="text-sm lg:text-base w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2">
                        @error('caraKontent')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit"
                        class="border border-gray-400 shadow-md hover:cursor-pointer hover:bg-gray-400 hover:text-white rounded-md">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
