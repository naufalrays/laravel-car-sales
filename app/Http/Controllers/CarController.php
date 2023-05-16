<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Facade;
use RealRashid\SweetAlert\Facades\Alert as FacadesAlert;
use Alert;
// use RealRashid\SweetAlert\Facades\Alert as FacadesAlert;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Car::orderBy('id')->get();
        return view('cars.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = new Car();
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();

            $file->move(public_path('images/cars'), $filename);
            $data['image'] = $filename;
            $data['name'] = $request->name;
            $data['type'] = $request->type;
            $data['stock'] = $request->stock;
            $data['price'] = $request->price;
        }
        $data->save();
        FacadesAlert::success('Success', 'Successfully added data');
        return redirect('cars');
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Car::find($id);
        return view('cars.update', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $data = Car::find($id);
        $data->update(
            [
                'name' => $request->name,
                'type' => $request->type,
                'stock' => $request->stock,
                'price' => $request->price
            ],
        ); // After
        if ($request->file('image')) {
            $file = $request->file('image');
            clearstatcache();
            $file->move(public_path('images/cars'), $data->image);
        }
        return redirect('/cars');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Car::find($id);
        if (file_exists('images/cars/' . $data->image)) {
            if (!in_array($data->image, ['Baleno.jpeg', 'XL7.jpeg', 'Ertiga.jpeg', 'Ignis.jpeg', 'S-Presso.jpeg'])) {
                @unlink('images/cars/' . $data->image);
            }
        }
        $data->delete();
        FacadesAlert::success('Success', 'Successfully deleted data');
        return back();
    }
}
