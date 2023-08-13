<?php

namespace Database\Seeders;

use App\Models\karyawan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        karyawan::create([
            'nama_karyawan' => 'affan',
            'divisi_id' => '1',
            'user_id' => '2',
            'jabatan' => 'manager',
            'is_active' => '1',
        ]);
        karyawan::create([
            'nama_karyawan' => 'rutt',
            'divisi_id' => '1',
            'user_id' => '3',
            'jabatan' => 'manager',
            'is_active' => '1',
        ]);
        karyawan::create([
            'nama_karyawan' => 'sifani',
            'divisi_id' => '1',
            'user_id' => '4',
            'jabatan' => 'staff',
            'is_active' => '1',
        ]);
        karyawan::create([
            'nama_karyawan' => 'direktur',
            'divisi_id' => '1',
            'user_id' => '5',
            'jabatan' => 'direktur',
            'is_active' => '1',
        ]);
        karyawan::create([
            'nama_karyawan' => 'coba',
            'divisi_id' => '2',
            'user_id' => '6',
            'jabatan' => 'staff',
            'is_active' => '1',
        ]);
    }
}
