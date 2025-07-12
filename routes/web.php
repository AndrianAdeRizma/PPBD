<?php

use App\Livewire\FormPendaftaran;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\socialiteController as socialite;

// Route untuk Halaman Depan
Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('landing.index');
    });

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::get('login/google/redirect', [socialite::class, 'redirect'])->name('redirect');
Route::get('login/google/callback', [socialite::class, 'callback'])->name('callback');
Route::get('/pendaftaran', FormPendaftaran::class)->name('pendaftaran');

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'siswa'])->group(function () {

    Route::get('profile-siswa/{id}', [SiswaController::class, 'profile'])->name('profile.siswa');

    Route::controller(PembayaranController::class)
        ->prefix('pembayaran') // prefix rute untuk siswa
        ->name('pembayaran.') // nama rute untuk siswa
        ->group(function () {
            // Form pembayaran siswa
            // Route::get('/', [PembayaranController::class, 'index'])->name('index');
            Route::get('/form', [PembayaranController::class, 'form'])->name('form');
            Route::post('/submit', [PembayaranController::class, 'submit'])->name('submit');
            Route::get('/edit', [PembayaranController::class, 'edit'])->name('edit');
            Route::put('/update', [PembayaranController::class, 'update'])->name('update');
            // Route::patch('/{pembayaran}/verifikasi', [PembayaranController::class, 'verifikasi'])->name('verifikasi');
            // Route::patch('/{pembayaran}/tolak', [PembayaranController::class, 'tolak'])->name('tolak');

        });

    Route::controller(SiswaController::class)
        ->prefix('siswa') // prefix rute untuk siswa
        ->name('siswa.') // nama rute untuk siswa
        ->group(function () {
            Route::get('/kartu-peserta', [SiswaController::class, 'kartuPeserta'])->name('kartu.peserta');
            Route::get('/kartu-peserta/cetak', [SiswaController::class, 'cetakKartuPeserta'])->name('cetak.kartu.peserta');
        });
});

// Route khusus untuk Admin
Route::middleware(['auth', 'admin'])->group(function () {

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
            Route::patch('/{siswa}/verifikasi', [SiswaController::class, 'verifikasi'])->name('verifikasi');
            Route::patch('/{siswa}/tolak', [SiswaController::class, 'tolak'])->name('tolak');
        });

    Route::controller(PembayaranController::class)
        ->prefix('pembayaran') // prefix rute untuk siswa
        ->name('pembayaran.') // nama rute untuk siswa
        ->group(function () {
            Route::get('/', [PembayaranController::class, 'index'])->name('index');
            Route::patch('/{pembayaran}/verifikasi', [PembayaranController::class, 'verifikasi'])->name('verifikasi');
            Route::patch('/{pembayaran}/tolak', [PembayaranController::class, 'tolak'])->name('tolak');
        });
});

Route::get('/preview-temp/{filename}', function ($filename) {
    $path = storage_path('app/private/bukti-pembayaran/' . $filename);

    \Illuminate\Support\Facades\Log::info("Coba buka file di path: " . $path);

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
        abort(404, 'File tidak ditemukan');
    }

    return response()->file($path);
})->name('foto.siswa');


Route::get('/bukti-pembayaran/{filename}', function ($filename) {
    $path = storage_path('app/private/bukti-pembayaran/' . $filename);

    // Log::info("Coba buka file di path: " . $path);

    if (!file_exists($path)) {
        abort(404, 'File tidak ditemukan.');
    }

    return response()->file($path);
})->where('filename', '.*')->name('pembayaran.bukti');
