<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
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

    public function allTag(Request $request)
    {

        // Listing columns to show
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'action',
        );

        $totalData = Tag::count(); // table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $contactCollection = Tag::when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', "%{$search}%");
        });

        // dd($totalData);

        $totalFiltered = $contactCollection->count();

        $contactCollection = $contactCollection->offset($start)->limit($limit)->orderBy($order, $dir)->get();

        $data = [];

        foreach ($contactCollection as $key => $item) {
            $row['id'] = $item->id;
            $row['name'] = $item->name;
            $row['action'] =  '<a href="javascript:void(0);"   data-id=' . $item->id . ' data-url="' . route('admin.tag.edit', $item->id) . '" class="edit btn btn-primary btn-sm">
            <i class="fas fa-edit"></i>
            </a>
            <a href="javascript:void(0);" data-url="' . route('admin.tag.destroy', $item->id) . '"
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
            'tag' => 'required',
        ]);

        $tag = new Tag;
        $tag->name = $request->tag;
        $tag->icon = $request->icon;
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
        if ($tag) {
            $response = response()->json($tag);
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
        $tag_id = $request->tag_id;
        $tag = Tag::findOrFail($tag_id);
        $tag->name = $request->tag;
        $tag->icon = $request->icon;
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
        if (DB::table('project_tag')->where('tag_id', $id)->doesntExist() || DB::table('post_tag')->where('tag_id', $id)->doesntExist()) {
            Tag::findOrFail($id)->delete();
            return response()->json(['success' => 'Tag deleted successfully.']);
        }
        return response()->json(['success' => 'Tag Use In Post or Category can not be deleted.']);
    }

    public function exist(Request $request)
    {
        $id = $request->get('tag_id');
        $countRec = $countRec = Tag::when($id != null, function ($query) use ($request) {
            return $query->where('id', '!=', $request->tag_id);
        })
            ->where('name', $request->tag)
            ->count();
        if ($countRec > 0) {
            return 'false';
        } else {
            return 'true';
        }
    }
}