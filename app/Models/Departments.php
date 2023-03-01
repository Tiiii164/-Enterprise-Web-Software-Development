<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $fillable = [
        "id",
        "name",
    ];
    protected $table = 'departments';
    protected $primaryKey = 'id';
    public function users()
    {
        return $this->belongsToMany(Users::class);
    }
}
