<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use DateTime;
use Barryvdh\DomPDF\Facade\Pdf;
use RealRashid\SweetAlert\Facades\Alert as FacadesAlert;


class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataPenjualan = Penjualan::all();
        return view('penjualan.index', ['dataPenjualan' => $dataPenjualan]);
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
    public function show(string $id, string $data)
    {
        $data = Penjualan::find();
        dd($id);
        $bulan = '05'; // Bulan yang ingin Anda ambil datanya
        $tahun = '2023'; // Tahun yang ingin Anda ambil datanya

        $data = Penjualan::whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->get();
        $timestamp = $data->created_at;
        $date = new DateTime($timestamp);
        $time = $date->format('Y-m-d');
        // dd($time);
        $pdf = PDF::loadView('laporan.faktur', ['time' => $time, 'data' =>    $data])->setPaper('A4', 'landscape');
        return $pdf->stream();
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

    public function cetakLaporan(Request $request,)
    {
        dd($request->startDate, $request->endDate);
        dd($request->endDate);
        $data = Penjualan::find();
        $bulan = '05'; // Bulan yang ingin Anda ambil datanya
        $tahun = '2023'; // Tahun yang ingin Anda ambil datanya

        $data = Penjualan::whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->get();
        $timestamp = $data->created_at;
        $date = new DateTime($timestamp);
        $time = $date->format('Y-m-d');
        // dd($time);
        $pdf = PDF::loadView('laporan.faktur', ['time' => $time, 'data' =>    $data])->setPaper('A4', 'landscape');
        return $pdf->stream();
    }
}
