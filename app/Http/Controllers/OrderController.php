<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Car;
use RealRashid\SweetAlert\Facades\Alert as FacadesAlert;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ordersData = Order::all();
        return view('order.index', ['ordersData' => $ordersData]);
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
        $carId = $request->carID;
        $carData = Car::find($carId);
        // dd($carData->stock);

        $order = Order::create([
            'user_id' => $request->userID,
            'car_id' => $carId,
            'recipient_name' => $request->recipient_name,
            'recipient_phone_number' => $request->recipient_phone_number,
            'recipient_address' => $request->recipient_address,
            'quantity' => $request->qty,
            'total_price' => $totalPrice,
        ]);
        $carData->update([
            'stock' => $carData->stock - $request->qty,
        ]);
        FacadesAlert::success('Success', 'Successfully added data'); //Sweet Alert
        return redirect('/order');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $carData = Car::find($id);
        return view('order.create', ['carData' => $carData]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Order::find($id);
        $carData = Car::find($data->car->id);
        $carData->update([
            'stock' => $carData->stock + $data->quantity,
        ]);
        $data->delete();
        FacadesAlert::success('Success', 'Successfully deleted data'); //Sweet Alert
        return back();
    }
}
