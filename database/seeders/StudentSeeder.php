<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Kelas;
use Carbon\Carbon;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Menggunakan strategi CHUNK agar memori tidak over-allocated untuk inserts berskala besar (1000 data lebih).
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Pastikan ada kelas untuk dijadikan referensi foreign key
        if(Kelas::count() == 0){
            $kelas = ['XII MIPA 1', 'XII MIPA 2', 'XI IPS 1', 'X Bahasa 1', 'XI MIPA 3'];
            foreach($kelas as $k){
                Kelas::create([
                    'nama_kelas' => $k,
                    'jurusan' => str_contains($k, 'MIPA') ? 'MIPA' : (str_contains($k, 'IPS') ? 'IPS' : 'Bahasa'),
                    'status' => 'aktif'
                ]);
            }
        }

        $kelasIds = Kelas::pluck('id')->toArray();
        $totalData = 1000;
        $batchSize = 250; // Insert per 250 record
        
        $data = [];

        for ($i = 0; $i < $totalData; $i++) {
            $data[] = [
                'nis' => 'SN-' . date('Y') . sprintf("%05d", $i + 1),
                'nama' => $faker->name,
                'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                'tanggal_lahir' => $faker->dateTimeBetween('-18 years', '-15 years')->format('Y-m-d'),
                'alamat' => $faker->address,
                'kelas_id' => $faker->randomElement($kelasIds),
                'status' => $faker->randomElement(['aktif', 'aktif', 'aktif', 'nonaktif']), // 75% chance aktif
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];

            // Masukkan secara batch (bulk insert)
            if (count($data) >= $batchSize) {
                DB::table('students')->insert($data);
                $data = []; // reset array
            }
        }

        // Insert sisanya jika array tidak habis tepat by batchSize
        if (count($data) > 0) {
            DB::table('students')->insert($data);
        }
    }
}
