<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topics extends Model
{
    use HasFactory;
    protected $table = 'topics';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'closure_date', 'final_closure_date'];
    public $timestamps = false;

    public function ideas()
    {
        return $this->hasMany(Ideas::class);
    }

    public function isDeadlinePassed()
    {
        return now() > $this->closure_date;
    }

}
