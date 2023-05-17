<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Facade;
use RealRashid\SweetAlert\Facades\Alert as FacadesAlert;
use Alert;
// use RealRashid\SweetAlert\Facades\Alert as FacadesAlert;

class MobilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataMobil = Mobil::orderBy('id')->get();
        return view('mobil.index', ['dataMobil' => $dataMobil]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mobil.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = new Mobil();
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();

            $file->move(public_path('images/cars'), $filename);
            $data['gambar'] = $filename;
            $data['merek'] = $request->name;
            $data['tipe'] = $request->type;
            $data['stok'] = $request->stock;
            $data['harga'] = $request->price;
        }
        $data->save();
        FacadesAlert::success('Success', 'Successfully added data');
        return redirect('mobil');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mobil $car)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $dataMobil = Mobil::find($id);
        return view('mobil.update', ['dataMobil' => $dataMobil]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $data = Mobil::find($id);
        $data->update(
            [
                'merek' => $request->name,
                'tipe' => $request->type,
                'stok' => $request->stock,
                'harga' => $request->price
            ],
        ); // After
        if ($request->file('image')) {
            $file = $request->file('image');
            clearstatcache();
            $file->move(public_path('images/cars'), $data->gambar);
        }
        return redirect('/mobil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Mobil::find($id);
        // dd($data->gambar);
        if (file_exists('images/cars/' . $data->gambar)) {
            if (!in_array($data->gambar, ['Baleno.png', 'XL7.png', 'Ertiga.png', 'Ignis.png', 'S-Presso.png'])) {
                @unlink('images/cars/' . $data->gambar);
            }
        }
        $data->delete();
        FacadesAlert::success('Sukses', 'Berhasil Menghapus Data');
        return back();
    }
}
