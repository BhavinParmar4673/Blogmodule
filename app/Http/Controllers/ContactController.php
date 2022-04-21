<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use App\mail\contactmail;
use App\Models\NewsLetter;

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
        $existEmail = Contact::where('email', $request->email)->first();

        if (!$existEmail) {
            $input = $request->all();
            Contact::create($input);
            return redirect()->back()->with('success', 'Contact Details Send Successfully');
        }
        return redirect()->back()->with('error', 'Contact Details Already Filled');

        // Mail::to($contact->email)->send(new contactmail($contact));

    }
    public function storeNewsletter(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $existEmail = NewsLetter::where('email', $request->email)->first();

        if (!$existEmail) {
            $input = $request->all();
            NewsLetter::create($input);
            return redirect()->back()->with('success', 'Email Subscribe Successfully');
        }
        return redirect()->back()->with('error', 'Email Already Subscribed');

        // Mail::to($contact->email)->send(new contactmail($contact));

    }
}