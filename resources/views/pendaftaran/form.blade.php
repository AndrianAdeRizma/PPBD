<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Formulir Pendaftaran Siswa Baru - Sekolah Harapan Bangsa</title>
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
            rel="stylesheet"
        />
        @vite('resources/css/app.css')
        <style>
            body {
                font-family: "Inter", sans-serif;
            }
        </style>
    </head>
    <body class="bg-gray-100">
        <div class="container mx-auto max-w-4xl py-12 px-4">
            <div class="bg-white p-8 md:p-10 rounded-2xl shadow-lg">
                <div class="text-center mb-10">
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-800">
                        Formulir Pendaftaran Siswa Baru
                    </h1>
                    <p class="text-gray-500 mt-2">
                        Pastikan semua data diisi dengan benar.
                    </p>
                </div>

                @if ($errors->any())
                <div
                    class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md"
                    role="alert"
                >
                    <p class="font-bold">Terjadi Kesalahan</p>
                    <ul class="list-disc list-inside mt-2">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form
                    action="{{ route('pendaftaran.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                >
                    @csrf

                    <h2 class="text-xl font-semibold text-gray-700 mb-4">
                        Data Siswa
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-form.input
                            name="nomor_pendaftaran"
                            label="Nomor Pendaftaran"
                            required
                        />
                        <x-form.input
                            name="nama_lengkap"
                            label="Nama Lengkap"
                            required
                        />
                        <x-form.input name="nisn" label="NISN" required />
                        <x-form.select
                            name="jenis_kelamin"
                            label="Jenis Kelamin"
                            :options="['Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan']"
                            required
                        />
                        <x-form.input
                            name="tempat_lahir"
                            label="Tempat Lahir"
                            required
                        />
                        <x-form.input
                            name="tanggal_lahir"
                            type="date"
                            label="Tanggal Lahir"
                            required
                        />
                        <x-form.input name="agama" label="Agama" required />
                        <x-form.input
                            name="nomor_telepon"
                            label="Nomor Telepon Siswa"
                            required
                        />
                        <x-form.input
                            name="asal_sekolah"
                            label="Asal Sekolah"
                            required
                        />
                        <x-form.textarea
                            name="alamat"
                            label="Alamat Lengkap"
                            required
                        />
                        <x-form.input
                            name="foto_siswa"
                            label="Foto Siswa"
                            type="file"
                        />
                        <x-form.input
                            name="dokumen_akta"
                            label="Dokumen Akta Kelahiran"
                            type="file"
                        />
                        <x-form.input
                            name="dokumen_ijazah"
                            label="Dokumen Ijazah"
                            type="file"
                        />
                        <x-form.input
                            name="dokumen_kk"
                            label="Dokumen Kartu Keluarga"
                            type="file"
                        />
                        <x-form.input
                            name="dokumen_rapor"
                            label="Dokumen Rapor"
                            type="file"
                        />
                    </div>

                    <hr class="my-8" />

                    <h2 class="text-xl font-semibold text-gray-700 mb-4">
                        Data Orang Tua
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-form.input
                            name="nama_ayah"
                            label="Nama Ayah"
                            required
                        />
                        <x-form.input
                            name="tanggal_lahir_ayah"
                            type="date"
                            label="Tanggal Lahir Ayah"
                        />
                        <x-form.input
                            name="pekerjaan_ayah"
                            label="Pekerjaan Ayah"
                        />
                        <x-form.input
                            name="dokumen_ktp_ayah"
                            label="Dokumen KTP Ayah"
                            type="file"
                        />

                        <x-form.input
                            name="nama_ibu"
                            label="Nama Ibu"
                            required
                        />
                        <x-form.input
                            name="tanggal_lahir_ibu"
                            type="date"
                            label="Tanggal Lahir Ibu"
                        />
                        <x-form.input
                            name="pekerjaan_ibu"
                            label="Pekerjaan Ibu"
                        />
                        <x-form.input
                            name="dokumen_ktp_ibu"
                            label="Dokumen KTP Ibu"
                            type="file"
                        />

                        <x-form.input
                            name="nomor_telepon_ortu"
                            label="Nomor Telepon Orang Tua"
                        />
                    </div>

                    <hr class="my-8" />

                    <h2 class="text-xl font-semibold text-gray-700 mb-4">
                        Data Wali (Opsional)
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-form.input name="nama_wali" label="Nama Wali" />
                        <x-form.input
                            name="tanggal_lahir_wali"
                            type="date"
                            label="Tanggal Lahir Wali"
                        />
                        <x-form.input
                            name="pekerjaan_wali"
                            label="Pekerjaan Wali"
                        />
                        <x-form.input
                            name="nomor_telepon_wali"
                            label="Nomor Telepon Wali"
                        />
                        <x-form.input
                            name="dokumen_ktp_wali"
                            label="Dokumen KTP Wali"
                            type="file"
                        />
                    </div>

                    <div class="mt-10 pt-6 border-t border-gray-200 text-right">
                        <button
                            type="submit"
                            class="bg-blue-600 text-white font-bold py-3 px-8 rounded-lg shadow-md hover:bg-blue-700 transition-colors duration-300"
                        >
                            Kirim Pendaftaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
