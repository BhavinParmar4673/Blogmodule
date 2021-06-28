<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        return view('admin.post.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',  
            'content' => 'required|min:5|max:10000',
            'description' => 'required|min:5|max:200',
            'categorys' => 'required',
            'tags' => 'required',
            'file' => 'required|mimes:jpg,jpeg,png',
        ]);

        $slug = Str::slug($request->title, '-');
        if ($request->hasFile('file')) {
            $path = Post::uploadimage($request->file('file'));
        }

        $post =Post::create([
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'content' => $request->content,
            'image' => $path,
            'status' => $request->status
        ]);

        $post->tags()->sync($request->tags);
        $post->categorys()->sync($request->categorys);
        
        if ($request->get('submit') == 'save') {
            return redirect()->route('admin.posts.index')->with('message', 'Blog Created Successfully');
        } elseif ($request->get('submit') == 'apply') {
            return redirect()->route('admin.posts.edit',$post->id)->with('message', 'Blog Created Successfully');
        }
    }

    public function allpost(Request $request)
    {
        $draw = $request->input('draw');
        $start = $request->input('start');
        $rowperpage = $request->input('length'); // Rows display per page
        $columnIndex = $request->input('order')[0]['column']; // Column index
        $columnName = $request->input('columns')[$columnIndex]['data']; // Column name
        $columnSortOrder = $request->input('order')[0]['dir']; // asc or desc
        $searchValue = $request->input('search')['value']; // Search value

            // Total records
            $totalRecords = Post::select('count(*) as allcount')
                ->when($searchValue != '', function ($query) use ($searchValue) {
                    return $query->where('id', 'like', '%' . $searchValue . '%')
                        ->orwhere('title', 'like', '%' . $searchValue . '%')
                        ->orwhere('created_at', 'like', '%' . $searchValue . '%');
                })->count();

            // Fetch records
            $records = Post::orderBy($columnName, $columnSortOrder)
                ->when($searchValue != '', function ($query) use ($searchValue) {
                    return $query->where('id', 'like', '%' . $searchValue . '%')
                    ->orwhere('title', 'like', '%' . $searchValue . '%')
                    ->orwhere('created_at', 'like', '%' . $searchValue . '%');
                })
                ->select('posts.*')
                ->skip($start)
                ->take($rowperpage)
                ->get();

            foreach ($records as $record) {
                $id = $record->id;
                $title =  $record->title;
                $post = Post::findorFail($id);
                $categorylist = "";
                foreach ($post->categorys as $category) {
                    $categorylist .=  '<span class="badge badge-info mr-1">' . $category->name . '</span>';
                }
                $author =Auth::guard('admin')->user()->name;
                $created_at = $record->created_at->toDateString();
                $status = '<span class="badge badge-success">'.$record->status.'</span>';
                $image = '<img height="80" src="' . $record->image_src . '" alt="Image"/>';
                $operation = '<a href="' . route('admin.posts.edit', $record->id) . '"  class="edit btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                      </a>
                      <a href="javascript:void(0);" data-url="' . route('admin.posts.destroy', $record->id) . '" 
                        data-id=' . $record->id . '  class="delete btn btn-danger btn-sm">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                      </a>';

                $data_arr[] = array(
                    "id" => $id,
                    "title" => $title,
                    "category" => $categorylist,
                    "author" => $author,
                    "created_at"=>$created_at,
                    "status" =>$status,
                    "image" => $image,
                    "operations" => $operation,
                );
            }

            $response = array(
                "draw" => intval($draw),
                "iTotalRecords" => $totalRecords,
                "iTotalDisplayRecords" => $totalRecords,
                "aaData" => $data_arr
            );
            return response()->json($response, 200);
    }
    

    /**
     * Display the specified resource.
     *
     * @param  String $slug
     * 
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {   
        $post = Post::where('slug',$slug)->first();
        $categorys = Category::all();
        $blogs = Post::latest()->take(4)->get();
        return view('admin.frontend.singleblog',[
            'post' => $post,
            'categorys' => $categorys,
            'blogs' => $blogs
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.post.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required|min:5',
            'description' => 'required|min:5|max:200',
        ]);

        $slug = Str::slug($request->title, '-');
        if ($request->hasFile('file')) {
            $post->deleteimage();
            $path = $post->uploadimage($request->file('file'));
            $post->image = $path;
        }
        $post->update([
                'title' => $request->title,
                'slug' => $slug,
                'description' => $request->description,
                'content' => $request->content,
                'status' => $request->status
             ]);
        $post->tags()->sync($request->tags);
        $post->categorys()->sync($request->categorys);
        if ($request->get('submit') == 'save') {
            return redirect()->route('admin.posts.index')->with('message', 'Blog Updated Successfully');
        } elseif ($request->get('submit') == 'apply') {
            return redirect()->route('admin.posts.edit',$post->id)->with('message', 'Blog Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->deleteimage(); //delete image in source folder
        $post->delete();
        return response()->json(['success' => 'Blog deleted successfully.']);
    }

    //common function of remotedata in mutiselect using ajax
    public function remoteajax($model,$search){
        $record = $model::orderby('name', 'asc')
             ->select('id', 'name as text')
             ->where('name', 'like', '%' . $search . '%')
             ->get();
         return $record;
     }

    public function blogtag(Request $request)
    {
        $search = $request->search;
        $tags = $this->remoteajax(Tag::class,$search);
        return response()->json($tags);
    }

    public function blogcategory(Request $request)
    {
        $search = $request->search;
        $categorys =  $this->remoteajax(Category::class,$search);
        return response()->json($categorys);
    }

    public function checkslug(Request $request){
        $slug = Str::slug($request->title, '-');
        return response()->json([
            'slug'=>$slug
        ]);
    }

    public function post()
    {   
        $posts = Post::latest()->paginate(5);
        $blogs = Post::latest()->take(4)->get();
        $categorys = Category::all();
        return view('admin.frontend.blog',[
            'posts' => $posts,
            'categorys' => $categorys,
            'blogs' => $blogs
        ]);
    }



}
