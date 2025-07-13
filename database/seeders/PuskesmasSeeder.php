<?php

namespace Database\Seeders;

use App\Models\Puskesmas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PuskesmasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $puskesmas = [
            ['id' => 1, 'nama' => 'Pasrepan', 'kecamatan_id' => 5],
            ['id' => 2, 'nama' => 'Purwodadi', 'kecamatan_id' => 1],
            ['id' => 3, 'nama' => 'Wonorejo', 'kecamatan_id' => 7],
            ['id' => 4, 'nama' => 'Winongan', 'kecamatan_id' => 19],
            ['id' => 5, 'nama' => 'Kraton', 'kecamatan_id' => 16],
            ['id' => 6, 'nama' => 'Ngempit', 'kecamatan_id' => 16],
            ['id' => 7, 'nama' => 'Lekok', 'kecamatan_id' => 22],
            ['id' => 8, 'nama' => 'Pandaan', 'kecamatan_id' => 11],
            ['id' => 9, 'nama' => 'Purwosari', 'kecamatan_id' => 8],
            ['id' => 10, 'nama' => 'Grati', 'kecamatan_id' => 20],
            ['id' => 11, 'nama' => 'Kejayan', 'kecamatan_id' => 6],
            ['id' => 12, 'nama' => 'Sukorejo', 'kecamatan_id' => 9],
            ['id' => 13, 'nama' => 'Beji', 'kecamatan_id' => 13],
            ['id' => 14, 'nama' => 'Prigen', 'kecamatan_id' => 10],
            ['id' => 15, 'nama' => 'Gempol', 'kecamatan_id' => 12],
            ['id' => 16, 'nama' => 'Lumbang', 'kecamatan_id' => 4],
            ['id' => 17, 'nama' => 'Kedawung Wetan', 'kecamatan_id' => 20],
            ['id' => 18, 'nama' => 'Rembang', 'kecamatan_id' => 15],
            ['id' => 19, 'nama' => 'Gondang Wetan', 'kecamatan_id' => 18],
            ['id' => 20, 'nama' => 'Raci', 'kecamatan_id' => 16],
            ['id' => 21, 'nama' => 'Pohjentrek', 'kecamatan_id' => 17],
            ['id' => 22, 'nama' => 'Nguling', 'kecamatan_id' => 21],
            ['id' => 23, 'nama' => 'Ambal Ambil', 'kecamatan_id' => 6],
            ['id' => 24, 'nama' => 'Bangil', 'kecamatan_id' => 14],
            ['id' => 25, 'nama' => 'Sebani', 'kecamatan_id' => 11],
            ['id' => 26, 'nama' => 'Kepulungan', 'kecamatan_id' => 12],
            ['id' => 27, 'nama' => 'Rejoso', 'kecamatan_id' => 23],
            ['id' => 28, 'nama' => 'Puspo', 'kecamatan_id' => 3],
            ['id' => 29, 'nama' => 'Karangrejo', 'kecamatan_id' => 8],
            ['id' => 30, 'nama' => 'Nongkojajar', 'kecamatan_id' => 2],
            ['id' => 31, 'nama' => 'Bulukandang', 'kecamatan_id' => 8],
            ['id' => 32, 'nama' => 'Sumberpitu', 'kecamatan_id' => 2],
            ['id' => 33, 'nama' => 'Tosari', 'kecamatan_id' => 24],
        ];

        foreach ($puskesmas as $data) {
            Puskesmas::create($data);
        } 
    }
}
