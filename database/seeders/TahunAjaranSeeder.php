<?php

namespace Database\Seeders;

use App\Models\TahunAjaran;
use Illuminate\Database\Seeder;

class TahunAjaranSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['tahun' => '2023/2024', 'semester' => 'Ganjil', 'status' => 'nonaktif'],
            ['tahun' => '2023/2024', 'semester' => 'Genap', 'status' => 'nonaktif'],
            ['tahun' => '2024/2025', 'semester' => 'Ganjil', 'status' => 'aktif'],
            ['tahun' => '2024/2025', 'semester' => 'Genap', 'status' => 'nonaktif'],
        ];

        foreach ($data as $item) {
            TahunAjaran::updateOrCreate(
                ['tahun' => $item['tahun'], 'semester' => $item['semester']],
                $item
            );
        }
    }
}
