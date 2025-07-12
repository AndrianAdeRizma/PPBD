<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8" />
        <title>Update Status Pendaftaran</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                line-height: 1.6;
                color: #333;
                background-color: #f4f4f4;
                padding: 20px;
                margin: 0;
            }
            .container {
                max-width: 600px;
                background: #ffffff;
                margin: 0 auto;
                padding: 30px;
                border-radius: 8px;
                box-shadow: 0 0 8px rgba(0, 0, 0, 0.08);
            }
            .logo {
                text-align: center;
                margin-bottom: 20px;
            }
            .logo img {
                height: 60px;
            }
            h2 {
                color: #000000;
            }
            .footer {
                margin-top: 40px;
                font-size: 0.85em;
                color: #777;
                text-align: center;
            }
            h1 {
                color: #0056b3;
                text-align: center;
                margin-bottom: 20px;
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

            <h1>Informasi Status Pendaftaran</h1>

            {{-- Konten Email --}}
            <h2>Halo, {{ $siswa->nama_lengkap }}!</h2>

            <p>
                Terima kasih telah melakukan pendaftaran di sekolah kami.
                Berikut adalah update terbaru mengenai status pendaftaran Anda:
            </p>

            <p><strong>Pesan dari Panitia:</strong></p>
            <p>
                <em>{{ $pesan }}</em>
            </p>

            <p>
                Status pendaftaran Anda saat ini adalah:
                <strong
                    >{{ ucwords(str_replace('_', ' ', $siswa->status_pendaftaran)) }}</strong
                >
            </p>

            <p>
                Jika ada pertanyaan, silakan hubungi kami melalui kontak resmi
                sekolah.
            </p>

            <p>Hormat kami,</p>
            <p>Panitia {{ config("app.name") }}</p>

            <div class="footer">
                &copy; {{ date("Y") }} {{ config("app.name") }}. Semua hak
                dilindungi.
            </div>
        </div>
    </body>
</html>
