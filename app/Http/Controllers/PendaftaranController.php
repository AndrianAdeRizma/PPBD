<?php

namespace App\Http\Controllers;

use App\Models\CalonSiswa;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    // Menampilkan halaman formulir pendaftaran
    public function create()
    {
        return view('pendaftaran.form');
    }

    // Menyimpan data dari formulir
    // app/Http/Controllers/PendaftaranController.php

    public function store(Request $request)
    {
        // 1. Validasi Input (tambahkan validasi untuk file)
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nisn' => 'required|string|unique:calon_siswa,nisn',
            // ... validasi lainnya
            'foto_siswa' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validasi file
        ]);

        // 2. Proses Upload File
        $pathFoto = null;
        if ($request->hasFile('foto_siswa')) {
            // Simpan file ke storage/app/public/fotos
            $pathFoto = $request->file('foto_siswa')->store('fotos', 'public');
        }

        // ... (kode untuk membuat nomor pendaftaran) ...
        $nomorPendaftaran = 'PPDB' . date('Y') . str_pad(CalonSiswa::count() + 1, 4, '0', STR_PAD_LEFT);

        // 3. Simpan data (termasuk path file) ke database
        $calonSiswa = new CalonSiswa();
        $calonSiswa->nomor_pendaftaran = $nomorPendaftaran;
        // ... (isi field lainnya dari $request) ...
        $calonSiswa->foto_siswa = $pathFoto; // Simpan path foto ke database
        $calonSiswa->save();

        // 4. Redirect ke halaman sukses
        return redirect()->route('pendaftaran.sukses')->with('nomor_pendaftaran', $nomorPendaftaran);
    }

    // Menampilkan halaman sukses
    public function sukses()
    {
        // Pastikan session 'nomor_pendaftaran' ada sebelum menampilkan halaman
        if (!session('nomor_pendaftaran')) {
            return redirect()->route('pendaftaran.form');
        }
        return view('pendaftaran.sukses');
    }
}
