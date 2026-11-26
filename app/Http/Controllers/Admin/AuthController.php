<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login administrator.
     */
    public function showLoginForm(): View|RedirectResponse
    {
        if (Auth::check() && Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    /**
     * Memproses login administrator dengan validasi dan proteksi sesi.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate(
            [
                'email' => ['required', 'email'],
                'password' => ['required', 'string'],
            ],
            [
                'email.required' => 'Alamat email wajib diisi.',
                'email.email' => 'Format alamat email tidak valid.',
                'password.required' => 'Kata sandi wajib diisi.',
            ]
        );

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            if (! Auth::user()->is_admin) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()
                    ->withInput($request->only('email'))
                    ->withErrors(['email' => 'Akun ini tidak memiliki hak akses administrator.']);
            }

            $request->session()->regenerate();

            return redirect()
                ->intended(route('admin.dashboard'))
                ->with('success', 'Selamat datang kembali di Dashboard Admin Zahran Kopi!');
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => 'Email atau kata sandi tidak sesuai.']);
    }

    /**
     * Logout administrator dan menghapus sesi.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('admin.login')
            ->with('success', 'Anda telah berhasil keluar dari sesi administrator.');
    }
}
