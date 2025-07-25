<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\DataUsers;

class AuthController extends Controller
{
    public function loginView(){
        return view('login');
    }

    public function registerView(){
        return view('register');
    }

    public function login(Request $request)
    {
        try {
            $data = $request->validate([
                'email'    => 'required|email',
                'password' => 'required|string',
            ]);

            // Ambil user dari DB
            $user = DataUsers::where('email', $data['email'])->first();

            // Cek keberadaan user dan password
            if (!$user || !Hash::check($data['password'], $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email atau password salah.',
                ], 401);
            }

            $role = null;
            if ($user->UsersPenghuni()->exists()) {
                $role = 'Penghuni';
            } elseif ($user->UsersPengurus()->exists()) {
                $role = 'Pengurus';
            } else {
                $role = 'unknown';
            }

            // Simpan session + login
            Auth::login($user);
            $request->session()->regenerate();

            session([
                session()->put('id_user', $user->id_user);
session()->put('nama', $user->nama);
session()->put('role', $role);

            ]);

            // Tentukan redirect
            $redirectMap = [
                'Penghuni' => '/list-kamar',
                'Pengurus' => '/',
            ];
            $redirectUrl = $redirectMap[$role] ?? '/';

            return response()->json([
                'success'  => true,
                'message'  => 'Login berhasil.',
                'redirect' => url($redirectUrl),
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout(); // logout user

        $request->session()->invalidate(); // hapus session
        $request->session()->regenerateToken(); // regen CSRF token

        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil',
        ]);
    }

    public function hash(Request $request){
        $validated = $request->validate([
            'password' => 'required|string|min:6',
        ]);

        $hashedPassword = Hash::make($validated['password']);

        // Update seluruh user dengan password yang sama (sudah di-hash)
        DataUsers::query()->update(['password' => $hashedPassword]);

        return redirect()->back()->with('success', 'Semua password berhasil di-hash!');
    }
}
