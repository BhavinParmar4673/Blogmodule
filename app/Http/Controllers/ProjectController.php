<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Tag;

class ProjectController extends Controller
{
    public function display()
    {
        $projects = Project::all();
        $tags = Tag::all();
        return view('frontend.project', [
            'projects' => $projects,
            'tags' => $tags
        ]);
    }

    public function singleProject($id)
    {
        $project =  Project::findOrFail($id);
        return view('frontend.singleproject', compact('project'));
    }

    public function filter(Request $request)
    {
        $tag_id = $request->id;
        if ($tag_id) {
            //filter project
            if ($tag_id == 'all') {
                $projects = Project::all();
            } else {
                $projects = Project::whereHas('tags', function ($query) use ($tag_id) {
                    $query->where('tags.id', $tag_id);
                })->get();
            }
            $html = view('frontend.filter', ['projects' => $projects])->render();
            $response =  response()->json(['html' => $html]);
        } else {
            $response = response()->json(['data' => 'Resource not found'], 404);
        }
        return $response;
    }
}