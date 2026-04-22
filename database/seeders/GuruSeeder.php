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
        $faker = \Faker\Factory::create('id_ID');

        for ($i = 0; $i < 15; $i++) {
            $jk = $faker->randomElement(['L', 'P']);
            $gelar = $jk === 'L' ? 'S.Pd' : 'M.Pd';
            $nama = $faker->firstName($jk === 'L' ? 'male' : 'female') . ' ' . $faker->lastName . ', ' . $gelar;

            \App\Models\Guru::create([
                'nip' => $faker->unique()->numerify('198#######201#####'),
                'nama_guru' => $nama,
                'jenis_kelamin' => $jk,
                'no_telp' => $faker->phoneNumber,
                'status' => 'aktif',
            ]);
        }
    }
}
