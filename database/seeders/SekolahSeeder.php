<?php

namespace Database\Seeders;

use App\Models\Kecamatan;
use App\Models\Puskesmas;
use App\Models\Sekolah;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;

class SekolahSeeder extends Seeder
{
    public function run(): void
    {
        $spreadsheet = IOFactory::load(public_path('sekolah.xlsx'));
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        foreach ($rows as $index => $row) {

            $namaKec     = strtolower(trim($row[0]));
            $namaPuskes  = strtolower(trim($row[1]));
            $npsn        = $row[2];
            $namaSekolah = $row[3];
            $desa        = $row[4];
            $alamat      = $row[5];

            $kecamatan = Kecamatan::get()->first(function ($item) use ($namaKec) {
                return strtolower($item->nama) === $namaKec;
            });

            $puskesmas = Puskesmas::get()->first(function ($item) use ($namaPuskes) {
                return strtolower($item->nama) === $namaPuskes;
            });

            if ($kecamatan && $puskesmas) {
                Sekolah::updateOrCreate(
                    [
                        'kecamatan_id' => $kecamatan->id,
                        'puskesmas_id' => $puskesmas->id,
                        'npsn' => $npsn,
                        'nama' => $namaSekolah,
                        'kelurahan' => $desa,
                        'alamat' => $alamat,
                    ]
                );

                echo "Inserted: $namaSekolah ($npsn)\n";
            } else {
                echo "Skipped: $namaSekolah - Kecamatan/Puskesmas tidak ditemukan\n";
            }
        }
    }
}
