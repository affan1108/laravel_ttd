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
        // DB::table('kecamatans')->truncate();

        $kecamatans = [
            ['nama' => 'Kraton'],
            ['nama' => 'Grati'],
            ['nama' => 'Pandaan'],
            ['nama' => 'Pasrepan'],
            ['nama' => 'Purwodadi'],
            ['nama' => 'Kejayan'],
            ['nama' => 'Wonorejo'],
            ['nama' => 'Purwosari'],
            ['nama' => 'Winongan'],
            ['nama' => 'Lekok'],
            ['nama' => 'Gempol'],
            ['nama' => 'Prigen'],
            ['nama' => 'Bangil'],
            ['nama' => 'Sukorejo'],
            ['nama' => 'Beji'],
            ['nama' => 'Lumbang'],
            ['nama' => 'Rembang'],
            ['nama' => 'Gondang Wetan'],
            ['nama' => 'Pohjentrek'],
            ['nama' => 'Nguling'],
            ['nama' => 'Rejoso'],
            ['nama' => 'Puspo'],
            ['nama' => 'Tutur'],
            ['nama' => 'Tosari'],
        ];

        foreach ($kecamatans as $data) {
            Kecamatan::create($data); 
        }
    }
}
