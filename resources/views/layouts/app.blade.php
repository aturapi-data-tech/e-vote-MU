<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>



    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title'){{ config('app.name', 'Sistem Informasi Rumah Sakit & E-Rekam Medis') }}</title>
    <link rel="icon" type="image/png" sizes="32x32" href={{ asset('storage/favicon.png') }}>









    <!-- Scripts vite-->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="{{ asset('build/assets/sirus.css') }}" rel="stylesheet">
    <script src="{{ asset('build/assets/sirus.js') }}" defer></script>









    @stack('styles')










    {{-- Livewire --}}
    @livewireStyles











    {{-- Dark Mode Toggle --}}
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
    {{--  --}}

















</head>


<body class="bg-red-50 dark:bg-gray-800">

    {{-- {{-- @include('layouts.navigation') --}}
    {{-- pt-16 --}}
    <div class="flex pt-0 overflow-hidden bg-red-50 dark:bg-gray-900 ">

        @include('layouts.sidebar')
        {{-- lg:ml-64 --}}
        <div id="main-content" class="relative w-full h-full overflow-y-auto bg-slate-400 lg:ml-0 dark:bg-gray-900">

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow dark:bg-gray-800">
                    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif






            <!-- Page Content -->
            <main class="">
                {{ $slot }}
            </main>









        </div>

    </div>










    {{-- Livewire --}}
    @livewireScripts















    @stack('scripts')
















    {{-- <script src="https://flowbite-admin-dashboard.vercel.app//app.bundle.js"></script> --}}
    <script src="assets/flowbite/dist/flowbite.min.js"></script>


</body>

</html>
