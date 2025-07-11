<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>PPDB - SMA PAPUA KASIH</title>

        <!-- Load Tailwind CSS CDN for modern styling -->
        <script src="https://cdn.tailwindcss.com"></script>

        <!-- Google Fonts: Outfit for headings and Inter for general text -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Outfit:wght@600;700;800;900&display=swap"
            rel="stylesheet"
        />

        <style>
            /* Apply Inter font as default for the body */
            body {
                font-family: "Inter", sans-serif;
            }
            /* Apply Outfit font for elements with 'outfit' class (headings, logo) */
            .outfit {
                font-family: "Outfit", sans-serif;
            }
            /* Custom background pattern for the hero section with subtle animation */
            .hero-background {
                /* More complex, abstract SVG pattern for a modern feel */
                background-image: url('data:image/svg+xml;utf8,<svg width="100%" height="100%" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><defs><filter id="noise" x="0" y="0" width="100%" height="100%"><feTurbulence type="fractalNoise" baseFrequency="0.6" numOctaves="3" stitchTiles="stitch" result="noise"/><feColorMatrix type="saturate" values="0"/></filter><pattern id="dots" width="10" height="10" patternUnits="userSpaceOnUse"><circle cx="2" cy="2" r="1" fill="%23e5e7eb" /></pattern></defs><rect width="100%" height="100%" fill="url(%23dots)" filter="url(%23noise)" opacity="0.3" /></svg>');
                background-size: cover;
                background-position: center;
                animation: pan-background 40s linear infinite alternate; /* Slower panning animation */
            }

            @keyframes pan-background {
                0% {
                    background-position: 0% 0%;
                }
                100% {
                    background-position: 100% 100%;
                }
            }

            /* Custom animation for the hero button */
            @keyframes pulse-grow {
                0% {
                    transform: scale(1);
                    box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.7);
                    text-shadow: none;
                }
                50% {
                    transform: scale(1.02);
                    box-shadow: 0 0 0 10px rgba(255, 255, 255, 0);
                    text-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
                }
                100% {
                    transform: scale(1);
                    box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.7);
                    text-shadow: none;
                }
            }
            .animate-pulse-grow {
                animation: pulse-grow 2s infinite ease-in-out;
            }

            /* Frosted glass effect for sticky navbar */
            .navbar-blur {
                backdrop-filter: blur(8px);
                -webkit-backdrop-filter: blur(8px); /* Safari support */
                background-color: rgba(
                    255,
                    255,
                    255,
                    0.85
                ); /* Slightly more opaque transparent white */
            }

            /* Subtle gradient shift animation for hero overlay */
            @keyframes gradient-shift {
                0% {
                    background-position: 0% 50%;
                }
                50% {
                    background-position: 100% 50%;
                }
                100% {
                    background-position: 0% 50%;
                }
            }
            .animate-gradient-shift {
                background-size: 200% 200%; /* Make gradient larger to allow shifting */
                animation: gradient-shift 20s ease infinite;
            }
        </style>
    </head>

    <body class="bg-gray-50 text-gray-800">
        <!-- Navigation Bar -->
        <nav class="navbar-blur shadow-lg sticky top-0 z-50 rounded-b-xl">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex-shrink-0">
                        <a
                            href="#"
                            class="text-2xl font-bold text-blue-700 outfit rounded-md"
                        >
                            SMA PAPUA KASIH
                        </a>
                    </div>
                    <!-- Desktop Navigation Links -->
                    <div class="hidden md:flex md:items-center md:space-x-8">
                        <a
                            href="#"
                            class="text-gray-700 hover:text-blue-700 font-semibold transition duration-300 rounded-md px-3 py-2 hover:border-b-2 hover:border-blue-600"
                            >Beranda</a
                        >
                        <a
                            href="#alur"
                            class="text-gray-700 hover:text-blue-700 font-semibold transition duration-300 rounded-md px-3 py-2 hover:border-b-2 hover:border-blue-600"
                            >Alur Pendaftaran</a
                        >
                        <a
                            href="#jadwal"
                            class="text-gray-700 hover:text-blue-700 font-semibold transition duration-300 rounded-md px-3 py-2 hover:border-b-2 hover:border-blue-600"
                            >Jadwal</a
                        >
                    </div>
                    <!-- Call to Action Button -->
                    <div>
                        <a
                            href="{{ route('pendaftaran') }}"
                            class="bg-blue-600 text-white px-5 py-2.5 rounded-lg font-semibold hover:bg-blue-700 transition duration-300 shadow-lg transform hover:-translate-y-0.5 hover:shadow-xl"
                        >
                            Daftar Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <main>
            <!-- Hero Section with Modern Background -->
            <section
                class="relative py-20 md:py-32 overflow-hidden rounded-b-3xl"
            >
                <!-- Background overlay with gradient and animated pattern -->
                <div class="absolute inset-0 hero-background opacity-15"></div>
                <div
                    class="absolute inset-0 bg-gradient-to-br from-blue-900/90 via-purple-900/90 to-indigo-900/90 opacity-98 animate-gradient-shift"
                ></div>

                <div
                    class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white"
                >
                    <h1
                        class="text-4xl md:text-6xl font-extrabold tracking-tight drop-shadow-2xl outfit"
                    >
                        <span class="block text-white"
                            >Selamat Datang di PPDB</span
                        >
                        <span
                            class="block bg-clip-text pb-1 text-transparent bg-gradient-to-r from-blue-300 via-purple-300 to-indigo-300 mt-2"
                        >
                            Sekolah Menengah Atas Papua Kasih
                        </span>
                    </h1>
                    <p
                        class="mt-4 max-w-2xl mx-auto text-lg text-blue-200 drop-shadow-md"
                    >
                        Wujudkan masa depan cerah putra-putri Anda bersama kami.
                        Segera daftarkan diri dan jadilah bagian dari generasi
                        berprestasi.
                    </p>
                    <div class="mt-10">
                        <a
                            href="{{ route('pendaftaran') }}"
                            class="inline-block bg-white text-blue-700 text-lg font-semibold px-8 py-4 rounded-full shadow-xl hover:bg-gray-100 transform hover:scale-105 transition-transform duration-300 ring-2 ring-blue-300 animate-pulse-grow"
                        >
                            Mulai Pendaftaran 🚀
                        </a>
                    </div>
                </div>
            </section>

            <!-- Important Information Section -->
            <section id="alur" class="bg-gray-50 py-20">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center">
                        <h2 class="text-3xl font-bold text-gray-900 outfit">
                            Informasi Penting PPDB 2025
                        </h2>
                        <p class="mt-4 text-gray-600">
                            Ikuti setiap langkah pendaftaran dengan cermat.
                        </p>
                    </div>
                    <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-10">
                        <!-- Alur Pendaftaran Card -->
                        <div
                            class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 ease-in-out border border-gray-100 transform hover:-translate-y-2 hover:scale-[1.02]"
                        >
                            <h3
                                class="text-xl font-bold mb-4 text-blue-700 outfit"
                            >
                                📝 Alur Pendaftaran
                            </h3>
                            <p class="text-gray-600">
                                Buat akun, isi formulir dengan data yang valid,
                                unggah berkas, dan finalisasi data Anda untuk
                                mendapatkan nomor pendaftaran.
                            </p>
                        </div>
                        <!-- Jadwal Penting Card -->
                        <div
                            id="jadwal"
                            class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 ease-in-out border border-gray-100 transform hover:-translate-y-2 hover:scale-[1.02]"
                        >
                            <h3
                                class="text-xl font-bold mb-4 text-purple-700 outfit"
                            >
                                🗓️ Jadwal Penting
                            </h3>
                            <ul
                                class="list-disc list-inside text-gray-600 space-y-2"
                            >
                                <li>Pendaftaran: 1 Juli - 15 Juli 2025</li>
                                <li>Seleksi Berkas: 16 Juli - 18 Juli 2025</li>
                                <li>Pengumuman: 20 Juli 2025</li>
                            </ul>
                        </div>
                        <!-- Persyaratan Card -->
                        <div
                            class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 ease-in-out border border-gray-100 transform hover:-translate-y-2 hover:scale-[1.02]"
                        >
                            <h3
                                class="text-xl font-bold mb-4 text-indigo-700 outfit"
                            >
                                📄 Persyaratan
                            </h3>
                            <p class="text-gray-600">
                                Siapkan scan Kartu Keluarga, Akta Kelahiran, dan
                                Ijazah/SKL dari sekolah sebelumnya dalam format
                                PDF/JPG (maks 2MB).
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <!-- Footer Section -->
        <footer class="bg-gray-900 text-white mt-10 rounded-t-xl">
            <div
                class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 text-center"
            >
                <p>
                    &copy; 2025 Panitia PPDB Sekolah SMA PAPUA KASIH. Semua Hak
                    Cipta Dilindungi.
                </p>
            </div>
        </footer>
    </body>
</html>
