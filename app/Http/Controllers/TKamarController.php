<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

use App\Models\Kamar;

class TKamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tanggalHariIni = Carbon::now()->format('Y-m-d');
        $kamars = Kamar::all(); // ambil semua kamar

        return view('Menu.ListKamar.index', compact('tanggalHariIni', 'kamars'));
    }

    public function cardViewListKamar(Request $request)
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
        ]);

        if ($request->has('namaKamar') && $request->namaKamar != '') {
        $keyword = $request->namaKamar;
        $query->where(function ($q) use ($keyword) {
            $q->where('nomor_kamar', 'LIKE', "%$keyword%")
              ->orWhere('ukuran', 'LIKE', "%$keyword%")
              ->orWhere('tipe', 'LIKE', "%$keyword%")
              ->orWhere('status_kamar', 'LIKE', "%$keyword%");
            });
        }

        $kamars = $query->get();

        return view('Menu.ListKamar.Data.table', compact('kamars'));

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
