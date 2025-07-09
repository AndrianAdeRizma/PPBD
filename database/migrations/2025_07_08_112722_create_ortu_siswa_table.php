<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ortu_siswa', function (Blueprint $table) {
            $table->id();

            // Data Ayah
            $table->string('nama_ayah', 100)->nullable();
            $table->date('tanggal_lahir_ayah')->nullable();
            $table->string('pekerjaan_ayah', 50)->nullable();

            // Data Ibu
            $table->string('nama_ibu', 100)->nullable();
            $table->date('tanggal_lahir_ibu')->nullable();
            $table->string('pekerjaan_ibu', 50)->nullable();

            // Kontak dan Dokumen Orang Tua
            $table->string('nomor_telepon_ortu', 15)->nullable();
            $table->string('dokumen_ktp_ayah', 255)->nullable();
            $table->string('dokumen_ktp_ibu', 255)->nullable();

            // Data Wali (opsional)
            $table->string('nama_wali', 100)->nullable();
            $table->date('tanggal_lahir_wali')->nullable();
            $table->string('pekerjaan_wali', 50)->nullable();
            $table->string('nomor_telepon_wali', 15)->nullable();
            $table->string('dokumen_ktp_wali', 255)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ortu_siswa');
    }
};
