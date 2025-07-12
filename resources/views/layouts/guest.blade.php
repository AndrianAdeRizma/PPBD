<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{ config("app.name", "Laravel") }}</title>

        <link
            rel="icon"
            href="{{ asset('favicon/favicon.ico') }}"
            type="image/x-icon"
        />
        <link
            rel="apple-touch-icon"
            sizes="180x180"
            href="{{ asset('favicon/apple-touch-icon.png') }}"
        />
        <link
            rel="icon"
            type="image/png"
            sizes="32x32"
            href="{{ asset('favicon/favicon-32x32.png') }}"
        />
        <link
            rel="icon"
            type="image/png"
            sizes="16x16"
            href="{{ asset('favicon/favicon-16x16.png') }}"
        />

        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link
            href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
            rel="stylesheet"
        />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        {{-- Style untuk latar belakang gelombang --}}
        <style>
            .wave-bg {
                background-color: #f3f4f6; /* bg-gray-100 */
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3e%3cpath fill='%23e5e7eb' fill-opacity='1' d='M0,160L48,176C96,192,192,224,288,218.7C384,213,480,171,576,149.3C672,128,768,128,864,149.3C960,171,1056,213,1152,224C1248,235,1344,213,1392,202.7L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z'%3e%3c/path%3e%3c/svg%3e");
                background-repeat: no-repeat;
                background-position: bottom;
            }
            .circle-background {
                background-color: #f3f4f6; /* bg-gray-100 */
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1600 800'%3e%3cdefs%3e%3cradialGradient id='a' cx='400' cy='400' r='400' gradientUnits='userSpaceOnUse'%3e%3cstop offset='0' stop-color='%23d8b4fe'/%3e%3cstop offset='1' stop-color='%23f3f4f6'/%3e%3c/radialGradient%3e%3cradialGradient id='b' cx='1200' cy='150' r='500' gradientUnits='userSpaceOnUse'%3e%3cstop offset='0' stop-color='%23a5b4fc'/%3e%3cstop offset='1' stop-color='%23f3f4f6'/%3e%3c/radialGradient%3e%3cradialGradient id='c' cx='800' cy='700' r='300' gradientUnits='userSpaceOnUse'%3e%3cstop offset='0' stop-color='%23f9a8d4'/%3e%3cstop offset='1' stop-color='%23f3f4f6'/%3e%3c/radialGradient%3e%3c/defs%3e%3crect fill='url(%23a)' width='800' height='800'/%3e%3crect fill='url(%23b)' x='800' width='800' height='800'/%3e%3crect fill='url(%23c)' y='400' width='800' height='400'/%3e%3c/svg%3e");
                background-size: cover;
                background-position: center;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased circle-background">
        {{-- Kontainer utama dengan kelas wave-bg --}}
        <div
            class="wave-bg min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0"
        >
            <div>
                <a href="/">
                    <x-application-logo
                        class="w-20 h-20 fill-current text-gray-500"
                    />
                </a>
            </div>

            <div
                class="w-full sm:max-w-md mt-6 px-6 py-4 overflow-hidden sm:rounded-lg"
            >
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
