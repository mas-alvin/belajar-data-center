<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        $jurusanIds = \App\Models\Jurusan::pluck('id')->toArray();
        $guruIds = \App\Models\Guru::pluck('id')->toArray();

        $kelasNames = [
            'X MIPA 1', 'X MIPA 2', 'X IPS 1', 
            'XI MIPA 1', 'XI MIPA 2', 'XI IPS 1', 
            'XII MIPA 1', 'XII MIPA 2', 'XII IPS 1'
        ];

        foreach ($kelasNames as $nama) {
            \App\Models\Kelas::updateOrCreate(['nama_kelas' => $nama], [
                'nama_kelas' => $nama,
                'jurusan_id' => $jurusanIds[array_rand($jurusanIds ?? [1])],
                'wali_kelas_id' => $guruIds[array_rand($guruIds ?? [1])] ?? null,
                'status' => 'aktif'
            ]);
        }
    }
}
