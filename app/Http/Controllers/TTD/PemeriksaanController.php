<?php

namespace App\Http\Controllers\TTD;

use App\Http\Controllers\Controller;
use App\Models\Pemeriksaan;
use App\Models\Puskesmas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PemeriksaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $layout = Auth::check() ? 'layouts.layouts-horizontal' : 'layouts.layouts-detached';
        $data = Pemeriksaan::all();
        $puskesmass = Puskesmas::all();

        // Hitung jumlah pemeriksaan per puskesmas per bulan
        $dataPerPuskesmas = [];

        foreach ($data as $pemeriksaan) {
            $bulan = $pemeriksaan->created_at->format('m');
            $puskesmasId = $pemeriksaan->puskesmas_id ?? null;
            $jenisKelamin = $pemeriksaan->jenis_kelamin; // Pastikan ini bernilai '1' atau '2'

            if ($puskesmasId && in_array($jenisKelamin, ['1', '2'])) {
                if (!isset($dataPerPuskesmas[$puskesmasId][$bulan][$jenisKelamin])) {
                    $dataPerPuskesmas[$puskesmasId][$bulan][$jenisKelamin] = 0;
                }

                $dataPerPuskesmas[$puskesmasId][$bulan][$jenisKelamin]++;
            }
        }

        // Generate warna per puskesmas
        // $colorPerPuskesmas = [];
        // foreach ($puskesmass as $puskesmas) {
        //     $colorPerPuskesmas[$puskesmas->id] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
        // }

        // Susun data untuk grafik
        $monthlyPuskesmasData = [];

        foreach ($puskesmass as $puskesmas) {
            for ($m = 1; $m <= 12; $m++) {
                $bulan = str_pad($m, 2, '0', STR_PAD_LEFT);

                $laki = $dataPerPuskesmas[$puskesmas->id][$bulan]['1'] ?? 0;
                $perempuan = $dataPerPuskesmas[$puskesmas->id][$bulan]['2'] ?? 0;

                $monthlyPuskesmasData[$bulan][] = [
                    'name' => $puskesmas->nama . ' (L)',
                    'value' => $laki,
                    'color' => 'blue',
                ];
                $monthlyPuskesmasData[$bulan][] = [
                    'name' => $puskesmas->nama . ' (P)',
                    'value' => $perempuan,
                    'color' => 'pink',
                ];
            }
        }

        // dd($dataPerPuskesmas, $colorPerPuskesmas, $monthlyPuskesmasData);

        return view('ttd.dashboard.pemeriksaan_hb', compact('data','puskesmass','monthlyPuskesmasData','layout'));


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Pemeriksaan::all();
        $puskesmass = Puskesmas::all();
        $deletes = Pemeriksaan::onlyTrashed()->get();
        // dd($deletes);

        return view('ttd.master.pemeriksaan', compact('data','puskesmass','deletes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input dasar, bisa dikembangkan sesuai kebutuhan
        $request->validate([
            'nik' => 'required|unique:pemeriksaans,nik',
        ]);

        DB::beginTransaction();

        try {
            if (Pemeriksaan::where('nik', $request->nik)->exists()) {
                return redirect()->back()->with('error', 'Nomor NIK sudah terdaftar');
            } else {
                Pemeriksaan::create($request->all());
                DB::commit();
                return redirect()->back()->with('success', 'Berhasil disimpan');
            }


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
        // dd($request->all());
        try {
            DB::beginTransaction();

            $data = Pemeriksaan::findOrFail($id);
            $data->update($request->all());

            DB::commit();

            return redirect()->back()->with('success', 'Data berhasil diperbarui');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            DB::beginTransaction();

            $data = Pemeriksaan::findOrFail($id);
            $data->delete();

            DB::commit();

            return redirect()->back()->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    public function restore($id)
    {
        $pemeriksaan = Pemeriksaan::withTrashed()->findOrFail($id);
        $pemeriksaan->restore();
        return redirect()->back()->with('success', 'Data berhasil dikembalikan.');
    }
}
