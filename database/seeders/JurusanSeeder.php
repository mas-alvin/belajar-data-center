<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use Illuminate\Database\Seeder;

class JurusanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama_jurusan' => 'Matematika dan Ilmu Pengetahuan Alam', 'kode_jurusan' => 'MIPA', 'status' => 'aktif'],
            ['nama_jurusan' => 'Ilmu Pengetahuan Sosial', 'kode_jurusan' => 'IPS', 'status' => 'aktif'],
            ['nama_jurusan' => 'Bahasa dan Sastra', 'kode_jurusan' => 'BAHASA', 'status' => 'aktif'],
            ['nama_jurusan' => 'Teknik Komputer dan Jaringan', 'kode_jurusan' => 'TKJ', 'status' => 'aktif'],
            ['nama_jurusan' => 'Akuntansi dan Keuangan Lemabaga', 'kode_jurusan' => 'AKL', 'status' => 'aktif'],
        ];

        foreach ($data as $item) {
            Jurusan::updateOrCreate(['kode_jurusan' => $item['kode_jurusan']], $item);
        }
    }
}
