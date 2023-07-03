<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Mobil;
use App\Models\Penjualan;
use App\Models\User;
use DateTime;
use Barryvdh\DomPDF\Facade\Pdf;
use RealRashid\SweetAlert\Facades\Alert as FacadesAlert;


class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataPemesanan = Pemesanan::all();
        return view('pemesanan.index', ['dataPemesanan' => $dataPemesanan]);
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
        // $user = $request->userID;
        $totalPrice = str_replace(".", "", $request->totalPrice);
        $carId = $request->carId;
        $dataMobil = Mobil::find($carId);

        $order = Pemesanan::create([
            'user_id' => $request->userId,
            'mobil_id' => $carId,
            'nama_penerima' => $request->nama_penerima,
            'nomor_penerima' => $request->nomor_penerima,
            'alamat_penerima' => $request->alamat_penerima,
            'jumlah' => $request->jumlah,
            'harga_total' => $request->harga_total,
        ]);
        FacadesAlert::success('Berhasil', 'Berhasil Melakukan Pemesanan'); //Sweet Alert
        return redirect('/pemesanan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $dataMobil = Mobil::find($id);
        return view('pemesanan.create', ['dataMobil' => $dataMobil, 'id' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $dataPemesanan = Pemesanan::find($id);
        return view('pemesanan.update', ['dataPemesanan' => $dataPemesanan]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $data = Pemesanan::find($id);
        $user = User::find($data->user_id);
        $mobil = Mobil::find($data->mobil_id);
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
        return redirect('pemesanan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Pemesanan::find($id);
        if ($data->status !== "Berhasil") {
            $data->delete();
            FacadesAlert::success('Berhasil', 'Berhasil menghapus data'); //Sweet Alert
        }
        return back();
    }

    public function informasi(Request $request)
    {
        $totalPrice = str_replace(".", "", $request->totalPrice);

        $carId = $request->carID;
        $dataMobil = Mobil::find($carId);
        return view('pemesanan.confirm', [
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
        $dataPemesanan = Pemesanan::find($id);
        return view('pemesanan.adminConfirm', ['dataPemesanan' => $dataPemesanan]);
    }

    public function updateKonfirmasiPembayaran(Request $request, $id)
    {
        $confirm = $request->confirm;
        $date = new DateTime(now());
        $time = $date->format('Y-m-d');
        $data = Pemesanan::find($id);
        $dataPenjualan = new Penjualan();
        $dataMobil = Mobil::find($data->mobil->id);
        if ($confirm === 'batal') {
            $data['status'] = 'Gagal';
            $data['alasan_gagal'] = $request->alasan_batal;
        } else {
            $data['status'] = 'Dibeli';
            $dataMobil['stok'] = $dataMobil->stok - $data->jumlah;
            $dataMobil->save();

            $dataPenjualan['user_id'] = 1;
            $dataPenjualan['pemesanan_id'] = $id;
            $dataPenjualan['tanggal_lunas'] = $time;
            $dataPenjualan->save();
        }
        $data->save();
        return redirect('/pemesanan');
    }

    public function cetakInvoice($id)
    {
        // $decrypted = Crypt::decryptString($id);
        $data = Pemesanan::find($id);
        $timestamp = $data->created_at;
        $date = new DateTime($timestamp);
        $time = $date->format('Y-m-d');
        // dd($time);
        $pdf = PDF::loadView('laporan.faktur', ['time' => $time, 'data' =>    $data])->setPaper('A4', 'landscape');
        return $pdf->stream();
    }
}
