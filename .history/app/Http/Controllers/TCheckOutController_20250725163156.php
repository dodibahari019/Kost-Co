<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

use App\Models\DataUsers;
use App\Models\Penghuni;
use App\Models\Pengurus;
use App\Models\Kamar;
use App\Models\Pembayaran;
use App\Models\PindahKamar;
use App\Models\CheckOut;

class TCheckOutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tanggalHariIni = Carbon::now()->format('Y-m-d');
        $idUser = Session::get('id_user');
        $namaLengkap = Session::get('nama');
        $tipeUser = Session::get('role');

        $data = Kamar::select([
            'kamar.id_kamar',
            'kamar.nomor_kamar',
            'kamar.ukuran',
            'kamar.tipe',
            'kamar.harga_sewa',
            'kamar.status_kamar',
            'kamar.tanggal_mulai_sewa',
            'kamar.tanggal_selesai_sewa',

            'penghuni.id_user AS id_penghuni',
            'penghuni.status_penghuni',

            'datausers.nama',
            'datausers.no_ktp',
            'datausers.no_hp',
            'datausers.alamat',
            'datausers.email',
            'datausers.password',
            'datausers.tipe_user',
        ])
        ->join('penghuni', 'penghuni.id_user', '=', 'kamar.id_penghuni')
        ->join('datausers', 'datausers.id_user', '=', 'penghuni.id_user')
        ->where('penghuni.id_user', $idUser)
        ->get();

        $listOfKamar = Kamar::select([
            'kamar.id_kamar',
            'kamar.nomor_kamar',
            'kamar.ukuran',
            'kamar.tipe',
            'kamar.harga_sewa',
            'kamar.status_kamar',
            'kamar.tanggal_mulai_sewa',
            'kamar.tanggal_selesai_sewa',
        ])
        ->where('kamar.status_kamar', 'Tersedia')
        ->whereNull('kamar.id_penghuni')
        ->get();

        return view('Menu.PengajuanCheckout.index', compact('tanggalHariIni', 'idUser', 'namaLengkap', 'tipeUser', 'data', 'listOfKamar'));
    }

    public function viewPengajuanPindahKamar()
    {
        return view('Menu.PengajuanCheckout.Data.table');
    }

    public function getViewPengajuanPindahKamar()
    {
        $tanggalHariIni = Carbon::now()->format('Y-m-d');
        $idUser = Session::get('id_user');
        $data = PindahKamar::select([
            'pindahkamar.id_pindah',
            'pindahkamar.id_penghuni',
            // 'pindahkamar.id_pengurus',
            'pindahkamar.tanggal_ajuan',
            'pindahkamar.status_pindah',
            'pindahkamar.catatan',
            'pindahkamar.nomor_kamar_tujuan',

            'kamar.id_kamar',
            'kamar.nomor_kamar',
            'kamar.ukuran',
            'kamar.tipe',
            'kamar.harga_sewa',
            'kamar.status_kamar',
            'kamar.tanggal_mulai_sewa',
            'kamar.tanggal_selesai_sewa',

            'penghuni.id_user AS id_penghuni',
            'penghuni.status_penghuni',

            'datausers.nama',
            'datausers.no_ktp',
            'datausers.no_hp',
            'datausers.alamat',
            'datausers.email',
            'datausers.password',
            'datausers.tipe_user',
        ])
        ->join('kamar', 'kamar.id_penghuni', '=', 'pindahkamar.id_penghuni')
        ->join('penghuni', 'penghuni.id_user', '=', 'kamar.id_penghuni')
        ->join('datausers', 'datausers.id_user', '=', 'penghuni.id_user')
        ->where('pindahkamar.id_penghuni', $idUser)
        ->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $idUser = Session::get('id_user');
            $tanggalHariIni = Carbon::now()->format('Y-m-d');
            $validated = $request->validate([
                'kamarTujuan' => 'required|string|max:15',
                'catatan'   => 'nullable|string',
            ]);

            // Cari ID terakhir
            $lastTransaksi = PindahKamar::orderBy('id_pindah', 'desc')->first();

            if ($lastTransaksi) {
                $lastNumber = (int)substr($lastTransaksi->id_pindah, 3); // Ambil angka dari 'SUP001'
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }

            $newId = 'PKM' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

            PindahKamar::create([
                'id_pindah' => $newId,
                'id_penghuni' => $idUser,
                'nomor_kamar_tujuan' => $validated['kamarTujuan'],
                'id_pengurus' => null,
                'tanggal_ajuan' => $tanggalHariIni,
                'status_pindah' => 'Diajukan',
                'catatan' => $validated['catatan'],
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
