<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AboutUs extends Model
{
    use HasFactory;

    protected $appends = ['file_src'];

    public function getFileSrcAttribute()
    {
        $str = Str::after($this->file, 'https://youtu.be/');
        return $str;
    }
}