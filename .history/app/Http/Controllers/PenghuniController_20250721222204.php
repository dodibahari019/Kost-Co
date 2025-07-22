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

    public function viewPenghuni()
    {
        return view('Menu.Penghuni.Data.table');
    }

    public function getViewPenghuni()
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
                $main = '<button type="button" action="/mobil-masuk/edit/'.$row->id_penghuni.'" style="width:30px; height:30px; display: flex; justify-content: center; align-items: center;" class="btn btn-warning bg-gradient-warning modal-crud" id="data-editInputPengeluaran-form-btn" title="Data | Edit Form">
                    <i class="nav-icon fas fa-edit"></i>
                </button>';

                return '<div style="display: flex; flex-direction: row; justify-content: center; align-items: center;">
                        '. $main .'
                        </div>';
                })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function dataTableViewPenghuni()
    {
        return view('Menu.Penghuni.Data.table');
    }

    public function isidataTableViewPenghuni(Request $request)
    {
        $query = Penghuni::select([
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
        ;

        if ($request->has('namaPenghuni') && $request->namaPenghuni != '') {
            $keyword = $request->namaPenghuni;
            $query->where(function ($q) use ($keyword) {
                $q->where('datausers.nama', 'LIKE', "%$keyword%")
                ->orWhere('datausers.no_ktp', 'LIKE', "%$keyword%")
                ->orWhere('datausers.no_hp', 'LIKE', "%$keyword%")
                ->orWhere('datausers.alamat', 'LIKE', "%$keyword%")
                ->orWhere('datausers.email', 'LIKE', "%$keyword%")
                ->orWhere('datausers.Status', 'LIKE', "%$keyword%")
                ->orWhere('datausers.Status', 'LIKE', "%$keyword%")
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
