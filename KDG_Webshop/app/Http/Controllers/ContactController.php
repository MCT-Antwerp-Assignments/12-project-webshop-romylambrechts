<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function submit(Request $request)
    {
        $messages = [
            'email.required' => 'Dont forget your email address!',
            'email.email' => 'Please provide a valid email address.',
            'message.required' => 'A message is required to submit the form.',
        ];

        $validatedData = $request->validate([
            'subject' => 'required|min:3|max:255',
            'email' => 'required|email',
            'message' => 'required|min:10',
        ], $messages);

        if ($validatedData) {
            Mail::to('romy.lambrechts@student.kdg.be')->send(new ContactMail($validatedData));
        }

        return redirect()->route('contact.index')->with('success', 'Your message has been sent successfully!');
    }
}