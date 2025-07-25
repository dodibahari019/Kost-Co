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
        return view('Menu.PengajuanPindahKamar.index', compact('tanggalHariIni', 'idUser', 'namaLengkap', 'tipeUser', 'data'));
    }

    public function viewPengajuanPindahKamar()
    {
        return view('Menu.Pengajuan.Data.table');
    }

    public function getViewPengajuanPindahKamar()
    {
        $tanggalHariIni = Carbon::now()->format('Y-m-d');
        $data = Penghuni::select([
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
        ->join('datausers', 'datausers.id_user', '=', 'penghuni.id_user')
        ->get();


        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $main = '<button type="button" action="/pengelolaan-penghuni/edit/'.$row->id_penghuni.'" style="width:30px; height:30px; display: flex; justify-content: center; align-items: center;" class="btn btn-warning bg-gradient-warning modal-crud" id="data-edit-form-btn" title="Data | Edit Form">
                    <i class="nav-icon fas fa-edit"></i>
                </button>';

                return '<div style="display: flex; flex-direction: row; justify-content: center; align-items: center;">
                        '. $main .'
                        </div>';
                })
            ->rawColumns(['action'])
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
