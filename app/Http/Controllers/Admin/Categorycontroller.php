<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class Categorycontroller extends Controller
{
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
        if ($request->hasFile('file')) {
            $path = $category->uploadimage($request->file('file'));
        }
        $category->image  = $path;
        $category->save();
        return response()->json(['success' => 'Category Add successfully.']);
    }

    public function allcategory(Request $request)
    {
        $draw = $request->input('draw');
        $start = $request->input('start');
        $rowperpage = $request->input('length'); // Rows display per page
        $columnIndex = $request->input('order')[0]['column']; // Column index
        $columnName = $request->input('columns')[$columnIndex]['data']; // Column name
        $columnSortOrder = $request->input('order')[0]['dir']; // asc or desc
        $searchValue = $request->input('search')['value']; // Search value

        // Total records
        $totalRecords = Category::select('count(*) as allcount')
            ->when($searchValue != '', function ($query) use ($searchValue) {
                return $query->where('name', 'like', '%' . $searchValue . '%')
                    ->orwhere('description', 'like', '%' . $searchValue . '%');
            })->count();


        // Fetch records
        $records = Category::orderBy($columnName, $columnSortOrder)
            ->when($searchValue != '', function ($query) use ($searchValue) {
                return $query->where('name', 'like', '%' . $searchValue . '%')
                    ->orwhere('description', 'like', '%' . $searchValue . '%');
            })
            ->select('categories.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        foreach ($records as $record) {
            $id = $record->id;
            $category_name = $record->name;
            $description = $record->description;
            $image = '<img height="50" src="' . $record->image_src . '" alt="Image"/>';
            $action = '<a href="javascript:void(0);"   data-id=' . $record->id . ' data-url="' . route('admin.category.edit', $record->id) . '" class="edit btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                      </a>
                      <a href="javascript:void(0);" data-url="' . route('admin.category.destroy', $record->id) . '"
                        data-id=' . $record->id . '  class="delete btn btn-danger btn-sm">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                      </a>';


            $data_arr[] = array(
                "id" => $id,
                "name" => $category_name,
                "description" => $description,
                "image" => $image,
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
}