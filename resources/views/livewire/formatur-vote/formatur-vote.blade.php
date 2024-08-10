<div class="bg-gradient-to-r from-green-200 to-gray-50">

    @section('title', $myTitle)

    <div class="px-4 pt-6 ">
        <div class="p-2 bg-gray-100 border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <!-- Card header -->


            <div class="w-full h-[calc(100dvh-50px)] mb-1 overflow-auto">
                <div class="sticky top-0 z-10 bg-gray-200">


                    {{-- text --}}
                    <div class="mb-1 bg-gray-100">
                        <div class="flex justify-center">
                            {{-- <div class="inline-flex">
                                <img class="h-20 " src="{{ asset('storage/logo-new.png') }}" alt="logo-new.png" />
                            @include('livewire.logo.logo')
                            <div class="ml-4">
                                <h3 class="text-3xl font-bold text-gray-900 dark:text-white">
                                    {{ $myTitle }}
                                </h3>
                                <span
                                    class="text-base font-medium text-gray-500 dark:text-gray-400">{{ $mySnipt }}</span>
                            </div>
                        </div> --}}

                            <div class="bg-gray-100">
                                <img class="w-[700px] h-[200px] " src="{{ asset('storage/KOP.png') }}" alt="KOP.png" />
                            </div>

                            <x-red-button wire:click.prefent="store()">Simpan Pilihan</x-red-button>
                        </div>


                        <div x-data
                            x-bind:class="'grid w-full gap-1 grid-cols-11 sm:hidden {{ 'grid-cols-' . $formaturVoteNumber }}'">
                            @for ($i = 1; $i <= env('APP_FORMATUR_VOTE', 9); $i++)
                                <div class="text-sm font-semibold text-center bg-yellow-300 rounded-full ">
                                    {{ $i }}
                                </div>
                            @endfor
                        </div>



                        <div x-data
                            x-bind:class="'grid w-full gap-1 grid-cols-11 sm:hidden {{ 'grid-cols-' . $formaturVoteNumber }}'">
                            @foreach ($calonFormaturTerpilih as $key => $cF)
                                <div
                                    class="inline-flex items-center justify-between w-auto p-1 my-2 bg-yellow-300 border-2 rounded-lg cursor-pointer border-grey-200 dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-blue-600 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                    <p class="w-auto text-sm truncate ">
                                        {{ $cF['no_urut'] . '.' . $cF['nama'] }}
                                    </p>
                                    <button type="button"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-red-500 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                        wire:click.prefent="voteFor({{ $key }},
                                        {{ $cF['no_urut'] }},
                                        '{{ addslashes($cF['nama']) }}')">
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



                <div class="grid grid-cols-7 gap-2 sm:grid-cols-2">


                    @foreach ($calonFormatur as $key => $cF)
                        @php
                            $bgCardPropertyColor = $cF['vote_status'] == 1 ? 'bg-yellow-300' : 'bg-yellow-50';
                            $fontCardPropertyColor = $cF['vote_status'] == 1 ? 'font-semibold' : 'font-normal';

                        @endphp
                        <div class="relative w-full pt-2 pr-2">
                            <a wire:click.prefent="voteFor({{ $key }},
                                {{ $cF['no_urut'] }},
                                '{{ addslashes($cF['nama']) }}')"
                                class="block p-2 {{ $bgCardPropertyColor }} border border-yellow-200 rounded-lg shadow hover:bg-yellow-200 ">

                                <span
                                    class="absolute w-6 h-6 font-semibold text-center text-white bg-red-500 rounded-full text-md">
                                    {{ $cF['no_urut'] }}
                                </span>

                                <div class="flex flex-col items-center pb-1">
                                    @if (empty($cF['foto']))
                                        <img class="rounded-lg shadow-lg w-36 h-36"
                                            src="{{ asset('storage/6685417.jpg') }}" alt="{{ $cF['foto'] }}" />
                                    @else
                                        <img class="rounded-lg shadow-lg w-36 h-36"
                                            src="{{ asset('images/' . $cF['foto']) }}" alt="{{ $cF['foto'] }}" />
                                    @endif


                                    <span class="text-sm {{ $fontCardPropertyColor }} text-gray-900 ">
                                        {{ $cF['nama'] }}
                                    </span>
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




                @if ($isOpen)
                    @include('livewire.formatur-vote.create')
                @endif




            </div>

        </div>
    </div>

    <div class="m-4 text-sm text-gray-700 bg-red-200 rounded-lg pl-[600px] sm:hidden">
        <p>
            1. Nama - nama yang telah lolos verifikasi PANLIH menjadi calon formatur.
        </p>
        <p>
            2. Peserta pemilik hak suara akan memilih 11 (sebelas nama) untuk menjadi formatur.
        </p>
        <p>
            3. Memperoleh suara 11 (sebelas) nama tertinggi akan menjadi formatur.
        </p>
        <p>
            4. Pemilihan dilaksanakan dengan menggunakan sistem elektronik voting (e-voting).
        </p>
        <p>
            5. Syarat dan keputusan berlandaskan putusan RAPIMDA pada Ahad tanggal 21 Juli 2024.
        </p>
        <p>
            6. Mengedepakan asas Langsung, Umum, bebas, rahasia, Jujur, dan adil.
        </p>
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
