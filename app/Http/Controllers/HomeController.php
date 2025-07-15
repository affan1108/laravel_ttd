<?php

namespace App\Http\Controllers;

use App\Models\Antrian\Doctor;
use App\Models\Hasil;
use App\Models\MWLWL;
use App\Models\Pemeriksaan;
use App\Models\Puskesmas;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (view()->exists($request->path())) {
            return view($request->path());
        }
        return abort(404);
    }

    public function root()
    {
        return view('index');
    }

    /*Language Translation*/
    public function lang($locale)
    {
        if ($locale) {
            App::setLocale($locale);
            Session::put('lang', $locale);
            Session::save();
            return redirect()->back()->with('locale', $locale);
        } else {
            return redirect()->back();
        }
    }

    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:1024'],
        ]);

        $user = User::find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');

        if ($request->file('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatarPath = public_path('/images/');
            $avatar->move($avatarPath, $avatarName);
            $user->avatar =  $avatarName;
        }

        $user->update();
        if ($user) {
            Session::flash('message', 'User Details Updated successfully!');
            Session::flash('alert-class', 'alert-success');
            // return response()->json([
            //     'isSuccess' => true,
            //     'Message' => "User Details Updated successfully!"
            // ], 200); // Status code here
            return redirect()->back();
        } else {
            Session::flash('message', 'Something went wrong!');
            Session::flash('alert-class', 'alert-danger');
            // return response()->json([
            //     'isSuccess' => true,
            //     'Message' => "Something went wrong!"
            // ], 200); // Status code here
            return redirect()->back();
        }
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            return response()->json([
                'isSuccess' => false,
                'Message' => "Your Current password does not matches with the password you provided. Please try again."
            ], 200); // Status code
        } else {
            $user = User::find($id);
            $user->password = Hash::make($request->get('password'));
            $user->update();
            if ($user) {
                Session::flash('message', 'Password updated successfully!');
                Session::flash('alert-class', 'alert-success');
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "Password updated successfully!"
                ], 200); // Status code here
            } else {
                Session::flash('message', 'Something went wrong!');
                Session::flash('alert-class', 'alert-danger');
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "Something went wrong!"
                ], 200); // Status code here
            }
        }
    }

    public function dashboard()
    {
        $layout = Auth::check() ? 'layouts.layouts-horizontal' : 'layouts.layouts-detached';
        $data = Hasil::with('pemeriksaan')->get();
        //  dd($data);
        if (Auth::user()->role == 'puskesmas') {
            $userPuskesmasIds = DB::table('akses')
                ->where('user_id', Auth::id())
                ->pluck('puskesmas_id');

            $puskesmass = Puskesmas::where('id', $userPuskesmasIds)->get();
        } else {
            $puskesmass = Puskesmas::all();
        }
        $dataTTD = DB::table('tablet_tambah_darah as ttd')
            ->join('pemeriksaans as pm', 'ttd.id_pemeriksaan', '=', 'pm.id')
            ->join('puskesmas as ps', 'pm.puskesmas_id', '=', 'ps.id')
            ->select('pm.jenis_kelamin', 'ps.nama', 'ttd.tgl_minum','pm.puskesmas_id')
            ->get();
        // dd($dataTTD);


        // Hitung jumlah pemeriksaan per puskesmas per bulan
        $dataPerPuskesmas = [];

        foreach ($data as $pemeriksaan) {
            $bulan = $pemeriksaan->created_at->format('m');
            $puskesmasId = $pemeriksaan->id_puskesmas ?? null;
            $jenisKelamin = $pemeriksaan->pemeriksaan->jenis_kelamin;
            // dd($jenisKelamin);

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

        $dataTTDPerPuskesmas = [];

        foreach ($dataTTD as $ttd) {
            // dd($ttd);
            $bulan = Carbon::parse($ttd->tgl_minum)->format('m');

            $puskesmasId = $ttd->puskesmas_id ?? null;
            $jenisKelamin = $ttd->jenis_kelamin;
            // dd($jenisKelamin);

            if ($puskesmasId && in_array($jenisKelamin, ['1', '2'])) {
                if (!isset($dataTTDPerPuskesmas[$puskesmasId][$bulan][$jenisKelamin])) {
                    $dataTTDPerPuskesmas[$puskesmasId][$bulan][$jenisKelamin] = 0;
                }

                $dataTTDPerPuskesmas[$puskesmasId][$bulan][$jenisKelamin]++;
            }
        }
        // dd($dataTTDPerPuskesmas);

        // Susun data untuk grafik
        $monthlyTTDPuskesmasData = [];

        foreach ($puskesmass as $puskesmas) {
            for ($m = 1; $m <= 12; $m++) {
                $bulan = str_pad($m, 2, '0', STR_PAD_LEFT);

                $laki = $dataTTDPerPuskesmas[$puskesmas->id][$bulan]['1'] ?? 0;
                $perempuan = $dataTTDPerPuskesmas[$puskesmas->id][$bulan]['2'] ?? 0;

                $monthlyTTDPuskesmasData[$bulan][] = [
                    'name' => $puskesmas->nama . ' (L)',
                    'value' => $laki,
                    'color' => 'blue',
                ];
                $monthlyTTDPuskesmasData[$bulan][] = [
                    'name' => $puskesmas->nama . ' (P)',
                    'value' => $perempuan,
                    'color' => 'pink',
                ];
            }
        }
        // dd($monthlyTTDPuskesmasData);


        // dd($dataPerPuskesmas, $colorPerPuskesmas, $monthlyPuskesmasData);

        return view('ttd.dashboard', compact('data', 'puskesmass', 'monthlyPuskesmasData', 'monthlyTTDPuskesmasData', 'layout'));
    }
}
