<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'image',
    ];

    public function getImageSrcAttribute()
    {
        if (Storage::exists($this->image)) {
            return asset('storage/' . $this->image);
        }
        return 'https://via.placeholder.com/120x80.png';
    }


    public static function uploadimage($image)
    {
        $name = $image->getClientOriginalName();
        $path = $image->storeAs('uploads', $name, [
            'disk' => 'public',
        ]);
        return $path;
    }

    public function deleteimage()
    {
        if ($this->image && Storage::exists($this->image)) {
            Storage::delete($this->image);
        }
    }

    public function blog()
    {
        return $this->hasMany(Blog::class, 'post_id');
    }

    public function post()
    {
        return $this->belongsToMany(Post::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}