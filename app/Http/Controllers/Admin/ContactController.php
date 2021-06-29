<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;


class ContactController extends Controller
{
    public function contactForm()
    {
        return view('admin.frontend.contact');
    }

    public function storeContactForm()
    {

    }
}
