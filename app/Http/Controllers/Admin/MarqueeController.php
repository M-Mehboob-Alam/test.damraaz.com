<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Marquee;

class MarqueeController extends Controller
{
    public function index()
    {
        $marquee = Marquee::first();
        return view('admin.marquee.index', compact('marquee'));
    }
    public function update(Request $request)
    {
        // return $request;
        $marquee = Marquee::first();
        $marquee->message = $request->message;
        $marquee->save();
        return back()->with('success', 'News updated!');
    }
}
