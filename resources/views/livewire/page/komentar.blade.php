{{-- Komentar --}}
<div class="w-full my-3">

    <h3 class="border-b mb-2 font-semibold">Komentar</h3>

    <div class="flex gap-x-3 rounded border border-emerald-400 my-3 shadow-sm p-3 ">
        <div class="w-full">
            @if (session()->has('message'))
                <p class="text-xs text-primary py-3">{{ session('message') }}</p>
            @endif
            <h3 class="text-primary text-lg">Tinggalkan Komentar</h3>
            <form action="" wire:submit.prevent="submitHandler()">
                <textarea class="px-2 py-1 border shadow placeholder:text-primary border-primary rounded-md w-full" type="text"
                    name="" id="" wire:model="komentarField"></textarea>
                <button
                    class="px-3 py-1 bg-primary duration-300 transition hover:text-black hover:bg-emerald-500 hover:scale-105 text-white rounded-lg">Submit</button>
            </form>
        </div>
    </div>
    @foreach ($komentar as $item)
        @if (!$item->parent_id)
            <div class="flex gap-x-3 rounded border border-emerald-400 my-3 shadow-sm p-3">
                <div class="h-32 w-32 rounded-full bg-primary p-2">
                    <img src="{{ asset('gambar/logo.png') }}" alt="">
                </div>
                <div class="py-3 w-full ">
                    <h3 class="border-b border-emerald-300 text-primary font-semibold">{{ $item->user->username }}
                    </h3>
                    <p>{{ $item->komentar }}</p>
                    <p class="text-xs text-secondary font-light">{{ $item->updated_at->diffForHumans() }}</p>
                    <div class="{{ $replyStatus ? ' ' : 'hidden' }}">
                        <form action="" class="flex flex-col" wire:submit.prevent="reply">
                            @csrf
                            <input type="hidden" name="" id="" wire:model='idKomentar'>
                            <textarea type="text" name="" id="" placeholder="hy" class="rounded border px-3 text-primary"
                                wire:model="komentarReply"></textarea>
                            <button class="flex my-2 px-2 py-1 self-end rounded bg-primary">Submit</button>
                        </form>
                    </div>
                </div>
                <p wire:click="balas({{ $item }})"
                    class=" text-xs hover:cursor-pointer text-primary py-1 px-2 hover:text-emerald-300 transition duration-300 shadow rounded-lg">
                    Balas</p>
            </div>
        @endif
        @if ($item->reply)
            @foreach ($item->reply as $reply)
                <div class="ml-5 flex gap-x-3 bg-emerald-200 rounded border border-emerald-400 my-3 shadow-sm p-3">
                    <div class="h-32 w-32 rounded-full bg-primary p-2">
                        <img src="{{ asset('gambar/logo.png') }}" alt="">
                    </div>
                    <div class="py-3 w-full ">
                        <h3 class="border-b border-emerald-300 text-primary font-semibold">User Name</h3>
                        <p>{{ $reply->komentar }}</p>
                        <p class="text-xs text-secondary font-light">{{ $item->updated_at->diffForHumans() }}</p>
                    </div>
                </div>
            @endforeach
        @endif
    @endforeach
</div>
