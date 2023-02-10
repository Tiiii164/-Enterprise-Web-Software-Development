<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Database\Eloquent\Model;


//model
class Users extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    //user has many ideas, comments,reacts,views
    public function ideas()
    {
        return $this->hasMany(Ideas::class);
    }
    public function comments()
    {
        return $this->hasMany(Comments::class);
    }
    public function views()
    {
        return $this->hasMany(Views::class);
    }
    public function reacts()
    {
        return $this->hasMany(Reacts::class);
    }
    //user belongs to department and role
    public function roles()
    {
        return $this->belongsTo(Roles::class);
    }
    public function departments()
    {
        return $this->belongsTo(Departments::class);
    }
}


//authentication
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
