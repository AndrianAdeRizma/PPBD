<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CalonSiswa as Siswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Mail; // <-- Tambahkan ini
use App\Mail\StatusPendaftaranMail;   // <-- Tambahkan ini
use Barryvdh\DomPDF\Facade\Pdf; // <-- Tambahkan ini

class SiswaController extends  Controller
{

    public function index()
    {
        $calonSiswa = Siswa::with('ortu')->orderBy('created_at', 'desc')->get();

        return view(
            'siswa.index',
            [
                'title' => 'Data Calon Siswa',
                'calonSiswa' => $calonSiswa,
            ]
        );
    }

    public function detail($id)
    {
        $siswa = Siswa::with('ortu')->findOrFail($id);

        // dd($siswa);

        if (!$siswa) {
            return response()->json(['message' => 'Siswa tidak ditemukan'], 404);
        }

        return response()->json($siswa);
    }
    public function profile($id)
    {
        try {
            $nomorPendaftaran = Crypt::decryptString($id);
        } catch (DecryptException $e) {
            abort(404); // Jika gagal didekripsi
        }

        $siswa = Siswa::with('ortu')->where('nomor_pendaftaran', $nomorPendaftaran)->firstOrFail();

        // dd($siswa);
        return view(
            'siswa.profile',
            [
                'title' => 'Profile Siswa',
                'siswa' => $siswa,
            ]

        );
    }

    public function kartuPeserta()
    {
        $user = Auth::user();
        $siswa = Siswa::where('user_id', $user->id)->firstOrFail();
        // dd($siswa);
        return view('siswa.kartu-peserta', ['siswa' => $siswa]);
    }

    public function cetakKartuPeserta()
    {
        $user = Auth::user();
        $siswa = Siswa::where('user_id', $user->id)->firstOrFail();
        // TAMBAHKAN BARIS INI UNTUK DEBUG
        // dd(storage_path('app/private/foto/siswa/' . basename($siswa->foto_siswa)));
        // Pengecekan keamanan tetap ada
        if ($siswa->status_pendaftaran != 'diverifikasi' || !$siswa->pembayaran || $siswa->pembayaran->status_pembayaran != 'diverifikasi') {
            abort(403, 'Akses Ditolak. Pendaftaran Anda belum lengkap.');
        }

        // --- Perubahan ada di sini ---
        // 1. Muat view yang akan dijadikan PDF
        $pdf = Pdf::loadView('siswa.kartu-peserta-cetak', ['siswa' => $siswa]);

        // 2. Buat nama file yang dinamis dan mulai download
        return $pdf->download('kartu-peserta-' . $siswa->nomor_pendaftaran . '.pdf');
    }

    public function verifikasi(Siswa $siswa)
    {
        // Mengubah status pendaftaran menjadi 'berkas_lengkap'
        $siswa->status_pendaftaran = 'diverifikasi';
        $siswa->save();

        // 2. Kirim email notifikasi
        $calonSiswa = $siswa;

        if ($siswa && $siswa->user) {
            $pesan = 'Selamat! Berkas pendaftaran Anda telah kami verifikasi dan dinyatakan lengkap. Silakan tunggu informasi selanjutnya.';
            Mail::to($siswa->user->email)->send(new StatusPendaftaranMail($siswa, $pesan));
        }

        // 3. Redirect
        return redirect()->back()->with('success', 'Pendaftaran siswa berhasil diverifikasi dan email notifikasi telah dikirim.');
    }

    /**
     * Fungsi untuk menolak pendaftaran siswa.
     */
    public function tolak(Siswa $siswa)
    {
        // Mengubah status pendaftaran menjadi 'berkas_tidak_lengkap'
        $siswa->status_pendaftaran = 'ditolak';
        $siswa->save();

        // 2. Kirim email notifikasi
        if ($siswa && $siswa->user) {
            $pesan = 'Mohon maaf, setelah kami periksa, terdapat kekurangan pada berkas pendaftaran Anda. Silakan periksa kembali data Anda atau hubungi panitia.';
            Mail::to($siswa->user->email)->send(new StatusPendaftaranMail($siswa, $pesan));
        }

        // 3. Redirect
        return redirect()->back()->with('success', 'Pendaftaran siswa berhasil ditolak dan email notifikasi telah dikirim.');
    }
}
