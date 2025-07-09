<?php

use App\Livewire\FormPendaftaran;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\AuthController;

use Illuminate\Support\Facades\Response;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\AdminController; // Nanti kita buat
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileController;


// Route untuk Halaman Depan
Route::get('/', function () {
    return view('landing.index');
});

Route::get('/tes', function () {
    return view('test');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/admin', function () {
    return 'Halo Admin!';
})->middleware('auth');


Route::get('/pendaftaran', FormPendaftaran::class)->name('pendaftaran');
Route::get('/pendaftaran/sukses', function () {
    return view('pendaftaran-sukses');
})->name('pendaftaran.sukses');

// Route untuk Pendaftaran Siswa
Route::get('/daftar', [PendaftaranController::class, 'create'])->name('pendaftaran.form');
Route::post('/daftar', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
// Route::get('/daftar/sukses', [PendaftaranController::class, 'sukses'])->name('pendaftaran.sukses');

// Route khusus untuk Admin
Route::middleware(['auth'])->group(function () {

    // Route untuk Dashboard Bawaan Breeze (sudah ada)
    Route::controller(DashboardController::class)->prefix('dashboard')->group(function () {
        Route::get('/', 'index')->name('dashboard');
    });

    // Route untuk Halaman data calon siswa
    Route::controller(SiswaController::class)
        ->prefix('siswa') // prefix rute untuk siswa
        ->name('siswa.') // nama rute untuk siswa
        ->group(function () {
            Route::get('/', 'index')->name('index');              // GET /siswa
            Route::post('/', 'create')->name('create');             // POST /siswa
            Route::get('/detail/{id}', 'detail')->name('detail');     // GET /siswa/detail/{id}
            Route::put('/{id}', 'update')->name('update');        // PUT /siswa/{id}
            Route::delete('/{id}', 'delete')->name('delete');   // DELETE /siswa/{id}
            Route::get('/edit/{id}', 'edit')->name('edit');
        });
});

Route::get('/preview-temp/{filename}', function ($filename) {
    $path = storage_path('app/livewire-tmp/' . $filename);

    if (!file_exists($path)) {
        abort(404, 'File tidak ditemukan');
    }

    return Response::make(file_get_contents($path), 200, [
        'Content-Type' => mime_content_type($path),
        'Content-Disposition' => 'inline; filename="' . $filename . '"',
    ]);
})->name('preview.temp');

Route::get('/dokumen/rapor/{namaFile}', [FileController::class, 'tampilkanDokumen'])->name('rapor.tampil');

Route::get('/siswa/{siswa}/dokumen/{jenis}', [
    FileController::class,
    'unduhDokumenSiswa'
])->name('dokumen.siswa.unduh');

Route::get('/ortu/{ortu}/dokumen/{jenis}', [
    FileController::class,
    'unduhDokumenOrtu'
])->name('dokumen.ortu.unduh');

Route::get('/foto/siswa/{filename}', function ($filename) {
    $path = storage_path('app/private/foto/siswa/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path);
})->name('foto.siswa');
