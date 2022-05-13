<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Project;
use App\Models\Tag;
use App\Models\Contact;
use App\Models\Setting;
use App\Models\AboutUs;
use App\Models\Employee;
use App\Models\Testimonial;




class IndexController extends Controller
{
    public function index()
    {
        $service = Service::whereNull('is_active')->get();
        $employees = Employee::whereNull('is_active')->get();
        $clients = Testimonial::whereNull('is_active')->get();
        $projects = Project::all();
        $about = AboutUs::first();
        $tags = Tag::all();
        $setting = Setting::where('name', 'general_settings')->first();
        $response = $setting->response;
        $this->data['title'] = 'home';
        $this->data['services'] = $service;
        $this->data['projects'] = $projects;
        $this->data['setting'] = $setting;
        $this->data['response'] = $response;
        $this->data['about'] = $about;
        $this->data['employees'] = $employees;
        $this->data['tags'] = $tags;
        $this->data['clients'] = $clients;
        return $this->view('theme.home.index');
    }

    public function singlePortfolio($id)
    {
        $project = Project::findOrFail($id);
        $html = view('theme.partial.modal', ['project' => $project])->render();
        return response()->json(['html' => $html], 200);
    }

    public function storeContactForm(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $existEmail = Contact::where('email', $request->email)->first();

        if (!$existEmail) {
            $input = $request->all();
            Contact::create($input);
            return response()->json([
                'success' => 'Contact Details Send Successfully',
            ], 200 ?? 400);
        }

        return response()->json([
            'error' => 'Contact Details Already Filled',
        ], 400);
    }
}