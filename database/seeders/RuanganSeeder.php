<?php

namespace Database\Seeders;

use App\Models\Ruangan;
use Illuminate\Database\Seeder;

class RuanganSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama_ruangan' => 'Ruang Teori 01', 'kode_ruangan' => 'R01', 'kapasitas' => 36, 'status' => 'aktif'],
            ['nama_ruangan' => 'Ruang Teori 02', 'kode_ruangan' => 'R02', 'kapasitas' => 36, 'status' => 'aktif'],
            ['nama_ruangan' => 'Lab Komputer A', 'kode_ruangan' => 'LAB-A', 'kapasitas' => 40, 'status' => 'aktif'],
            ['nama_ruangan' => 'Lab Kimia', 'kode_ruangan' => 'LAB-KIM', 'kapasitas' => 32, 'status' => 'aktif'],
            ['nama_ruangan' => 'Perpustakaan Utama', 'kode_ruangan' => 'PERPUS', 'kapasitas' => 60, 'status' => 'aktif'],
        ];

        foreach ($data as $item) {
            Ruangan::updateOrCreate(['kode_ruangan' => $item['kode_ruangan']], $item);
        }
    }
}
