<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('calon_siswa', function (Blueprint $table) {
            $table->enum('status_kelulusan', ['lulus', 'tidak_lulus', 'belum_ditentukan'])->default('belum_ditentukan')->after('status_pendaftaran');
        });
    }

    public function down(): void
    {
        Schema::table('calon_siswa', function (Blueprint $table) {
            $table->dropColumn('status_kelulusan');
        });
    }
};
