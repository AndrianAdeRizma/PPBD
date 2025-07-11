<?php
// app/Http/Controllers/PembayaranController.php
namespace App\Http\Controllers;

use App\Models\CalonSiswa;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\StatusPembayaranMail;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{

    public function index()
    {
        $pembayaran = Pembayaran::with('calonSiswa')->get();
        return view('pembayaran.index', compact('pembayaran'));
    }

    public function form()
    {
        $user = Auth::user()->calonSiswa;
        $siswa = CalonSiswa::where('id', $user->id)->first();
        $pembayaran = Pembayaran::where('calon_siswa_id', $siswa->id)->first();
        $isEditing = false;
        // dd($pembayaran->toArray());

        return view('pembayaran.form', compact('pembayaran', 'siswa', 'isEditing'));
    }

    public function submit(Request $request)
    {
        $request->validate([
            'nama_pemilik_rekening' => 'required|string|max:100',
            'nomor_rekening' => 'required|string|max:20',
            'bank' => 'required|string|max:50',
            'jumlah_bayar' => 'required|integer',
            'tanggal_pembayaran' => 'required|date',
            'bukti_pembayaran' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $siswa = Auth::user()->calonSiswa;

        // Simpan file ke storage
        $path = $request->file('bukti_pembayaran')->store('/bukti-pembayaran');

        try {
            $pembayaran = Pembayaran::updateOrCreate(
                ['calon_siswa_id' => $siswa->id],
                [
                    'nama_pemilik_rekening' => $request->nama_pemilik_rekening,
                    'nomor_rekening' => $request->nomor_rekening,
                    'bank' => $request->bank,
                    'jumlah_bayar' => $request->jumlah_bayar,
                    'tanggal_pembayaran' => $request->tanggal_pembayaran,
                    'bukti_pembayaran' => $path,
                ]
            );

            return redirect()->route('pembayaran.form')->with('success', 'Pembayaran berhasil dikirim.');
        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->route('pembayaran.form')->with('error', 'Terjadi kesalahan saat mengirim pembayaran.');
        }
    }
    public function edit()
    {
        $user = Auth::user()->calonSiswa;
        $siswa = CalonSiswa::where('id', $user->id)->first();
        $pembayaran = Pembayaran::where('calon_siswa_id', $siswa->id)->first();
        $isEditing = true;

        return view('pembayaran.form', compact('pembayaran', 'siswa', 'isEditing'));
    }

    public function update(Request $request)
    {
        $siswa = Auth::user()->calonSiswa;
        $pembayaran = $siswa->pembayaran;

        $data = $request->validate([
            'nama_pemilik_rekening' => 'required|string|max:100',
            'nomor_rekening' => 'required|string|max:20',
            'bank' => 'required|string|max:50',
            'jumlah_bayar' => 'required|integer',
            'tanggal_pembayaran' => 'required|date',
            'bukti_pembayaran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('bukti_pembayaran')) {
            $data['bukti_pembayaran'] = $request->file('bukti_pembayaran')->store('private/bukti-pembayaran');
        }

        // if (!$pembayaran) {
        //     $siswa->pembayaran()->create($data);
        // } else {
        //     $pembayaran->update($data);
        // }

        $pembayaran->update($data);

        return redirect()->route('pembayaran.form')->with('success', 'Data pembayaran berhasil diperbarui.');
    }

    public function verifikasi(Pembayaran $pembayaran)
    {
        $pembayaran->status_pembayaran = 'diverifikasi'; // atau 'lunas'
        $pembayaran->save();

        // Kirim email notifikasi
        $calonSiswa = $pembayaran->calonSiswa;

        if ($calonSiswa && $calonSiswa->user) {
            $pesan = "Pembayaran Anda sejumlah Rp " . number_format($pembayaran->jumlah_bayar) . " telah kami konfirmasi. Terima kasih.";
            // Menggunakan relasi 'calonSiswa'
            Mail::to($calonSiswa->user->email)->send(new StatusPembayaranMail($pembayaran, $pesan));
        }

        return redirect()->back()->with('success', 'Pembayaran berhasil diverifikasi dan email notifikasi telah dikirim.');
    }

    /**
     * Fungsi untuk menolak pembayaran.
     */
    public function tolak(Pembayaran $pembayaran)
    {
        $pembayaran->status_pembayaran = 'ditolak'; // atau 'ditolak'
        $pembayaran->save();

        // Kirim email notifikasi
        $calonSiswa = $pembayaran->calonSiswa;
        if ($calonSiswa && $calonSiswa->user) {
            $pesan = "Mohon maaf, pembayaran Anda kami tolak. Silakan hubungi panitia untuk informasi lebih lanjut.";
            // Menggunakan relasi 'calonSiswa'
            Mail::to($calonSiswa->user->email)->send(new StatusPembayaranMail($pembayaran, $pesan));
        }

        return redirect()->back()->with('success', 'Pembayaran berhasil ditolak dan email notifikasi telah dikirim.');
    }
}
