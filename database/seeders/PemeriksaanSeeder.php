<?php

namespace Database\Seeders;

use App\Models\Pemeriksaan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PemeriksaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pemeriksaan = [
            ['id' => 1, 'nik' => '05648216564894451', 'nama' => 'Bambang', 'nomer' => '081654987561','tempat_lahir' => 'Pasuruan', 'alamat' => 'Pasuruan', 'tgl_lahir' => '2005-12-05', 'kecamatan_id' => 1,  'puskesmas_id' => 2, 'sekolah_id' => 1, 'alamat_sekolah' => 'lekok', 'kelas' => '7', 'jenis_kelamin' => '1', 'nama_ortu' => 'fahmi'],
            ['id' => 2, 'nik' => '05648216076911135', 'nama' => 'Nana', 'nomer' => '087632165498','tempat_lahir' => 'Pasuruan', 'alamat' => 'Pasuruan', 'tgl_lahir' => '2005-02-18', 'kecamatan_id' => 16,  'puskesmas_id' => 5, 'sekolah_id' => 2, 'alamat_sekolah' => 'bangil', 'kelas' => '8', 'jenis_kelamin' => '2', 'nama_ortu' => 'novan'],
            ['id' => 3, 'nik' => '54354216564643543', 'nama' => 'Bambang Nana', 'nomer' => '085641235987','tempat_lahir' => 'Pasuruan', 'alamat' => 'Pasuruan', 'tgl_lahir' => '2005-10-25', 'kecamatan_id' => 11,  'puskesmas_id' => 8, 'sekolah_id' => 3, 'alamat_sekolah' => 'kota', 'kelas' => '9', 'jenis_kelamin' => '1', 'nama_ortu' => 'angga'],
        ];

        foreach ($pemeriksaan as $data) {
            Pemeriksaan::create($data); 
        }
    }
}
