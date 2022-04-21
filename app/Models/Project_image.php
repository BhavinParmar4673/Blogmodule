<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Project_image extends Model
{
    use HasFactory;


    protected $fillable = [
        'image', 'project_id',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
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
        $path = $image->storeAs('project', $name, [
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