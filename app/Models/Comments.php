<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $primaryKey = 'id';
    //comment belongs to user, idea 
    public function users()
    {
        return $this->belongsTo(Users::class);
    }
    public function ideas()
    {
        return $this->belongsTo(Ideas::class);
    }
}
