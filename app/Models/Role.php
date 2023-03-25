<?php

namespace App\Models;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    public $guarded = [];
    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user');
    }
    public function permissions() 
    {
        return $this->belongsToMany(Permission::class,'permission_role');
    }
}
