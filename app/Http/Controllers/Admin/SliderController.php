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
            'link' => 'required|url',
            'linkname' => 'required',
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
        $slider->status = $request->status == 'on' ? 1 : 0;

        $slider->save();
        return redirect()->route('admin.sliders.index')->with('success', 'Slide Created Successfully');
    }

    public function dataListing(Request $request)
    {
        // Listing columns to show
        $columns = array(
            0 => 'id',
            1 => 'heading',
            2 => 'image',
            3 => 'status',
            4 => 'action'
        );

        $totalData = Slider::count(); // table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $contactCollection = Slider::when($search, function ($query, $search) {
            return $query->where('heading', 'LIKE', "%{$search}%");
        });

        // dd($totalData);

        $totalFiltered = $contactCollection->count();

        $contactCollection = $contactCollection->offset($start)->limit($limit)->orderBy($order, $dir)->get();

        $data = [];

        foreach ($contactCollection as $key => $item) {
            $status = '';
            if ($item->status == 1) {
                $status = '<span class="badge badge-success">Visible</span>';
            } else {
                $status = '<span class="badge badge-success">Hidden</span>';
            }
            $row['id'] = $item->id;
            $row['heading'] = $item->heading;
            $row['image'] = '<img height="80" src="' . $item->image_src . '" alt="Image"/>';
            $row['status'] = $status;
            $row['action'] =  '<a href="' . route('admin.sliders.edit', $item->id) . '"  class="edit btn btn-primary btn-sm">
            <i class="fas fa-edit"></i>
            </a>
            <a href="javascript:void(0);" data-url="' . route('admin.sliders.destroy', $item->id) . '"
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
        return view('admin.slider.edit', compact('slider'));
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
            'link' => 'required|url',
            'linkname' => 'required'
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
        $slider->status = $request->status == 'on' ? 1 : 0;
        $slider->save();
        return redirect()->route('admin.sliders.index')->with('success', 'Slide Updated Successfully');
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