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

class TPindahKamarController extends Controller
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
        $tanggalHariIni = Carbon::now()->format('Y-m-d');
        $data = Pembayaran::select([
            'pembayaran.id_pembayaran',
            'pembayaran.tanggal_pembayaran',
            'pembayaran.nominal',
            'pembayaran.periode',
            'pembayaran.status_pembayaran',
            'pembayaran.tipe_pembayaran',

            'penghuni.id_user as id_penghuni',
            'penghuni.status_penghuni',
            'datausers.nama as nama_penghuni',
            'datausers.no_ktp as ktp_penghuni',
            'datausers.no_hp as hp_penghuni',
            'datausers.email as email_penghuni',

            'kamar.id_kamar',
            'kamar.nomor_kamar',
            'kamar.ukuran',
            'kamar.tipe',
            'kamar.harga_sewa',
            'kamar.status_kamar',
            'kamar.tanggal_mulai_sewa',
            'kamar.tanggal_selesai_sewa',
        ])
        ->join('penghuni', 'penghuni.id_user', '=', 'pembayaran.id_penghuni')
        ->join('datausers', 'datausers.id_user', '=', 'penghuni.id_user')

        ->join('kamar', 'kamar.id_penghuni', '=', 'penghuni.id_user')
        ->get();
        return view('Menu.PengajuanPindahKamar.index', compact('tanggalHariIni', 'idUser', 'namaLengkap', 'tipeUser'));
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
        //
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
