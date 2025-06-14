<?php

namespace App\Http\Controllers\TTD;

use App\Http\Controllers\Controller;
use App\Models\Pemeriksaan;
use App\Models\TambahDarah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TambahDarahController extends Controller
{

    public function index()
    {
       
        
        if (Auth::check()) {
            // Jika sudah login, arahkan ke view admin/master
            return view('tambah-darah.tambah-darah.index');
        } 
        $data = TambahDarah::all();
        

    }
    public function create() {}
    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'nik' => 'required|string|max:20',
            'id_pemeriksaan' => 'required|exists:pemeriksaans,id',
            'tgl_minum' => 'required|date',
            'jml_tablet' => 'required|integer|min:1',
            'pengawas' => 'required|string|max:100',
            'no_pengawas' => 'required|string|max:20',
            'tgl_periksa_ulang' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        // Simpan ke database
        TambahDarah::create([
            'nik' => $validated['nik'],
            'id_pemeriksaan' => $validated['id_pemeriksaan'],
            'tgl_minum' => $validated['tgl_minum'],
            'jumlah_tablet' => $validated['jml_tablet'],
            'pengawas' => $validated['pengawas'],
            'nomor_pengawas' => $validated['no_pengawas'],
            'tgl_periksa_ulang' => $validated['tgl_periksa_ulang'],
            'keterangan' => $validated['keterangan'],
            'created_at' => now(),
        ]);

        return redirect()->route('tambah-darah.index')->with('success', 'Data berhasil disimpan.');
    }
    public function show($id)
    {
        $data = Pemeriksaan::findOrFail($id);
        return view('ttd.dashboard.tablet_tambah_darah', compact('data'));
    }
    public function edit($id) {}
    public function update(Request $request, $id) {}
    public function destroy($id) {}
    public function cariByNik($nik)
    {
        $data = Pemeriksaan::where('nik', $nik)->get();

        if ($data->isEmpty()) {
            return response()->json([
                'status' => 'not_found',
                'message' => 'Data tidak ditemukan.'
            ]);
        }

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
}
