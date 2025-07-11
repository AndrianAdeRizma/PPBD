<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>PPDB - SMA PAPUA KASIH</title>

        <!-- Load Tailwind CSS CDN for modern styling -->
        <script src="https://cdn.tailwindcss.com"></script>

        <!-- Google Fonts: Inter for general text and Merriweather for headings -->
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
            /* Apply Inter font as default for the body */
            body {
                font-family: "Inter", sans-serif;
            }
            /* Apply Merriweather font for elements with 'merriweather' class */
            .merriweather {
                font-family: "Merriweather", serif;
            }
            /* Custom background pattern for the hero section */
            .hero-background {
                background-image: url('data:image/svg+xml;utf8,<svg width="100%" height="100%" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 L 0 10" fill="none" stroke="%23e5e7eb" stroke-width="0.2" /></pattern></defs><rect width="100%" height="100%" fill="url(%23grid)" /></svg>');
                background-size: cover;
                background-position: center;
            }
        </style>
    </head>

    <body class="bg-gray-50 text-gray-800">
        <!-- Navigation Bar -->
        <nav class="bg-white shadow-sm sticky top-0 z-50 rounded-b-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex-shrink-0">
                        <a
                            href="#"
                            class="text-2xl font-bold text-blue-700 merriweather rounded-md"
                        >
                            SMA PAPUA KASIH
                        </a>
                    </div>
                    <!-- Desktop Navigation Links -->
                    <div class="hidden md:flex md:items-center md:space-x-8">
                        <a
                            href="#"
                            class="text-gray-600 hover:text-blue-600 font-medium transition duration-300 rounded-md px-3 py-2"
                            >Beranda</a
                        >
                        <a
                            href="#alur"
                            class="text-gray-600 hover:text-blue-600 font-medium transition duration-300 rounded-md px-3 py-2"
                            >Alur Pendaftaran</a
                        >
                        <a
                            href="#jadwal"
                            class="text-gray-600 hover:text-blue-600 font-medium transition duration-300 rounded-md px-3 py-2"
                            >Jadwal</a
                        >
                    </div>
                    <!-- Call to Action Button -->
                    <div>
                        <a
                            href="#"
                            class="bg-blue-600 text-white px-5 py-2.5 rounded-lg font-semibold hover:bg-blue-700 transition duration-300 shadow-md"
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
                class="relative py-20 md:py-32 overflow-hidden rounded-b-xl"
            >
                <!-- Background overlay with gradient -->
                <div class="absolute inset-0 hero-background opacity-20"></div>
                <div
                    class="absolute inset-0 bg-gradient-to-br from-blue-500/80 via-purple-600/80 to-indigo-700/80 opacity-90"
                ></div>

                <div
                    class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white"
                >
                    <h1
                        class="text-4xl md:text-6xl font-extrabold tracking-tight drop-shadow-lg"
                    >
                        <span class="block text-white"
                            >Selamat Datang di PPDB</span
                        >
                        <span
                            class="block bg-clip-text pb-1 text-transparent bg-gradient-to-r from-blue-200 via-purple-200 to-indigo-200 mt-2"
                        >
                            Sekolah Menengah Atas Papua Kasih
                        </span>
                    </h1>
                    <p
                        class="mt-4 max-w-2xl mx-auto text-lg text-blue-100 drop-shadow-md"
                    >
                        Wujudkan masa depan cerah putra-putri Anda bersama kami.
                        Segera daftarkan diri dan jadilah bagian dari generasi
                        berprestasi.
                    </p>
                    <div class="mt-10">
                        <a
                            href="#"
                            class="inline-block bg-white text-blue-700 text-lg font-semibold px-8 py-4 rounded-full shadow-xl hover:bg-gray-100 transform hover:scale-105 transition-transform duration-300 ring-2 ring-blue-300"
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
                        <h2 class="text-3xl font-bold text-gray-900">
                            Informasi Penting PPDB 2025
                        </h2>
                        <p class="mt-4 text-gray-600">
                            Ikuti setiap langkah pendaftaran dengan cermat.
                        </p>
                    </div>
                    <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-10">
                        <!-- Alur Pendaftaran Card -->
                        <div
                            class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100"
                        >
                            <h3 class="text-xl font-bold mb-4 text-blue-700">
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
                            class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100"
                        >
                            <h3 class="text-xl font-bold mb-4 text-purple-700">
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
                            class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100"
                        >
                            <h3 class="text-xl font-bold mb-4 text-indigo-700">
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
