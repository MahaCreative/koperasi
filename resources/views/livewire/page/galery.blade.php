<div class="py-16">
    <div id="carouselExampleCaptions" class="carousel slide relative" data-bs-ride="carousel">
        <div class="carousel-indicators absolute right-0 bottom-0 left-0 flex justify-center p-0 mb-4">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner relative w-full overflow-hidden">
            @foreach ($galery as $no => $item)
                <div class="carousel-item @if ($no + 1 == 1) active @endif relative float-left w-full">
                    <div class="relative overflow-hidden bg-no-repeat bg-cover" style="background-position: 50%;">
                        <img src="{{ asset($item->takeImage) }}" class="block w-full" />
                        <div
                            class="absolute top-0 right-0 bottom-0 left-0 w-full h-full overflow-hidden bg-fixed bg-black opacity-50">
                        </div>
                    </div>
                    <div class="carousel-caption hidden md:block absolute text-center">
                        <h5 class="text-xl">{{ $item->judul }}</h5>
                        <p>{{ $item->kontent }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <button
            class="carousel-control-prev absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline left-0"
            type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon inline-block bg-no-repeat" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button
            class="carousel-control-next absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline right-0"
            type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon inline-block bg-no-repeat" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <section class="overflow-hidden text-gray-700 ">

        <div class="container px-5 py-2 mx-auto lg:pt-24 lg:px-32">
            <div class="flex justify-center my-3">
                <h3 class="text-3xl text-primary border-b-4 border-spacing-3 border-primary">Galery Koperasi Berkah</h3>
            </div>
            <div class="flex flex-wrap -m-1 md:-m-2 my-3">
                <div class="flex flex-wrap w-full">
                    @foreach ($galery as $no => $item)
                        <div class="w-1/3 p-1 md:p-2">
                            <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                                src="{{ asset($item->takeImage) }}">
                        </div>
                        <div class="w-1/3 p-1 md:p-2">
                            <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                                src="{{ asset($item->takeImage) }}">
                        </div>
                        <div class="w-1/3 p-1 md:p-2">
                            <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                                src="{{ asset($item->takeImage) }}">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

</div>
