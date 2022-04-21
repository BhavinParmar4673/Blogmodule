<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'body', 'image', 'cat_id', 'project_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }


    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

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
        $path = $image->storeAs('blogpost', $name, [
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
}