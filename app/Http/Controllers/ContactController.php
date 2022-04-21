<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use App\mail\contactmail;



class ContactController extends Controller
{
    public function contactForm()
    {
        return view('frontend.contact');
    }

    public function storeContactForm(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $input = $request->all();
        $contact = Contact::create($input);

        Mail::to($contact->email)->send(new contactmail($contact));
        return redirect()->back()->with(['success' => 'Contact Form Submit Successfully']);
    }
}