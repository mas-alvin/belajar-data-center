<?php

namespace Database\Seeders;

use App\Models\Guru;
use Illuminate\Database\Seeder;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gurus = [
            [
                'nip' => '198001012010011001',
                'nama_guru' => 'Budi Santoso, S.Pd',
                'jenis_kelamin' => 'L',
                'no_telp' => '081234567890',
                'status' => 'aktif',
            ],
            [
                'nip' => '198202022012022002',
                'nama_guru' => 'Siti Aminah, M.Pd',
                'jenis_kelamin' => 'P',
                'no_telp' => '081234567891',
                'status' => 'aktif',
            ],
            [
                'nip' => '198503032015031003',
                'nama_guru' => 'Ahmad Rifa\'i, S.Kom',
                'jenis_kelamin' => 'L',
                'no_telp' => '081234567892',
                'status' => 'aktif',
            ],
            [
                'nip' => '198804042018042004',
                'nama_guru' => 'Dewi Lestari, S.Si',
                'jenis_kelamin' => 'P',
                'no_telp' => '081234567893',
                'status' => 'aktif',
            ],
        ];

        foreach ($gurus as $guru) {
            Guru::updateOrCreate(['nip' => $guru['nip']], $guru);
        }
    }
}
