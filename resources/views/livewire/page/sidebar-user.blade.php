<div class="col-span-4 lg:col-span-1 ">
    {{-- Iklan --}}
    <div class="w-full flex justify-center py-3 gap-y-3">
        <div>
            @foreach ($iklan as $item)
                <img class="my-2 w-[250px]" src="{{ asset($item->takeImage) }}" alt="">
            @endforeach
        </div>
    </div>
    <div class="px-3 my-2">
        <h3 class="border-b-2 mb-2 border-primary font-bold text-primary">Category</h3>
        <ul>
            <li>
                @foreach ($kategori as $item)
                    <a href=""
                        class="flex px-3 items-center gap-x-2 text-primary duration-300 transition ease-linear scale-105 hover:text-emerald-400">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                                <path
                                    d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                            </svg>
                        </span>
                        <span>{{ $item->judul }}</span>
                    </a>
                @endforeach
            </li>
        </ul>
    </div>
    <div class="px-3">
        <h3 class="border-b-2 mb-2 border-primary font-bold text-primary">New Post</h3>
        <ul>
            @foreach ($newPost as $item)
                <li>
                    <a href="{{ route('artikel-view', $item->slug) }}">
                        <div class="flex justify-center h-44 lg:h-36">
                            <div class="flex flex-col md:flex-row md:max-w-xl rounded-lg bg-white shadow-lg">
                                <img class=" w-full h-24 md:h-auto object-cover md:w-48 rounded-t-lg md:rounded-none md:rounded-l-lg"
                                    src="{{ asset($item->takeImage) }}" alt="" />
                                <div class="py-1 px-2 flex flex-col justify-start">
                                    <h5 class="text-gray-900 text-lg font-medium mb-2">{{ $item->judul }}</h5>
                                    <p class="text-gray-700  mb-4 text-xs">
                                        {!! $item->kontent !!}
                                    </p>
                                    <p class="text-gray-600 text-xs">Publish date:
                                        {{ $item->updated_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
