<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            // Menambahkan kolom 'status' setelah kolom 'tanggal_pembayaran'
            // dalam file migrasi...
            $table->enum('status_pembayaran', ['pending', 'diverifikasi', 'ditolak'])->default('pending')->after('tanggal_pembayaran');
        });
    }

    public function down(): void
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            // Perintah untuk menghapus kolom jika migrasi di-rollback
            $table->dropColumn('status_pembayaran');
        });
    }
};
