<?php

namespace App\Http\Controllers\TTD;

use App\Http\Controllers\Controller;
use App\Models\Pemeriksaan;
use App\Models\TambahDarah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;


class TambahDarahController extends Controller
{

    public function index()
    {
        $layout = Auth::check() ? 'layouts.layouts-horizontal' : 'layouts.layouts-detached';

        if (Auth::check()) {
            // Jika sudah login, arahkan ke view admin/master


            $data = TambahDarah::with('pemeriksaan')->where('aktif', '=', 1)->get();
            $datanonaktif = TambahDarah::with('pemeriksaan')->where('aktif', '=', 0)->get();


            return view('ttd.master.tambah_darah', compact('data', 'datanonaktif'));
        } else {

            return view('ttd.dashboard.tablet_tambah_darah', compact('layout'));
        }
    }
    public function create() {}
    public function store(Request $request)
    {
        if (auth()->guest()) {
            $validator = Validator::make($request->all(), [
                'g-recaptcha-response' => 'required|captcha',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Pastikan captcha sudah benar.');
            }
        }
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
            [
                'nik.required' => 'NIK wajib diisi.',
                'id_pemeriksaan.exists' => 'Pemeriksaan tidak ditemukan.',
                'tgl_minum.required' => 'Tanggal minum wajib diisi.',
                'jml_tablet.required' => 'Jumlah tablet wajib diisi.',
                'pengawas.required' => 'Pengawas wajib diisi.',
                'no_pengawas.required' => 'Nomor pengawas wajib diisi.',
                'tgl_periksa_ulang.required' => 'Tanggal periksa ulang wajib diisi.',
            ]
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
    public function show($encryptedId)
    {
        try {
            $id = Crypt::decryptString($encryptedId);
            $data = Pemeriksaan::findOrFail($id);

            // lanjutkan...
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            abort(404); // jika tidak valid
        }
        return view('ttd.dashboard.tablet_tambah_darah', compact('data'));
    }
    public function edit($id) {}
    public function update(Request $request, $id)
    {
        // dd($request->all());
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
        $data->update(['aktif' => 0]); // Tandai sebagai tidak aktif

        // Redirect dengan pesan sukses
        return redirect()->route('tambah-darah.index')->with('success', 'Data berhasil dihapus.');
    }

    public function cariByNik($nik)
    {
        $data = Pemeriksaan::with('sekolah')
            ->where('nik', 'like', '%' . $nik . '%')
            ->get();


        if ($data->isEmpty()) {
            return response()->json([
                'status' => 'not_found',
                'message' => 'Data tidak ditemukan.'
            ]);
        }
        // Tambahkan encrypted_id ke setiap item
        $data = $data->map(function ($item) {
            $item->encrypted_id = Crypt::encryptString($item->id);
            return $item;
        });
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
    public function data(Request $request)
    {
        $isTotal = $request->filter_type === 'total';
        $isUnactive = $request->filter_type === 'unactive';

        $query = DB::table('tablet_tambah_darah as ttd')
            ->join('pemeriksaans as p', 'ttd.id_pemeriksaan', '=', 'p.id')
            ->leftJoin('puskesmas as ps', 'p.puskesmas_id', '=', 'ps.id')
            ->leftJoin('kecamatans as k', 'p.kecamatan_id', '=', 'k.id')
            ->join('sekolahs as s', 'p.sekolah_id', '=', 's.id'); // Hanya ambil data yang aktif

        if ($request->has('filter_month') && $request->filter_month !== 'all') {
            $query->whereMonth('ttd.tgl_minum', $request->filter_month);
        }

        if ($isTotal) {
            $query
                ->where('ttd.aktif', 1)
                ->select(
                    'p.id',
                    'p.nik',
                    'p.nama',
                    'p.nomer',
                    'p.tempat_lahir',
                    'p.tgl_lahir',
                    'p.alamat',
                    'p.kelas',
                    'p.nama_ortu',
                    'k.nama as kecamatan',
                    DB::raw("CASE 
                WHEN p.jenis_kelamin = 1 THEN 'Laki-laki'
                WHEN p.jenis_kelamin = 2 THEN 'Perempuan'
                ELSE 'Tidak Diketahui' 
            END as jenis_kelamin"),
                    'ps.nama as nama_puskesmas',
                    's.nama as nama_sekolah',
                    DB::raw('SUM(ttd.jumlah_tablet) as jumlah_tablet'),
                    DB::raw("GROUP_CONCAT(ttd.tgl_minum ORDER BY ttd.tgl_minum ASC SEPARATOR '\n') as tgl_minum"),
                    DB::raw("GROUP_CONCAT(ttd.tgl_periksa_ulang ORDER BY ttd.tgl_minum ASC SEPARATOR '\n') as tgl_periksa_ulang"),
                    DB::raw("GROUP_CONCAT(DISTINCT ttd.pengawas ORDER BY ttd.tgl_minum ASC SEPARATOR '\n') as pengawas"),
                    DB::raw("GROUP_CONCAT(DISTINCT ttd.nomor_pengawas ORDER BY ttd.tgl_minum ASC SEPARATOR '\n') as nomor_pengawas"),
                    DB::raw("GROUP_CONCAT(DISTINCT ttd.keterangan ORDER BY ttd.tgl_minum ASC SEPARATOR '\n') as keterangan")
                )
                ->groupBy(
                    'p.id',
                    'p.nik',
                    'p.nama',
                    'p.nomer',
                    'p.tempat_lahir',
                    'p.tgl_lahir',
                    'p.alamat',
                    'p.kelas',
                    'p.nama_ortu',
                    'p.jenis_kelamin',
                    'ps.nama',
                    's.nama',
                    'k.nama'
                );
        } else if ($isUnactive) {
            $query
                ->where('ttd.aktif', 0)
                ->select(
                    'ttd.id',
                    'p.nik',
                    'p.nama',
                    'p.nomer',
                    'p.tempat_lahir',
                    'p.tgl_lahir',
                    'p.alamat',
                    'p.kelas',
                    'p.nama_ortu',
                    'k.nama as kecamatan',
                    DB::raw("CASE 
                WHEN p.jenis_kelamin = 1 THEN 'Laki-laki'
                WHEN p.jenis_kelamin = 2 THEN 'Perempuan'
                ELSE 'Tidak Diketahui'
            END as jenis_kelamin"),
                    'ps.nama as nama_puskesmas',
                    's.nama as nama_sekolah',
                    'ttd.jumlah_tablet',
                    'ttd.tgl_minum',
                    'ttd.tgl_periksa_ulang',
                    'ttd.pengawas',
                    'ttd.nomor_pengawas',
                    'ttd.keterangan'
                );
        } else {
            $query->where('ttd.aktif', 1)
                ->select(
                    'ttd.id',
                    'p.nik',
                    'p.nama',
                    'p.nomer',
                    'p.tempat_lahir',
                    'p.tgl_lahir',
                    'p.alamat',
                    'p.kelas',
                    'p.nama_ortu',
                    'k.nama as kecamatan',
                    DB::raw("CASE 
                WHEN p.jenis_kelamin = 1 THEN 'Laki-laki'
                WHEN p.jenis_kelamin = 2 THEN 'Perempuan'
                ELSE 'Tidak Diketahui'
            END as jenis_kelamin"),
                    'ps.nama as nama_puskesmas',
                    's.nama as nama_sekolah',
                    'ttd.jumlah_tablet',
                    'ttd.tgl_minum',
                    'ttd.tgl_periksa_ulang',
                    'ttd.pengawas',
                    'ttd.nomor_pengawas',
                    'ttd.keterangan'
                );
        }

        $datatable = DataTables::of($query)
            ->addIndexColumn();

        // Hanya tampilkan kolom aksi jika BUKAN total
        if (!$isTotal) {
            $datatable->addColumn('action', function ($row) {
                return '
                <button class="btn btn-sm btn-warning btn-edit" data-id="' . $row->id . '">
                    <i class="fas fa-edit"></i> Edit
                </button>
                <button class="btn btn-sm btn-danger btn-delete" data-id="' . $row->id . '">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            ';
            })->rawColumns(['action']);
        }

        return $datatable->make(true);
    }

    public function getedit($id)
    {
        $ttd = TambahDarah::with('pemeriksaan')->findOrFail($id);
        return response()->json($ttd);
    }
    public function restore($id)
    {
        // Cari data berdasarkan ID
        $data = TambahDarah::findOrFail($id);

        // Tandai sebagai aktif
        $data->update(['aktif' => 1]);

        // Redirect dengan pesan sukses
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
}
