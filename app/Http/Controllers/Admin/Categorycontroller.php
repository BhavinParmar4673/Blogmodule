<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Traits\DatatableTrait;

class CategoryController extends Controller
{
    use DatatableTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.category.index');
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
            'category' => 'required',
            'description' => 'required',
            'file' => 'required|mimes:jpg,jpeg,png',
        ]);

        $category = new Category;
        $category->name = $request->category;
        $category->description = $request->description;
        $category->is_active = now()->format('Y-m-d H:i:s');
        if ($request->hasFile('file')) {
            $path = $category->uploadimage($request->file('file'));
        }
        $category->image  = $path;
        $category->save();
        return response()->json(['success' => 'Category Add successfully.']);
    }

    public function allCategory(Request $request)
    {

        // Listing columns to show
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'status',
            3 => 'image',
            4 => 'action',
        );

        $totalData = Category::count(); // table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $contactCollection = Category::when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', "%{$search}%");
        });

        // dd($totalData);

        $totalFiltered = $contactCollection->count();

        $contactCollection = $contactCollection->offset($start)->limit($limit)->orderBy($order, $dir)->get();

        $data = [];

        foreach ($contactCollection as $key => $item) {
            $row['id'] = $item->id;
            $row['name'] = $item->name;
            $row['status'] = $this->status($item->is_active, $item->id, route('admin.category.status', ['id' => $item->id]));
            $row['image'] =  '<img height="50" src="' . $item->image_src . '" alt="Image"/>';
            $row['action'] =  '<a href="javascript:void(0);"   data-id=' . $item->id . ' data-url="' . route('admin.category.edit', $item->id) . '" class="edit btn btn-primary btn-sm">
            <i class="fas fa-edit"></i>
            </a>
            <a href="javascript:void(0);" data-url="' . route('admin.category.destroy', $item->id) . '"
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        if ($category) {
            $image = array("image" => $category->image_src);
            $response =  response()->json([$category, $image]);
        } else {
            $response = response()->json(['data' => 'Resource not found'], 404);
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
    public function update(Request $request, $id)
    {

        $cat_id = $request->cat_id;
        $category = Category::findOrFail($cat_id);
        $category->name = $request->category;
        $category->description = $request->description;

        if ($request->hasFile('file')) {
            $category->deleteimage();
            $path = $category->uploadimage($request->file('file'));
            $category->image  = $path;
        }

        $cat = $category->save();
        return response()->json([$cat, 'success' => 'Categry update successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (DB::table('category_post')->where('category_id', $id)->doesntExist()) {
            $category = Category::findOrFail($id);
            $category->deleteimage();
            $category->delete();
            return response()->json(['success' => 'Categry deleted successfully.']);
        }
        return response()->json(['success' => 'Categry Use In other model can not be deleted.']);
    }


    public function exists(Request $request)
    {
        $id = $request->get('cat_id');
        $count = Category::when($id != null, function ($query) use ($request) {
            return $query->where('id', '!=', $request->cat_id);
        })->where('name', $request->category)->count();
        if ($count > 0) {
            return 'false';
        } else {
            return 'true';
        }
    }

    public function changeStatus(Request $request, $id)
    {
        $category = Category::findOrFail($request->id);
        $category->is_active  = $request->status == 'true' ? null :  date('Y-m-d H:i:s');

        if ($category->save()) {
            $statusCode = 200;
        }

        $status = $request->status == 'true' ? 'active' : 'deactivate';
        $message = "Category $status successfully.";

        return response()->json([
            'success' => true,
            'message' => $message
        ], $statusCode ?? 400);
    }
}