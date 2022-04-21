<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\Project;

class PostController extends Controller
{
    public function post()
    {
        $posts = Post::latest()->paginate(5);
        $blogs = Post::latest()->take(4)->get();
        $categorys = Category::all();
        return view('frontend.blog', [
            'posts' => $posts,
            'categorys' => $categorys,
            'blogs' => $blogs
        ]);
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $categorys = Category::all();
        $blogs = Post::latest()->take(4)->get();
        return view('frontend.singleblog', [
            'post' => $post,
            'categorys' => $categorys,
            'blogs' => $blogs
        ]);
    }
}