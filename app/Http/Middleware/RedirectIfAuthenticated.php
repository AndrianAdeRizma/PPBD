<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response; // Tidak perlu Crypt jika hanya back()

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Pengguna sudah login
                $user = Auth::guard($guard)->user();


                // dd('Nilai Role Pengguna dari DB:', $user->role, 'URL Saat Ini:', $request->fullUrl());

                // Cek apakah ada intended URL. Jika ada, prioritaskan itu.
                $redirectTo = session()->pull('url.intended', null);
                if ($redirectTo) {
                    return redirect($redirectTo);
                }

                // Jika tidak ada intended URL:
                // Prioritaskan pengarahan berdasarkan peran.
                // Jika peran adalah 'admin', arahkan ke dashboard admin.


                // Untuk peran lain, termasuk 'siswa' atau peran lainnya,
                // Arahkan kembali ke halaman sebelumnya.
                // Ini akan menangani semua kasus selain admin dan intended URL.
                // Sangat penting untuk memastikan halaman sebelumnya valid dan tidak memicu loop.
                return redirect()->back();

                // Catatan: Baris 'return redirect(RouteServiceProvider::HOME);' dihapus
                // karena redirect()->back() menjadi fallback utama untuk non-admin.
            }
        }

        return $next($request);
    }
}
