<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\Project;
use App\Models\Post;

class DashboardController extends Controller
{
    public function index()
    {
        $blogs = Post::latest()
            ->take(3)
            ->get();

        $projects = Project::latest()
            ->take(8)
            ->get();

        $testimonial = Testimonial::where('visibility', 1)
            ->latest()
            ->get();

        return view('frontend.index', ['blogs' => $blogs, 'projects' => $projects, 'testimonial' => $testimonial]);
    }
}