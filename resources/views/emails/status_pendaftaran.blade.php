<!DOCTYPE html>
<html>
    <head>
        <title>Update Status Pendaftaran</title>
    </head>
    <body>
        <h2>Halo, {{ $siswa->nama_lengkap }}!</h2>
        <p>
            Terima kasih telah melakukan pendaftaran di sekolah kami. Berikut
            adalah update terbaru mengenai status pendaftaran Anda:
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

        <p>Jika ada pertanyaan, silakan hubungi kami.</p>
        <br />
        <p>Hormat kami,</p>
        <p>Panitia Penerimaan Peserta Didik Baru</p>
    </body>
</html>
