<?php

namespace App\Http\Controllers\TTD;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class SekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Sekolah::all();
        $kecamatans = Kecamatan::all();
        return view('ttd.master.sekolah', compact('data','kecamatans'));
    }

    public function data()
    {
        $query = Sekolah::with('kecamatan')->select('sekolahs.*'); // Sesuaikan nama tabel
        
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                return ''; // Aksi akan di-generate oleh DataTables
            })
            ->rawColumns(['action'])
            ->make(true);
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
        DB::beginTransaction();

        try {
            if (Sekolah::where('npsn', $request->npsn)->exists()) {
                return redirect()->back()->with('error', 'Nomor NPSN sudah terdaftar');
            } else {
                Sekolah::create($request->all());
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
    public function edit($id)
    {
        $sekolah = Sekolah::findOrFail($id);
        return response()->json($sekolah);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();

            $data = Sekolah::findOrFail($id);
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

            $data = Sekolah::findOrFail($id);

            if ($data->pemeriksaan()->exists()) {
                return redirect()->back()->with('error', 'Tidak bisa dihapus karena masih memiliki data pemeriksaan.');
            }

            if ($data->akses()->exists()) {
                return redirect()->back()->with('error', 'Tidak bisa dihapus karena masih memiliki data akses.');
            }

            $data->delete();

            DB::commit();

            return redirect()->back()->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    public function export(Request $request)
    {
        return Excel::download(new SekolahExport($request->all()), 'sekolah.xlsx');
    }
}
