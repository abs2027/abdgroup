<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LokasiPenempatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('lokasi_penempatans')->insert([
            [
                'nama_lokasi' => 'Kantor Pusat - Serang',
                'alamat_lokasi' => 'Jl. Raya Serang No. 123',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lokasi' => 'Kantor Cabang - Cilegon',
                'alamat_lokasi' => 'Jl. Industri Cilegon No. 45',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
