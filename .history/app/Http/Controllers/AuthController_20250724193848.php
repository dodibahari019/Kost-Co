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
                'id_user' => $user->id_user,
                'nama'    => $user->nama,
                'role'    => $role,
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

    public function register(Request $request){
        try{
            $tanggalHariIni = Carbon::now()->format('Y-m-d');
            $validated = $request->validate([
                'username'      => 'required|string|max:50',
                'password'      => 'required|string|min:6',
                'noKTP'         => 'required|string',
                'fotoKTP'       => 'required|image|mimes:jpg,jpeg,png|max:2048', // maksimal 2MB
                'namaLengkap'   => 'required|string|max:100',
                'fotoKaryawan'  => 'required|image|mimes:jpg,jpeg,png|max:2048',
                'email'         => 'required|email|max:100',
                'noHp'          => 'required|string|max:15',
                'jabatan'       => 'required|string|max:10',
                'alamat'        => 'required|string|max:255',
            ]);

            // Cari ID terakhir
            $lastDataUsers = DataUsers::orderBy('Id_DataUser', 'desc')->first();

            if ($lastDataUsers) {
                $lastNumber = (int)substr($lastDataUsers->Id_DataUser, 3); // Ambil angka dari 'SUP001'
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }

            $newId = 'USR' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
            $tipeUser = TipeUser::where('Tipe_User', 'Karyawan')->first();
            if (!$tipeUser) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tipe user Customer tidak ditemukan.',
                ]);
            }

            // Proses upload foto
            $fotoKTP = null;
            $fotoKaryawan = null;
            if ($request->hasFile('fotoKTP')) {
                $fotoKTP = $request->file('fotoKTP')->store('FotoKTPKaryawan', 'public');
            }

            if ($request->hasFile('fotoKaryawan')) {
                $fotoKaryawan = $request->file('fotoKaryawan')->store('FotoKaryawan', 'public');
            }

            DataUsers::create([
                'Id_DataUser'        => $newId,
                'Id_TipeUser'        => $tipeUser->Id_TipeUser,
                'Id_Jabatan'         => $validated['jabatan'],
                'Username'           => $validated['username'],
                'Password'           => bcrypt($validated['password']), // hash!
                'Nama_Lengkap'       => $validated['namaLengkap'],
                'No_KTP'             => $validated['noKTP'],
                'Email'              => $validated['email'],
                'No_Hp'              => $validated['noHp'],
                'Alamat'             => $validated['alamat'],
                'Foto_Profil'        => $fotoKaryawan,
                'Foto_KTP'           => $fotoKTP,
                'Google_Id'          => null,
                'Email_Verified_At'  => null,
                'No_Hp_Verified_At'  => null,
                'remember_token'     => null,
            ]);

            // return response()->json([
            //     'success' => true,
            //     'message' => 'Data Suku Cadang berhasil disimpan!',
            //     'id'      => $newId
            // ]);

            return redirect()->back();
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage(),
            ]);
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
