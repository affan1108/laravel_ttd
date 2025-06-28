<?php

namespace App\Http\Controllers\TTD;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function data(Request $request)
    {
        $data = Sekolah::with('kecamatan');

        return datatables()->eloquent($data)
        ->addIndexColumn()
        ->addColumn('action', function($row) {
            return '<a data-bs-toggle="modal" data-bs-target="#editModal'.$row->id.'" class="btn btn-secondary">Edit</a> ' .
                   '<a data-bs-toggle="modal" data-bs-target="#deleteRecordModal'.$row->id.'" class="btn btn-danger">Hapus</a>';
        })
        ->rawColumns(['action'])
        ->toJson();
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
            dd($th);
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
            $data->delete();

            DB::commit();

            return redirect()->back()->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }
}
