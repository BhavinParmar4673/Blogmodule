<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Traits\DatatableTrait;

class ServiceController extends Controller
{
    use DatatableTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['title'] = 'Services';
        return $this->view('admin.service.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['title'] = 'Create Service';
        return $this->view('admin.service.create');
    }

    public function dataListing(Request $request)
    {

        // Listing columns to show
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'image',
            3 => 'action',
        );

        $totalData = Service::count(); // table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $contactCollection = Service::when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', "%{$search}%");
        });

        // dd($totalData);

        $totalFiltered = $contactCollection->count();

        $contactCollection = $contactCollection->offset($start)->limit($limit)->orderBy($order, $dir)->get();

        $data = [];

        foreach ($contactCollection as $key => $item) {
            $row['id'] = $item->id;
            $row['name'] = $item->name;
            $row['description'] = $item->description;
            $row['status'] = $this->status($item->is_active, $item->id, route('admin.service.status', ['id' => $item->id]));
            $row['image'] =  '<img height="50" src="' . $item->image_src . '" alt="Image"/>';;
            $row['action'] =  '<a href="' . route('admin.service.edit', $item->id) . '"  class="edit btn btn-primary btn-sm">
            <i class="fas fa-edit"></i>
            </a>
            <a href="javascript:void(0);" data-url="' . route('admin.service.destroy', $item->id) . '"
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
        $service = new Service();
        $service->name = $request->title;
        $service->slug = $request->slug;
        $service->description = $request->description;
        $service->is_active = now()->format('Y-m-d H:i:s');
        $service->save();

        if ($request->hasFile('file')) {
            $service->addMediaFromRequest('file')->toMediaCollection('service');
        }

        return redirect()->route('admin.service.index')->with('success', 'Service Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        $this->data['title'] = 'Edit Service';
        $this->data['service'] = $service;
        return $this->view('admin.service.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $service->name = $request->title;
        $service->slug = $request->slug;
        $service->description = $request->description;
        $service->save();

        if ($request->hasFile('file')) {
            $service->clearMediaCollection('service');
            $service->addMediaFromRequest('file')->toMediaCollection('service');
        }

        return redirect()->route('admin.service.index')->with('success', 'Service Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->clearMediaCollection('service'); //delete image in source folder
        $service->delete();
        return response()->json(['success' => 'Service deleted successfully.']);
    }

    public function exists(Request $request)
    {
        $id = $request->get('id');
        $count = Service::when($id != null, function ($query) use ($request) {
            return $query->where('id', '!=', $request->id);
        })->where('name', $request->title)->count();
        if ($count > 0) {
            return 'false';
        } else {
            return 'true';
        }
    }
    
    public function changeStatus(Request $request, $id)
    {
        $service = Service::findOrFail($request->id);
        $service->is_active  = $request->status == 'true' ? null :  date('Y-m-d H:i:s');

        if ($service->save()) {
            $statusCode = 200;
        }

        $status = $request->status == 'true' ? 'active' : 'deactivate';
        $message = "Service $status successfully.";

        return response()->json([
            'success' => true,
            'message' => $message
        ], $statusCode ?? 400);
    }
}