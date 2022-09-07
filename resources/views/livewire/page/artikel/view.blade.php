<div class="mt-16 px-14">

    <div class="grid grid-cols-4  border my-5">
        <div class="col-span-4 lg:col-span-3 p-3 gap-y-2">
            <div class="border-b border-emerald-400">
                <h1 class="text-xl font-semibold text-primary "><a href="">{{ $artikel[0]->judul }}</a>
                </h1>
                <p class="text-xs text-secondary">Post By : Guntur | 31 menit yang lalu</p>
            </div>
            <div class="my-3 px-3 w-full">
                <div class="flex self-center justify-start items-center my-2">
                    <img class=" w-[200px]" src="{{ asset($artikel[0]->takeImage) }}" alt="">
                </div>
                <p>{!! $artikel[0]->kontent !!}</p>
            </div>
            <div>

                @livewire('page.komentar', ['ArtikelId' => $artikel[0]->id])
            </div>
        </div>
        @livewire('page.sidebar-user')
    </div>
</div>
