<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrtuSiswa extends Model
{
    protected $table = 'ortu_siswa'; // ← tambahkan ini
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_ayah',
        'tanggal_lahir_ayah',
        'pekerjaan_ayah',
        'dokumen_ktp_ayah',
        'nama_ibu',
        'tanggal_lahir_ibu',
        'pekerjaan_ibu',
        'dokumen_ktp_ibu',
        'nomor_telepon_ortu',
        'nama_wali',
        'tanggal_lahir_wali',
        'pekerjaan_wali',
        'nomor_telepon_wali',
        'dokumen_ktp_wali',
    ];
    public function siswa()
    {
        return $this->hasMany(CalonSiswa::class, 'ortu_id');
    }
}
