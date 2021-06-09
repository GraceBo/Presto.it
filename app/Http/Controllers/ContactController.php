<?php

namespace App\Http\Controllers;

use App\Mail\RevisorMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view ('contact.index');
    }

    public function store(Request $request)
    {
        $contact = Contact::create
        ([
            'name'=> $request->name,
            'email'=> $request->email,
            'phone'=>$request->phone,
            'body'=>$request->body,
        ]);

        Mail::to('adminPresto@gmail.com')->send(new RevisorMail($contact));
        return redirect()->back()->with('message', 'Candidatura inviata correttamente');
    }
}
