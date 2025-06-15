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
        $layout = Auth::check() ? 'layouts.layouts-horizontal' : 'layouts.layouts-detached';

        if (Auth::check()) {
            // Jika sudah login, arahkan ke view admin/master


            $data = TambahDarah::with('pemeriksaan')->get();


            return view('ttd.master.tambah_darah', compact('data'));
        } else {

            return view('ttd.dashboard.tablet_tambah_darah', compact('layout'));
        }
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
        // dd($validated);


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
    public function update(Request $request, $id)
    {
        // Validasi data
        $validated = $request->validate([
            'nik' => 'required|string|max:20',
            'tgl_minum' => 'required|date',
            'jumlah_tablet' => 'required|integer|min:1',
            'pengawas' => 'required|string|max:100',
            'nomor_pengawas' => 'required|string|max:20',
            'tgl_periksa_ulang' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);
        // dd($validated);

        // Cari data berdasarkan ID
        $data = TambahDarah::findOrFail($id);

        // Update data
        $data->update([
            'tgl_minum' => $validated['tgl_minum'],
            'jumlah_tablet' => $validated['jumlah_tablet'],
            'pengawas' => $validated['pengawas'],
            'nomor_pengawas' => $validated['nomor_pengawas'],
            'tgl_periksa_ulang' => $validated['tgl_periksa_ulang'],
            'keterangan' => $validated['keterangan'],
        ]);

        return redirect()->route('tambah-darah.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Cari data berdasarkan ID
        $data = TambahDarah::findOrFail($id);

        // Hapus data
        $data->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('tambah-darah.index')->with('success', 'Data berhasil dihapus.');
    }

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
