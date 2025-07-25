<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function login(Request $request){
        try {
            $data = $request->validate([
                'email' => 'required|string',
                'password' => 'required|string',
            ]);

            $user = DataUsers::where('email', $data['email'])
                    ->first();

            if (!$user || !Hash::check($data['password'], $user->Password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak terdaftar.',
                ], 401);
            }

            /* -------------------------------
            2. Simpan info user di session
            --------------------------------*/
            $role = $user->DataJabatan->Nama_Jabatan ?? 'unknown';
            session([
                'Id_DataUser'  => $user->Id_DataUser,
                'username'     => $user->Username,
                'nama' => $user->Username, //Nama_Lengkap,
            ]);
            /* -------------------------------
            1. Login & buat session
            --------------------------------*/
            Auth::login($user);
            $request->session()->regenerate();


            /* -------------------------------
            3. Tentukan URL redirect berdasarkan role
            --------------------------------*/
            $redirectMap = [
                'CEO'               => '/setting-users',
                'Bagian Keuangan'   => '/pemasukan',
                'Divisi Operasional'=> '/master-supplier',
                'Divisi Pemasaran'  => '/tukar-tambah',
                'Teknisi'           => '/pengecekan',
                'Developer'         => '/setting-users',
            ];

            $redirectUrl = $redirectMap[$role] ?? '/';

            /* -------------------------------
            4. Kirim respons ke frontend
            --------------------------------*/
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
