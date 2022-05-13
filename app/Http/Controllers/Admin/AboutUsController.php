<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['title'] = 'About Us';
        return $this->view('admin.about.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['title'] = 'create About Us';
        return $this->view('admin.about.create');
    }

    public function dataListing(Request $request)
    {

        // Listing columns to show
        $columns = array(
            0 => 'heading',
            1 => 'action',
        );

        $totalData = AboutUs::count(); // table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $contactCollection = AboutUs::when($search, function ($query, $search) {
            return $query->where('heading', 'LIKE', "%{$search}%");
        });

        // dd($totalData);

        $totalFiltered = $contactCollection->count();

        $contactCollection = $contactCollection->offset($start)->limit($limit)->orderBy($order, $dir)->get();

        $data = [];

        foreach ($contactCollection as $key => $item) {
            $row['id'] = $item->id;
            $row['heading'] = $item->heading;

            $row['action'] =  '<a href="' . route('admin.about-us.edit', ['about_u' => $item->id]) . '"  class="edit btn btn-primary btn-sm">
            <i class="fas fa-edit"></i>
            </a>
            <a href="javascript:void(0);" data-url="' . route('admin.about-us.destroy', ['about_u' => $item->id]) . '"
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $about = new AboutUs();
        $about->heading = $request->heading;
        $about->content = $request->content;
        $about->file = $request->file;
        $about->save();

        return redirect()->route('admin.about-us.index')->with('success', 'About Us Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AboutUs  $aboutUs
     * @return \Illuminate\Http\Response
     */
    public function show(AboutUs $aboutUs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AboutUs  $aboutUs
     * @return \Illuminate\Http\Response
     */
    public function edit(AboutUs $about_u)
    {
        // $about = AboutUs::findOrFail
        $this->data['title'] = 'Edit AboutUs';
        $this->data['about'] = $about_u;
        return $this->view('admin.about.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AboutUs  $aboutUs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AboutUs $about_u)
    {
        $about_u->heading = $request->heading;
        $about_u->content = $request->content;
        $about_u->file = $request->file;
        $about_u->save();

        return redirect()->route('admin.about-us.index')->with('success', 'About Us Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AboutUs  $aboutUs
     * @return \Illuminate\Http\Response
     */
    public function destroy(AboutUs $about_u)
    {
        $about_u->delete();
        return response()->json(['success' => 'About Us deleted successfully.'], 200);
    }
}