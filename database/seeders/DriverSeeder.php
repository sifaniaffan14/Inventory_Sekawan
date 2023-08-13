<?php

namespace Database\Seeders;

use App\Models\driver;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        driver::create([
            'kode_driver' => '1234',
            'nama' => 'sifani',
            'status' => '1',
            'is_active' => '1',
        ]);
        driver::create([
            'kode_driver' => '12777',
            'nama' => 'affan',
            'status' => '1',
            'is_active' => '1',
        ]);
    }
}
