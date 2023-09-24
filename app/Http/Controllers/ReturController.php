<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Pemesanan;
use App\Models\Retur;
use App\Models\User;
use Illuminate\Http\Request;

class ReturController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $dataPemesanan = Pemesanan::find($request->pemesanan_id);
        $mobil = Mobil::find($dataPemesanan->mobil_id);
        $harga_total_retur = $mobil->harga * $request->jumlah_retur; // Harga mobil * jumlah retur
        // Add data retur
        $dataRetur = new Retur();
        $dataRetur["pemesanan_id"] = $request->pemesanan_id;
        $dataRetur["user_id"] = $dataPemesanan->user_id;
        $dataRetur["mobil_id"] = $dataPemesanan->mobil_id;
        $dataRetur["nomor_retur"] = $request->no_retur;
        $dataRetur["jumlah_retur"] = $request->jumlah_retur;
        $dataRetur["harga_total_retur"] = $harga_total_retur;
        $dataRetur["status"] = "Menunggu Konfirmasi";
        $dataRetur["alasan_retur"] = $request->alasan_retur;
        $dataRetur->save();
        $dataPemesanan["status"] = "Menunggu Konfirmasi Retur";
        $dataPemesanan["alasan_Gagal"] = "";
        $dataPemesanan->save();
        return redirect('/pemesanan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dataPemesanan = Pemesanan::find($id);
        return view('retur.create', ['dataPemesanan' => $dataPemesanan]);
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
