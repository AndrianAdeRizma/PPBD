<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalonSiswa extends Model
{
    protected $table = 'calon_siswa';
    protected $primaryKey = 'id';
    protected $foreignKey = 'ortu_id';
    protected $fillable = [
        'user_id',
        'nomor_pendaftaran', //21 digit
        'nama_lengkap',
        'nisn',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'nomor_telepon',
        'asal_sekolah',
        'alamat',
        'foto_siswa',
        'dokumen_akta',
        'dokumen_ijazah',
        'dokumen_kk',
        'dokumen_rapor',
        'status_pendaftaran',
        'status_kelulusan',
        'ortu_id', // jika menggunakan relasi
    ];

    public function ortu()
    {
        return $this->belongsTo(OrtuSiswa::class, $this->ortu_id);
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function nilai()
    {
        return $this->hasOne(Nilai::class, 'calon_siswa_id'); // Menggunakan calon_siswa_id
    }
}
