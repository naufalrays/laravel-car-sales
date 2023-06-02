<?php

namespace App\Http\Controllers;

use App\Models\LaporanPenjualan;
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
        $dataLaporan = LaporanPenjualan::all();
        return view('penjualan.index', [
            'dataPenjualan' => $dataPenjualan,
            'dataLaporan' => $dataLaporan
        ]);
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
        $dataTableLaporan = new LaporanPenjualan();

        $daftarBulan = [
            'Januari' => '01',
            'Februari' => '02',
            'Maret' => '03',
            'April' => '04',
            'Mei' => '05',
            'Juni' => '06',
            'Juli' => '07',
            'Agustus' => '08',
            'September' => '09',
            'Oktober' => '10',
            'November' => '11',
            'Desember' => '12'
        ];

        // Menginisialiasasi variabel bulan dan tahun berdasarkan hasil dari input form
        $bulan = ucfirst($request->bulan);
        $tahun = $request->tahun;

        // Mengubah nama bulan menjadi digit dan mencari data yang sesuai dengan bulan tersebut
        $digitBulan = $daftarBulan[$bulan];
        $dataPenjualan = Penjualan::whereMonth('tanggal_lunas', $digitBulan)->get();

        // Mendapatkan data Array
        $data_dataPenjualan = $dataPenjualan->pluck('id')->toArray();

        // Mengubah data Array menjadi [1,2,3] string
        $dataArray = "[" . implode(", ", $data_dataPenjualan) . "]";

        // Mencari Laporan Penjualan dengan bulan yang diinginkan
        $dataLaporan = LaporanPenjualan::where('bulan', $bulan)
            ->where('tahun', $tahun);

        // Menambahkan data bulan laporanPenjualan
        if ($dataLaporan->count() === 0) {
            $dataTableLaporan['bulan'] = $bulan;
            $dataTableLaporan['tahun'] = $tahun;
            $dataTableLaporan['array_penjualan'] = $dataArray;
            $dataTableLaporan->save();
        } else {
            // Mengambil data laporan
            $getDataLaporan = $dataLaporan->first();

            // Kondisi jika ada data penjualan baru maka akan ditambahkan
            if ($getDataLaporan->array_penjualan !== $dataArray) {
                $getDataLaporan->array_penjualan = $dataArray;
                $getDataLaporan->save();
            }
        };

        // Kembali kehalaman penjualan
        return redirect('penjualan');
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

    public function cetakLaporan(Request $request)
    {
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
