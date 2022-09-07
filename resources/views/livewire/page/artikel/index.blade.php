<div class="mt-16  px-14">
    <div class="grid grid-cols-4  border my-5">
        <div class="col-span-4 lg:col-span-3 p-3 gap-y-2">
            @livewire('page.populer-post')
            {{-- Berita Terbaru --}}
            <div class="w-full my-3">
                <h3 class="border-b mb-2 font-semibold">Postingan Terbaru</h3>
                @forelse ($artikel as $item)
                    <a href="{{ route('artikel-view', $item->slug) }}">
                        <div class="flex my-2 ">
                            <div class="flex flex-col md:flex-row rounded-lg bg-white shadow-lg w-full">
                                <img class=" w-full h-96 md:h-auto object-cover md:w-48 rounded-t-lg md:rounded-none md:rounded-l-lg"
                                    src="{{ asset($item->takeImage) }}" alt="" />
                                <div class="p-6 flex flex-col justify-start">
                                    <div class="border-b border-emerald-400 w-full">
                                        <h5 class="text-primary text-2xl font-bold">{{ $item->judul }}</h5>
                                        <p class="text-xs text-secondary">Publish By: {{ $item->user->username }} |
                                            Create At :
                                            {{ $item->updated_at->diffForHumans() }}</p>
                                    </div>
                                    <p class="text-gray-700 text-base mb-4">
                                        {!! Str::limit($item->kontent, 50) !!}
                                    </p>
                                    <p class="text-gray-600 text-xs">{{ $item->updated_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                @endforelse
                {{ $artikel->links() }}
            </div>
        </div>
        @livewire('page.sidebar-user')
    </div>

</div>
