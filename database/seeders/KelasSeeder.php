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

        $data = [
            ['nama_kelas' => 'X MIPA 1', 'jurusan_id' => $jurusanIds[array_rand($jurusanIds ?? [1])], 'wali_kelas_id' => $guruIds[array_rand($guruIds ?? [1])] ?? null, 'status' => 'aktif'],
            ['nama_kelas' => 'XI IPS 2', 'jurusan_id' => $jurusanIds[array_rand($jurusanIds ?? [1])], 'wali_kelas_id' => $guruIds[array_rand($guruIds ?? [1])] ?? null, 'status' => 'aktif'],
            ['nama_kelas' => 'XII MIPA 1', 'jurusan_id' => $jurusanIds[array_rand($jurusanIds ?? [1])], 'wali_kelas_id' => $guruIds[array_rand($guruIds ?? [1])] ?? null, 'status' => 'aktif'],
            ['nama_kelas' => 'X TKJ 1', 'jurusan_id' => $jurusanIds[array_rand($jurusanIds ?? [1])], 'wali_kelas_id' => $guruIds[array_rand($guruIds ?? [1])] ?? null, 'status' => 'aktif'],
        ];

        foreach ($data as $item) {
            Kelas::updateOrCreate(['nama_kelas' => $item['nama_kelas']], $item);
        }
    }
}
