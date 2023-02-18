<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Roles;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_Staff = new Roles();
        $role_Staff->name = 'Staff';
        $role_Staff->save();

        $role_Manager = new Roles();
        $role_Manager->name = 'Manager';
        $role_Manager->save();

        $role_Admin = new Roles();
        $role_Admin->name = 'Admin';
        $role_Admin->save();

        Roles::create(['name'=>'Admin']);
        Roles::create(['name'=>'Staff']);
        Roles::create(['name'=>'Manager']);
    }
}
