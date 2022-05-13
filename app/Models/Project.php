<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Project extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'title', 'description',
    ];

    protected $appends = ['image', 'filter', 'photo'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function blog()
    {
        return $this->hasMany(blog::class, 'post_id');
    }

    public function project_images()
    {
        return $this->hasMany(Project_image::class, 'project_id');
    }

    public function getImageAttribute()
    {
        $image_url = $this->getMedia('project')->first();
        if ($image_url) {
            return  $image_url->getUrl();
        }
        return 'https://via.placeholder.com/120x80.png';
    }

    public function getFilterAttribute()
    {
        $project_tags = $this->tags;
        $filter = '';
        foreach ($project_tags as $key => $list) {
            $filter .= ' ' . $list->name;
        }
        return $filter;
    }

    public function getPhotoAttribute()
    {
        $product_url = $this->getMedia('project-multiple');
        if ($product_url) {
            return  $product_url;
        }
        return 'https://via.placeholder.com/120x80.png';
    }
}
