<div class="lg:grid lg:grid-cols-5 px-4" wire:ignore>

    <div class="w-full lg:col-span-3 py-3">
        <div id="editor"></div>
        <button wire:click="submitHandler"
            class="w-full my-3 py-1 px-3 duration-300 transition ease-in-out hover:bg-emerald-400 bg-primary rounded-lg shadow-md text-white">
            Submit
        </button>

    </div>
    <div class="lg:col-span-2 -mt-16">
        <div class="my-20 w-full px-8">
            <div class="border border-gray-400/50 shadow-md rounded-lg p-4 my-5">
                <div class="py-3 flex flex-col gap-y-3 items-center justify-center">
                    <img class="w-[200px] " src="{{ asset($profile->takeImage) }}" alt="">
                    <h3 class="font-bold text-2xl">{{ $profile->nama_koperasi }}</h3>
                </div>
                <div class="border border-gray-400/50 shadow-md rounded-lg py-3 px-4">
                    <p id="kontent"></p>
                </div>
            </div>
        </div>

    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {
                const editor = CKEDITOR.replace('editor');
                const kontent = $('#kontent');

                editor.on('change', function(event) {
                    // console.log(event.editor.getData());
                    @this.set('kontent', event.editor.getData());
                    kontent.html(event.editor.getData());
                });
                $('#submit').click(function(e) {
                    CKEDITOR.instance['editor'].setData('');
                })
            });
        </script>
    @endpush
</div>
