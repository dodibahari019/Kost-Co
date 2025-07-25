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

class PindahKamarController extends Controller
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
        return view('Menu.PindahKamar.index', compact('tanggalHariIni', 'idUser', 'namaLengkap', 'tipeUser'));

    }

    public function viewPindahKamar()
    {
        return view('Menu.PindahKamar.Data.table');
    }

    public function getViewPindahKamar()
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
            ->addColumn('action', function ($row) {
                $main = '<button type="button" action="/pengelolaan-ajuan-pindah-kamar/edit/'.$row->id_pindah.'" style="width:30px; height:30px; display: flex; justify-content: center; align-items: center;" class="btn btn-warning bg-gradient-warning modal-crud" id="data-edit-form-btn" title="Data | Edit Form">
                    <i class="nav-icon fas fa-edit"></i>
                </button>';

                return '<div style="display: flex; flex-direction: row; justify-content: center; align-items: center;">
                        '. $main .'
                        </div>';
                })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function dataTableViewPindahKamar()
    {
        return view('Menu.PindahKamar.Data.table');
    }

    public function isidataTableViewPindahKamar(Request $request)
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
                ->orwhere('penghuni.status_penghuni', 'LIKE', "%$keyword%");
            });
        }

        return DataTables::of($query)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
            $main = '<button type="button" action="/pengelolaan-ajuan-pindah-kamar/edit/'.$row->id_pindah.'" style="width:30px; height:30px; display: flex; justify-content: center; align-items: center;" class="btn btn-warning bg-gradient-warning modal-crud" id="data-edit-form-btn" title="Data | Edit Form">
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
        ->where('penghuni.id_user', $idPenghuni)
        ->get();
        return view('Menu.PindahKamar.Data.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $validated = $request->validate([
                'status' => 'required|in:Aktif,Tidak Aktif,Menunggu',
            ]);

            Penghuni::where('id_user', $idPenghuni)->update([
                'status_penghuni' => $validated['status'],
            ]);

            return redirect()->back();
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
