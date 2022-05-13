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

        $post = Post::create([
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
            return redirect()->route('admin.posts.index')->with('success', 'Blog Created Successfully');
        } elseif ($request->get('submit') == 'apply') {
            return redirect()->route('admin.posts.edit', $post->id)->with('success', 'Blog Created Successfully');
        }
    }

    public function allPost(Request $request)
    {

        // Listing columns to show
        $columns = array(
            0 => 'id',
            1 => 'title',
            2 => 'category',
            3 => 'author',
            4 => 'created_at',
            5 => 'status',
            6 => 'image',
            7 => 'action',
        );

        $totalData = Post::count(); // table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $contactCollection = Post::when($search, function ($query, $search) {
            return $query->where('title', 'LIKE', "%{$search}%")->orWhere('created_at', 'LIKE', "%{$search}%");
        });

        // dd($totalData);

        $totalFiltered = $contactCollection->count();

        $contactCollection = $contactCollection->offset($start)->limit($limit)->orderBy($order, $dir)->get();

        $data = [];

        foreach ($contactCollection as $key => $item) {
            $post = Post::findOrFail($item->id);
            $list = "";
            foreach ($post->categorys as $category) {
                $list .=  '<span class="badge badge-info mr-1">' . $category->name . '</span>';
            }
            $row['id'] = $item->id;
            $row['title'] = $item->title;
            $row['category'] = $list;
            $row['author'] = Auth::guard('admin')->user()->name;
            $row['created_at'] = $item->created_at->toDateString();
            $row['status'] =  '<span class="badge badge-success">' . $item->status . '</span>';
            $row['image'] =  '<img height="80" src="' . $item->image_src . '" alt="Image"/>';
            $row['action'] =  '<a href="' . route('admin.posts.edit', $item->id) . '"  class="edit btn btn-primary btn-sm">
            <i class="fas fa-edit"></i>
            </a>
            <a href="javascript:void(0);" data-url="' . route('admin.posts.destroy', $item->id) . '"
                data-id=' . $item->id . '  class="delete btn btn-danger btn-sm">
                <i class="fa fa-trash" aria-hidden="true"></i>
            </a>';

            $data[] = $row;
        }
        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        );

        return response()->json($json_data);
    }


    /**
     * Display the specified resource.
     *
     * @param  String $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
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
            return redirect()->route('admin.posts.index')->with('success', 'Blog Updated Successfully');
        } elseif ($request->get('submit') == 'apply') {
            return redirect()->route('admin.posts.edit', $post->id)->with('success', 'Blog Updated Successfully');
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
    public function remoteajax($model, $search)
    {
        $record = $model::orderby('name', 'asc')
            ->select('id', 'name as text')
            ->where('name', 'like', '%' . $search . '%')
            ->get();
        return $record;
    }

    public function blogtag(Request $request)
    {
        $search = $request->search;
        $tags = $this->remoteajax(Tag::class, $search);
        return response()->json($tags);
    }

    public function blogcategory(Request $request)
    {
        $search = $request->search;
        $categorys =  $this->remoteajax(Category::class, $search);
        return response()->json($categorys);
    }

    public function checkslug(Request $request)
    {
        $slug = Str::slug($request->title, '-');
        return response()->json([
            'slug' => $slug
        ]);
    }
}