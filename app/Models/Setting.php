<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Setting extends Model implements HasMedia
{
    use  InteractsWithMedia;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'response'];

    public function getResponseAttribute($value)
    {
        return json_decode($value);
    }

    public function getLogoAttribute()
    {
        $logo_url = $this->getMedia('logo')->first();

        if ($logo_url) {
            return  $logo_url->getUrl();
        }
        return  asset('theme/assets/img/logos/logo-4-2.png');
    }


    public function getFaviconAttribute()
    {

        $favicon_url = $this->getMedia('favicon')->first();

        if ($favicon_url) {
            return  $favicon_url->getUrl();
        }

        return asset('admin/assets/media/misc/image.png');
    }

    public static function generalSettings()
    {
        return self::where('name', 'general_settings');
    }
}