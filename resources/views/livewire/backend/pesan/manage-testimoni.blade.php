<div class="py-3 px-3">
    <div class="flex justify-between my-2 border-b py-2 border-emerald-400">
        <h3 class="text-lg text-primary">Testimoni</h3>
        <button wire:click="$toggle('statusForm')" class="py-1 px-3 rounded-lg shadow bg-primary">Tambahkan
            Testimoni</button>
    </div>
    @if (session()->has('message'))
        <div
            class="bg-primary/50 border border-emerald-300 rounded-lg shadow-md p-2 my-2 flex justify-between items-center">
            {{ session('message') }}
            <span>x</span>
        </div>
    @endif
    <div class="py-2">
        <form class="{{ $statusForm ? '' : 'hidden' }}" action=""
            wire:submit.prevent="{{ $updateStatus ? 'updateHandler' : 'submitHandler' }}">
            @csrf
            <label class="text-primary italic"
                for="">{{ $updateStatus ? 'Update Testimoni ' : 'Buat Testimoni Baru' }}</label>
            <textarea wire:model="testimoniField" name="" id=""
                class="w-full px-3 py-2 h-14 rounded-lg border border-emerald-400 text-primary"></textarea>
            @error('testimoniField')
                <p class="text-red-500 italic text-xs">{{ $message }}</p>
            @enderror
            <button class="py-1 px-3 rounded-lg shadow bg-primary">
                {{ $updateStatus ? 'Update' : 'Submit' }}
            </button>
        </form>
    </div>
    <div class=" rounded-lg border border-emerald-400 px-3 py-2 gap-x-3">
        <div class="w-full">
            <table class="w-full">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Testimoni</td>
                        <td>Status</td>
                        <td>Update</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($testimoni as $no => $item)
                        @if ($item->user_id == auth()->user()->id or
                            auth()->user()->hasRole('kepala koperasi'))
                            <tr>
                                <td>{{ $no + 1 }}</td>
                                <td>{{ $item->testimoni }}</td>
                                <td>
                                    <div class="flex flex-col flex-wrap">
                                        @can('petugas koperasi')
                                            <select name="" id="" class="text-primary"
                                                wire:change="changeSelect($event.target.value, {{ $item->id }})">
                                                <option class="text-primary placeholder:text-primary selection:text-primary"
                                                    value="{{ $item->status }}" selected>
                                                    {{ $item->status ? 'Aktif' : 'Tidak Aktif' }}</option>
                                                <option value="1"
                                                    class="text-primary placeholder:text-primary selection:text-primary">
                                                    Aktif</option>
                                                <option value="0"
                                                    class="text-primary placeholder:text-primary selection:text-primary">
                                                    Tidak Aktif</option>
                                            </select>
                                        @else
                                            <p class="italic {{ $item->status ? 'text-primary' : 'text-red-500' }}">
                                                {{ $item->status ? 'Aktif' : 'Tidak Aktif' }}
                                            </p>
                                        @endcan
                                    </div>
                                </td>
                                <td>{{ $item->updated_at->diffForHumans() }}</td>
                                <td>
                                    <button wire:click="edit({{ $item->id }})"
                                        class="rounded-lg py-1 px-2 bg-orange-400 duration-300 transition ease-in-out hover:bg-orange-500">Edit</button>
                                    <button wire:click="delete({{ $item->id }})"
                                        class="rounded-lg py-1 px-2 bg-red-400 duration-300 transition ease-in-out hover:bg-red-500">Delete</button>

                                </td>
                            </tr>
                        @endif
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
