<?php

namespace Database\Seeders;

use App\Models\Kecamatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kecamatans = [
            ['id' => 1, 'nama' => 'Pasrepan'],
            ['id' => 2, 'nama' => 'Purwodadi'],
            ['id' => 3, 'nama' => 'Wonorejo'],
            ['id' => 4, 'nama' => 'Winongan'],
            ['id' => 5, 'nama' => 'Kraton'],
            ['id' => 6, 'nama' => 'Ngempit'],
            ['id' => 7, 'nama' => 'Lekok'],
            ['id' => 8, 'nama' => 'Pandaan'],
            ['id' => 9, 'nama' => 'Purwosari'],
            ['id' => 10, 'nama' => 'Grati'],
            ['id' => 11, 'nama' => 'Kejayan'],
            ['id' => 12, 'nama' => 'Sukorejo'],
            ['id' => 13, 'nama' => 'Beji'],
            ['id' => 14, 'nama' => 'Prigen'],
            ['id' => 15, 'nama' => 'Gempol'],
            ['id' => 16, 'nama' => 'Lumbang'],
            ['id' => 17, 'nama' => 'Kedawung Wetan'],
            ['id' => 18, 'nama' => 'Rembang'],
            ['id' => 19, 'nama' => 'Gondang Wetan'],
            ['id' => 20, 'nama' => 'Raci'],
            ['id' => 21, 'nama' => 'Pohjentrek'],
            ['id' => 22, 'nama' => 'Nguling'],
            ['id' => 23, 'nama' => 'Ambal Ambil'],
            ['id' => 24, 'nama' => 'Bangil'],
            ['id' => 25, 'nama' => 'Sebani'],
            ['id' => 26, 'nama' => 'Kepulungan'],
            ['id' => 27, 'nama' => 'Rejoso'],
            ['id' => 28, 'nama' => 'Puspo'],
            ['id' => 29, 'nama' => 'Karangrejo'],
            ['id' => 30, 'nama' => 'Nongkojajar'],
            ['id' => 31, 'nama' => 'Bulukandang'],
            ['id' => 32, 'nama' => 'Sumberpitu'],
            ['id' => 33, 'nama' => 'Tosari'],
        ];

        foreach ($kecamatans as $data) {
            Kecamatan::create($data); 
        }
    }
}
