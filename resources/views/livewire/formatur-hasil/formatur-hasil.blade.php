<div class="bg-gradient-to-r from-green-200 to-gray-100">

    <div class="px-4 pt-6 ">
        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm h-[calc(100dvh-25px)]">
            <!-- Card header -->

            <div class="flex justify-between h-24 p-2">
                <div class="inline-flex">
                    {{-- <img class="h-20 " src="{{ asset('storage/logo-new.png') }}" alt="logo-new.png" /> --}}
                    @include('livewire.logo.logo')
                    <div class="ml-4">
                        <h3 class="text-3xl font-bold text-gray-900">{{ $myTitle }}
                        </h3>
                        <span class="text-base font-medium text-gray-500 ">{{ $mySnipt }}</span>
                    </div>
                </div>
            </div>


            <div class="flex justify-between">
                <div class='w-1/2 pt-20 h-4/5'>
                    <canvas id="myChartx"></canvas>
                </div>

                <div class="w-[48%]">
                    <div class="">


                        <div class="md:flex md:justify-between">

                            {{-- search --}}
                            <div class="relative pointer-events-auto md:w-1/2">
                                <div class="absolute inset-y-0 left-0 flex items-center p-5 pl-3 pointer-events-none">
                                    <svg width="24" height="24" fill="none" aria-hidden="true"
                                        class="flex-none mr-3">
                                        <path d="m19 19-3.5-3.5" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <circle cx="11" cy="11" r="6" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        </circle>
                                    </svg>
                                </div>
                                <x-text-input id="simpleSearch" name="namesimpleSearch" type="text" class="p-2 pl-10"
                                    autofocus autocomplete="simpleSearch" placeholder="Cari Data"
                                    wire:model.lazy="search" />
                            </div>
                            {{-- end search --}}



                            {{-- two button --}}
                            <div class="flex justify-between mt-2 md:mt-0">
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        {{-- Button myLimitPerPage --}}
                                        <x-alternative-button class="inline-flex">
                                            <svg class="-ml-1 mr-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path clip-rule="evenodd" fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                            </svg>
                                            Tampil ({{ $limitPerPage }})
                                        </x-alternative-button>
                                    </x-slot>
                                    {{-- Open myLimitPerPagecontent --}}
                                    <x-slot name="content">

                                        @foreach ($myLimitPerPages as $myLimitPerPage)
                                            <x-dropdown-link wire:click="setLimitPerPage({{ $myLimitPerPage }})">
                                                {{ __($myLimitPerPage) }}
                                            </x-dropdown-link>
                                        @endforeach
                                    </x-slot>
                                </x-dropdown>
                            </div>
                            {{-- end two button --}}



                        </div>


                    </div>



                    <!-- Table -->
                    <div class="flex flex-col mt-6">
                        <div class="overflow-x-auto rounded-lg">
                            <div class="inline-block min-w-full align-middle">
                                <div class="overflow-hidden shadow sm:rounded-lg">
                                    <table class="w-full text-sm text-left text-gray-500 table-auto ">
                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                                            <tr>
                                                <th scope="col" class="w-2/12 px-4 py-3">
                                                    @if ($sortField == 'no_urut')
                                                        <x-sort-link :active=true wire:click.prevent="sortBy('no_urut')"
                                                            role="button" href="#">
                                                            No Urut
                                                        </x-sort-link>
                                                    @else
                                                        <x-sort-link :active=false
                                                            wire:click.prevent="sortBy('no_urut')" role="button"
                                                            href="#">
                                                            No Urut
                                                        </x-sort-link>
                                                    @endif
                                                </th>
                                                <th scope="col" class="px-4 py-3">

                                                    @if ($sortField == 'nama')
                                                        <x-sort-link :active=true wire:click.prevent="sortBy('nama')"
                                                            role="button" href="#">
                                                            Nama
                                                        </x-sort-link>
                                                    @else
                                                        <x-sort-link :active=false wire:click.prevent="sortBy('nama')"
                                                            role="button" href="#">
                                                            Nama
                                                        </x-sort-link>
                                                    @endif
                                                </th>




                                                <th scope="col" class="w-8 px-4 py-3 text-center">Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white ">


                                            @foreach ($calonFormatur as $cF)
                                                <tr class="border-b group ">
                                                    <th scope="row"
                                                        class="px-4 py-3 font-medium text-gray-900 group-hover:bg-gray-100 group-hover:text-blue-700 whitespace-nowrap">
                                                        {{ $cF->no_urut }}</th>
                                                    <td
                                                        class="px-4 py-3 group-hover:bg-gray-100 group-hover:text-blue-700">
                                                        {{ $cF->nama }}</td>


                                                    <td
                                                        class="flex items-center justify-center px-4 py-3 group-hover:bg-gray-100 group-hover:text-blue-700">
                                                        {{ $cF->vote_status }}
                                                    </td>
                                                </tr>
                                            @endforeach



                                        </tbody>
                                    </table>



                                    {{-- no data found start --}}
                                    @if ($calonFormatur->count() == 0)
                                        <div class="w-full p-4 text-sm text-center text-gray-500 ">
                                            {{ 'Data ' . $myProgram . ' Tidak ditemukan' }}
                                        </div>
                                    @endif
                                    {{-- no data found end --}}



                                </div>
                            </div>
                        </div>
                    </div>



                    <!-- Pagination start -->
                    <div class="flex items-center justify-end pt-3 sm:pt-6">
                        {{ $calonFormatur->links('vendor.livewire.tailwind') }}
                    </div>
                    <!-- Pagination end -->



                </div>
            </div>


        </div>
    </div>
























    {{-- push start ///////////////////////////////// --}}
    @push('scripts')
        {{-- script start --}}

        <script src="{{ url('assets/js/jquery.min.js') }}"></script>
        <script src="{{ url('assets/plugins/toastr/toastr.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


        <script>
            var ctxx = document.getElementById("myChartx");
            var myChart = new Chart(ctxx, {
                type: 'bar',
                data: {
                    labels: ['x'],
                    datasets: [{
                        label: 'Hasil Pemilihan Formatur',
                        data: [],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 205, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(201, 203, 207, 0.2)'
                        ],
                        borderColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',
                            'rgb(201, 203, 207)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                },
            });



            myChart.data.labels = @json($labels);
            myChart.data.datasets[0].data = @json($data);;
            myChart.update();
        </script>







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
