<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-Voting</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
    <link rel="icon" href="{{ URL::asset('favicon.ico') }}" type="image/x-icon" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gradient-to-r from-cyan-500 to-blue-500">



    {{-- Hero --}}
    <section class="text-blue-700 bg-white p-[100px]">
        <div class="py-8">
            @include('livewire.logo.logo')

            <div class="mb-4">
                <h1 class="text-6xl font-extrabold ">
                    Selamat Datang di [Platform E-Voting]!
                </h1>
                <h1 class="py-2 text-4xl font-extrabold text-gray-700">
                    PIMPINAN DAERAH PEMUDA MUHAMMADIYAH <br>KABUPATEN BLITAR 2023 - 2027
                </h1>
                <p class="py-2 mb-6 font-light text-gray-900">
                    Kami dengan bangga mempersembahkan solusi e-voting terkini yang dirancang untuk membuat proses
                    pemilihan Anda lebih mudah, aman, dan transparan. Baik Anda seorang pemilih, kandidat, atau
                    penyelenggara pemilihan, [Platform E-Voting] adalah pilihan tepat untuk memastikan setiap suara
                    dihitung dengan tepat.</p>


            </div>



            <div class="">
                {{-- <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/hero/phone-mockup.png" alt="mockup"> --}}


                <a href="{{ route('formaturVote') }}"
                    class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                    E-voting!!
                    <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>

                <a href="{{ route('formaturHasil') }}"
                    class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                    Hasil E-voting!!
                    <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>

            </div>
        </div>
    </section>


    <footer style="background-color: #f8f9fa; padding: 10px; text-align: center; font-size: 14px;">
        <p>&copy; 2024 Aturapidata Technology. All rights reserved.</p>
        <p>Supported by <a href="nuurwahidanshary@gmail.com" target="_blank"
                style="text-decoration: none; color: #007bff;">@nwanshary</a></p>
    </footer>






    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
</body>

</html>
