<?php

namespace App\Http\Controllers\TTD;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use App\Models\Pemeriksaan;
use App\Models\Puskesmas;
use App\Models\Sekolah;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PemeriksaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $layout = Auth::check() ? 'layouts.layouts-horizontal' : 'layouts.layouts-detached';
        $puskesmass = Puskesmas::all();
        $sekolahs = Sekolah::all();
        $kecamatans = Kecamatan::all();

        return view('ttd.dashboard.pemeriksaan_hb', compact('puskesmass','layout','sekolahs','kecamatans'));


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Pemeriksaan::all();
        $puskesmass = Puskesmas::all();
        $deletes = Pemeriksaan::onlyTrashed()->get();
        $sekolahs = Sekolah::all();
        $kecamatans = Kecamatan::all();
        // dd($deletes);

        return view('ttd.master.pemeriksaan', compact('data','puskesmass','deletes','sekolahs','kecamatans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input dasar, bisa dikembangkan sesuai kebutuhan
        if (auth()->guest()) {
            $validator = Validator::make($request->all(), [
                'nik' => 'required|size:16|unique:pemeriksaans,nik',
                'g-recaptcha-response' => 'required|captcha',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error', 'Pastikan NIK dan captcha sudah benar.');
            }
        } else {
            $validator = Validator::make($request->all(), [
                'nik' => 'required|size:16|unique:pemeriksaans,nik',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error', 'NIK harus 16 digit.');
            }
        }

        DB::beginTransaction();

        try {
            if (Pemeriksaan::where('nik', $request->nik)->exists()) {
                return redirect()->back()->with('error', 'Nomor NIK sudah terdaftar');
            } else {
                Pemeriksaan::create($request->except('g-recaptcha-response'));
                DB::commit();
                return redirect()->back()->with('success', 'Berhasil disimpan');
            }


        } catch (\Throwable $th) {
            // dd($th);
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
