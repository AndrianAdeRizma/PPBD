<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Informasi Hasil Seleksi</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                line-height: 1.6;
                color: #333;
                background-color: #f4f4f4;
                margin: 0;
                padding: 20px;
            }
            .container {
                max-width: 600px;
                margin: 0 auto;
                background: #fff;
                padding: 30px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            h1 {
                color: #0056b3;
                text-align: center;
                margin-bottom: 20px;
            }
            p {
                margin-bottom: 10px;
            }
            .status {
                font-weight: bold;
                padding: 8px 12px;
                border-radius: 5px;
                display: inline-block;
                margin-top: 15px;
            }
            .status.lulus {
                background-color: #d4edda;
                color: #155724;
            }
            .status.tidak-lulus {
                background-color: #f8d7da;
                color: #721c24;
            }
            .footer {
                margin-top: 30px;
                text-align: center;
                font-size: 0.9em;
                color: #777;
            }
            .button-link {
                display: block;
                width: fit-content;
                margin: 20px auto;
                padding: 10px 20px;
                background-color: #007bff;
                color: #ffffff !important;
                text-decoration: none;
                border-radius: 5px;
                text-align: center;
            }
            .logo {
                text-align: center;
                margin-bottom: 20px;
            }
            .logo img {
                height: 60px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            {{-- Logo Sekolah --}}
            <div class="logo">
                <img
                    src="{{ $message->embed(public_path('logo/logo.png')) }}"
                    alt="Logo Sekolah"
                />
            </div>

            <h1>Informasi Hasil Seleksi Penerimaan Siswa Baru</h1>

            <p>
                Yth. Saudara/i <strong>{{ $siswa->nama_lengkap }}</strong
                >,
            </p>

            <p>
                Terima kasih atas partisipasi Anda dalam seleksi penerimaan
                siswa baru di sekolah kami.
            </p>

            <p>
                Berdasarkan hasil seleksi yang telah Anda ikuti, berikut adalah
                ringkasan informasi hasil seleksi Anda:
            </p>

            <ul>
                <li>
                    <strong>Nomor Pendaftaran:</strong>
                    {{ $siswa->nomor_pendaftaran }}
                </li>
                <li>
                    <strong>Nama Lengkap:</strong> {{ $siswa->nama_lengkap }}
                </li>

                @if ($nilai)
                <li>
                    <strong>Total Nilai Tes:</strong> {{ $nilai->jumlah_nilai }}
                </li>
                <li>
                    <strong>Status:</strong>
                    @if (($nilai->keterangan) == 'Mencukupi')
                    <span class="status lulus">LULUS</span>
                    @elseif (($nilai->keterangan) == 'Tidak Mencukupi')
                    <span class="status tidak-lulus">TIDAK LULUS</span>
                    @else
                    <span class="status">Menunggu Verifikasi</span>
                    @endif
                </li>
                @else
                <li><strong>Status:</strong> Belum ada data nilai tes.</li>
                @endif
            </ul>

            @if ($nilai && ($nilai->keterangan) == 'Mencukupi')
            <p>
                Selamat! Anda dinyatakan <strong>LULUS</strong> seleksi. Kami
                sangat gembira menyambut Anda. Informasi lebih lanjut mengenai
                tahapan daftar ulang akan kami sampaikan segera melalui email
                berikutnya atau dapat Anda cek di website resmi sekolah.
            </p>
            <a href="https://example-sekolah.com" class="button-link"
                >Kunjungi Website Sekolah</a
            >
            @elseif ($nilai && ($nilai->keterangan) == 'Tidak Mencukupi')
            <p>
                Mohon maaf, berdasarkan hasil seleksi, Anda dinyatakan
                <strong>TIDAK LULUS</strong> seleksi kali ini.
            </p>
            <p>
                Nilai Anda adalah <strong>{{ $nilai->jumlah_nilai }}</strong
                >. Nilai tersebut belum mencukupi standar minimum kelulusan yang
                telah ditetapkan oleh panitia seleksi.
            </p>
            <p>
                Kami memahami ini bisa mengecewakan, namun kami berharap Anda
                tetap semangat dan sukses dalam kesempatan berikutnya.
            </p>
            @else
            <p>
                Status kelulusan Anda akan ditentukan setelah nilai tes lengkap
                diproses dan diverifikasi oleh panitia.
            </p>
            @endif

            <p>Hormat kami,</p>
            <p>Panitia {{ config("app.name") }}</p>

            <div class="footer">
                &copy; {{ date("Y") }} {{ config("app.name") }}. Semua Hak
                Dilindungi.
            </div>
        </div>
    </body>
</html>
