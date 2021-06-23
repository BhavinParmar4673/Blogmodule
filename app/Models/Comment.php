<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'post_id', 'body'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function blog()
    {
    	return $this->belongsTo(Blog::class, 'post_id');
    }
    
    public function replies()
    {
    	return $this->hasMany(Reply::class, 'comment_id');
    }
}
