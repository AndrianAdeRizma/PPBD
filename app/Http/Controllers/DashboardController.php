<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\CalonSiswa as Siswa;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCalon = Siswa::count();
        $totalDiterima = Siswa::where('status_pendaftaran', 'diterima')->count();
        $totalDitolak = Siswa::where('status_pendaftaran', 'ditolak')->count();

        $jumlahPerTahun = Siswa::selectRaw('YEAR(created_at) as tahun, COUNT(*) as total')
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->pluck('total', 'tahun');

        $jenisKelamin = Siswa::selectRaw("jenis_kelamin, COUNT(*) as total")
            ->groupBy('jenis_kelamin')
            ->pluck('total', 'jenis_kelamin');

        // dd($jenisKelamin);

        $usiaRata2 = round(
            Siswa::get()
                ->filter(fn($s) => $s->tanggal_lahir)
                ->avg(fn($s) => Carbon::parse($s->tanggal_lahir)->age),
            1
        );

        return view('dashboard', compact(
            'totalCalon',
            'totalDiterima',
            'totalDitolak',
            'jumlahPerTahun',
            'jenisKelamin',
            'usiaRata2'
        ));
    }
}
