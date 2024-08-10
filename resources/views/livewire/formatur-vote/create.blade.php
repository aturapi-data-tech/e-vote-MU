<div class="fixed inset-0 z-40 ease-out duration-400">

    <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">

        <!-- This element is to trick the browser into transition-opacity. -->
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​


        <div class="inline-block overflow-auto text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:max-h-[35rem] sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
            role="dialog" aria-modal="true" aria-labelledby="modal-headline">

            <div
                class="sticky top-0 flex items-start justify-between p-4 bg-white border-b rounded-t dark:border-gray-600">

                <h3 class="text-2xl font-semibold text-gray-900 dark:text-white">
                    {{ $myTitle }}
                </h3>
            </div>



            <div class="px-2 pt-2 pb-2 bg-white ">



                <div>
                    <x-input-label for="token" :value="__('Masukkan Token')" />
                    <div class="flex">
                        <x-text-input class="block mt-1" autofocus wire:model="token"
                            wire:keydown.enter="validateToken('{{ $token }}')" />
                    </div>
                    @error('token')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>





            </div>






        </div>



    </div>

</div>
