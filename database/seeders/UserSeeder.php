<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Roles;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Admin = new User();
        $Admin->name = 'Admin';
        $Admin->email = 'admin@gmail.com';
        $Admin->password = bcrypt('123');
        $Admin->role_id = '3';
        $Admin->department_id = '1'; 
        $Admin->save();

        $Manager = new User();
        $Manager->name = 'Manager';
        $Manager->email = 'manager@gmail.com';
        $Manager->password = bcrypt('123');
        $Manager->role_id = '2';
        $Manager->department_id = '1'; 
        $Manager->save();
    }
}
