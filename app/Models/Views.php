<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Views extends Model
{
    use HasFactory;
    protected $table = 'views';
    protected $primaryKey = 'id';
    //view belongs to user, idea 
    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function ideas()
    {
        return $this->belongsTo(Ideas::class);
    }
}
