<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $user=Auth()->user();
        $notifications=Notification::where('user_id',$user->id)->where('is_admin',false)->latest()->get();
        foreach($notifications as $n)
        {
            $n->is_read=1;
            $n->save();
        }
        return view('frontend.notification.index',compact('notifications'));
        
    }
}
