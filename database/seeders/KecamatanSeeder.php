<?php

namespace Database\Seeders;

use App\Models\Kecamatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $path = public_path('35.14_kecamatan.geojson');
        $geojson = json_decode(File::get($path), true);

        foreach ($geojson['features'] as $feature) {
            $nama = $feature['properties']['nm_kecamatan'] ?? 'Tanpa Nama';
            $geometry = json_encode($feature['geometry']);

            DB::table('kecamatans')->insert([
                'nama' => $nama,
                'geometry' => DB::raw("ST_GeomFromGeoJSON('$geometry')"),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
