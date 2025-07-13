<?php

namespace App\Http\Controllers\TTD;

use App\Http\Controllers\Controller;
use App\Models\Akses;
use App\Models\Kecamatan;
use App\Models\Pemeriksaan;
use App\Models\Puskesmas;
use App\Models\Sekolah;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::where('role', '!=', 'superadmin')->get();
        $puskesmass = Puskesmas::all();
        $sekolahs = Sekolah::all();
        $kecamatans = Kecamatan::all();
        return view('ttd.master.user', compact('data','puskesmass','sekolahs','kecamatans'));
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
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
            ]);

            // dd($validator, $validator->fails());
            // Jika validasi gagal
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Simpan user ke database
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'role' => $request->input('role'),
            ]);

            if($request->kecamatan_id){
                Akses::create([
                    'user_id' => $user->id,
                    'kecamatan_id' => $request->kecamatan_id,
                    'sekolah_id' => $request->sekolah_id,
                    'puskesmas_id' => $request->puskesmas_id,
                ]);
            }

            return redirect()->back()->with('success', 'User berhasil ditambahkan');
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
                'name' => 'string|max:255',
                'role' => 'string|max:255',
            ]);

            // Cari data berdasarkan ID
            $user = User::findOrFail($id);

            // Update data
            $user->update([
                'name' => $request->name,
                'role' => $request->role,
            ]);

            return redirect()->back()->with('success', 'Data berhasil diperbarui!');
        } catch (\Exception $e) {
            dd($e->getMessage());
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
            $user = User::findOrFail($id);

            // Hapus data
            $user->delete();

            // Redirect dengan pesan sukses
            return redirect()->back()->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
