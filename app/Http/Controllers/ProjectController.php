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
}