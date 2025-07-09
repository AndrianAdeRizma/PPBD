<?php

namespace App\Http\Controllers;

use App\Models\User;
// use PhpParser\Node\Expr\Empty_;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

// use Illuminate\Support\Facades\DB;


class SocialiteController extends Controller
{

    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        // Google user object dari google
        // $userFromGoogle = Socialite::driver('google')->stateless()->user();
        try {
            $userFromGoogle = Socialite::driver('google')->user();
            // Lanjutkan dengan menggunakan $userFromGoogle
            // dd($userFromGoogle); // Contoh: menampilkan informasi user dari Google
        } catch (\Exception $e) {
            // Tangani error jika otentikasi gagal
            dd("Terjadi kesalahan saat login dengan Google: " . $e->getMessage());
        }
        // Ambil user dari database berdasarkan google user id
        $userFromDatabase = User::where('google_id', $userFromGoogle->getId())->first();

        // Jika tidak ada user, maka buat user baru
        if (!$userFromDatabase) {

            DB::beginTransaction();

            try {
                $newUser = User::create([
                    'google_id' => $userFromGoogle->getId(),
                    'email' => $userFromGoogle->getEmail(),
                    'role' => 'siswa',
                    'password' => null,
                    'remember_token' => null,
                    'created_at' => date('Y-m-d')
                ]);

                // User::create([
                //     'auth_id' => $newUser->id_auth,
                //     'nama' => $userFromGoogle->getName(),
                // 'created_at' => date('Y-m-d')
                // ]);

                DB::commit();
            } catch (\Throwable $th) {
                DB::rollBack();
                dd($th);
                die;
                return redirect()->back()->with(['error' => 'Something Went Wrong!']);
            }

            // Login user yang baru dibuat
            auth('web')->login($newUser);
            session()->regenerate();

            return redirect('dashboard');
        }

        // Jika ada user langsung login saja
        auth('web')->login($userFromDatabase);
        session()->regenerate();

        return redirect('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('landingpage');
    }
}
