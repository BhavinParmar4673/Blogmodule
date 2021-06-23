<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Blog $blog)
    {
        // validate incoming request data
        $this->validate(request(), [
            'new_comment' => 'required|min:1|max:255'
        ]);

      
        // store comment
        // $comment = new Comment();
        // $comment->user_id = auth()->id();
        // $comment->post_id = request()->post_id;
        // $comment->body = request()->new_comment;
        // $comment->save();

     

         $blog->comments()->create([
            'user_id'   => auth()->id(),
            'body'      => request()->new_comment
        ]);


        // redirect to the previous URL
        return redirect()->back();
    }
}
