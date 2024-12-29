<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Pengguna;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Cari pengguna berdasarkan email
        $user = Pengguna::where('email', $request->input('email'))->first();

        // Periksa apakah pengguna ditemukan dan password cocok
        if ($user && Hash::check($request->input('password'), $user->password)) {
            // Simpan data pengguna ke sesi manual
            session([
                'user_id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
            ]);

            // Redirect ke halaman forum
            return redirect()->route('forumdiskusi')->with('success', 'Login successful.');
        }

        // Jika login gagal
        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->onlyInput('email'); // Hanya simpan input email untuk kenyamanan pengguna
    }



    public function logout()
    {
        // Invalidate the session and regenerate the CSRF token
        session()->invalidate();
        session()->regenerateToken();

        // Optionally, destroy the session data (if needed)
        // session()->flush();

        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }

}
