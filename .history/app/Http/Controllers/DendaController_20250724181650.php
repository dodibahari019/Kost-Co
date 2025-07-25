<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

use App\Models\Penghuni;
use App\Models\Kamar;
use App\Models\Denda;
use App\Models\Pembayaran;
use App\Models\Pengurus;
use App\Models\DataUsers;

class DendaController extends Controller
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
        return view('Menu.Denda.index', compact('tanggalHariIni'));
    }

    public function viewDenda()
    {
        return view('Menu.Denda.Data.table');
    }

    public function getViewDenda()
    {
        $tanggalHariIni = Carbon::now()->format('Y-m-d');
        $data = Denda::select([
            'denda.id_denda',
            'denda.id_pembayaran',
            'denda.tanggal_jatuh_tempo',
            'denda.jumlah_denda',
            'denda.status_denda',

            // 'id_pembayaran',
            'pembayaran.id_penghuni',
            'pembayaran.id_pengurus',
            'pembayaran.tanggal_pembayaran',
            'pembayaran.nominal',
            'pembayaran.periode',
            'pembayaran.status_pembayaran',
            'pembayaran.tipe_pembayaran',

            'datausers.id_user',
            'datausers.nama',
            'datausers.no_ktp',
            'datausers.no_hp',
            'datausers.alamat',
            'datausers.email',
            'datausers.password',
            'datausers.tipe_user',

            // 'penghuni.id_user',
            'penghuni.status_penghuni',

            // 'pengurus.id_user',
            'pengurus.jadwal_kerja',

            'kamar.id_kamar',
            // 'kamar.id_penghuni',
            'kamar.nomor_kamar',
            'kamar.ukuran',
            'kamar.tipe',
            'kamar.harga_sewa',
            'kamar.status_kamar',
            'kamar.tanggal_mulai_sewa',
            'kamar.tanggal_selesai_sewa',
        ])
        ->join('pembayaran', 'denda.id_pembayaran', '=', 'pembayaran.id_pembayaran')
        ->join('penghuni', 'pembayaran.id_penghuni', '=', 'penghuni.id_user')
        ->join('pengurus', 'pembayaran.id_pengurus', '=', 'pengurus.id_user')
        ->join('datausers', 'datausers.id_user', '=', 'penghuni.id_user')
        // ->join('datausers as pengurus_data', 'pengurus_data.id_user', '=', 'pengurus.id_user')
        ->join('kamar', 'penghuni.id_user', '=', 'kamar.id_penghuni')
        ->get();


        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $main = '<button type="button" action="/pengelolaan-denda/edit/'.$row->id_denda.'" style="width:30px; height:30px; display: flex; justify-content: center; align-items: center;" class="btn btn-warning bg-gradient-warning modal-crud" id="data-edit-form-btn" title="Data | Edit Form">
                    <i class="nav-icon fas fa-edit"></i>
                </button>';

                return '<div style="display: flex; flex-direction: row; justify-content: center; align-items: center;">
                        '. $main .'
                        </div>';
                })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function dataTableViewDenda()
    {
        return view('Menu.Denda.Data.table');
    }

    public function isidataTableViewDenda(Request $request)
    {
         $query = Denda::select([
            'denda.id_denda',
            'denda.id_pembayaran',
            'denda.tanggal_jatuh_tempo',
            'denda.jumlah_denda',
            'denda.status_denda',

            // 'id_pembayaran',
            'pembayaran.id_penghuni',
            'pembayaran.id_pengurus',
            'pembayaran.tanggal_pembayaran',
            'pembayaran.nominal',
            'pembayaran.periode',
            'pembayaran.status_pembayaran',
            'pembayaran.tipe_pembayaran',

            'datausers.id_user',
            'datausers.nama',
            'datausers.no_ktp',
            'datausers.no_hp',
            'datausers.alamat',
            'datausers.email',
            'datausers.password',
            'datausers.tipe_user',

            // 'penghuni.id_user',
            'penghuni.status_penghuni',

            // 'pengurus.id_user',
            'pengurus.jadwal_kerja',

            'kamar.id_kamar',
            // 'kamar.id_penghuni',
            'kamar.nomor_kamar',
            'kamar.ukuran',
            'kamar.tipe',
            'kamar.harga_sewa',
            'kamar.status_kamar',
            'kamar.tanggal_mulai_sewa',
            'kamar.tanggal_selesai_sewa',
        ])
        ->join('pembayaran', 'denda.id_pembayaran', '=', 'pembayaran.id_pembayaran')
        ->join('penghuni', 'pembayaran.id_penghuni', '=', 'penghuni.id_user')
        ->join('pengurus', 'pembayaran.id_pengurus', '=', 'pengurus.id_user')
        ->join('datausers', 'datausers.id_user', '=', 'penghuni.id_user')
        // ->join('datausers as pengurus_data', 'pengurus_data.id_user', '=', 'pengurus.id_user')
        ->join('kamar', 'penghuni.id_user', '=', 'kamar.id_penghuni')
        ;

        if ($request->has('namaDenda') && $request->namaDenda != '') {
            $keyword = $request->namaDenda;
            $query->where(function ($q) use ($keyword) {
                $q->where('denda.status_denda', 'LIKE', "%$keyword%")
                ->orWhere('datausers.nama', 'LIKE', "%$keyword%")
                ->orWhere('kamar.nomor_kamar', 'LIKE', "%$keyword%");
            });
        }

        return DataTables::of($query)
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
