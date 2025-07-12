<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use Illuminate\Http\Request;
use App\Mail\GraduationEmail;
use Illuminate\Validation\Rule;
use App\Models\CalonSiswa as Siswa;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class NilaiController extends Controller
{
    public function index()
    {
        // PENTING: Eager load relasi 'nilai' dan 'pembayaran'
        // agar data nilai dan status pembayaran bisa diakses di view
        // dan Alpine.js bisa mendapatkan nilai_tes_id dari $siswa->nilai->id
        $calonSiswa = Siswa::with('nilai', 'pembayaran')->get();
        return view('nilai.index', compact('calonSiswa'));
    }

    public function getNilaiSiswa($id)
    {
        try {
            $calonSiswaId = Crypt::decryptString($id);
        } catch (DecryptException $e) {
            abort(404, 'ID calon siswa tidak valid.'); // Pesan lebih deskriptif
        }

        $siswa = Siswa::with('nilai')->where('id', $calonSiswaId)->firstOrFail();;

        return view(
            'nilai.nilai-siswa',
            [
                'title' => 'Nilai Siswa',
                'siswa' => $siswa,
            ]
        );
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'calon_siswa_id' => 'required|exists:calon_siswa,id',
            'jumlah_nilai' => 'required|numeric|min:0|max:999.99',
            'keterangan' => ['required', Rule::in(['Mencukupi', 'Tidak Mencukupi'])], // Gunakan Rule::in
        ]);

        // Cek apakah sudah ada nilai tes untuk calon siswa ini
        $nilaiTesExist = Nilai::where('calon_siswa_id', $validatedData['calon_siswa_id'])->first();

        if ($nilaiTesExist) {
            // Jika sudah ada, kembalikan dengan error dan data lama, serta flag untuk membuka modal
            // Ini akan memicu modal terbuka kembali dengan pesan error
            return back()->withErrors(['calon_siswa_id' => 'Nilai untuk siswa ini sudah ada. Gunakan tombol edit.'])
                ->withInput()
                ->with('open_modal_on_error', true)
                ->with('nilai_tes_id', $nilaiTesExist->id); // Kirim ID nilai yang sudah ada
        }

        // Jika belum ada, buat record baru
        Nilai::create($validatedData);

        return redirect()->route('nilai.index')->with('success', 'Nilai seleksi berhasil disimpan!');
    }

    public function update(Request $request, Nilai $nilai) // Ubah parameter dari $nilaiTes menjadi $nilai agar sesuai dengan Route Model Binding ke model Nilai
    {
        // Untuk memastikan modal terbuka kembali setelah error validasi,
        // kita perlu menyimpan nilai_tes_id (yang sekarang adalah nilai->id)
        // dan calon_siswa_id ke old()
        $request->merge([
            'nilai_tes_id' => $nilai->id, // Menggunakan $nilai->id
            'calon_siswa_id' => $nilai->calon_siswa_id,
        ]);

        $validatedData = $request->validate([
            'calon_siswa_id' => ['required', 'exists:calon_siswa,id'],
            'jumlah_nilai' => ['required', 'numeric', 'min:0',],
            'keterangan' => ['required', Rule::in(['Mencukupi', 'Tidak Mencukupi'])],
        ]);

        // Opsional: Pastikan calon_siswa_id yang dikirim sesuai dengan nilai yang diupdate
        if ($validatedData['calon_siswa_id'] != $nilai->calon_siswa_id) {
            return back()->withErrors(['calon_siswa_id' => 'ID Siswa tidak cocok dengan nilai yang akan diupdate.'])
                ->withInput()
                ->with('open_modal_on_error', true)
                ->with('nilai_tes_id', $nilai->id);
        }

        $nilai->update($validatedData); // Menggunakan $nilai

        return redirect()->route('nilai.index')->with('success', 'Nilai seleksi berhasil diperbarui!');
    }

    public function sendGraduationEmail(Request $request, $id)
    {
        try {
            // Mengambil data siswa beserta relasi nilainya
            $siswa = Siswa::with('nilai')->findOrFail($id);

            // Validasi: Pastikan siswa punya email
            if (empty($siswa->user->email)) {
                return redirect()->back()->with('error', 'Email siswa tidak ditemukan. Tidak dapat mengirim email.');
            }

            // Validasi: Pastikan siswa memiliki data nilai
            if (!$siswa->nilai) {
                return redirect()->back()->with('warning', 'Data nilai tes untuk siswa ini belum tersedia. Tidak dapat mengirim informasi kelulusan.');
            }

            // Kirim email
            Mail::to($siswa->user->email)->send(new GraduationEmail($siswa, $siswa->nilai));

            $status = strtolower($siswa->nilai->keterangan) === 'mencukupi' ? 'lulus' : 'tidak_lulus';

            // Update status kelulusan di database
            $siswa->update(['status_kelulusan' => $status]);

            return redirect()->back()->with('success', 'Email informasi kelulusan berhasil dikirim ke ' . $siswa->nama_lengkap . ' dengan email ' . $siswa->user->email);
        } catch (\Exception $e) {
            // Log error untuk debugging
            Log::error('Error sending graduation email: ' . $e->getMessage(), ['exception' => $e, 'calon_siswa_id' => $id]);

            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengirim email: ' . $e->getMessage());
        }
    }
}
