<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Mobil;
use RealRashid\SweetAlert\Facades\Alert as FacadesAlert;


class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataPembelian = Pembelian::all();
        return view('pembelian.index', ['dataPembelian' => $dataPembelian]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $recipient_name = $request->recipient_name;
        // $user = $request->userID;
        $totalPrice = str_replace(".", "", $request->totalPrice);
        $carId = $request->carId;
        $dataMobil = Mobil::find($carId);
        // dd($dataMobil->stock);

        $order = Pembelian::create([
            'user_id' => $request->userId,
            'mobil_id' => $carId,
            'nama_penerima' => $request->nama_penerima,
            'nomor_penerima' => $request->nomor_penerima,
            'alamat_penerima' => $request->alamat_penerima,
            'jumlah' => $request->jumlah,
            'harga_total' => $request->harga_total,
        ]);
        $dataMobil->update([
            'stok' => $dataMobil->stok - $request->qty,
        ]);
        FacadesAlert::success('Berhasil', 'Berhasil Melakukan Pembelian'); //Sweet Alert
        return redirect('/pembelian');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $dataMobil = Mobil::find($id);
        return view('pembelian.create', ['dataMobil' => $dataMobil, 'id' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembelian $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pembelian $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Pembelian::find($id);
        $carData = Pembelian::find($data->car->id);
        $carData->update([
            'stock' => $carData->stock + $data->quantity,
        ]);
        $data->delete();
        FacadesAlert::success('Success', 'Successfully deleted data'); //Sweet Alert
        return back();
    }

    public function informasi(Request $request)
    {
        $totalPrice = str_replace(".", "", $request->totalPrice);
        $carId = $request->carID;
        $dataMobil = Mobil::find($carId);
        // dd($request);
        return view('pembelian.confirm', [
            'user_id' => $request->userId,
            'data_mobil' => $dataMobil,
            'nama_penerima' => $request->recipient_name,
            'nomor_penerima' => $request->recipient_phone_number,
            'alamat_penerima' => $request->recipient_address,
            'jumlah' => $request->qty,
            'harga_total' => $totalPrice,
        ]);
    }
    public function confirm($id)
    {
    }
}
