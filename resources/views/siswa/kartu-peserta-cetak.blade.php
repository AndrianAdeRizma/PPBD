<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>Kartu Peserta - {{ $siswa->nama_lengkap }}</title>
        <style>
            /* Reset dasar untuk memastikan konsistensi lintas browser/PDF generator */
            body {
                margin: 0;
                padding: 0; /* Pastikan padding body 0 untuk perhitungan margin yang lebih akurat */
                font-family: "Helvetica", "Arial", sans-serif; /* Font umum untuk kompatibilitas PDF */
                color: #333;
                font-size: 12px; /* Ukuran font standar yang baik untuk cetak */
                -webkit-print-color-adjust: exact; /* Penting untuk cetak warna background */
                print-color-adjust: exact;
                width: 210mm; /* Lebar A4 */
                height: 297mm; /* Tinggi A4 */
                box-sizing: border-box; /* Pastikan padding masuk dalam lebar/tinggi */

                /* Centering strategy for the .card (which will be inline-block) */
                text-align: center; /* Menengahkan konten inline-block di dalam body */
            }

            /* Gaya untuk wadah kartu */
            .card {
                /* Mengurangi lebar kartu agar lebih proporsional seperti di gambar */
                width: 75mm; /* Lebar kartu disesuaikan agar tidak terlalu lebar */

                margin: 50px 50px 50px 50px;

                display: inline-block; /* Penting untuk penengahan dengan text-align: center */
                background-color: white;
                border: 1px solid #e5e7eb; /* Border seperti di gambar */
                border-radius: 8px; /* Sudut tumpul */
                padding: 24px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Shadow ringan (dukungan DOMPDF bervariasi) */
                text-align: left; /* Mengatur ulang text-align untuk konten di dalam kartu */
            }

            /* Penataan teks */
            .text-center {
                text-align: center;
            }
            .font-bold {
                font-weight: bold;
            }

            /* Gaya header */
            .logo {
                height: 60px; /* Ukuran logo yang pas untuk cetak */
                margin-bottom: 8px;
                display: block; /* Memastikan logo berada di baris sendiri dan bisa di-margin auto */
                margin-left: auto;
                margin-right: auto;
            }
            .header-title {
                font-size: 18px; /* Ukuran font lebih kecil untuk cetak */
                font-weight: bold;
                color: #1f2937;
                margin-top: 0;
                margin-bottom: 4px;
            }
            .header-subtitle {
                font-size: 12px;
                color: #4b5563;
                margin-top: 0;
                margin-bottom: 16px;
            }

            /* Bagian profil menggunakan TABLE untuk berdampingan (lebih kompatibel untuk PDF) */
            .profile-table {
                width: 100%; /* Tabel mengisi lebar yang tersedia dalam .card */
                border-collapse: collapse; /* Menghilangkan spasi antar sel */
                margin-bottom: 20px;
            }
            .profile-table td {
                vertical-align: top; /* Menjajarkan konten sel ke atas */
                padding: 0; /* Menghilangkan padding default sel tabel */
            }
            .profile-table .photo-cell {
                width: 96px; /* Lebar tetap untuk kolom foto */
                padding-right: 16px; /* Jarak antara foto dan detail */
            }

            .photo-placeholder {
                width: 96px;
                height: 128px;
                border: 1px solid #d1d5db; /* Border sesuai gambar */
                background-color: #f9fafb; /* Latar belakang untuk placeholder */
                display: flex; /* Untuk menengahkan 'Foto 3x4' jika tidak ada gambar */
                align-items: center;
                justify-content: center;
            }
            .profile-photo {
                width: 100%;
                height: 100%;
                object-fit: cover; /* Memastikan foto mengisi area tanpa distorsi */
            }
            .profile-details p {
                margin: 0 0 6px 0; /* Jarak antar baris informasi */
                line-height: 1.4; /* Jarak baris yang nyaman */
            }

            /* Kotak informasi */
            .info-box {
                background-color: #eff6ff;
                border: 1px solid #bfdbfe;
                border-radius: 6px;
                padding: 12px;
                font-size: 12px;
                color: #1e40af;
            }
            .info-box strong {
                font-weight: bold;
            }

            /* Untuk menyembunyikan elemen saat dicetak (jika ini juga digunakan di halaman web) */
            @media print {
                .no-print {
                    display: none !important;
                }
            }
        </style>
    </head>
    <body>
        <div class="card">
            <div class="text-center">
                {{-- Logo sekolah, diakses dari storage path untuk DOMPDF --}}
                {{-- Pastikan path ini benar-benar mengarah ke file logo yang ada --}}
                <img
                    src="{{ storage_path('app/public/logo/logo.png') }}"
                    alt="Logo Sekolah"
                    class="logo"
                />
                <h1 class="header-title">KARTU PESERTA UJIAN</h1>
                <p class="header-subtitle">
                    Penerimaan Peserta Didik Baru SMA Papua Kasih
                </p>
            </div>

            {{-- Menggunakan TABLE untuk layout foto dan detail siswa --}}
            <table class="profile-table">
                <tr>
                    <td class="photo-cell">
                        <div class="photo-placeholder">
                            @if($siswa->foto_siswa)
                            {{-- Foto siswa, diakses dari storage path untuk DOMPDF --}}
                            <img
                                src="{{ storage_path('app/private/foto/siswa/' . basename($siswa->foto_siswa))}}"
                                alt="Foto Peserta"
                                class="profile-photo"
                                {{--
                                Menggunakan
                                class
                                yang
                                benar
                                --}}
                            />
                            @else
                            <span>Foto 3x4</span>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="profile-details">
                            <p>
                                <span class="font-bold">Nomor Pendaftaran:</span
                                ><br />{{ $siswa->nomor_pendaftaran }}
                            </p>
                            <p>
                                <span class="font-bold">Nama Lengkap:</span
                                ><br />{{ $siswa->nama_lengkap }}
                            </p>
                            <p>
                                <span class="font-bold">Asal Sekolah:</span
                                ><br />{{ $siswa->asal_sekolah }}
                            </p>
                        </div>
                    </td>
                </tr>
            </table>

            <div class="info-box">
                <p>
                    <strong>Catatan:</strong> Harap membawa kartu ini saat
                    seleksi ujian masuk PPDB.
                </p>
            </div>
        </div>
    </body>
</html>
