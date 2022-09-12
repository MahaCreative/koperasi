<div wire:ignore>
    @section('title')
        Edit Artikel
    @endsection
    <div class="w-full">
        <form class="w-full" action="" enctype="multipart/form-data" wire:submit.prevent="submitHandler()">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-x-2">
                <div class="lg:col-span-3 rounded-md shadow">
                    <div class="">
                        <div class="flex justify-between items-center">
                            <h3>Create A New Artikel</h3>
                        </div>
                        <div id="editor" class="h-screen" wire:model="kontent">
                            {!! $this->kontent !!}
                        </div>
                    </div>
                </div>
                <div class="w-full border border-gray-400/50 shadow-md shadow-gray-500/50 rounded-md p-3 my-2">
                    <div class=" flex flex-col">
                        <label for="">Title</label>
                        <input type="text" wire:model="judul"
                            class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2">
                        @error('judul')
                            <p class="text-xs italic text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class=" flex flex-col">
                        <label>Minimal</label>
                        <select id="kategori"
                            class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2"
                            style="width: 100%;" wire:model="varkategori">
                            <option value="" selected>Pilih Kategori</option>
                            @forelse ($kategori as $item)
                                <option value="{{ $item->id }}">{{ $item->judul }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class=" flex flex-col">
                        <label for="">Thumbnail</label>
                        <input type="file" name="thumbnail" id="thumbnail" wire:model="thumbnail"
                            class="w-full border border-gray-400/50 rounded-md px-2 py-1 flex items-center mb-2  hover:bg-gray-400/50">
                    </div>
                    <button id="submit"
                        class=" border border-gray-400/50 rounded-md hover:bg-gray-400/50 px-2 py-1 flex items-center mb-2">Submit</button>
                </div>
            </div>
        </form>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {
                const editor = CKEDITOR.replace('editor');
                editor.on('change', function(event) {
                    console.log(event.editor.getData());
                    @this.set('kontent', event.editor.getData());
                });
                $('#submit').click(function(e) {
                    CKEDITOR.instance['editor'].setData('');
                })
                $('#kategori').on('change', function(e) {
                    @this.set('varkategori', e.target.value)
                })
            });
        </script>
    @endpush
</div>
