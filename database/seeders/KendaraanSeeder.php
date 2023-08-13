<?php

namespace Database\Seeders;

use App\Models\kendaraan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KendaraanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        kendaraan::create([
            'kode_kendaraan' => '12345',
            'nama_kendaraan' => 'Kijang',
            'merk' => 'Toyota',
            'tahun' => '2001',
            'kondisi' => '2001',
            'status' => '1',
            'is_active' => '1',
        ]);
        kendaraan::create([
            'kode_kendaraan' => '12456',
            'nama_kendaraan' => 'Beat',
            'merk' => 'Honda',
            'tahun' => '2020',
            'kondisi' => 'baik',
            'status' => '1',
            'is_active' => '1',
        ]);
    }
}
