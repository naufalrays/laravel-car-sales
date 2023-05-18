<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
// use PDF;

class LaporanController extends Controller
{
    public function show(Request $request)
    {

        // dd('test');
        $pdf = PDF::loadView('laporan.cetak');
        $pdf->setPaper('A4', 'potrait');
        return $pdf->stream();
    }
}
