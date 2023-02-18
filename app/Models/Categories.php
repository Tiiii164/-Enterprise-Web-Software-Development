<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $fillable = ['name'];
    const CREATED_AT = 'day_time';
    const UPDATED_AT = null;
    //one Category has many Foods
    public function ideas()
    {
        return $this->hasMany(Ideas::class);
    }
}
