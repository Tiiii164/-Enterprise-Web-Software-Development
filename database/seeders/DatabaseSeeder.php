<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

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
        // DB::table('departments')->insert([
        //     'name' => 'IT',
        // ]);

        // $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
    }
}
