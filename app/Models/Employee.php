<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Employee extends Model implements HasMedia
{
    use HasFactory;
    use SoftDeletes;
    use InteractsWithMedia;


    public function getProfileAttribute()
    {
        $image_url = $this->getMedia('employee')->first();
        if ($image_url) {
            return  $image_url->getUrl();
        }
        return 'https://via.placeholder.com/120x80.png';
    }
}