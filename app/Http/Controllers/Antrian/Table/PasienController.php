<?php

namespace App\Http\Controllers\Antrian\Table;

use App\Http\Controllers\Controller;
use App\Models\Antrian\Patient;
use App\Models\MWLWL;
// use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = DB::table('antrian_patientwl')
                ->join('antrian_mwlwl', 'antrian_patientwl.PATIENT_ID', '=', 'antrian_mwlwl.PATIENT_ID')
                ->leftJoin('report_ris_2024-11-09', 'report_ris_2024-11-09.ACCESSION_NO', '=', 'antrian_mwlwl.ACCESSION_NO')
                ->leftJoin('antrian_study_ris as sris', function ($join) {
                    $join->on('report_ris_2024-11-09.ACCESSION_NO', '=', 'sris.ACCESSION_NO');
                    $join->where('sris.PATIENT_LOCATION', 'Radiologi');
                })
                ->select('antrian_patientwl.PATIENT_ID','antrian_patientwl.PATIENT_SEX','antrian_mwlwl.ACCESSION_NO','antrian_mwlwl.PATIENT_NAME', 'report_ris_2024-11-09.ID_REPORT_RIS', 'sris.ACCESSION_NO')
                // ->select('antrian_mwlwl.ACCESSION_NO', 'report_ris.ACCESSION_NO', 'antrian_study_ris.ACCESSION_NO')
                ->where('antrian_mwlwl.PATIENT_LOCATION', 'Radiologi')
                ->groupBy('antrian_patientwl.PATIENT_ID','antrian_patientwl.PATIENT_SEX','antrian_mwlwl.ACCESSION_NO','antrian_mwlwl.PATIENT_NAME', 'report_ris_2024-11-09.ID_REPORT_RIS', 'sris.ACCESSION_NO')
                ->get();
        $data = DB::table('antrian_patientwl')->select('PATIENT_ID','PATIENT_NAME')->get();
        // dd($patients);
        return view("antrian.tables.pasien.index", compact('patients','data'));
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
        // dd($request);
        // Ambil data dari request
        $token = $request->get('_token');
        $antrian = $request->get('antrian'); // "ABDUL KODIR|00467008"
        $accessionNo = $request->get('accession_no');
        $request_depatment = $request->get('REQUEST_DEPARTMENT');

        // Pisahkan nama pasien dan ID pasien
        [$patientName, $patientId] = explode('|', $antrian);

        // Debug output
        // return new Response("
        //     Token: $token <br>
        //     Patient Name: $patientName <br>
        //     Patient ID: $patientId <br>
        //     Accession No: $accessionNo
        // ");

        MWLWL::create([
            'PATIENT_ID' => $patientId,
            'PATIENT_NAME' => $patientName,
            'ACCESSION_ID' => $accessionNo,
            'REQUEST_DEPARTMENT' => $request_depatment,
        ]);

        return redirect()->back();
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
        $pasien = MWLWL::where('PATIENT_ID', $id)->firstOrFail();

        // Update PATIENT_NAME dengan data dari request
        $pasien->PATIENT_NAME = $request->input('PATIENT_NAME');
        // dd($pasien);

        $pasien->save();

        return redirect()->back()->with('success', 'Video berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
