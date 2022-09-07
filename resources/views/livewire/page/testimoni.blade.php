<div>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.theme.default.min.css">
    <section id="testimonial_area" class=" bg-primary">
        <div class="flex justify-center py-3 text-xl font-extrabold text-white">
            Testimoni
        </div>
        <div class="px-10">
            <div class="row">
                <div class="">
                    <div class="testmonial_slider_area text-center owl-carousel ">
                        @foreach ($testimoni as $index => $item)
                            <div class="flex justify-center flex-col bg-white py-5 rounded-md shadow-lg">
                                <div
                                    class="rounded-full w-32 h-32 border-8 shadow-md my-3 shadow-gray-500/50 border-primary items-center flex justify-center self-center overflow-hidden">
                                    <img class="w-full" src="{{ asset($item->user->takeImage) }}" alt="">
                                </div>
                                <h5 class="text-lg text-primary shadow-md">{{ $item->user->username }}</h5>
                                <span>{{ $item->user->email }}</span>
                                <p class="content">
                                    {{ $item->testimoni }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.min.js"></script>
        <script>
            $(".testmonial_slider_area").owlCarousel({
                autoplay: true,
                slideSpeed: 1000,
                items: 3,
                loop: true,
                nav: true,
                margin: 30,
                dots: true,
                responsive: {
                    320: {
                        items: 1
                    },
                    767: {
                        items: 2
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 3
                    }
                }

            });
        </script>
    @endpush
</div>
