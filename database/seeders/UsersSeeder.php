<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'role_id' => '1',
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'is_active' => '1',
        ]);
        User::create([
            'role_id' => '3',
            'username' => 'affan',
            'password' => Hash::make('manager_123'),
            'is_active' => '1',
        ]);
        User::create([
            'role_id' => '3',
            'username' => 'rutt',
            'password' => Hash::make('manager_123'),
            'is_active' => '1',
        ]);
        User::create([
            'role_id' => '4',
            'username' => 'sifani',
            'password' => Hash::make('staff_123'),
            'is_active' => '1',
        ]);
        User::create([
            'role_id' => '2',
            'username' => 'direktur',
            'password' => Hash::make('direktur_123'),
            'is_active' => '1',
        ]);
        User::create([
            'role_id' => '4',
            'username' => 'coba',
            'password' => Hash::make('staff_123'),
            'is_active' => '1',
        ]);
    }
}
