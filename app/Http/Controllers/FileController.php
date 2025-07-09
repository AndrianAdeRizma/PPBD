<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\CalonSiswa as Siswa;
use App\Models\OrtuSiswa as Ortu;

class FileController extends Controller
{
    public function tampilkanDokumen($namaFile)
    {
        // Anda bisa menambahkan logika otorisasi di sini
        $path = 'private/dokumen/' . $namaFile; // Sesuaikan path-nya
        if (!Storage::exists($path)) {
            abort(404);
        }
        return response()->file(storage_path('app/' . $path));
    }

    public function unduhDokumenSiswa(Siswa $siswa, $jenis)
    {
        $path = null;
        $filename = null;

        // dd('Controller terpanggil', $siswa); // <--- TAMBAHKAN INI

        // Asumsi: Kolom di database hanya menyimpan NAMA FILE, bukan path lengkap.
        // Contoh: $siswa->dokumen_akta berisi "akta_siswa_123.pdf"

        switch ($jenis) {
            case 'akta':
                //  dd($siswa->dokumen_akta);
                $filename = $siswa->dokumen_akta;
                if ($filename) {
                    $path = $filename;
                }
                break;
            case 'ijazah':
                $filename = $siswa->dokumen_ijazah;
                if ($filename) {
                    $path = $filename;
                }
                break;
            case 'kk':
                $filename = $siswa->dokumen_kk;
                if ($filename) {
                    $path = $filename;
                }
                break;
            case 'rapor':
                $filename = $siswa->dokumen_rapor;
                if ($filename) {
                    $path = $filename;
                }
                break;
            case 'foto':
                $filename = $siswa->foto_siswa;
                if ($filename) {
                    // Sesuaikan dengan folder tempat foto disimpan
                    $path = 'private/dokumen/foto/' . $filename;
                }
                break;
            default:
                abort(404, 'Jenis dokumen tidak valid.');
        }

        // Cek jika path kosong atau file tidak ada
        if (!$path || !Storage::exists($path)) {
            abort(404, 'File tidak ditemukan.');
        }
        // dd($path);
        // Gunakan response()->file(), BUKAN response()->download()
        // Kirim file sebagai respons
        return response()->file(storage_path('app/private/' . $path));
    }

    public function unduhDokumenOrtu(Ortu $ortu, $jenis)
    {
        $path = null;
        $filename = null;

        // dd($ortu);

        switch ($jenis) {
            case 'ktp_ayah':
                $filename = $ortu->dokumen_ktp_ayah;
                if ($filename) {
                    $path = $filename;
                }
                break;
            case 'ktp_ibu':
                $filename = $ortu->dokumen_ktp_ibu;
                if ($filename) {
                    $path = $filename;
                }
                break;
            case 'ktp_wali':
                $filename = $ortu->dokumen_ktp_wali;
                if ($filename) {
                    $path = $filename;
                }
                break;
            default:
                abort(404, 'Jenis dokumen tidak valid.');
        }

        if (!$path || !Storage::exists($path)) {
            abort(404, 'File tidak ditemukan.');
        }



        return response()->file(storage_path('app/private/' . $path));
    }

    public function tampilFoto($filename)
    {
        $path = storage_path('app/private/' . $filename);

        if (!file_exists($path)) {
            abort(404, 'File tidak ditemukan');
        }

        return response()->file($path);
    }
}
