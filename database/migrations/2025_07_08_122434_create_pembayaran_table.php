<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel calon_siswa
            $table->foreignId('calon_siswa_id')->constrained('calon_siswa')->onDelete('cascade');
            // Informasi Pembayaran
            $table->string('nama_pemilik_rekening', 100);
            $table->string('nomor_rekening', 20);
            $table->string('bank', 50);
            $table->integer('jumlah_bayar');
            $table->string('bukti_pembayaran', 255);
            $table->date('tanggal_pembayaran');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
