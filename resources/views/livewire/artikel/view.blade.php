<div class="mt-16 px-14">
    @section('title')
        Artikel
    @endsection
    <div class="grid grid-cols-4  border my-5">
        <div class="col-span-4 lg:col-span-3 p-3 gap-y-2">
            <div class="border-b border-emerald-400">
                <h1 class="text-lg text-primary "><a href="">{{ $artikel[0]->judul }}</a>
                </h1>
                <p class="text-xs text-secondary">Post By : Guntur | 31 menit yang lalu</p>
            </div>
            <div class="my-3 px-3 w-full">
                <div class="flex self-center justify-center items-center my-2">
                    <img class=" w-[200px]" src="{{ asset('gambar/Iklan.jpg') }}" alt="">
                </div>
                <p>{!! $artikel[0]->kontent !!}</p>
            </div>
            <div>

                @livewire('page.komentar', ['ArtikelId' => $artikel[0]->id])
            </div>
        </div>
        @livewire('page.sidebaruser')
    </div>
</div>
