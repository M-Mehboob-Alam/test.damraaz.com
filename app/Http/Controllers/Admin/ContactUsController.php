<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\ContactUs;

class ContactUsController extends Controller
{
    public function index()
    {
        $contacts = ContactUs::where('isContacted', false)->latest()->get();
        return view('admin.contactUs.index', compact('contacts'));
    }
    public function contact($id)
    {
        $contact = ContactUs::find($id);
        $contact->isContacted = true;
        $contact->save();
        return back()->with('success', 'Mark as contacted..');
    }
    public function contacted()
    {
        $contacts = ContactUs::where('isContacted', true)->latest()->get();
        return view('admin.contactUs.contacted', compact('contacts'));
    }
}
