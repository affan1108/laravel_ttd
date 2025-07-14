<?php

namespace App\Http\Controllers\TTD;

use App\Http\Controllers\Controller;
use App\Models\Akses;
use App\Models\Hasil;
use App\Models\Pemeriksaan;
use App\Models\Puskesmas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $user = Auth::user();
        $akses = Akses::where('user_id', $user->id)->get();

        $kecamatanIds = $akses->pluck('kecamatan_id')->filter()->unique();
        $puskesmasIds = $akses->pluck('puskesmas_id');
        $sekolahIds = $akses->pluck('sekolah_id');

        $data = collect(); // Default data kosong
        $puskesmass = collect(); // Default data kosong

        if ($user->role === 'puskesmas') {
            if ($puskesmasIds->isNotEmpty()) {
                $data = Hasil::with('pemeriksaan')
                    ->whereIn('id_puskesmas', $puskesmasIds)
                    ->get();

                $puskesmass = Puskesmas::whereIn('kecamatan_id', $kecamatanIds)->get();
            }
        } elseif ($user->role === 'sekolah') {
            if ($puskesmasIds->isNotEmpty()) {
                $data = Hasil::with('pemeriksaan')
                    ->whereIn('id_puskesmas', $puskesmasIds)
                    ->get();

                $puskesmass = Puskesmas::whereIn('kecamatan_id', $kecamatanIds)->get();
            }
        } else {
            // Untuk role lainnya (superadmin/dinas)
            $data = Hasil::with('pemeriksaan')->get();
            $puskesmass = Puskesmas::all();
        }

        return view('ttd.master.hasil', compact('data', 'puskesmass'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        if (auth()->guest()) {
            $request->validate([
                'g-recaptcha-response' => 'required|captcha',
            ]);
        }
        DB::beginTransaction();

        try {
            $data = $request->except('pemeriksaan_domisili', 'g-recaptcha-response');

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
        try {
            DB::beginTransaction();

            $data = Hasil::findOrFail($id);
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
        //
    }

    public function cariNik(Request $request)
    {
        $search = $request->q;

        if(auth()->guest()) {
            $results = DB::table('pemeriksaans')
                ->select('id','nik', 'nama')
                ->where(function ($query) use ($search) {
                    $query->where('nik', 'like', "%{$search}%")
                        ->orWhere('nama', 'like', "%{$search}%");
                })
                ->limit(20)
                ->get();
            
        } elseif (Auth::user()->role == 'sekolah') {
            $akses = Akses::where('user_id', Auth::user()->id)->first();

            $results = DB::table('pemeriksaans')
                ->select('id','nik', 'nama')
                ->where('sekolah_id', $akses->sekolah_id)
                ->where(function ($query) use ($search) {
                    $query->where('nik', 'like', "%{$search}%")
                        ->orWhere('nama', 'like', "%{$search}%");
                })
                ->limit(20)
                ->get();
        } elseif (Auth::user()->role == 'puskesmas') {
            $akses = Akses::where('user_id', Auth::user()->id)->first();

            $results = DB::table('pemeriksaans')
                ->select('id','nik', 'nama')
                ->where('puskesmas_id', $akses->puskesmas_id)
                ->where(function ($query) use ($search) {
                    $query->where('nik', 'like', "%{$search}%")
                        ->orWhere('nama', 'like', "%{$search}%");
                })
                ->limit(20)
                ->get();
        }

        return response()->json($results);
    }

    // public function chartData()
    // {
    //     $berat = Hasil::where('hasil', '<', 8)->count();
    //     $sedang = Hasil::whereBetween('hasil', [8, 10.9])->count();
    //     $ringan = Hasil::whereBetween('hasil', [11, 11.9])->count();
    //     $normal = Hasil::where('hasil', '>=', 12)->count();

    //     return response()->json([
    //         'labels' => ['Berat', 'Sedang', 'Ringan', 'Normal'],
    //         'data' => [$berat, $sedang, $ringan, $normal]
    //     ]);
    // }

    public function hasilHB($bulan, $puskesmasId)
    {
        $query = Hasil::query();

        if ($bulan !== '00') {
            $query->whereMonth('tgl_pemeriksaan', $bulan);
        }

        if ($puskesmasId !== '00') {
            $query->where('id_puskesmas', $puskesmasId);
        }

        $berat = (clone $query)->where('hasil', '<', 8)->count();
        $sedang = (clone $query)->whereBetween('hasil', [8, 10.9])->count();
        $ringan = (clone $query)->whereBetween('hasil', [11, 11.9])->count();
        $normal = (clone $query)->where('hasil', '>=', 12)->count();

        return response()->json([
            'labels' => ['Berat', 'Sedang', 'Ringan', 'Normal'],
            'data' => [$berat, $sedang, $ringan, $normal]
        ]);
    }

}
