<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="bumblebee">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/all.min.css') }}">

        <style>
            /* -----
            SVG Icons - svgicons.sparkk.fr
            ----- */

            .svg-icon {
            width: 2em;
            height: 2em;
            }

            .svg-icon path,
            .svg-icon polygon,
            .svg-icon rect {
            fill: #e2bc23;
            }

            .svg-icon circle {
            stroke: #e2bc23;
            stroke-width: 1;
            }
        </style>

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen" style="background-image: url({{ asset('svg/home.svg')}})" x-data="{ showCart: false}">

            @livewire('navigation-menu')
            <div 
                x-show="showCart" 
                @click.away="showCart = false"
                x-cloak
                x-transition:enter="transition ease duration-200"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease duration-200"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-0"
                style="display: none !important;" 
                class="fixed p-3 z-30 top-0 right-0 bg-slate-900 h-screen w-60 lg:w-96">
                <h3 class="text-xl text-base-100">Tu carrito</h3>
            </div>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        <footer class="footer p-10 bg-base-200 text-base-content">
            <div>
              <svg width="50" height="50" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd" class="fill-current"><path d="M22.672 15.226l-2.432.811.841 2.515c.33 1.019-.209 2.127-1.23 2.456-1.15.325-2.148-.321-2.463-1.226l-.84-2.518-5.013 1.677.84 2.517c.391 1.203-.434 2.542-1.831 2.542-.88 0-1.601-.564-1.86-1.314l-.842-2.516-2.431.809c-1.135.328-2.145-.317-2.463-1.229-.329-1.018.211-2.127 1.231-2.456l2.432-.809-1.621-4.823-2.432.808c-1.355.384-2.558-.59-2.558-1.839 0-.817.509-1.582 1.327-1.846l2.433-.809-.842-2.515c-.33-1.02.211-2.129 1.232-2.458 1.02-.329 2.13.209 2.461 1.229l.842 2.515 5.011-1.677-.839-2.517c-.403-1.238.484-2.553 1.843-2.553.819 0 1.585.509 1.85 1.326l.841 2.517 2.431-.81c1.02-.33 2.131.211 2.461 1.229.332 1.018-.21 2.126-1.23 2.456l-2.433.809 1.622 4.823 2.433-.809c1.242-.401 2.557.484 2.557 1.838 0 .819-.51 1.583-1.328 1.847m-8.992-6.428l-5.01 1.675 1.619 4.828 5.011-1.674-1.62-4.829z"></path></svg>
              <p>ACME Industries Ltd.<br>Providing reliable tech since 1992</p>
            </div> 
            <div>
              <span class="footer-title">Services</span> 
              <a class="link link-hover">Branding</a> 
              <a class="link link-hover">Design</a> 
              <a class="link link-hover">Marketing</a> 
              <a class="link link-hover">Advertisement</a>
            </div> 
            <div>
              <span class="footer-title">Company</span> 
              <a class="link link-hover">About us</a> 
              <a class="link link-hover">Contact</a> 
              <a class="link link-hover">Jobs</a> 
              <a class="link link-hover">Press kit</a>
            </div> 
            <div>
              <span class="footer-title">Legal</span> 
              <a class="link link-hover">Terms of use</a> 
              <a class="link link-hover">Privacy policy</a> 
              <a class="link link-hover">Cookie policy</a>
            </div>
        </footer>

        @livewireScripts
    </body>
</html>
