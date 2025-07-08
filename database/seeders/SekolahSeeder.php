<?php

namespace Database\Seeders;

use App\Models\Kecamatan;
use App\Models\Sekolah;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;

class SekolahSeeder extends Seeder
{
    public function run(): void
    {
        $path = public_path('SD SMP PASURUAN.xlsx');
        $spreadsheet = IOFactory::load($path);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        foreach ($rows as $index => $row) {
            if ($index == 0) continue; // skip header

            $npsn = trim($row[1]);
            $namaSekolah = trim($row[2]);
            $alamat = trim($row[3]);
            $kelurahan = trim($row[4]);
            $status = trim($row[5]);
            $namaKecamatan = trim($row[6]);
            $jenjang = trim($row[7]);

            $kecamatan = DB::table('kecamatans')->where('nama', $namaKecamatan)->first();

            if (!$kecamatan) {
                echo "❌ Kecamatan '$namaKecamatan' tidak ditemukan, baris dilewati.\n";
                continue;
            }


            Sekolah::create([
                'npsn' => $npsn,
                'nama' => $namaSekolah,
                'alamat' => $alamat,
                'kelurahan' => $kelurahan,
                'status' => $status,
                'kecamatan_id' => $kecamatan->id,
                'jenjang' => $jenjang,
            ]);
        }

        $this->command->info('Import selesai!');
    }
}
