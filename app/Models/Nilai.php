<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'nilai_tes';
    protected $primaryKey = 'id';
    protected $foreignKey = 'calon_siswa_id';
    protected $fillable = [
        'calon_siswa_id',
        'jumlah_nilai',
        'nilai',
        'keterangan',
    ];

    public function calonSiswa()
    {
        return $this->belongsTo(CalonSiswa::class, 'calon_siswa_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
