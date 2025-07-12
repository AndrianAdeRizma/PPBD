<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>{{ $title ?? "Pendaftaran" }}</title>
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
        @vite('resources/css/app.css') @livewireStyles
        <style>
            body {
                font-family: "Inter", sans-serif;
            }
            .wave,
            .wave2,
            .wave3 {
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
                height: auto;
                pointer-events: none;
            }
            .wave2,
            .wave3 {
                z-index: 0;
            }
        </style>
    </head>
    <body
        class="relative min-h-screen bg-gradient-to-r from-blue-300 via-blue-200 to-blue-400 overflow-x-hidden"
    >
        <main class="relative z-10 container mx-auto py-10 px-4">
            {{ $slot }}
        </main>

        <!-- Gelombang 1 -->
        <svg
            class="wave"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 1440 320"
        >
            <path
                fill="#ffffff33"
                fill-opacity="1"
                d="M0,160L30,149.3C60,139,120,117,180,133.3C240,149,300,203,360,213.3C420,224,480,192,540,181.3C600,171,660,181,720,170.7C780,160,840,128,900,128C960,128,1020,160,1080,165.3C1140,171,1200,149,1260,133.3C1320,117,1380,107,1410,101.3L1440,96L1440,320L0,320Z"
            ></path>
        </svg>

        <!-- Gelombang 2 -->
        <svg
            class="wave2"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 1440 320"
        >
            <path
                fill="#ffffff55"
                fill-opacity="1"
                d="M0,224L40,218.7C80,213,160,203,240,197.3C320,192,400,192,480,181.3C560,171,640,149,720,149.3C800,149,880,171,960,160C1040,149,1120,107,1200,96C1280,85,1360,107,1400,117.3L1440,128L1440,320L0,320Z"
            ></path>
        </svg>

        <!-- Gelombang 3 -->
        <svg
            class="wave3"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 1440 320"
        >
            <path
                fill="#ffffff77"
                fill-opacity="1"
                d="M0,288L48,272C96,256,192,224,288,208C384,192,480,192,576,186.7C672,181,768,171,864,154.7C960,139,1056,117,1152,112C1248,107,1344,117,1392,122.7L1440,128L1440,320L0,320Z"
            ></path>
        </svg>

        @livewireScripts
        <script>
            function loginWithGoogle() {
                // Ambil URL Google Redirect dari Blade secara aman
                const googleLoginUrl = '{{ route('redirect') }}';
                console.log('Mengarahkan ke:', googleLoginUrl); // Untuk debugging
                window.location.href = googleLoginUrl;
            }
        </script>
        <script>
            document.addEventListener("livewire:load", () => {
                Livewire.hook("message.processed", (message, component) => {
                    const firstErrorInput = document.querySelector(
                        'input[data-error="true"], select[data-error="true"], textarea[data-error="true"]'
                    );
                    if (
                        firstErrorInput &&
                        typeof firstErrorInput.focus === "function"
                    ) {
                        firstErrorInput.scrollIntoView({
                            behavior: "smooth",
                            block: "center",
                        });
                        firstErrorInput.focus();
                    }
                });
            });
        </script>
    </body>
</html>
