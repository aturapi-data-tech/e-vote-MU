<div>

    <div class="px-4 pt-6 ">
        <div class="p-2 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <!-- Card header -->


            <div class="w-full max-h-[600px]  overflow-auto mb-1">
                <div class="sticky top-0">


                    {{-- text --}}
                    <div class="bg-white ">
                        <div class="flex justify-between h-16 p-2">
                            <div>
                                <h3 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $myTitle }}</h3>
                                <span
                                    class="text-base font-medium text-gray-500 dark:text-gray-400">{{ $mySnipt }}</span>
                            </div>
                            <x-primary-button wire:click.prefent="store()">Simpan</x-primary-button>
                        </div>

                        <div class="grid w-full gap-1 md:grid-cols-9">
                            @foreach ($calonFormaturTerpilih as $key => $cF)
                                <div
                                    class="inline-flex items-center justify-between w-auto p-1 my-5 text-gray-800 bg-yellow-100 border-2 border-green-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-blue-600 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                    <div class="block">
                                        <div class="w-auto text-xl">{{ $cF['no_urut'] . '.' . $cF['nama'] }}</div>
                                    </div>
                                    <button type="button"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-red-500 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                        wire:click.prefent="voteFor({{ $key }},
                                        {{ $cF['no_urut'] }},
                                        '{{ $cF['nama'] }}')">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="sr-only">Hapus</span>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    {{-- end text --}}

                </div>



                <div class="flex flex-wrap ">


                    @foreach ($calonFormatur as $key => $cF)
                        @php
                            $bgCardPropertyColor = $cF['vote_status'] == 1 ? 'bg-yellow-300' : 'bg-white';
                        @endphp
                        <div class="w-full pt-2 pr-2 md:basis-1/5 ">
                            <a wire:click.prefent="voteFor({{ $key }},
                                {{ $cF['no_urut'] }},
                                '{{ $cF['nama'] }}')"
                                class="block p-6 {{ $bgCardPropertyColor }} border border-gray-200 rounded-lg shadow hover:bg-blue-100 dark:bg-gray-700 dark:border-gray-700 dark:hover:bg-gray-700 ">

                                <div class="flex flex-col items-center pb-1">
                                    @if (empty($cF['foto']))
                                        <img class="w-20 h-20 rounded-full shadow-lg"
                                            src="{{ asset('storage/6685417.jpg') }}" alt="{{ $cF['foto'] }}" />
                                    @else
                                        <img class="w-20 h-20 rounded-full shadow-lg"
                                            src="{{ asset('images/' . $cF['foto']) }}" alt="{{ $cF['foto'] }}" />
                                    @endif
                                    <h5 class="mb-1 text-2xl font-medium text-gray-900 dark:text-white">
                                        {{ $cF['no_urut'] . '  ' . $cF['nama'] }}</h5>
                                    <span class="text-sm text-gray-500 dark:text-gray-400"> {{ $cF['nama'] }}</span>
                                </div>

                            </a>

                            {{-- <a
                                wire:click.prefent="voteFor({{ $key }},
                            {{ 1 }},
                        '{{ 2 }}')">x{{ $key }}
                            </a> --}}

                        </div>
                    @endforeach
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
                    window.livewire.emit('confirm_remove_record_data', key, name);
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
