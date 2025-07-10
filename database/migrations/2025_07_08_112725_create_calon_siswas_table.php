<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('calon_siswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('ortu_id')->constrained('ortu_siswa')->onDelete('cascade');
            $table->string('nomor_pendaftaran', 50)->unique();
            $table->string('nama_lengkap', 100);
            $table->string('nisn', 10)->unique();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('tempat_lahir', 50);
            $table->date('tanggal_lahir');
            $table->string('agama', 20);
            $table->text('alamat');
            $table->string('nomor_telepon', 15);
            $table->string('asal_sekolah', 100);
            $table->string('foto_siswa', 255)->nullable();
            $table->string('dokumen_akta', 255)->nullable();
            $table->string('dokumen_ijazah', 255)->nullable();
            $table->string('dokumen_kk', 255)->nullable();
            $table->string('dokumen_rapor', 255)->nullable();
            $table->enum('status_pendaftaran', ['pending', 'diverifikasi', 'diterima', 'ditolak'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calon_siswa');
    }
};
