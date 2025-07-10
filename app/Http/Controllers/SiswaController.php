<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CalonSiswa as Siswa;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

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
}
