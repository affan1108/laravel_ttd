<?php

namespace App\Http\Controllers\TTD;

use App\Http\Controllers\Controller;
use App\Models\Pemeriksaan;
use App\Models\Puskesmas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PemeriksaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Pemeriksaan::all();
        $puskesmass = Puskesmas::all();
        return view('ttd.dashboard.pemeriksaan_hb', compact('data','puskesmass'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input dasar, bisa dikembangkan sesuai kebutuhan
        $request->validate([
            'nik' => 'required|unique:pemeriksaans,nik',
            // tambahkan validasi lainnya di sini
        ]);

        DB::beginTransaction();

        try {
            if (Pemeriksaan::where('nik', $request->nik)->exists()) {
                return redirect()->back()->with('error', 'Nomor NIK sudah terdaftar');
            } else {
                Pemeriksaan::create($request->all());
                return redirect()->back()->with('success', 'Berhasil disimpan');
            }

            DB::commit();

        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
