<div class="my-2 px-4 py-2">
    <div class="flex justify-between">
        <h3 class="text-lg text-primary2 border-b border-emerald-300">Manage Komentar</h3>
        <input class="py-1 px-3 border border-emerald-400 rounded-lg placeholder:text-emerald-400" type="text"
            name="" id="" placeholder="Search..." wire:model="cari">
    </div>
    <div class="bg-primary2 py-2 px-2 max-h-96 overflow-auto">
        <table class="w-full text-xs ">
            <thead class="border-b border-emerald-400/50">
                <tr>
                    <td class="border-r border-emerald-400/50 text-left px-2">ID</td>
                    <td class="border-r border-emerald-400/50 text-left px-2">Artikel</td>
                    <td class="border-r border-emerald-400/50 text-left px-2">Username</td>
                    <td>Balas Komentar Id</td>
                    <td class="border-r border-emerald-400/50 text-left px-2">Komentar</td>
                    <td class="border-r border-emerald-400/50 text-left px-2">Tanggal</td>
                    <td class="border-r border-emerald-400/50 text-left px-2">Status</td>
                    <td class="border-r border-emerald-400/50 text-left px-2">Aksi</td>
                </tr>
            </thead>
            <tbody>
                @forelse ($komentar as $no => $item)
                    <tr
                        class="duration-300 transition ease-in hover:even:bg-emerald-300/50 hover:odd:bg-slate-400/50  rounded-lg border-b shadow-md border-emerald-400/50 py-2 px-2">
                        <td class="p-2">{{ $item->id }}</td>
                        <td class="p-2"><a class="hover:text-white"
                                href="{{ route('artikel-view', $item->artikelslug) }}">{{ $item->judul }}</a>
                        </td>
                        <td class="p-2">{{ $item->username }}</td>
                        <td class="text-center">{{ $item->parent_id }}</td>
                        <td class="p-2">{{ $item->komentar }}</td>
                        <td class="p-2">{{ $item->created_at->diffForHumans() }}</td>

                        <td class="p-2 text-center">
                            <input {{ $item->status ? 'checked' : '' }} type="checkbox" name="" id=""
                                wire:change="change($event.target.checked, {{ $item->id }})" />
                        </td>
                        <td class="p-2">

                            <button type="button" wire:click="delete({{ $item->id }})"
                                class="py-1 px-2 rounded-lg shadow bg-red-400 hover:bg-red-500 duration-300 transition">Delete</button>
                        </td>
                    </tr>
                @empty
                    <p>Kosong</p>
                @endforelse
            </tbody>
        </table>
        @if (session()->has('message'))
            <div
                class="bg-primary2/50 border border-emerald-300 rounded-lg shadow-md p-2 my-2 flex justify-between items-center">
                {{ session('message') }}
                <span>x</span>
            </div>
        @endif
    </div>
</div>
