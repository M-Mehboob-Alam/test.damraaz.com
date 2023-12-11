<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactUs;
class ContactUsController extends Controller
{
    public function create()
    {
        return view('frontend.contactUs.create');
    }
    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'phone'=>"required",
            'message'=>'required',
        ]);
        $contact=new ContactUs();
        $contact->name=$request->name;
        $contact->email=$request->email;
        $contact->phone=$request->phone;
        $contact->message=$request->message;
        $contact->save();
        return redirect(url('/'))->with('success','Your form has been submitted. We will contact you soon');
    }
}
