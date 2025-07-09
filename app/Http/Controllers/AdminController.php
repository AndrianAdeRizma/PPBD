<?php

namespace App\Http\Controllers;

use App\Models\CalonSiswa;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $pendaftar = CalonSiswa::orderBy('created_at', 'desc')->get();
        return view('admin.pendaftar.index', ['pendaftar' => $pendaftar]);
    }

    // Method baru untuk menampilkan detail
    public function show($id)
    {
        $siswa = CalonSiswa::findOrFail($id);
        return view('admin.pendaftar.show', ['siswa' => $siswa]);
    }

    // Method baru untuk update status
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_pendaftaran' => 'required|in:pending,diverifikasi,diterima,ditolak',
        ]);

        $siswa = CalonSiswa::findOrFail($id);
        $siswa->status_pendaftaran = $request->status_pendaftaran;
        $siswa->save();

        return redirect()->route('admin.pendaftar.show', $id)->with('sukses', 'Status pendaftaran berhasil diperbarui!');
    }
}
