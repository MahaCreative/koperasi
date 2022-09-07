<div class="my-20 w-full px-8">
    <div class="border border-gray-400/50 shadow-md rounded-lg p-4 my-5">
        <div class="py-3 flex flex-col gap-y-3 items-center justify-center">
            <img class="w-[200px] " src="{{ asset($profile->takeImage) }}" alt="">
            <h3 class="font-bold text-2xl">{{ $profile->nama }}a</h3>
        </div>
        <div class="border border-gray-400/50 shadow-md rounded-lg py-3 px-4">
            {!! $about->kontent !!}
        </div>
    </div>
</div>
