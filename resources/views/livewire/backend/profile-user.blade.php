<div class="flex flex-col gap-y-3">
    <div class="border-b border-emerald-400">
        <span><a href="{{ route('dashboard') }}">Dashboard /</a></span>
        <span><a class="text-emerald-400" href="{{ Request::url() }}">Profile User </a></span>
    </div>

    <div class="flex gap-x-3">
        <button wire:click="setView('profil')" {{ $view == 'profil' ? 'disabled' : '' }}
            class="border border-gray-400/50 {{ $view == 'profil' ? 'bg-gray-500/50 text-white' : '' }} shadow rounded-md p-2 hover:cursor-pointer hover:bg-gray-500/50 hover:text-white transition duration-300 ease-in">Lihat
            Profil</button>
        <button wire:click="setView('akun')" {{ $view == 'akun' ? 'disabled' : '' }}
            class="border border-gray-400/50 {{ $view == 'akun' ? 'bg-gray-500/50 text-white' : '' }} shadow rounded-md p-2 hover:cursor-pointer hover:bg-gray-500/50 hover:text-white transition duration-300 ease-in">Lihat
            Akun</button>
    </div>
    <div class="min-w-full overflow-x-hidden relative">
        <div
            class="border relative top-0 bg-white shadow-md w-full border-gray-700/50 rounded-md p-3 transition duration-500 ease-out   {{ $view == 'profil' ? 'translate-x-[0]' : 'translate-x-[1400px]' }}">
            <h3 class="font-bold text-lg">Profile User</h3>
            <div class="">
                <form class="grid grid-cols-4" wire:submit.prevent="submitHandler">
                    <div class="col-span-4 my-2">
                        {{-- @if ($logo)
                        Logo Preview:
                        <img src="{{ $logo->temporaryUrl() }}">
                    @endif --}}

                    </div>
                    @csrf
                    <label class="col-span-1 flex items-center" for="">Nama Lengkap</label>
                    <div class="col-span-3">
                        <input wire:model="nama_lengkap"
                            class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                            type="text">

                        @error('nama_lengkap')
                            <p class="text-red-500 italic text-sm font-light">{{ $message }}</p>
                        @enderror
                    </div>


                    <label class="col-span-1 flex items-center" for="">NIK</label>
                    <div class="col-span-3">
                        <input wire:model="nik"
                            class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                            type="number">

                        @error('nik')
                            <p class="text-red-500 italic text-sm font-light">{{ $message }}</p>
                        @enderror
                    </div>


                    <label class="col-span-1 flex items-center" for="">NO KK</label>
                    <div class="col-span-3">
                        <input wire:model="no_kk"
                            class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                            type="number">

                        @error('no_kk')
                            <p class="text-red-500 italic text-sm font-light">{{ $message }}</p>
                        @enderror
                    </div>
                    <label class="col-span-1 flex items-center" for="">Tempat Lahir</label>
                    <div class="col-span-3">
                        <input wire:model="tempat_lahir"
                            class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                            type="text">

                        @error('tempat_lahir')
                            <p class="text-red-500 italic text-sm font-light">{{ $message }}</p>
                        @enderror
                    </div>
                    <label class="col-span-1 flex items-center" for="">Tanggal Lahir</label>
                    <div class="col-span-3">
                        <input wire:model="ttl"
                            class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                            type="date">

                        @error('ttl')
                            <p class="text-red-500 italic text-sm font-light">{{ $message }}</p>
                        @enderror
                    </div>

                    <label class="col-span-1 flex items-center" for="">No. Telp</label>
                    <div class="col-span-3">
                        <input wire:model="no_telp"
                            class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                            type="number">

                        @error('no_telp')
                            <p class="text-red-500 italic text-sm font-light">{{ $message }}</p>
                        @enderror
                    </div>


                    <label class="col-span-1 flex items-center" for="">Alamat</label>
                    <div class="col-span-3">
                        <textarea wire:model="alamat" class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                            name="" id="" cols="30" rows="1"></textarea>
                    </div>

                    <label class="col-span-1 flex items-center" for="">Kecamatan</label>
                    <div class="col-span-3">
                        <input wire:model="kecamatan"
                            class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                            type="text">

                        @error('kecamatan')
                            <p class="text-red-500 italic text-sm font-light">{{ $message }}</p>
                        @enderror
                    </div>


                    <label class="col-span-1 flex items-center" for="">kelurahan</label>
                    <div class="col-span-3">
                        <input wire:model="kelurahan"
                            class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                            type="text">

                        @error('kelurahan')
                            <p class="text-red-500 italic text-sm font-light">{{ $message }}</p>
                        @enderror
                    </div>


                    <label class="col-span-1 flex items-center" for="">Kabupaten</label>
                    <div class="col-span-3">
                        <input wire:model="kabupaten"
                            class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                            type="text">

                        @error('kabupaten')
                            <p class="text-red-500 italic text-sm font-light">{{ $message }}</p>
                        @enderror
                    </div>

                    <label class="col-span-1 flex items-center" for="">Provinsi</label>
                    <div class="col-span-3">
                        <input wire:model="provinsi"
                            class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                            type="text">

                        @error('provinsi')
                            <p class="text-red-500 italic text-sm font-light">{{ $message }}</p>
                        @enderror
                    </div>


                    <label class="col-span-1 flex items-center" for="">Pekerjaan</label>
                    <div class="col-span-3 uppercase">
                        <select wire:model='pekerjaan_id'
                            class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2 "
                            name="">

                            @if ($profileUser)
                                <option value="" selected disabled>{{ $profileUser->pekerjaan->pekerjaan }}
                                </option>
                            @endif
                            @forelse ($pekerjaan as $item)
                                <option class="" value="{{ $item->id }}">{{ $item->pekerjaan }}
                                </option>
                            @empty
                            @endforelse
                        </select>

                    </div>
                    <div class="col-span-4">

                        @error('pekerjaan_id')
                            <p class="text-red-500 italic text-sm font-light">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-x-2">
                        <button type="submit"
                            class="border uppercaseborder-gray-400/50 shadow rounded-md p-2 hover:cursor-pointer hover:bg-gray-500/50 hover:text-white transition duration-300 ease-in">Save</button>

                    </div>
                </form>
            </div>
        </div>
        <div
            class="border w-full absolute top-0 bg-white border-gray-700/50 rounded-md p-3 transition duration-500 ease-out {{ $view == 'akun' ? 'translate-x-[0px]' : 'translate-x-[1400px]' }}">
            <h3 class="font-bold text-lg">Akun User</h3>
            <img class="lg:w-44 w-24" src="{{ asset(auth()->user()->takeImage) }}" alt="">
            <div class="">
                <form class="grid grid-cols-4" wire:submit.prevent="submitHandlerAkun">
                    <label class="col-span-1 flex items-center" for="">Username</label>
                    <div class="col-span-3">
                        <input wire:model="username"
                            class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                            type="text">

                        @error('username')
                            <p class="text-red-500 italic text-sm font-light">{{ $message }}</p>
                        @enderror
                    </div>
                    <label class="col-span-1 flex items-center" for="">Email</label>
                    <div class="col-span-3">
                        <input wire:model="email"
                            class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                            type="text">

                        @error('email')
                            <p class="text-red-500 italic text-sm font-light">{{ $message }}</p>
                        @enderror
                    </div>
                    <label class="col-span-1 flex items-center" for="">Password</label>
                    <div class="col-span-3">
                        <input wire:keydown="typePassword" wire:model="password"
                            class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                            type="text">

                        @error('password')
                            <p class="text-red-500 italic text-sm font-light">{{ $message }}</p>
                        @enderror
                    </div>
                    <label class="col-span-1 flex items-center" for="">Konfirmasi Password</label>
                    <div class="col-span-3">
                        <input wire:keydown="typePassword" wire:model="password_confirmation"
                            class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                            type="text">

                    </div>
                    <label class="col-span-1 flex items-center" for="">Foto</label>
                    <div class="col-span-3">
                        <input wire:model="photo"
                            class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                            type="file">

                        @error('photo')
                            <p class="text-red-500 italic text-sm font-light">{{ $message }}</p>
                        @enderror
                    </div>
                    @if ($checkPassword)
                        <div class="col-span-4">
                            <p>Passord Harus Sama</p>
                        </div>
                    @endif
                    <div class="flex gap-x-2">
                        <button type="submit"
                            class="border uppercaseborder-gray-400/50 shadow rounded-md p-2 hover:cursor-pointer hover:bg-gray-500/50 hover:text-white transition duration-300 ease-in">Save</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $('#select2').select2()
        </script>
    @endpush
</div>
