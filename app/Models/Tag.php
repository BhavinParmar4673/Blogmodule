<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public Function project()
    {
        return $this->belongsToMany(Project::class);
    }

    public Function post()
    {
        return $this->belongsToMany(Post::class);
    }


}
