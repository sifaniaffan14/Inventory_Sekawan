<?php

namespace Database\Seeders;

use App\Models\role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        role::create([
            'nama_role' => 'admin',
            'is_active' => '1',
        ]);
        role::create([
            'nama_role' => 'direktur',
            'is_active' => '1',
        ]);
        role::create([
            'nama_role' => 'manager',
            'is_active' => '1',
        ]);
        role::create([
            'nama_role' => 'staff',
            'is_active' => '1',
        ]);
    }
}
