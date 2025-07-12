<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StudentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Periksa apakah pengguna terautentikasi dan memiliki peran 'student'
        if (Auth::check() && Auth::user()->role === 'siswa') {
            return $next($request); // Lanjutkan ke request jika siswa
        }

        // Jika tidak, arahkan kembali atau berikan respons error
        // Contoh: Mengarahkan kembali ke halaman home dengan pesan error
        // return redirect('/')->with('error', 'Akses ditolak. Anda bukan siswa.');
        abort(403, 'Anda tidak memiliki izin untuk mengakses halaman ini.');

        // Atau, jika Anda ingin mengembalikan respons JSON untuk API:
        // return response()->json(['message' => 'Akses ditolak. Anda bukan siswa.'], 403);
    }
}
