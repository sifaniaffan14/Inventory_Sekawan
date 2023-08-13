<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(DivisiSeeder::class);
        $this->call(DriverSeeder::class);
        $this->call(KendaraanSeeder::class);
        $this->call(KaryawanSeeder::class);
    }
}
