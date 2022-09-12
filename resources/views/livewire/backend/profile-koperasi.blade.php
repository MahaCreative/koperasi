<div class="flex flex-col gap-y-3">
    @section('title')
        Profile Koperasi
    @endsection
    <div class="border-b border-emerald-400">
        <span><a href="{{ route('dashboard') }}">Dashboard /</a></span>
        <span><a class="text-emerald-400" href="{{ Request::url() }}">Profile Koperasi </a></span>
    </div>
    <div class="border border-gray-700/50 rounded-md p-3">
        <h3 class="font-bold text-lg">Profile Perusahaan</h3>
        <div class="">
            <form class="grid grid-cols-4" wire:submit.prevent="submitHandler">
                <div class="col-span-4 my-2">
                    {{-- @if ($logo)
                        Logo Preview:
                        <img src="{{ $logo->temporaryUrl() }}">
                    @endif --}}
                    <img class="lg:w-40 w-24" src="{{ asset($profileKoperasi->takeImage) }}" alt="">
                </div>
                @csrf
                <label class="col-span-1 flex items-center" for="">Nama Koperasi</label>
                <div class="col-span-3">
                    <input wire:model="nama_koperasi"
                        class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                        type="text" placeholder="hy">

                    @error('nama_koperasi')
                        <p class="text-red-500 italic text-sm font-light">{{ $message }}</p>
                    @enderror
                </div>


                <label class="col-span-1 flex items-center" for="">Nama Perusahaan</label>
                <div class="col-span-3">
                    <input wire:model="nama_perusahaan"
                        class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                        type="text" placeholder="hy">

                    @error('nama_perusahaan')
                        <p class="text-red-500 italic text-sm font-light">{{ $message }}</p>
                    @enderror
                </div>


                <label class="col-span-1 flex items-center" for="">Badan Hukum</label>
                <div class="col-span-3">
                    <input wire:model="badan_hukum"
                        class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                        type="text" placeholder="hy">

                    @error('badan_hukum')
                        <p class="text-red-500 italic text-sm font-light">{{ $message }}</p>
                    @enderror
                </div>


                <label class="col-span-1 flex items-center" for="">Alamat</label>
                <div class="col-span-3">
                    <textarea wire:model="alamat" class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                        name="" id="" cols="30" rows="1"></textarea>
                </div>

                <label class="col-span-1 flex items-center" for="">Kota</label>
                <div class="col-span-3">
                    <input wire:model="kota"
                        class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                        type="text" placeholder="hy">

                    @error('kota')
                        <p class="text-red-500 italic text-sm font-light">{{ $message }}</p>
                    @enderror
                </div>


                <label class="col-span-1 flex items-center" for="">Provinsi</label>
                <div class="col-span-3">
                    <input wire:model="provinsi"
                        class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                        type="text" placeholder="hy">

                    @error('provinsi')
                        <p class="text-red-500 italic text-sm font-light">{{ $message }}</p>
                    @enderror
                </div>


                <label class="col-span-1 flex items-center" for="">Kode Pos</label>
                <div class="col-span-3">
                    <input wire:model="kode_pos"
                        class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                        type="text" placeholder="hy">

                    @error('kode_pos')
                        <p class="text-red-500 italic text-sm font-light">{{ $message }}</p>
                    @enderror
                </div>


                <label class="col-span-1 flex items-center" for="">No. Telp</label>
                <div class="col-span-3">
                    <input wire:model="no_telp"
                        class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                        type="text" placeholder="hy">

                    @error('no_telp')
                        <p class="text-red-500 italic text-sm font-light">{{ $message }}</p>
                    @enderror
                </div>


                <label class="col-span-1 flex items-center" for="">Fax</label>
                <div class="col-span-3">
                    <input wire:model="fax"
                        class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                        type="text" placeholder="hy">

                    @error('fax')
                        <p class="text-red-500 italic text-sm font-light">{{ $message }}</p>
                    @enderror
                </div>


                <label class="col-span-1 flex items-center" for="">Nama Pimpinan</label>
                <div class="col-span-3">
                    <input wire:model="nama_pimpinan"
                        class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                        type="text" placeholder="hy">

                    @error('nama_pimpinan')
                        <p class="text-red-500 italic text-sm font-light">{{ $message }}</p>
                    @enderror
                </div>


                <label class="col-span-1 flex items-center" for="">Nama Bendahara</label>
                <div class="col-span-3">
                    <input wire:model="nama_bendahara"
                        class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                        type="text" placeholder="hy">

                    @error('nama_bendahara')
                        <p class="text-red-500 italic text-sm font-light">{{ $message }}</p>
                    @enderror
                </div>


                <label class="col-span-1 flex items-center" for="">Nama Sekretari</label>
                <div class="col-span-3">
                    <input wire:model="nama_sekretaris"
                        class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                        type="text" placeholder="hy">

                    @error('nama_sekretaris')
                        <p class="text-red-500 italic text-sm font-light">{{ $message }}</p>
                    @enderror
                </div>


                <label class="col-span-1 flex items-center" for="">Logo Koperasi</label>
                <div class="col-span-3">
                    <input wire:model="logo"
                        class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                        type="file" placeholder="hy">

                    @error('logo')
                        <p class="text-red-500 italic text-sm font-light">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-span-4" wire:loading wire:target="photo">Uploading...</div>


                <div class="flex gap-x-2">
                    <button type="submit"
                        class="border border-gray-400/50 shadow rounded-md p-2 hover:cursor-pointer hover:bg-gray-500/50 hover:text-white transition duration-300 ease-in">Save</button>
                    <button
                        class="border border-gray-400/50 shadow rounded-md p-2 hover:cursor-pointer hover:bg-gray-500/50 hover:text-white transition duration-300 ease-in">Cancell</button>
                </div>
            </form>
        </div>
    </div>
