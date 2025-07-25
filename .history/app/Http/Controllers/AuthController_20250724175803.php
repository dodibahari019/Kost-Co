<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

            $user = DataUsers::with('DataJabatan')
                    ->where('Username', $data['username'])
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
                'Username'     => $user->Username,
                'Nama_Lengkap' => $user->Username, //Nama_Lengkap,
                'Tipe_User'    => $role,
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
                'password'      => 'required|string|min:6',
            ]);

            $updateData = [
                'password'           => bcrypt($validated['password']), // hash!
            ];

            DataUsers::where('id_user', $idUser)->update($updateData);

            return redirect()->back();
    }
}
