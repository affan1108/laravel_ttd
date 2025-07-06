<?php

namespace App\Http\Controllers\TTD;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Kecamatan::all();
        return view('ttd.master.kecamatan', compact('data'));
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
            ]);

            // dd($validator, $validator->fails());
            // Jika validasi gagal
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Simpan user ke database
            Kecamatan::create([
                'nama' => $request->input('nama'),
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
            $data = Kecamatan::findOrFail($id);

            // Update data
            $data->update([
                'nama' => $request->nama,
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
            $data = Kecamatan::findOrFail($id);

            // Hapus data
            $data->delete();

            // Redirect dengan pesan sukses
            return redirect()->back()->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    public function geojson()
{
    $data = DB::table('kecamatans as kec')
        ->leftJoin('sekolahs as s', 's.kecamatan_id', '=', 'kec.id')
        ->leftJoin('pemeriksaans as bio', 'bio.nama_sekolah', '=', 's.id')
        ->leftJoin('hasils as h', 'h.id_biodata', '=', 'bio.id')
        ->leftJoin('puskesmas as pus', 'pus.id', '=', 'h.id_puskesmas')
        ->select(
            'kec.id',
            'kec.nama as kecamatan',
            DB::raw('ST_AsGeoJSON(kec.geometry) as geometry'),
            DB::raw('MAX(pus.nama) as puskesmas'),
            DB::raw('COUNT(h.id) as total'),
            DB::raw('SUM(CASE WHEN h.hasil >= 12 THEN 1 ELSE 0 END) as normal'),
            DB::raw('SUM(CASE WHEN h.hasil BETWEEN 11 AND 11.9 THEN 1 ELSE 0 END) as ringan'),
            DB::raw('SUM(CASE WHEN h.hasil BETWEEN 8 AND 10.9 THEN 1 ELSE 0 END) as sedang'),
            DB::raw('SUM(CASE WHEN h.hasil < 8 THEN 1 ELSE 0 END) as berat')
        )
        ->groupBy('kec.id', 'kec.nama', 'kec.geometry')
        ->get();

    $features = $data->map(function ($row) {
        return [
            'type' => 'Feature',
            'geometry' => $row->geometry ? json_decode($row->geometry) : null,
            'properties' => [
                'kecamatan' => $row->kecamatan,
                'puskesmas' => $row->puskesmas,
                'total'     => (int) $row->total,
                'normal'    => (int) $row->normal,
                'ringan'    => (int) $row->ringan,
                'sedang'    => (int) $row->sedang,
                'berat'     => (int) $row->berat,
            ]
        ];
    });

    return response()->json([
        'type' => 'FeatureCollection',
        'features' => $features
    ]);
}

}
