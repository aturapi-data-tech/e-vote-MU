<div>

    <div class="px-4 pt-6">
        <div
            class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <!-- Card header -->



            <div class="w-full mb-1">
                <div class="">


                    {{-- text --}}
                    <div class="mb-5">
                        <h3 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $myTitle }}</h3>
                        <span class="text-base font-normal text-gray-500 dark:text-gray-400">{{ $mySnipt }}</span>
                    </div>
                    {{-- end text --}}



                    <div class="grid grid-cols-1 gap-2 ">
                        <div>
                            <x-text-input id="TokenRender" name="nameTokenRender" type="text" class="" autofocus
                                autocomplete="TokenRender" placeholder="Jml Token Render"
                                wire:model="jmlmyTokenRender" />
                        </div>
                        {{-- two button --}}
                        <div class="flex mt-2 md:mt-0">
                            <x-primary-button wire:click="create('{{ $jmlmyTokenRender }}')"
                                class="flex justify-center flex-auto">
                                <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Tambah Data {{ $myProgram }}
                            </x-primary-button>
                        </div>


                        {{-- end two button --}}


                    </div>







                </div>



                <!-- Token -->
                <div class="flex flex-col mt-6">
                    <div class="overflow-x-auto rounded-lg">
                        <div class="inline-block min-w-full align-middle">
                            <div class="overflow-hidden shadow sm:rounded-lg">

                                <div class="grid grid-cols-10 gap-2">
                                    @php
                                        $hitungTokenTerpakai = 0;
                                    @endphp

                                    @foreach ($myQData as $myQ)
                                        @php
                                            $tokenTerpakai = $myQ->token_status > 0 ? 1 : 0;
                                            $hitungTokenTerpakai = $hitungTokenTerpakai + $tokenTerpakai;
                                        @endphp
                                        <div
                                            class="p-2 text-center rounded-lg  {{ $myQ->token_status > 0 ? 'bg-red-300' : 'bg-primary-200' }}">
                                            {{ $myQ->token }}
                                        </div>
                                    @endforeach
                                </div>

                                <p class="pt-4 text-lg font-semibold">
                                    Jumlah token yang tersedia : {{ $myQDataCount }}
                                </p>
                                <br>
                                <p class="text-lg font-semibold">
                                    Jumlah token yang terpakai : {{ $hitungTokenTerpakai }}
                                </p>
                                <br>
                                <p class="text-lg font-semibold">
                                    Jumlah token yang belum terpakai : {{ $myQDataCount - $hitungTokenTerpakai }}
                                </p>


                            </div>
                        </div>
                    </div>
                </div>




            </div>

            {{-- <div class="flex mt-10">
                <x-red-button wire:click="resetVoteMU()" class="flex justify-center flex-auto">
                    <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Reset Data {{ $myProgram }}
                </x-red-button>
            </div> --}}


            <div class="flex items-center justify-center h-screen">
                <div x-data="{ showModal: false }">
                    <!-- Button to open the modal -->
                    <x-red-button @click="showModal = true" class="flex justify-center flex-auto">
                        <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Reset Data {{ $myProgram }}
                    </x-red-button>


                    <!-- Background overlay -->
                    <div x-show="showModal" class="fixed inset-0 transition-opacity" aria-hidden="true"
                        @click="showModal = false">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                    </div>
                    <!-- Modal -->
                    <div x-show="showModal" x-transition:enter="transition ease-out duration-300 transform"
                        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave="transition ease-in duration-200 transform"
                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        class="fixed inset-0 z-10 overflow-y-auto" x-cloak>
                        <div
                            class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                            <!-- Modal panel -->
                            <div class="inline-block w-full overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                                role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                                    <!-- Modal content -->
                                    <div class="sm:flex sm:items-start">
                                        <div
                                            class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-red-100 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                                            <!-- Heroicon name: outline/exclamation -->
                                            <svg width="64px" height="64px" class="w-6 h-6 text-red-600"
                                                stroke="currentColor" fill="none" viewBox="0 0 24.00 24.00"
                                                xmlns="http://www.w3.org/2000/svg" stroke="#ef4444"
                                                stroke-width="0.45600000000000007">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path
                                                        d="M12 7.25C12.4142 7.25 12.75 7.58579 12.75 8V13C12.75 13.4142 12.4142 13.75 12 13.75C11.5858 13.75 11.25 13.4142 11.25 13V8C11.25 7.58579 11.5858 7.25 12 7.25Z"
                                                        fill="#ef4444"></path>
                                                    <path
                                                        d="M12 17C12.5523 17 13 16.5523 13 16C13 15.4477 12.5523 15 12 15C11.4477 15 11 15.4477 11 16C11 16.5523 11.4477 17 12 17Z"
                                                        fill="#ef4444"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M8.2944 4.47643C9.36631 3.11493 10.5018 2.25 12 2.25C13.4981 2.25 14.6336 3.11493 15.7056 4.47643C16.7598 5.81544 17.8769 7.79622 19.3063 10.3305L19.7418 11.1027C20.9234 13.1976 21.8566 14.8523 22.3468 16.1804C22.8478 17.5376 22.9668 18.7699 22.209 19.8569C21.4736 20.9118 20.2466 21.3434 18.6991 21.5471C17.1576 21.75 15.0845 21.75 12.4248 21.75H11.5752C8.91552 21.75 6.84239 21.75 5.30082 21.5471C3.75331 21.3434 2.52637 20.9118 1.79099 19.8569C1.03318 18.7699 1.15218 17.5376 1.65314 16.1804C2.14334 14.8523 3.07658 13.1977 4.25818 11.1027L4.69361 10.3307C6.123 7.79629 7.24019 5.81547 8.2944 4.47643ZM9.47297 5.40432C8.49896 6.64148 7.43704 8.51988 5.96495 11.1299L5.60129 11.7747C4.37507 13.9488 3.50368 15.4986 3.06034 16.6998C2.6227 17.8855 2.68338 18.5141 3.02148 18.9991C3.38202 19.5163 4.05873 19.8706 5.49659 20.0599C6.92858 20.2484 8.9026 20.25 11.6363 20.25H12.3636C15.0974 20.25 17.0714 20.2484 18.5034 20.0599C19.9412 19.8706 20.6179 19.5163 20.9785 18.9991C21.3166 18.5141 21.3773 17.8855 20.9396 16.6998C20.4963 15.4986 19.6249 13.9488 18.3987 11.7747L18.035 11.1299C16.5629 8.51987 15.501 6.64148 14.527 5.40431C13.562 4.17865 12.8126 3.75 12 3.75C11.1874 3.75 10.4379 4.17865 9.47297 5.40432Z"
                                                        fill="#ef4444"></path>
                                                </g>
                                            </svg>
                                        </div>
                                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                            <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-headline">
                                                Reset Data E-Voting </h3>
                                            <div class="mt-2">
                                                <p class="text-sm text-gray-500"> Apakah anda yakin ingin menghapus dat
                                                    E-Voting?? <span class="font-bold">Setelah proses berlanjut</span>
                                                    Data ini tidak dapat dikembalikan. </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="grid justify-between grid-cols-2 px-4 py-3 bg-gray-50 gap-9">

                                    <x-red-button wire:click="resetVoteMU()" class="flex justify-center flex-auto">
                                        <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Reset Data E-Voting
                                    </x-red-button>

                                    <x-light-button @click="showModal = false">Cancel</x-light-button>

                                </div>
                            </div>






                        </div>
                    </div>
                </div>
            </div>




        </div>
    </div>




























    {{-- push start ///////////////////////////////// --}}
    @push('scripts')
        {{-- script start --}}
        <script src="{{ url('assets/js/jquery.min.js') }}"></script>
        <script src="{{ url('assets/plugins/toastr/toastr.min.js') }}"></script>
        {{-- script end --}}










        {{-- Global Livewire JavaScript Object start --}}
        <script type="text/javascript">
            window.livewire.on('toastr-success', message => toastr.success(message));
            window.Livewire.on('toastr-info', (message) => {
                toastr.info(message)
            });
            window.livewire.on('toastr-error', message => toastr.error(message));













            // confirmation message remove record
            window.livewire.on('confirm_remove_record', (key, name) => {

                let cfn = confirm('Apakah anda ingin menghapus data ini ' + name + '?');

                if (cfn) {
                    window.livewire.emit('confirm_remove_record_myQ', key, name);
                }
            });
















            // press_dropdownButton flowbite
            window.Livewire.on('pressDropdownButton', (key) => {
                // set the dropdown menu element
                const $targetEl = document.getElementById('dropdownMenu' + key);

                // set the element that trigger the dropdown menu on click
                const $triggerEl = document.getElementById('dropdownButton' + key);

                // options with default values
                const options = {
                    placement: 'left',
                    triggerType: 'click',
                    offsetSkidding: 0,
                    offsetDistance: 10,
                    delay: 300,
                    onHide: () => {
                        console.log('dropdown has been hidden');

                    },
                    onShow: () => {
                        console.log('dropdown has been shown');
                    },
                    onToggle: () => {
                        console.log('dropdown has been toggled');
                    }
                };

                /*
                 * $targetEl: required
                 * $triggerEl: required
                 * options: optional
                 */
                const dropdown = new Dropdown($targetEl, $triggerEl, options);

                dropdown.show();

            });
        </script>
        {{-- Global Livewire JavaScript Object end --}}
    @endpush













    @push('styles')
        {{-- stylesheet start --}}
        <link rel="stylesheet" href="{{ url('assets/plugins/toastr/toastr.min.css') }}">
        {{-- stylesheet end --}}
    @endpush
    {{-- push end --}}
</div>
