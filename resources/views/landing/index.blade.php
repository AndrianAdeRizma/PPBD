<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>PPDB - SMA PAPUA KASIH</title>

        <!-- <script src="https://cdn.tailwindcss.com"></script> -->

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
            rel="stylesheet"
        />

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Merriweather:ital,opsz,wght@0,18..144,300..900;1,18..144,300..900&display=swap"
            rel="stylesheet"
        />

        <style>
            /* Menggunakan font Inter sebagai font default */
            body {
                font-family: "Inter", sans-serif;
            }
        </style>
        @vite(['resources/css/app.css', 'resources/js/app.js']) @livewireStyles
    </head>

    <body class="bg-gray-50 text-gray-800">
        <nav class="bg-white shadow-sm sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex-shrink-0">
                        <a
                            href="#"
                            class="text-2xl font-bold text-blue-700 merriweathe"
                        >
                            SMA PAPUA KASIH
                        </a>
                    </div>
                    <div class="hidden md:flex md:items-center md:space-x-8">
                        <a
                            href="#"
                            class="text-gray-600 hover:text-blue-600 font-medium"
                            >Beranda</a
                        >
                        <a
                            href="#alur"
                            class="text-gray-600 hover:text-blue-600 font-medium"
                            >Alur Pendaftaran</a
                        >
                        <a
                            href="#jadwal"
                            class="text-gray-600 hover:text-blue-600 font-medium"
                            >Jadwal</a
                        >
                    </div>
                    <div>
                        <a
                            href="{{ url('pendaftaran') }}"
                            class="bg-blue-600 text-white px-5 py-2.5 rounded-lg font-semibold hover:bg-blue-700 transition duration-300"
                        >
                            Daftar Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <main>
            <section class="py-20 md:py-32">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <h1
                        class="text-4xl md:text-6xl font-extrabold tracking-tight"
                    >
                        <span class="block text-gray-900"
                            >Selamat Datang di PPDB</span
                        >
                        <span
                            class="block bg-clip-text pb-1 text-transparent bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-500 mt-2"
                        >
                            Sekolah Menengah Atas Papua Kasih
                        </span>
                    </h1>
                    <p class="mt-4 max-w-2xl mx-auto text-lg text-gray-600">
                        Wujudkan masa depan cerah putra-putri Anda bersama kami.
                        Segera daftarkan diri dan jadilah bagian dari generasi
                        berprestasi.
                    </p>
                    <div class="mt-10">
                        <a
                            href="{{ url('pendaftaran') }}"
                            class="inline-block bg-blue-600 text-white text-lg font-semibold px-8 py-4 rounded-lg shadow-lg hover:bg-blue-700 transform hover:scale-105 transition-transform duration-300"
                        >
                            Mulai Pendaftaran 🚀
                        </a>
                    </div>
                </div>
            </section>

            <section id="alur" class="bg-white py-20">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center">
                        <h2 class="text-3xl font-bold">
                            Informasi Penting PPDB 2025
                        </h2>
                        <p class="mt-4 text-gray-600">
                            Ikuti setiap langkah pendaftaran dengan cermat.
                        </p>
                    </div>
                    <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-10">
                        <div
                            class="bg-/40 backdrop-blur-lg p-8 rounded-xl shadow-md"
                        >
                            <h3 class="text-xl font-bold mb-4">
                                📝 Alur Pendaftaran
                            </h3>
                            <p class="text-gray-600">
                                Buat akun, isi formulir dengan data yang valid,
                                unggah berkas, dan finalisasi data Anda untuk
                                mendapatkan nomor pendaftaran.
                            </p>
                        </div>
                        <div
                            id="jadwal"
                            class="bg-/40 backdrop-blur-lg p-8 rounded-xl shadow-md"
                        >
                            <h3 class="text-xl font-bold mb-4">
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
                        <div
                            class="bg-/40 backdrop-blur-lg p-8 rounded-xl shadow-md"
                        >
                            <h3 class="text-xl font-bold mb-4">
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

        <footer class="bg-gray-800 text-white">
            <div
                class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 text-center"
            >
                <p>
                    &copy; {{ date("Y") }} Panitia PPDB Sekolah SMA PAPUA KASIH.
                    Semua Hak Cipta Dilindungi.
                </p>
            </div>
        </footer>
    </body>
</html>
