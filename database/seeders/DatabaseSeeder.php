<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Role;
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
        $this->call(LaratrustSeeder::class);
    
        // $qaManager = new User();
        // $qaManager->name = 'QA Manager';
        // $qaManager->email = 'qamanager2002@gmail.com';
        // $qaManager->password = bcrypt('123');
        // $qaManager->save();
        // $qaManager->departments()->attach('1');
        // $qaManager->roles()->attach(Role::where('name', 'Manager')->first());
    }
}
