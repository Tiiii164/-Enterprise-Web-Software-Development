<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topics extends Model
{
    use HasFactory;
    protected $table = 'topics';
    protected $primaryKey = 'id';
    //one Category has many Foods
    public function ideas()
    {
        return $this->hasMany(Ideas::class);
    }
}
