<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Periksa apakah pengguna terautentikasi dan memiliki peran 'admin'
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request); // Lanjutkan ke request jika admin
        }

        // Jika tidak, arahkan kembali atau berikan respons error
        // Contoh: Mengarahkan kembali ke halaman home dengan pesan error
        abort(403, 'Anda tidak memiliki izin untuk mengakses halaman ini.');

        // Atau, jika Anda ingin mengembalikan respons JSON untuk API:
        // return response()->json(['message' => 'Akses ditolak. Anda bukan admin.'], 403);
    }
}
