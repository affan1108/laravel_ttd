<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            KecamatanSeeder::class,
            PuskesmasSeeder::class,
            SekolahSeeder::class,
            PemeriksaanSeeder::class,
        ]);
    }
}
