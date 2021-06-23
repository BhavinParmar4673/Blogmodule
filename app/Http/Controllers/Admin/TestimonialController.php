<?php

namespace App\Http\Controllers\Admin;

use App\Models\Member;
use App\Http\Controllers\Controller as Controller;
use App\Models\Testimonial;
use Facade\FlareClient\Http\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.testimonial.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.testimonial.create');
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
            'content' => 'required|min:5|max:2000',
            'file' => 'required|mimes:jpg,jpeg,png',
            'fullname'=>'required',
            'email' =>'email|required|unique:members,email',
            'url'=>'required|url',
            'designation'=>'required',
        ]);
        $slug = Str::slug($request->title, '-');
        if ($request->hasFile('file')) {
            $path = Testimonial::uploadimage($request->file('file'));
        }

        $testimonial =Testimonial::create([
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
            'image' => $path,
            'visibility' => $request->visible == 'on'? 1:0,
        ]);
        $member= Member::create([
            'fullname' => $request->fullname,
            'testimonial_id'=>$testimonial->id,
            'email' => $request->email,
            'url' => $request->url,
            'designation'=>$request->designation
        ]);
        return redirect()->route('admin.testimonials.index')->with('message', 'Testimonials Created Successfully');
    }

    public function datatable(Request $request)
    {
        $draw = $request->input('draw');
        $start = $request->input('start');
        $rowperpage = $request->input('length'); // Rows display per page
        $columnIndex = $request->input('order')[0]['column']; // Column index
        $columnName = $request->input('columns')[$columnIndex]['data']; // Column name
        $columnSortOrder = $request->input('order')[0]['dir']; // asc or desc
        $searchValue = $request->input('search')['value']; // Search value

            // Total records
            $totalRecords = Testimonial::select('count(*) as allcount')
                ->when($searchValue != '', function ($query) use ($searchValue) {
                    return $query->where('id', 'like', '%' . $searchValue . '%')
                        ->orwhere('title', 'like', '%' . $searchValue . '%')
                        ->orwhere('created_at', 'like', '%' . $searchValue . '%');
                })->count();

            // Fetch records
            $records = Testimonial::orderBy($columnName, $columnSortOrder)
                ->when($searchValue != '', function ($query) use ($searchValue) {
                    return $query->where('id', 'like', '%' . $searchValue . '%')
                    ->orwhere('title', 'like', '%' . $searchValue . '%')
                    ->orwhere('created_at', 'like', '%' . $searchValue . '%');
                })
                ->select('testimonials.*')
                ->skip($start)
                ->take($rowperpage)
                ->get();

            foreach ($records as $record) {
                $id = $record->id;
                $title =  $record->title;
                $created_at = $record->created_at->toDateString();
                if($record->visibility == 1){
                    $visible = '<span class="badge badge-success">On</span>';
                }else{
                    $visible = '<span class="badge badge-success">Off</span>';
                }
                $image = '<img height="80" src="' . $record->image_src . '" alt="Image"/>';
                $operation = '<a href="' . route('admin.testimonials.edit', $record->id) . '"  class="edit btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                      </a>
                      <a href="javascript:void(0);" data-url="' . route('admin.testimonials.destroy', $record->id) . '" 
                        data-id=' . $record->id . '  class="delete btn btn-danger btn-sm">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                      </a>';

                $data_arr[] = array(
                    "id" => $id,
                    "title" => $title,
                    "created_at"=>$created_at,
                    "visible" =>$visible,
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
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonial $testimonial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonial.edit')->with([
            'testimonial'=>$testimonial
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $this->validate($request, [
            'title' => 'required',  
            'fullname'=>'required',
            'email' =>'email|required',
            'url'=>'required|url',
            'designation'=>'required',
        ]);
       
        // $memberrecord = Member::where('testimonial_id',$testimonial->id)->first();
        $slug = Str::slug($request->title, '-');
        if ($request->hasFile('file')) {
            $testimonial->deleteimage();
            $path = $testimonial->uploadimage($request->file('file'));
            $testimonial->image = $path;
        }
        $testimonial->update([
                'title' => $request->title,
                'slug' => $slug,
                'content' => $request->content,
                'visibility' => $request->visible == 'on'? 1:0,
             ]);
        $testimonial->member->update([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'url' => $request->url,
            'designation'=>$request->designation
        ]);
        return redirect()->route('admin.testimonials.index')->with('message', 'Testimonials Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial)
    {
        $testimonial->deleteimage(); //delete image in source folder
        $testimonial->delete();
        return response()->json(['success' => 'Testimonials deleted successfully.']);
    }
}
