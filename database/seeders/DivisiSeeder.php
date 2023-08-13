<?php

namespace Database\Seeders;

use App\Models\divisi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        divisi::create([
            'nama_divisi' => 'produksi',
            'is_active' => '1',
        ]);
        divisi::create([
            'nama_divisi' => 'umum',
            'is_active' => '1',
        ]);
    }
}
