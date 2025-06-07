<?php

namespace App\Http\Controllers\TTD;

use App\Http\Controllers\Controller;
use App\Models\TambahDarah;
use Illuminate\Http\Request;

class TambahDarahController extends Controller
{
   
    public function index()
    {
        $data = TambahDarah::all();
        return view('ttd.dashboard.tablet_tambah_darah', compact('data'));
    }
}
