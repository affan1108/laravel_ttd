<?php

namespace App\Http\Controllers\Antrian\Table;

use App\Http\Controllers\Controller;
use App\Models\Antrian\Doctor;
use App\Models\MWLWL;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = Doctor::select('id','nama','gelar_belakang')->where('unit_ruang', 'radiologi')->limit(10)->get();
        return view("antrian.tables.dokter.dokter", compact('doctors'));
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
        // dd($request);
        // Ambil data dari request
        $nama = $request->get('nama'); // "ABDUL KODIR|00467008"
        $gelar = $request->get('gelar_belakang');
        $unit = $request->get('unit_ruang');

        Doctor::create([
            'nama' => $nama,
            'gelar_belakang' => $gelar,
            'unit_ruang' => $unit
        ]);

        return redirect()->back();
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
        $dokter = Doctor::where('id', $id)->firstOrFail();

        // Update PATIENT_NAME dengan data dari request
        $dokter->nama = $request->input('nama');
        $dokter->gelar_belakang = $request->input('gelar_belakang');
        // dd($pasien);

        $dokter->save();

        return redirect()->back()->with('success', 'Video berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dokter = Doctor::findOrFail($id);
        $dokter->delete();

        return redirect()->back();
    }
}
