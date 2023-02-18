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
        // $role_Staff = Roles::where('name', 'Staff')->first();
        // $role_Manager = Roles::where('name', 'Manager')->first();
        // $role_Admin = Roles::where('name', 'Manager')->first();

        // $Admin = new User();
        // $Admin->name = 'Admin';
        // $Admin->email = 'admin@gmail.com';
        // $Admin->password = bcrypt('123');
        // $Admin->role_id = '3';
        // $Admin->department_id = '3'; 
        // $Admin->save();
        // $Admin->roles()->attach($role_Admin);

        // $Manager = new User();
        // $Manager->name = 'Manager';
        // $Manager->email = 'manager@gmail.com';
        // $Manager->password = bcrypt('123');
        // $Manager->role_id = '2';
        // $Manager->department_id = '2'; 
        // $Manager->save();
        // $Manager->roles()->attach($role_Manager);
           
        // User::create([
        //     'name' => 'Admin',
        //     'email' => 'admin@gmail.com',
        //     'password' => '123',
        //     'role_id' => 1,
        //     'department_id' => 1,
        //])
    }
}
