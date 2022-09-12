<div class="py-16 px-14 capitalize">
    @section('title')
        Kontak Kami
    @endsection

    <div class="grid grid-cols-5 px-4 my-5 gap-x-9 py-3 border border-emerald-400 rounded-lg">
        <div class="col-span-5 lg:col-span-3 ">
            <p class="text-3xl font-light text-primary">Hubungi Kami</p>

            <div class="py-3">
                @if (session()->has('message'))
                    <div
                        class=" bg-primary/50 border border-emerald-300 rounded-lg shadow-md p-2 my-2 flex justify-between items-center">
                        {{ session('message') }}
                        <span>x</span>
                    </div>
                @endif
            </div>
            <div class="w-full my-6 ">
                <form action="" class="" wire:submit.prevent="submitHandler">
                    @csrf
                    <div class="w-full justify-between  flex flex-col lg:flex-row gap-x-3 gap-y-2">
                        <div class="flex flex-col my-1 w-full">
                            <label for="" class="text-[16pt]">Nama Lengkap</label>
                            <input type="text"
                                class="rounded-lg py-1 px-2 border border-emerald-300 placeholder:text-emerald-300"
                                type="text" placeholder="Nama Lengkap" wire:model="nama">
                            @error('nama')
                                <p class="text-xs text-red-600 italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col my-1 w-full">
                            <label for="" class="text-[16pt]">Email</label>
                            <input type="text"
                                class="rounded-lg py-1 px-2 border border-emerald-300 placeholder:text-emerald-300"
                                type="email" placeholder="Email" wire:model="email">
                            @error('email')
                                <p class="text-xs text-red-600 italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col my-1 w-full">
                            <label for="" class="text-[16pt]">Telp</label>
                            <input type="number"
                                class="rounded-lg py-1 px-2 border border-emerald-300 placeholder:text-emerald-300"
                                type="text" placeholder="Telp" wire:model="telp">
                            @error('telp')
                                <p class="text-xs text-red-600 italic">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="flex my-2 justify-between gap-x-3 gap-y-2">
                        <textarea wire:model="subjek" class="w-full rounded-lg py-1 px-2 border border-emerald-300 placeholder:text-emerald-300"
                            name="" id="" cols="30" rows="10" placeholder="Subjek"></textarea>
                    </div>
                    <button type="submit"
                        class="bg-emerald-500 text-white text-bold rounded-lg shadow py-1 px-3">Hubungi
                        Kami</button>
                </form>
            </div>
        </div>
        <div class="col-span-5 lg:col-span-2">
            <p class="text-3xl font-light text-primary">Info Kontak</p>
            <div class="w-full text-[16pt] my-6">

                <table class="w-full flex gap-y-3">
                    <tr class="w-full py-2 ">
                        <td class="w-32 mx-3 ">Nama</td>
                        <td class="mr-3">:</td>
                        <td>{{ $profil->nama_koperasi }}</td>
                    </tr>
                    <tr class="w-full py-2 ">
                        <td class="w-32 mx-3">Alamat </td>
                        <td class="mr-3">: </td>
                        <td>{{ $profil->alamat }}</td>
                    </tr>
                    <tr class="w-full py-2 ">
                        <td class="w-32 mx-3">Telp </td>
                        <td class="mr-3">: </td>
                        <td>{{ $profil->no_telp }}</td>
                    </tr>
                    <tr class="w-full py-2 ">
                        <td class="w-32 mx-3">Alamat </td>
                        <td class="mr-3">: </td>
                        <td>{{ $profil->alamat }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
