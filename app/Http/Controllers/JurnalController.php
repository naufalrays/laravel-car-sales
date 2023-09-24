<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use Illuminate\Http\Request;

class JurnalController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index()
    {
        $jurnals = Jurnal::all();
        return view('jurnal.index', compact('jurnals'));
    }
}
