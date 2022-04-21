<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;

class Tagcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.tag.index');
    }

    public function alltag(Request $request)
    {
        $draw = $request->input('draw');
        $start = $request->input('start');
        $rowperpage =$request->input('length');// Rows display per page
        $columnIndex =$request->input('order')[0]['column']; // Column index
        $columnName =$request->input('columns')[$columnIndex]['data']; // Column name
        $columnSortOrder =$request->input('order')[0]['dir']; // asc or desc
        $searchValue = $request->input('search')['value']; // Search value

        // Total records
        $totalRecords = Tag::select('count(*) as allcount')
            ->when($searchValue !='',function($query) use($searchValue){
            return $query->where('id', 'like', '%' . $searchValue . '%')
            ->orwhere('name', 'like', '%' . $searchValue . '%');
            })->count();


        // Fetch records
        $records = Tag::orderBy($columnName, $columnSortOrder)
        ->when($searchValue !='',function($query) use($searchValue){
            return $query->where('id', 'like', '%' . $searchValue . '%')
            ->orwhere('name', 'like', '%' . $searchValue . '%');
            })
            ->select('tags.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        foreach ($records as $record) {
            $id = $record->id;
            $tag_name = $record->name;
            $action = '<a href="javascript:void(0);"   data-id=' . $record->id . ' data-url="' . route('admin.tag.edit', $record->id) . '" class="edit btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                      </a>
                      <a href="javascript:void(0);" data-url="' . route('admin.tag.destroy', $record->id) . '"
                        data-id=' . $record->id . '  class="delete btn btn-danger btn-sm">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                      </a>';


            $data_arr[] = array(
                "id" => $id,
                "name" => $tag_name,
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
        $this->validate($request,[
            'tag' =>'required',
           ]);

           $tag = new Tag;
           $tag->name = $request->tag;
           $tag->save();
           return response()->json(['success' => 'Tag Add successfully.']);
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
        $tag = Tag::findOrFail($id);
        if($tag){
            $response = response()->json($tag);
        }else{
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
        $tag_id = $request->tag_id;
        $tag = Tag::findOrFail($tag_id);
        $tag->name = $request->tag;
        $tags = $tag->save();
        return response()->json([$tags, 'success' => 'Tag update successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (DB::table('project_tag')->where('tag_id',$id)->doesntExist() || DB::table('post_tag')->where('tag_id',$id)->doesntExist() ) {
            Tag::findOrFail($id)->delete();
            return response()->json(['success'=>'Tag deleted successfully.']);
        }
        return response()->json(['success'=>'Tag Use In Post or Category can not be deleted.']);
    }

}