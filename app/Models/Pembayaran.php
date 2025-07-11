<?php // app/Models/Pembayaran.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [
        'calon_siswa_id',
        'nama_pemilik_rekening',
        'nomor_rekening',
        'bank',
        'jumlah_bayar',
        'bukti_pembayaran',
        'tanggal_pembayaran',
        'status_pembayaran',
    ];

    public function calonSiswa()
    {
        return $this->belongsTo(CalonSiswa::class, 'calon_siswa_id');
    }
}
