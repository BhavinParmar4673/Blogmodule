<?php

namespace App\Http\Controllers\Admin;

use App\Models\Member;
use App\Http\Controllers\Controller as Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Traits\DatatableTrait;

class TestimonialController extends Controller
{
    use DatatableTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['title'] = 'Testimonial';
        return $this->view('admin.testimonial.index');
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
            'fullname' => 'required',
            'email' => 'email|required|unique:members,email',
            'url' => 'required|url',
            'designation' => 'required',
        ]);
        $slug = Str::slug($request->title, '-');
        if ($request->hasFile('file')) {
            $path = Testimonial::uploadimage($request->file('file'));
        }

        $testimonial = Testimonial::create([
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
            'image' => $path,
            'is_active' => now()->format('Y-m-d H:i:s')
        ]);
        $member = Member::create([
            'fullname' => $request->fullname,
            'testimonial_id' => $testimonial->id,
            'email' => $request->email,
            'url' => $request->url,
            'designation' => $request->designation
        ]);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonials Created Successfully');
    }

    public function dataListing(Request $request)
    {

        // Listing columns to show
        $columns = array(
            0 => 'title',
            1 => 'created_at',
            2 => 'status',
            3 => 'action',
        );

        $totalData = Testimonial::count(); // table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $contactCollection = Testimonial::when($search, function ($query, $search) {
            return $query->where('title', 'LIKE', "%{$search}%")->orWhere('created_at', 'LIKE', "%{$search}%");
        });

        // dd($totalData);

        $totalFiltered = $contactCollection->count();

        $contactCollection = $contactCollection->offset($start)->limit($limit)->orderBy($order, $dir)->get();

        $data = [];

        foreach ($contactCollection as $key => $item) {
            $row['id'] = $item->id;
            $row['title'] = $item->title;
            $row['created_at'] = $item->created_at->toDateString();
            $row['status'] = $this->status($item->is_active, $item->id, route('admin.testimonials.status', ['id' => $item->id]));
            $row['action'] =  '<a href="' . route('admin.testimonials.edit', $item->id) . '"  class="edit btn btn-primary btn-sm">
            <i class="fas fa-edit"></i>
            </a>
            <a href="javascript:void(0);" data-url="' . route('admin.testimonials.destroy', $item->id) . '"
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
            'testimonial' => $testimonial
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
            'fullname' => 'required',
            'email' => 'email|required',
            'url' => 'required|url',
            'designation' => 'required',
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
            'content' => $request->content
        ]);
        $testimonial->member->update([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'url' => $request->url,
            'designation' => $request->designation
        ]);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonials Updated Successfully');
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

    public function exists(Request $request)
    {
        $id = $request->get('id');
        $count = Testimonial::when($id != null, function ($query) use ($request) {
            return $query->where('id', '!=', $request->id);
        })->where('title', $request->title)->count();
        if ($count > 0) {
            return 'false';
        } else {
            return 'true';
        }
    }

    public function changeStatus(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($request->id);
        $testimonial->is_active  = $request->status == 'true' ? null :  date('Y-m-d H:i:s');

        if ($testimonial->save()) {
            $statusCode = 200;
        }

        $status = $request->status == 'true' ? 'active' : 'deactivate';
        $message = "Testimonial $status successfully.";

        return response()->json([
            'success' => true,
            'message' => $message
        ], $statusCode ?? 400);
    }
}