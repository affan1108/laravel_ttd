<?php

namespace App\Http\Controllers\TTD;

use App\Http\Controllers\Controller;
use App\Models\Hasil;
use App\Models\Pemeriksaan;
use App\Models\Puskesmas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HasilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Hasil::with('pemeriksaan')->get();
        $puskesmass = Puskesmas::all();
        return view('ttd.dashboard.hasil', compact('data','puskesmass'));
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
        // dd($request->all());
        DB::beginTransaction();

        try {
            $data = $request->except('pemeriksaan_domisili');

            if ($request->pemeriksaan_domisili == 1) {
                $biodata = Pemeriksaan::where('id', $request->id_biodata)->first();

                if (!$biodata) {
                    return redirect()->back()->with('error', 'Biodata tidak ditemukan.');
                }

                $data['id_puskesmas'] = $biodata->puskesmas_id;
            } else {
                // Gunakan input user
                $data['id_puskesmas'] = $request->id_puskesmas;
            }

            Hasil::create($data);

            DB::commit();
            return redirect()->back()->with('success', 'Berhasil disimpan');
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

    public function cariNik(Request $request)
    {
        $search = $request->q;

        $results = DB::table('pemeriksaans')
            ->select('id','nik', 'nama')
            ->where('nik', 'like', "%{$search}%")
            ->orWhere('nama', 'like', "%{$search}%")
            ->limit(20) // batasi hasil agar efisien
            ->get();

        return response()->json($results);
    }

    public function chartData()
    {
        $berat = Hasil::where('hasil', '<', 8)->count();
        $sedang = Hasil::whereBetween('hasil', [8, 10.9])->count();
        $ringan = Hasil::whereBetween('hasil', [11, 11.9])->count();
        $normal = Hasil::where('hasil', '>=', 12)->count();

        return response()->json([
            'labels' => ['Berat', 'Sedang', 'Ringan', 'Normal'],
            'data' => [$berat, $sedang, $ringan, $normal]
        ]);
    }

}
