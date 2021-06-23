<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    
    public function blog()
    {
    	return $this->hasMany(blog::class, 'post_id');
    }

    public function project_images()
    {
        return $this->hasMany(Project_image::class,'project_id');
    }

}
