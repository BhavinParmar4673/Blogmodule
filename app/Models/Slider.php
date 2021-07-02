<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Slider extends Model
{
    use HasFactory;
    protected $fillable = [
        'heading', 'description','link','linkname','image','status',
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
        $path = $image->storeAs('slider', $name, [
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
}
