<?php

namespace Database\Seeders;

use App\Models\MataPelajaran;
use Illuminate\Database\Seeder;

class MataPelajaranSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama_mapel' => 'Matematika Wajib', 'kode_mapel' => 'MTK-W', 'kelompok' => 'A', 'status' => 'aktif'],
            ['nama_mapel' => 'Bahasa Indonesia', 'kode_mapel' => 'BIN-W', 'kelompok' => 'A', 'status' => 'aktif'],
            ['nama_mapel' => 'Bahasa Inggris', 'kode_mapel' => 'BIG-W', 'kelompok' => 'A', 'status' => 'aktif'],
            ['nama_mapel' => 'Fisika', 'kode_mapel' => 'FIS-P', 'kelompok' => 'C', 'status' => 'aktif'],
            ['nama_mapel' => 'Ekonomi', 'kode_mapel' => 'EKO-P', 'kelompok' => 'C', 'status' => 'aktif'],
            ['nama_mapel' => 'Pendidikan Jasmani', 'kode_mapel' => 'PJOK', 'kelompok' => 'B', 'status' => 'aktif'],
        ];

        foreach ($data as $item) {
            MataPelajaran::updateOrCreate(['kode_mapel' => $item['kode_mapel']], $item);
        }
    }
}
