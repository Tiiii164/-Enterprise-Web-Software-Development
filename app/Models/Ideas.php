<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ideas extends Model
{
    use HasFactory;
    protected $table = 'ideas';
    protected $primaryKey = 'id';
    //protected $fillable = ['text','file-path'];
    protected $fillable = ['title', 'text', 'file_path', 'user_id', 'topics_id', 'categories_id'];

    //idea has many views, comments, reacts
    public function views()
    {
        return $this->hasMany(Views::class);
    }
    public function comments()
    {
        return $this->hasMany(Comments::class);
    }
    public function reacts()
    {
        return $this->hasMany(Reacts::class);
    }
    //idea belongs to category, topic, user
    public function categories()
    {
        return $this->belongsTo(Categories::class);
    }
    public function topics()
    {
        return $this->belongsTo(Topics::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function departments()
    {
        return $this->belongsTo(Departments::class);
    }
}
