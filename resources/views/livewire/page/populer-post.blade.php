<div class="w-full  grid md:grid-cols-3 lg:grid-cols-5 gap-x-3 items-center justify-center">
    @foreach ($artikel as $item)
        <div>
            <div class="rounded-md h-32 relative overflow-hidden bg-no-repeat bg-cover max-w-xs">
                <img src="{{ asset($item->takeImage) }}"
                    class="max-w-xs w-full hover:scale-110 transition duration-300 ease-in-out items-center"
                    alt="Louvre" />
            </div>
            <h3>{{ $item->judul }}</h3>
        </div>
    @endforeach
</div>
