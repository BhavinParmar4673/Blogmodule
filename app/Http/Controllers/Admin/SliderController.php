<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
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
            'heading' => 'required',
            'description' => 'required',
            'link'=>'required|url',
            'linkname'=>'required',
            'file' => 'required|mimes:jpg,jpeg,png',
        ]);
        
        $slider = new Slider();
        $slider->heading = $request->heading;
        $slider->description = $request->description;
        $slider->link = $request->link;
        $slider->linkname = $request->linkname;
        if ($request->hasFile('file')) {
            $path = $slider->uploadimage($request->file('file'));
        }
        $slider->image = $path;
        $slider->status = $request->status == 'on'? 1:0;

        $slider->save();
        return redirect()->route('admin.sliders.index')->with('message', 'Slide Created Successfully');
       

    }

    public function allslider(Request $request)
    {
        $draw = $request->input('draw');
        $start = $request->input('start');
        $rowperpage = $request->input('length'); // Rows display per page
        $columnIndex = $request->input('order')[0]['column']; // Column index
        $columnName = $request->input('columns')[$columnIndex]['data']; // Column name
        $columnSortOrder = $request->input('order')[0]['dir']; // asc or desc
        $searchValue = $request->input('search')['value']; // Search value

            // Total records
            $totalRecords = Slider::select('count(*) as allcount')
                ->when($searchValue != '', function ($query) use ($searchValue) {
                    return $query->where('id', 'like', '%' . $searchValue . '%')
                        ->orwhere('heading', 'like', '%' . $searchValue . '%');
                })->count();

            // Fetch records
            $records = Slider::orderBy($columnName, $columnSortOrder)
                ->when($searchValue != '', function ($query) use ($searchValue) {
                    return $query->where('id', 'like', '%' . $searchValue . '%')
                    ->orwhere('heading', 'like', '%' . $searchValue . '%');
                })
                ->select('sliders.*')
                ->skip($start)
                ->take($rowperpage)
                ->get();

            foreach ($records as $record) {
                $id = $record->id;
                $heading =  $record->heading;
                $image = '<img height="80" src="' . $record->image_src . '" alt="Image"/>';
                if($record->status == 1){
                    $status = '<span class="badge badge-success">Visible</span>';
                }else{
                    $status = '<span class="badge badge-success">Hidden</span>';
                }
                $operation = '<a href="' . route('admin.sliders.edit', $record->id) . '"  class="edit btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                      </a>
                      <a href="javascript:void(0);" data-url="' . route('admin.sliders.destroy', $record->id) . '" 
                        data-id=' . $record->id . '  class="delete btn btn-danger btn-sm">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                      </a>';

                $data_arr[] = array(
                    "id" => $id,
                    "heading" => $heading,
                    "image" => $image,
                    "status" =>$status,
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
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        return view('admin.slider.edit',compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        $this->validate($request, [
            'heading' => 'required',
            'description' => 'required',
            'link'=>'required|url',
            'linkname'=>'required'
        ]);
        
        $slider->heading = $request->heading;
        $slider->description = $request->description;
        $slider->link = $request->link;
        $slider->linkname = $request->linkname;
        if ($request->hasFile('file')) {
            $slider->deleteimage();
            $path = $slider->uploadimage($request->file('file'));
            $slider->image = $path;
        }
        $slider->status = $request->status == 'on'? 1:0;
        $slider->save();
        return redirect()->route('admin.sliders.index')->with('message', 'Slide Updated Successfully');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        $slider->deleteimage(); //delete image in source folder
        $slider->delete();
        return response()->json(['success' => 'Slide deleted successfully.']);
    }
}
