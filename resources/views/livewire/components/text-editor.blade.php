<div wire:ignore>
    <div id="editor" class="h-screen" wire:model="kontent"></div>
    @push('scripts')
        <script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
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
            });
        </script>
    @endpush
</div>
