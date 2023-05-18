<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Mobil;
use App\Models\User;
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
        // $dataMobil->update([
        //     'stok' => $dataMobil->stok - $request->qty,
        // ]);
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
    public function edit($id)
    {
        $dataPembelian = Pembelian::find($id);
        return view('pembelian.update', ['dataPembelian' => $dataPembelian]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $data = Pembelian::find($id);
        $user = User::find($data->user_id);
        $mobil = Mobil::find($data->mobil_id);
        // $request->validate([]);
        // dd($mobil->tipe);
        if ($request->file('image')) {
            $file = $request->file('image');
            $extension = $file->extension();
            $filename = date('YmdHi') . '-' . $data->id . '-' . $user->name . '-' . $mobil->tipe . '.' . $extension;
            $file->move(public_path('images/buktiPembayaran'), $filename);
            $data['gambar'] = $filename;
            $data['nama_penerima'] = $request->name;
            $data['nomor_penerima'] = $request->number;
            $data['alamat_penerima'] = $request->address;
            $data['status'] = 'Menunggu Konfirmasi';
        }
        $data->save();
        return redirect('pembelian');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Pembelian::find($id);
        // $carData = Pembelian::find($data->car->id);
        // $carData->update([
        //     'stock' => $carData->stock + $data->quantity,
        // ]);
        if ($data->status !== "Berhasil") {
            $data->delete();
            FacadesAlert::success('Berhasil', 'Berhasil menghapus data'); //Sweet Alert
        }
        // if($data->)
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

    public function konfirmasiPembayaran($id)
    {
        $dataPembelian = Pembelian::find($id);
        return view('pembelian.adminConfirm', ['dataPembelian' => $dataPembelian]);
        // dd('masuk kesini');
    }

    public function updateKonfirmasiPembayaran($id, $bool)
    {
        $data = Pembelian::find($id);
        if ($bool === 'gagal') {
            // $data->update(
            //     ['status' => 'Gagal']
            // );
            $data['status'] = 'Gagal';
        } else {
            // $data->update(
            //     ['status' => 'Dibeli']
            // );
            $data['status'] = 'Dibeli';
        }
        $data->save();
        return redirect('/pembelian');
        // dd('masuk kesini');
    }
}
