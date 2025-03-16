<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

         <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Main Styling -->
        <link href="{{ asset('./assets/css/argon-dashboard-tailwind.css?v=1.0.1') }}" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="m-0 font-sans antialiased text-slate-500">
        <div class="absolute w-full min-h-screen bg-gray-100">
            {{-- @include('layouts.navigation') --}}
            @include('layouts.sidebar')

            {{-- alert berhasil --}}
            @if (session()->has('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded flex justify-end">
                    {{ session('success') }}
                </div>
            @endif

            {{-- alert gagal --}}
            @if (session()->has('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded flex justify-end">
                    {{ session('error') }}
                </div>
            @endif

            <main class="relative min-h-[90vh] transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
                <!-- Page Heading -->
                @isset($header)
                    <nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all ease-in shadow-none duration-250 rounded-2xl lg:flex-nowrap lg:justify-start" navbar-main navbar-scroll="false">
                        <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
                            <nav>
                                {{ $header }}
                            </nav>
                        </div>
                    </nav>
                @endisset

            <!-- Page Content -->
            
                {{ $slot }}
            </main>

            {{-- footer --}}
            @include('layouts.footer')
        </div>
    </body>

     <!-- main script file  -->
    <script src="{{ asset('./assets/js/argon-dashboard-tailwind.js?v=1.0.1') }}" async></script>

    {{-- script js --}}
    {{-- @yield('scripts') --}}
    @isset($scripts)
        {{ $scripts }}
    @endisset
</html>
