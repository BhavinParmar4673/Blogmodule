<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog = Blog::all();
        // view home page with all posts from database.
        return view('blogpost.home',compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorys = Category::all();
        $projects =  Project::all();
        return view('blogpost.create', [
            'categorys' => $categorys,
            'projects'  => $projects
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate incoming request data with validation rules
        $this->validate(request(), [
            'title' => 'required|min:1|max:255',
            'body'  => 'required|min:1|max:300',
            'file' => 'required|mimes:jpg,jpeg,png',
        ]);

        if ($request->hasFile('file')) {
            $path = Blog::uploadimage($request->file('file'));
        }
        // store data with create() method
        $post = Blog::create([
            'user_id'   => auth()->id(),
            'title'     => request()->title,
            'body'      => request()->body,
            'cat_id'    => request()->category,
            'project_id' => request()->project,
            'image'     => $path
        ]);
        return redirect()->route('blogs.index')->with('message', 'Blog Added Suceesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        return view('blogpost.show')->with('blog', $blog);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        $categorys = Category::all();
        $projects =  Project::all();
        return view('blogpost.edit', [
            'categorys' => $categorys,
            'projects'  => $projects,
            'blog' => $blog
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $this->validate(request(), [
            'title' => 'required|min:1|max:255',
            'body'  => 'required|min:1|max:300',
        ]);
        if ($request->hasFile('file')) {
            if ($blog->image && Storage::exists($blog->image)) {
                Storage::delete($blog->image);
            }
            $path = $blog->uploadimage($request->file('file'));
            $blog->image = $path;
        }
        $blog->title = request()->title;
        $blog->body = request()->body;
        $blog->cat_id = request()->category;
        $blog->project_id = request()->project;

        $blog->update();
        return redirect()->route('blogs.index')->with('message', 'Blog Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        //
    }
}
