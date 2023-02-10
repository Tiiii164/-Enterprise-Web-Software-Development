<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reacts extends Model
{
    use HasFactory;
    protected $table = 'reacts';
    protected $primaryKey = 'id';
    //react belongs to user, idea 
    public function users()
    {
        return $this->belongsTo(Users::class);
    }
    public function ideas()
    {
        return $this->belongsTo(Ideas::class);
    }
}
