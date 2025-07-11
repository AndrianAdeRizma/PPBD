<!DOCTYPE html>
<html>
    <head>
        <title>Update Status Pembayaran</title>
    </head>
    <body>
        {{-- Asumsi ada relasi dari Pembayaran ke CalonSiswa --}}
        <h2>Halo, {{ $pembayaran->calonSiswa->nama_lengkap }}!</h2>

        <p>
            Terima kasih telah melakukan pembayaran untuk pendaftaran siswa
            baru. Berikut adalah update status pembayaran Anda:
        </p>

        <p><strong>Pesan dari Panitia:</strong></p>
        <p>
            <em>{{ $pesan }}</em>
        </p>

        <p>
            Status pembayaran Anda saat ini adalah:
            <strong>{{ ucfirst($pembayaran->status_pembayaran) }}</strong>
        </p>

        <p>Jika ada pertanyaan, silakan hubungi kami.</p>
        <br />
        <p>Hormat kami,</p>
        <p>Panitia Penerimaan Peserta Didik Baru</p>
    </body>
</html>
