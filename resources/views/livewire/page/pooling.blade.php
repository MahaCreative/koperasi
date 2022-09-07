<div>
    <div wire:click="$set('poolingStatus', true)"
        class="fixed bottom-0 py-1 mx-3 my-3 px-3 bg-primary rounded-lg shadow-md hover:bg-cyan-600 duration-300 transition cursor-pointer">
        pooling
    </div>
    <div
        class="{{ $poolingStatus ? ' flex' : 'hidden' }} duration-300 transition ease bg-gray-500 bg-opacity-40 w-screen fixed top-0 z-50 min-h-screen overflow-hidden max-h-screen  items-center justify-center">
        <div
            class="{{ $poolingStatus ? ' flex' : 'hidden' }} duration-300 transition ease bg-white rounded-lg shadow-md  flex-col items-center min-w-[30%] ">
            <div class="p-3 flex justify-between w-full">
                <h3 class="text-primary font-bold">Pooling</h3>
                <P wire:click="$set('poolingStatus')" class="hover:cursor-pointer hover:text-red-500">X</P>
            </div>
            <div class="py-4">
                <p class="text-primary font-bold">Apakah anda suka koperasiberkah.com</p>
                <div class="flex justify-center gap-x-3">
                    <button wire:click="suka"
                        class="py-1 px-3 rounded-md shadow bg-cyan-400 duration-300 hover:bg-cyan-600 transition">Suka</button>
                    <button wire:click="tidaksuka"
                        class="py-1 px-3 rounded-md shadow bg-red-400 duration-300 hover:bg-red-500 transition">Tidak
                        Suka</button>
                </div>
            </div>
        </div>
    </div>

</div>
