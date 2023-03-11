<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $primaryKey = 'id';
    protected $fillable = ['text'];
    //comment belongs to user, idea 
    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function ideas()
    {
        return $this->belongsTo(Ideas::class);
    }
}
