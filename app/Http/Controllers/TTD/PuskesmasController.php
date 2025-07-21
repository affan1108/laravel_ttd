<?php

namespace App\Http\Controllers\TTD;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use App\Models\Puskesmas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PuskesmasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Puskesmas::with('kecamatan')->get();
        $kecamatans = Kecamatan::all();
        return view('ttd.master.puskesmas', compact('data','kecamatans'));
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
        try {
            // Validasi data
            $validator = Validator::make($request->all(), [
                'nama' => ['required', 'string', 'max:255'],
                'kecamatan_id' => ['required'],
            ]);

            // dd($validator, $validator->fails());
            // Jika validasi gagal
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Simpan user ke database
            Puskesmas::create([
                'nama' => $request->input('nama'),
                'kecamatan_id' => $request->input('kecamatan_id'),
            ]);

            return redirect()->back()->with('success', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
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
        // dd($request->all());
        try{
            $request->validate([
                'nama' => 'string|max:255',
            ]);

            // Cari data berdasarkan ID
            $data = Puskesmas::findOrFail($id);

            // Update data
            $data->update([
                'nama' => $request->nama,
                'kecamatan_id' => $request->kecamatan_id,
            ]);

            return redirect()->back()->with('success', 'Data berhasil diperbarui!');
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Cari data berdasarkan ID
            $data = Puskesmas::findOrFail($id);

            // Hapus data
            $data->delete();

            // Redirect dengan pesan sukses
            return redirect()->back()->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
