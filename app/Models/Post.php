<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug','content', 'image','description','status',
    ];

    public function getImageSrcAttribute()
    {
        if (Storage::exists($this->image)) {
            return asset('storage/' . $this->image);
        }
        return asset('/storage/uploads/avatar.jpg');
    }

    public static function uploadimage($image)
    {
        $name = $image->getClientOriginalName();
        $path = $image->storeAs('post', $name, [
            'disk' => 'public',
        ]);
        return $path;
    }

    public function deleteimage()
    {
        if($this->image && Storage::exists($this->image)){
            Storage::delete($this->image);
        }
    }

    public function categorys()
    {
        return $this->belongsToMany(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function getStatusAttribute($attribute)
    {
        return[
            0=>'Pending',
            1=>'Published'
        ][$attribute];
    }

    public function setSlugAttribute($value) {
        if (static::whereSlug($slug = Str::slug($value))->exists()) {
            $slug = $this->incrementSlug($slug);
        }
        $this->attributes['slug'] = $slug;
    }

    public function incrementSlug($slug) {
        $original = $slug;
        $count = 1;
        while (static::whereSlug($slug)->exists()) {
            $slug = "{$original}-" . $count++;
        }
        return $slug;
    }

}
