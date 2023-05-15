<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert as FacadesAlert;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all(); // Mengambil semua data yang ada pada tabel User
        return view('users.index', ['users' => $users]); // Memberikan data users ke dalam tampilan users/index.blade.php
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create'); // Menampilkan tampilan pada view users/create.blade.php
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:' . User::class],
            'password' => ['required',  Rules\Password::defaults()],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'phone_number' => ['numeric', 'unique:' . User::class],
            'roles' => ['required', 'in:admin,user'],
        ]);
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole($request->roles);
        FacadesAlert::success('Success', 'Successfully added data');
        return redirect('users');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = User::find($id); // Mencari data dengan id yang sama
        return view('users.update', ['data' => $data]); // Membuka halaman users/update.blade.php dan memberikan data
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = User::find($id); // Mencari data dengan id yang sama
        $data->update(
            [
                'name' => $request->name,
                'username' => $request->username,
                'password' => $request->password ?? $data->password,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
            ],
        ); // After
        DB::table('model_has_roles')->where('model_id', $id)->delete(); // Menghapus role yang sudah ada
        $data->assignRole($request->roles); // Memberikan role pada users
        FacadesAlert::success('Success', 'Successfully updated data');
        return redirect('/users'); // Pindah halaman ke users
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = User::find($id); // Mencari data dengan id yang sama
        $data->delete(); // Hapus Field
        FacadesAlert::success('Success', 'Successfully deleted data'); //Sweet Alert
        return back(); // Kembali ke halaman sebelumnya atau merefresh halaman tersebut
    }
}
