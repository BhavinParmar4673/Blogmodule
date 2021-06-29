<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Tag;
use App\Models\Project_image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class Projectcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.project.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'description' => 'required',
            'images' => 'required',
            'images.*' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tags' => 'required|min:1'
        ]);

        $project =new Project();
        $project->title = $request->title;
        $project->description = $request->description;
        $project->save();

        if ($request->hasFile('images')) {
            foreach($request->file('images') as $file){
                $Project_image = new Project_image();
                $Project_image->project_id = $project->id;
                $path =$Project_image->uploadimage($file);
                $Project_image->image   = $path;
                $Project_image->save();
            }
        }
        $project->tags()->sync($request->tags, false);
        return response()->json(['success' => 'Project Add successfully.'],200);
    }

    public function allproject(Request $request)
    {
        $draw = $request->input('draw');
        $start = $request->input('start');
        $rowperpage = $request->input('length'); // Rows display per page
        $columnIndex = $request->input('order')[0]['column']; // Column index
        $columnName = $request->input('columns')[$columnIndex]['data']; // Column name
        $columnSortOrder = $request->input('order')[0]['dir']; // asc or desc
        $searchValue = $request->input('search')['value']; // Search value

        // Total records
        $totalRecords = Project::select('count(*) as allcount')
            ->when($searchValue != '', function ($query) use ($searchValue) {
                return $query->where('title', 'like', '%' . $searchValue . '%')
                    ->orwhere('description', 'like', '%' . $searchValue . '%');
            })->count();


        // Fetch records
        $records = Project::orderBy($columnName, $columnSortOrder)
            ->when($searchValue != '', function ($query) use ($searchValue) {
                return $query->where('title', 'like', '%' . $searchValue . '%')
                    ->orwhere('description', 'like', '%' . $searchValue . '%');
            })
            ->select('projects.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();
        foreach ($records as $record) {
            $id = $record->id;
            $title = $record->title;
            $description = $record->description;
            $image ='<a href="' . route('admin.projects.show', $record->id) . '">Image</a>';
            $action = '<a href="javascript:void(0);"   data-id=' . $record->id . ' data-url="' . route('admin.projects.edit', $record->id) . '" class="edit btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                      </a>
                      <a href="javascript:void(0);" data-url="' . route('admin.projects.destroy', $record->id) . '"
                        data-id=' . $record->id . '  class="delete btn btn-danger btn-sm">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                      </a>';
            $project = Project::findorFail($id);
            $taglist = "";
            foreach ($project->tags as $tag) {
                $taglist .=  '<span class="badge badge-info mr-1">' . $tag->name . '</span>';
            }

            $data_arr[] = array(
                "id" => $id,
                "title" => $title,
                "description" => $description,
                "image" => $image,
                "tag" => $taglist,
                "action" => $action,
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $projectimage = Project_image::where('project_id',$id)->get();
        // return view('admin.project.display',compact('projectimage'));

        $project =  Project::findorFail($id);
        return view('admin.frontend.singleproject',compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::findorFail($id);
        if($project){
            $tags = $project->tags;
            $projectimg= $project->project_images;
            foreach($projectimg as $image){
                $images[]=  array(
                    "id" =>$image->id,
                    "image"=>$image->image_src
                    );
            }
            $response = response()->json([$project, $tags,$images]);
        }else{
            $response =response()->json(['data' => 'Resource not found'], 404);
        }
        return $response;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $datalist = $request->all();
        $project_id = $request->project_id;
        $project = Project::findorFail($project_id);
        $project->title = $request->title;
        $project->description = $request->description;
        $project->save();

         //one or more preoladed image remove : not all
        if (isset($datalist['preloaded']) && $datalist['preloaded'] !=1) {
            $preloaded = $datalist['preloaded'];
            $delete_image = Project_image::whereNotIn('id',$preloaded)->where('project_id',$project_id)->get();
            $delete_image->each(function($image){
                $image->deleteimage();
            });
            Project_image::whereNotIn('id',$preloaded)->where('project_id',$project_id)->delete();
            //all preoladed image remove
        }else{
            $remove_image = Project_image::where('project_id',$project_id)->get();
            $remove_image->each(function($image){
                $image->deleteimage();
            });
            Project_image::where('project_id',$project_id)->delete();
        }

        //insert a new image
        if ($request->hasFile('images')) {
            $photos = $request->file('images');
            foreach($photos as $file){
                $Project_image = new Project_image();
                $Project_image->project_id = $project->id;
                $path = $Project_image->uploadimage($file);
                $Project_image->image   = $path;
                $Project_image->save();
            }
        }
        $project->tags()->sync($request->tags);
        return response()->json(['success' => 'Project update successfully'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findorFail($id);
        $project->project_images->each(function($image){
            if($image->image){
                $image->deleteimage();
            }
        });
        $project->delete();
        return response()->json(['success' => 'Project deleted successfully.'],200);
    }
    
    public function display(){
        $projects = Project::all();
        $tags = Tag::all();
        return view('admin.frontend.project',[
            'projects' => $projects,
            'tags' => $tags
        ]);
    }

    public function filter(Request $request)
    {
        $tag_id = $request->id;
        if($tag_id)
        {
             //filter project
             if($tag_id == 'all'){
                $projects = Project::all();
             }else{
                $projects = Project::whereHas('tags', function($query) use($tag_id) {
                    $query->where('tags.id', $tag_id);
                })->get();
            }

            $html = '';
            foreach($projects as $key => $myproject){
            $html .= '<div class="col-lg-6 col-sm-12 mb-4">
                <div class="itembox all">
                        <div class="portfolio-item">
                            <a class="portfolio-link" href="'.route('admin.projects.show',$myproject->id).'">
                            <div class="thumbnail">';
                                foreach ($myproject->project_images as $image){
                                    $html .= '<img class="img-fluid" src="'.$image->image_src.'" alt="..." />';
                                }
                            $html .= '</div>
                            </a>
                        </div>
                        <div class="portfolio-details mt-4">
                            <h2 class="work__title">'.$myproject->title.'</h2>
                            <p class="text-muted">'.$myproject->description.'</p>
                        </div>
                    </div>
                </div>';
            }
            $response =  response()->json(['html' => $html]);
        }else{
            $response = response()->json(['data' => 'Resource not found'], 404);
        }
        return $response;
    }





}
