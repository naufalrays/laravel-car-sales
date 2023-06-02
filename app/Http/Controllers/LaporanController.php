<?php

namespace App\Http\Controllers;

use App\Models\LaporanPenjualan;
use App\Models\Pemesanan;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
// use PDF;

class LaporanController extends Controller
{
    public function show(Request $request)
    {
        $pdf = PDF::loadView('laporan.cetak');
        $pdf->setPaper('A4', 'potrait');
        return $pdf->stream();
    }

    public function cetakLaporanPenjualan($id)
    {
        // Mengambil data Laporan Penjualan dengan id yang dipilih
        $dataLaporan = LaporanPenjualan::find($id);

        // Merubah bentuk json ke array yang awalnya [1,2,3] json menjadi [1,2,3] array
        $arrayPenjualan = json_decode($dataLaporan->array_penjualan);

        $bulan = $dataLaporan->bulan;
        $tahun = $dataLaporan->tahun;

        // Mengambil data Penjualan dengan id yang ada pada field array_penjualan pada table Laporan Penjualan
        $dataPenjualan = Penjualan::whereIn('id', $arrayPenjualan)->get();

        if ($dataPenjualan->isEmpty()) {
            return view('laporan.data-kosong');
        }
        $pdf = PDF::loadView('laporan.laporan-penjualan', [
            'dataPenjualan' => $dataPenjualan,
            'bulan' => $bulan,
            'tahun' => $tahun,
        ])->setPaper('A4', 'landscape');
        return $pdf->stream();
        // dd($Penjualan);
    }
}
