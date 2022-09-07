<div>
    <!-- Hero Section Start -->
    <section id="hero" class="pt-36 lg:pt-16">
        <div class="container">
            <div class="flex flex-wrap">
                <div class="self-center w-full px-4 lg:w-1/2">
                    <h1 class="text-base font-semibold md:text-xl lg:text-2xl text-primary2">
                        {{ $this->heroes ? $this->heroes->tag_line : 'Halo Semua 🖐🖐' }}<span
                            class="block mt-1 text-4xl font-bold text-dark lg:text-5xl uppercase">{{ $this->heroes ? $this->heroes->judul : 'Koperasi Berkah Sejahtera' }}
                        </span>
                    </h1>
                    <p class="mb-10 font-medium leading-relaxed text-secondary ">
                        {{ $this->heroes ? $this->heroes->kontent : 'Isikan Kontent Apa saja Yang Ingin Anda Isikan' }}
                    </p>
                    <a href=""
                        class="px-8 py-3 text-base font-semibold text-white transition duration-300 ease-in-out rounded-full shadow bg-primary2 hover:shadow-lg hover:opacity-60">Hubungi
                        Kami</a>
                </div>

                <div class="self-end w-full px-4 lg:w-1/2 ">
                    <div class="relative mt-10 lg:mt-0 lg:right-0 py-24">
                        <img src="{{ asset($heroes ? $this->heroes->takeImage : 'image/Untitled-1.png') }}"
                            alt="" class="w-[60%] mx-auto">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section end -->
</div>
