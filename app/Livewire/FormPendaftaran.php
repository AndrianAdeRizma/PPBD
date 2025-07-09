<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\OrtuSiswa;
use App\Models\CalonSiswa;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class FormPendaftaran extends Component
{
    use WithFileUploads;

    public $step = 1;

    // Data Siswa
    public $nama_lengkap, $nisn, $jenis_kelamin,
        $tempat_lahir, $tanggal_lahir, $agama, $alamat,
        $nomor_telepon, $asal_sekolah, $foto_siswa,
        $dokumen_akta, $dokumen_ijazah, $dokumen_kk, $dokumen_rapor;

    // Data Orang Tua
    public $nama_ayah, $tanggal_lahir_ayah, $pekerjaan_ayah, $dokumen_ktp_ayah;
    public $nama_ibu, $tanggal_lahir_ibu, $pekerjaan_ibu, $dokumen_ktp_ibu;
    public $nomor_telepon_ortu;

    // Data Wali (Opsional)
    public $nama_wali, $tanggal_lahir_wali, $pekerjaan_wali, $nomor_telepon_wali, $dokumen_ktp_wali;

    public function render()
    {
        return view('livewire.form-pendaftaran');
    }

    public function nextStep()
    {
        if ($this->step === 1) {
            $rules = [
                'nama_lengkap' => 'required|string|max:255',
                'nisn' => 'required|string|digits:10|unique:calon_siswa,nisn',
                'jenis_kelamin' => 'required',
                'tempat_lahir' => 'required|string|max:100',
                'tanggal_lahir' => 'required|date',
                'agama' => 'required',
                'alamat' => 'required',
                'nomor_telepon' => 'required|string',
                'asal_sekolah' => 'required|string',

                'foto_siswa' => 'required|file|image|max:2048',
                'dokumen_akta' => 'required|file|mimes:pdf|max:2048',
                'dokumen_ijazah' => 'required|file|mimes:pdf|max:2048',
                'dokumen_kk' => 'required|file|mimes:pdf|max:2048',
                'dokumen_rapor' => 'required|file|mimes:pdf|max:2048',
            ];

            $messages = [
                'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
                'nisn.required' => 'NISN wajib diisi.',
                'nisn.unique' => 'NISN sudah terdaftar.',
                'nisn.string' => 'NISN harus berupa angka.',
                'nisn.max' => 'NISN tidak boleh lebih dari 10 karakter.',
                'nisn.digits' => 'NISN harus terdiri dari 10 angka.',
                'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
                'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
                'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
                'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',
                'agama.required' => 'Agama wajib diisi.',
                'alamat.required' => 'Alamat wajib diisi.',
                'nomor_telepon.required' => 'Nomor telepon siswa wajib diisi.',
                'asal_sekolah.required' => 'Asal sekolah wajib diisi.',

                'foto_siswa.required' => 'Foto siswa wajib diunggah.',
                'foto_siswa.image' => 'Foto siswa harus berupa file gambar.',
                'foto_siswa.max' => 'Ukuran foto siswa tidak boleh lebih dari 2MB.',

                'dokumen_akta.required' => 'Dokumen akta kelahiran wajib diunggah.',
                'dokumen_akta.mimes' => 'Format akta kelahiran harus PDF, JPG, atau PNG.',
                'dokumen_akta.max' => 'Ukuran dokumen akta kelahiran tidak boleh lebih dari 2MB.',

                'dokumen_ijazah.required' => 'Dokumen ijazah wajib diunggah.',
                'dokumen_ijazah.mimes' => 'Format dokumen ijazah harus PDF, JPG, atau PNG.',
                'dokumen_ijazah.max' => 'Ukuran dokumen ijazah tidak boleh lebih dari 2MB.',

                'dokumen_kk.required' => 'Dokumen kartu keluarga wajib diunggah.',
                'dokumen_kk.mimes' => 'Format kartu keluarga harus PDF, JPG, atau PNG.',
                'dokumen_kk.max' => 'Ukuran kartu keluarga tidak boleh lebih dari 2MB.',

                'dokumen_rapor.required' => 'Dokumen rapor wajib diunggah.',
                'dokumen_rapor.mimes' => 'Format rapor harus PDF, JPG, atau PNG.',
                'dokumen_rapor.max' => 'Ukuran dokumen rapor tidak boleh lebih dari 2MB.',
            ];

            Validator::make($this->all(), $rules, $messages)->validate();
            $this->resetValidation();
            $this->step++;
        }
    }

    public function previousStep()
    {
        $this->resetValidation();
        $this->step--;
    }

    public function submit()
    {
        $this->validate([
            'nama_ayah' => 'nullable|string',
            'nama_ibu' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {

            $ortu = OrtuSiswa::create([
                'nama_ayah' => $this->nama_ayah,
                'tanggal_lahir_ayah' => $this->tanggal_lahir_ayah,
                'pekerjaan_ayah' => $this->pekerjaan_ayah,
                'dokumen_ktp_ayah' => $this->dokumen_ktp_ayah ? $this->dokumen_ktp_ayah->store('dokumen/ortu') : null,
                'nama_ibu' => $this->nama_ibu,
                'tanggal_lahir_ibu' => $this->tanggal_lahir_ibu,
                'pekerjaan_ibu' => $this->pekerjaan_ibu,
                'dokumen_ktp_ibu' => $this->dokumen_ktp_ibu ? $this->dokumen_ktp_ibu->store('dokumen/ortu') : null,
                'nomor_telepon_ortu' => $this->nomor_telepon_ortu,
                'nama_wali' => $this->nama_wali,
                'tanggal_lahir_wali' => $this->tanggal_lahir_wali,
                'pekerjaan_wali' => $this->pekerjaan_wali,
                'nomor_telepon_wali' => $this->nomor_telepon_wali,
                'dokumen_ktp_wali' => $this->dokumen_ktp_wali ? $this->dokumen_ktp_wali->store('dokumen/ortu') : null,
            ]);

            $generatedNoRegistrasi = 'REG-' . now()->format('YmdHis') . rand(100, 999);

            CalonSiswa::create([
                'ortu_id' => $ortu->id,
                'nomor_pendaftaran' => $generatedNoRegistrasi,
                'nama_lengkap' => $this->nama_lengkap,
                'nisn' => $this->nisn,
                'jenis_kelamin' => $this->jenis_kelamin,
                'tempat_lahir' => $this->tempat_lahir,
                'tanggal_lahir' => $this->tanggal_lahir,
                'agama' => $this->agama,
                'alamat' => $this->alamat,
                'nomor_telepon' => $this->nomor_telepon,
                'asal_sekolah' => $this->asal_sekolah,
                'foto_siswa' => $this->foto_siswa ? $this->foto_siswa->store('foto/siswa') : null,
                'dokumen_akta' => $this->dokumen_akta ? $this->dokumen_akta->store('dokumen/siswa') : null,
                'dokumen_ijazah' => $this->dokumen_ijazah ? $this->dokumen_ijazah->store('dokumen/siswa') : null,
                'dokumen_kk' => $this->dokumen_kk ? $this->dokumen_kk->store('dokumen/siswa') : null,
                'dokumen_rapor' => $this->dokumen_rapor ? $this->dokumen_rapor->store('dokumen/siswa') : null,
            ]);

            DB::commit();

            session()->flash('message', 'Pendaftaran berhasil disimpan!');
            return redirect()->route('pendaftaran.berhasil');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal menyimpan pendaftaran: ' . $e->getMessage());
            session()->flash('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
            return redirect()->back();
        }
    }

    public function getPreviewAktaUrlProperty()
    {
        if ($this->dokumen_akta && $this->dokumen_akta->getClientOriginalExtension() === 'pdf') {
            $path = $this->dokumen_akta->storeAs('preview/akta', $this->dokumen_akta->getClientOriginalName(), 'public');
            return asset('storage/' . $path);
        }

        return null;
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, [
            'dokumen_kk',
            'foto_siswa',
            'dokumen_akta',
            'dokumen_rapor',
            'dokumen_ijazah',
            'dokumen_ktp_ayah',
            'dokumen_ktp_ibu',
            'dokumen_ktp_wali'
        ])) {
            $this->resetValidation($propertyName);
        }
    }
}
