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

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tanggalHariIni = Carbon::now()->format('Y-m-d');
        return view('Menu.Kamar.index', compact('tanggalHariIni'));
    }

    public function viewKamar()
    {
        return view('Menu.Kamar.Data.table');
    }

    public function getViewKamar()
    {
        $tanggalHariIni = Carbon::now()->format('Y-m-d');
        $data = Kamar::select([
            'kamar.id_kamar',
            'kamar.nomor_kamar',
            'kamar.ukuran',
            'kamar.tipe',
            'kamar.harga_sewa',
            'kamar.status_kamar',
            'kamar.tanggal_mulai_sewa',
            'kamar.tanggal_selesai_sewa',

            // 'penghuni.id_user AS id_penghuni',
            // 'penghuni.status_penghuni',

            // 'datausers.nama',
            // 'datausers.no_ktp',
            // 'datausers.no_hp',
            // 'datausers.alamat',
            // 'datausers.email',
            // 'datausers.password',
            // 'datausers.tipe_user',
        ])
        // ->join('penghuni', 'penghuni.id_user', '=', 'kamar.id_penghuni')
        // ->join('datausers', 'datausers.id_user', '=', 'penghuni.id_user')
        ->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $main = '<button type="button" action="/pengelolaan-kamar/edit/'.$row->id_kamar.'" style="width:30px; height:30px; display: flex; justify-content: center; align-items: center;" class="btn btn-warning bg-gradient-warning modal-crud" id="data-edit-form-btn" title="Data | Edit Form">
                    <i class="nav-icon fas fa-edit"></i>
                </button>';
                $main .= '
                <form class="d-inline my-0" id="DestroyOfFormId" action="/pengelolaan-kamar/delete/'.$row->id_kamar.'" method="post">
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <input type="hidden" name="_method" value="delete">
                    <input type="hidden" name="statusProses" value="delete">
                    <input type="hidden" name="state" value="delete">
                    <button type="submit" title="Data | Delete" style="width:30px; height:30px; display: flex; justify-content: center; align-items: center;" class="btn btn-danger bg-gradient-danger">
                        <i class="nav-icon fas fa-trash"></i>
                    </button>
                </form>
                ';
                return '<div style="display: flex; flex-direction: row; justify-content: space-evenly; align-items: center;">
                    '. $main .'
                </div>';
                })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function dataTableViewKamar()
    {
        return view('Menu.Kamar.Data.table');
    }

    public function isidataTableViewKamar(Request $request)
    {
       $query = Kamar::select([
            'kamar.id_kamar',
            'kamar.nomor_kamar',
            'kamar.ukuran',
            'kamar.tipe',
            'kamar.harga_sewa',
            'kamar.status_kamar',
            'kamar.tanggal_mulai_sewa',
            'kamar.tanggal_selesai_sewa',

            // 'penghuni.id_user AS id_penghuni',
            // 'penghuni.status_penghuni',

            // 'datausers.nama',
            // 'datausers.no_ktp',
            // 'datausers.no_hp',
            // 'datausers.alamat',
            // 'datausers.email',
            // 'datausers.password',
            // 'datausers.tipe_user',
        ])
        // ->join('penghuni', 'penghuni.id_user', '=', 'kamar.id_penghuni')
        // ->join('datausers', 'datausers.id_user', '=', 'penghuni.id_user')
        // ->get()
        ;

        if ($request->has('namaKamar') && $request->namaKamar != '') {
            $keyword = $request->namaKamar;
            $query->where(function ($q) use ($keyword) {
                $q->where('kamar.nomor_kamar', 'LIKE', "%$keyword%")
                ->orWhere('kamar.ukuran', 'LIKE', "%$keyword%")
                ->orWhere('kamar.tipe', 'LIKE', "%$keyword%")
                ->orwhere('kamar.status_kamar', 'LIKE', "%$keyword%");
            });
        }

        return DataTables::of($query)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
            $main = '<button type="button" action="/pengelolaan-kamar/edit/'.$row->id_kamar.'" style="width:30px; height:30px; display: flex; justify-content: center; align-items: center;" class="btn btn-warning bg-gradient-warning modal-crud" id="data-edit-form-btn" title="Data | Edit Form">
                <i class="nav-icon fas fa-edit"></i>
            </button>';
            $main .= '
            <form class="d-inline my-0" id="DestroyOfFormId" action="/pengelolaan-kamar/delete/'.$row->id_kamar.'" method="post">
                <input type="hidden" name="_token" value="' . csrf_token() . '">
                <input type="hidden" name="_method" value="delete">
                <input type="hidden" name="statusProses" value="delete">
                <input type="hidden" name="state" value="delete">
                <button type="submit" title="Data | Delete" style="width:30px; height:30px; display: flex; justify-content: center; align-items: center;" class="btn btn-danger bg-gradient-danger">
                    <i class="nav-icon fas fa-trash"></i>
                </button>
            </form>
            ';
            return '<div style="display: flex; flex-direction: row; justify-content: space-evenly; align-items: center;">
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
        return view('Menu.Kamar.Data.create');
    }

    public function getLastNomorKamar(Request $request)
    {
        $tipe = $request->input('tipe');
        $prefixMap = [
            'Premium' => 'A',
            'Reguler' => 'B',
        ];

        $prefix = $prefixMap[$tipe] ?? 'X';
        $lastKamar = Kamar::where('tipe', $tipe)
            // ->where('nomor_kamar', 'like', $prefix . '%')
            ->orderBy('nomor_kamar', 'desc')
            ->first();

        $lastNomor = $lastKamar ? intval(substr($lastKamar->nomor_kamar, 1)) : 0;
        $newNomor = $prefix . str_pad($lastNomor + 1, 3, '0', STR_PAD_LEFT);
        return response()->json(['nomor_baru' => $newNomor]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         try{
            $request->merge([
                'hargaSewa' => str_replace('.', '', $request->hargaSewa),
            ]);
            $validated = $request->validate([
                'tipeKamar' => 'required|string|max:15',
                'nomorKamar' => 'required|string|max:15',
                'ukuran' => 'required|string|max:20',
                'statusKamar' => 'required|in:Tersedia,Terisi,Dipesan',
                'hargaSewa' => 'required|numeric|min:0',
            ]);

            // Cari ID terakhir
            $lastTransaksi = Kamar::orderBy('id_kamar', 'desc')->first();

            if ($lastTransaksi) {
                $lastNumber = (int)substr($lastTransaksi->id_kamar, 3); // Ambil angka dari 'SUP001'
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }

            $newId = 'KMR' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

            Kamar::create([
                'id_kamar' => $newId,
                'id_penghuni' => null,
                'nomor_kamar' => $validated['nomorKamar'],
                'ukuran' => $validated['ukuran'],
                'tipe' => $validated['tipeKamar'],
                'harga_sewa' => $validated['hargaSewa'],
                'status_kamar' => $validated['statusKamar'],
                'tanggal_mulai_sewa' => null,
                'tanggal_selesai_sewa' => null,
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
    public function edit(string $idKamar)
    {
        $data = Kamar::select([
            'kamar.id_kamar',
            'kamar.nomor_kamar',
            'kamar.ukuran',
            'kamar.tipe',
            'kamar.harga_sewa',
            'kamar.status_kamar',
            'kamar.tanggal_mulai_sewa',
            'kamar.tanggal_selesai_sewa',
        ])
        ->where('id_kamar', $idKamar)
        ->get();
        return view('Menu.Kamar.Data.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $idKamar)
    {
         try{
            $request->merge([
                'hargaSewa' => str_replace('.', '', $request->hargaSewa),
            ]);
            $validated = $request->validate([
                'tipeKamar' => 'required|string|max:15',
                'nomorKamar' => 'required|string|max:15',
                'ukuran' => 'required|string|max:20',
                'statusKamar' => 'required|in:Tersedia,Terisi,Dipesan',
                'hargaSewa' => 'required|numeric|min:0',
            ]);

            Kamar::where('id_kamar', $idKamar)->update([
                // 'nomor_kamar' => $validated['nomorKamar'],
                'ukuran' => $validated['ukuran'],
                // 'tipe' => $validated['tipeKamar'],
                'harga_sewa' => $validated['hargaSewa'],
                'status_kamar' => $validated['statusKamar'],
                'tanggal_mulai_sewa' => null,
                'tanggal_selesai_sewa' => null,
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
    public function destroy(string $idKamar)
    {
        $dataSukuCadang = SukuCadang::findOrFail($idKamar);
        $dataSukuCadang->delete();

        return redirect()->back();
    }
}
