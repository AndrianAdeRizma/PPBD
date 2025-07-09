<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalonSiswa extends Model
{
    protected $table = 'calon_siswa';
    protected $primaryKey = 'id';
    protected $foreignKey = 'ortu_id';
    protected $fillable = [
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
        'ortu_id', // jika menggunakan relasi
    ];

    public function ortu()
    {
        return $this->belongsTo(OrtuSiswa::class, $this->ortu_id);
    }
}
