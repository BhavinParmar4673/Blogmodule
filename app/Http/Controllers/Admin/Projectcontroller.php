<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Traits\DatatableTrait;

class ProjectController extends Controller
{
    use DatatableTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['title'] = 'Projects';
        return $this->view('admin.project.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::whereNull('is_active')->get();
        $this->data['title'] = 'create Project';
        $this->data['category'] = $category;
        return $this->view('admin.project.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'title' => 'required',
        //     'description' => 'required',
        //     'images' => 'required',
        //     'images.*' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
        //     'tags' => 'required|min:1'
        // ]);

        $project = new Project();
        $project->title = $request->title;
        $project->client = $request->client;
        $project->category_id = $request->cat_id;
        $project->view_more = $request->description;
        $project->website = $request->url;
        $project->brief = $request->brief;
        $project->save();

        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $project->addMediaFromRequest('file')->toMediaCollection('project');
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $project->addMedia($file)->toMediaCollection('project-multiple');
            }
        }
        $project->tags()->sync($request->tags, false);

        return redirect()->route('admin.projects.index')->with('success', 'Project Created Successfully');
    }

    public function allProject(Request $request)
    {

        // Listing columns to show
        $columns = array(
            0 => 'id',
            1 => 'title',
            2 => 'description',
            4 => 'tag',
            5 => 'action',
        );

        $totalData = Project::count(); // table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $contactCollection = Project::when($search, function ($query, $search) {
            return $query->where('title', 'LIKE', "%{$search}%")->orWhere('description', 'LIKE', "%{$search}%");
        });

        // dd($totalData);

        $totalFiltered = $contactCollection->count();

        $contactCollection = $contactCollection->offset($start)->limit($limit)->orderBy($order, $dir)->get();

        $data = [];

        foreach ($contactCollection as $key => $item) {
            $project = Project::findOrFail($item->id);
            $list = "";
            foreach ($project->tags as $tag) {
                $list .=  '<span class="badge badge-info mr-1">' . $tag->name . '</span>';
            }
            $row['id'] = $item->id;
            $row['title'] = $item->title;
            $row['category'] = '<span class="badge badge-success">' . $item->category->name . '</span>';
            $row['tag'] =  $list;
            $row['action'] =  '<a href="' . route('admin.projects.edit', $item->id) . '"  class="edit btn btn-primary btn-sm">
            <i class="fas fa-edit"></i>
            </a>
            <a href="javascript:void(0);" data-url="' . route('admin.projects.destroy', $item->id) . '"
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $tags = $project->tags;
        $category = Category::whereNull('is_active')->get();
        $this->data['title'] = 'Edit Project';
        $this->data['category'] = $category;
        $this->data['project'] = $project;
        $this->data['tags'] = $tags;
        return $this->view('admin.project.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $project->title = $request->title;
        $project->client = $request->client;
        $project->category_id = $request->cat_id;
        $project->view_more = $request->description_view;
        $project->website = $request->url;
        $project->brief = $request->brief;
        $project->save();

        if ($request->hasFile('project_file')  && $request->file('project_file')->isValid()) {
            $project->clearMediaCollection('project');
            $project->addMediaFromRequest('project_file')->toMediaCollection('project');
        }

        $preloaded = $request->preloaded;

        if (isset($preloaded) && count($preloaded) > 0) {
            $delete_image = Media::whereNotIn('id', $preloaded)->where('model_id', $project->id)->where('collection_name', 'project-multiple')->delete();
        } else {
            $project->clearMediaCollection('project-multiple');
        }

        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $file) {
                $project->addMedia($file)->toMediaCollection('project-multiple');
            }
        }

        $project->tags()->sync($request->tags);
        return redirect()->route('admin.projects.index')->with('success', 'Project Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->clearMediaCollection('project-multiple');
        $project->delete();
        return response()->json(['success' => 'Project deleted successfully.'], 200);
    }

    public function exists(Request $request)
    {
        $id = $request->get('id');
        $count = Project::when($id != null, function ($query) use ($request) {
            return $query->where('id', '!=', $request->id);
        })->where('title', $request->title)->count();
        if ($count > 0) {
            return 'false';
        } else {
            return 'true';
        }
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            //get filename with extension
            $filExtension = $request->file('upload')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filExtension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('upload')->getClientOriginalExtension();

            //filename to store
            $store = $filename . '_' . time() . '.' . $extension;

            //Upload File
            $request->file('upload')->storeAs('ckUpload', $store);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/ckUpload/' . $store);
            $msg = '';
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            // Render HTML output
            @header('Content-type: text/html; charset=utf-8');
            echo $re;
        }
    }
}