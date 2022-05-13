<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Service extends Model  implements HasMedia
{
    use HasFactory;
    use SoftDeletes;
    use InteractsWithMedia;

    protected $appends = ['image_src'];

    public function features()
    {
        return $this->hasMany(ServiceFeature::class, 'service_id');
    }

    public function getImageSrcAttribute()
    {
        $image_url = $this->getMedia('service')->first();
        if ($image_url) {
            return  $image_url->getUrl();
        }
        return 'https://via.placeholder.com/120x80.png';
    }
}
