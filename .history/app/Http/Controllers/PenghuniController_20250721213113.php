<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

use App\Models\PengeluaranTemp;

class PenghuniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tanggalHariIni = Carbon::now()->format('Y-m-d');
        return view('Menu.Penghuni.index', compact('tanggalHariIni'));
    }

    public function viewMobilMasuk()
    {
        return view('Menu.BeliMobil.Karyawan.Pengajuan.table');
    }

    public function getVIewMobilMasuk()
    {
        $tanggalHariIni = Carbon::now()->format('Y-m-d');
        $data = TransaksiCustomerTemp::select([
            'transaksicustomertemps.Id_TransaksiCustomerTmp',
            'transaksicustomertemps.Id_DataUser',
            'datausers.Nama_Lengkap AS NamaUser',
            'transaksicustomertemps.TanggalTransaksi',
            'transaksicustomertemps.Merk',
            'transaksicustomertemps.Tipe',
            'transaksicustomertemps.Tahun',
            'transaksicustomertemps.Harga',
            'transaksicustomertemps.MetodePembayaran',
            'transaksicustomertemps.Foto',
            'transaksicustomertemps.Keterangan',
            'transaksicustomertemps.Nama AS NamaPenawar',
            'transaksicustomertemps.Email',
            'transaksicustomertemps.No_HP',
            'transaksicustomertemps.Alamat',
            'transaksicustomertemps.Foto',
            'transaksicustomertemps.Status'
        ])
        ->join('datausers', 'datausers.Id_DataUser', '=', 'transaksicustomertemps.Id_DataUser')
        ->whereBetween('transaksicustomertemps.TanggalTransaksi', [
            $tanggalHariIni,
            $tanggalHariIni
        ])
        ->where('transaksicustomertemps.Status', '!=', 'Selesai')
        ->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $main = '<button type="button" onclick="ButtonDetail('
                . '\'' . $row->Id_TransaksiCustomerTmp . '\','
                . '\'' . $row->Id_DataUser . '\','
                . '\'' . $row->Merk . '\','
                . $row->Tahun . ','
                . $row->Harga . ','
                . '\'' . $row->Foto . '\','
                . '\'' . $row->Keterangan . '\','
                . '\'' . $row->NamaPenawar . '\','
                . '\'' . $row->Email . '\','
                . '\'' . $row->No_HP . '\','
                . '\'' . $row->Alamat . '\','
                . '\'' . $row->Status . '\','
                . '\'' . $row->MetodePembayaran . '\','
                . '\'' . $row->TanggalTransaksi . '\','
                . '\'' . $row->Tipe . '\',); OpenGate();"
                style="width:30px; height:30px; display: flex; justify-content: center; align-items: center;"
                class="btn btn-info bg-gradient-info"
                id="idButton"
                title="Data | Detail">
                    <i class="nav-icon fas fa-eye"></i>
            </button>';

            return '<div style="display: flex; flex-direction: row; justify-content: center; align-items: center;">
                    '. $main .'
                    </div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function dataTableView()
    {
        return view('Menu.BeliMobil.Karyawan.Pengajuan.table');
    }

    public function isidataTableView(Request $request)
    {
        $query = TransaksiCustomerTemp::select([
            'transaksicustomertemps.Id_TransaksiCustomerTmp',
            'transaksicustomertemps.Id_DataUser',
            'transaksicustomertemps.TanggalTransaksi',
            'datausers.Nama_Lengkap AS NamaUser',
            'transaksicustomertemps.Merk',
            'transaksicustomertemps.Tipe',
            'transaksicustomertemps.Tahun',
            'transaksicustomertemps.Harga',
            'transaksicustomertemps.Foto',
            'transaksicustomertemps.Keterangan',
            'transaksicustomertemps.Nama AS NamaPenawar',
            'transaksicustomertemps.Email',
            'transaksicustomertemps.No_HP',
            'transaksicustomertemps.Alamat',
            'transaksicustomertemps.Foto',
            'transaksicustomertemps.Status',
            'transaksicustomertemps.MetodePembayaran',
        ])
        ->join('datausers', 'datausers.Id_DataUser', '=', 'transaksicustomertemps.Id_DataUser')
        ->where('transaksicustomertemps.Status', '!=', 'Selesai');

        if ($request->has('namaMerk') && $request->namaMerk != '') {
            $keyword = $request->namaMerk;
            $query->where(function ($q) use ($keyword) {
                $q->where('transaksicustomertemps.Merk', 'LIKE', "%$keyword%")
                ->orWhere('transaksicustomertemps.Nama', 'LIKE', "%$keyword%")
                ->orWhere('transaksicustomertemps.Email', 'LIKE', "%$keyword%")
                ->orWhere('transaksicustomertemps.Alamat', 'LIKE', "%$keyword%")
                ->orWhere('transaksicustomertemps.Status', 'LIKE', "%$keyword%")
                ->orwhere('transaksicustomertemps.MetodePembayaran', 'LIKE', "%$keyword%");
            });
        }

        if ($request->filled('tanggalAwal') && $request->filled('tanggalAkhir')) {
            $query->whereBetween('transaksicustomertemps.TanggalTransaksi', [
                $request->tanggalAwal,
                $request->tanggalAkhir
            ]);
        }

        return DataTables::of($query)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
            $main = '<button type="button" onclick="ButtonDetail('
            . '\'' . $row->Id_TransaksiCustomerTmp . '\','
            . '\'' . $row->Id_DataUser . '\','
            . '\'' . $row->Merk . '\','
            . $row->Tahun . ','
            . $row->Harga . ','
            . '\'' . $row->Foto . '\','
            . '\'' . $row->Keterangan . '\','
            . '\'' . $row->NamaPenawar . '\','
            . '\'' . $row->Email . '\','
            . '\'' . $row->No_HP . '\','
            . '\'' . $row->Alamat . '\','
            . '\'' . $row->Status . '\','
            . '\'' . $row->MetodePembayaran . '\','
            . '\'' . $row->TanggalTransaksi . '\','
            . '\'' . $row->Tipe . '\',); OpenGate();"
            style="width:30px; height:30px; display: flex; justify-content: center; align-items: center;"
            class="btn btn-info bg-gradient-info"
            id="idButton"
            title="Data | Detail">
                <i class="nav-icon fas fa-eye"></i>
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
