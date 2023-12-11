<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications=Notification::where('is_admin',true)->where('is_read',false)->latest()->paginate(15);
        return view('admin.notification.index',compact('notifications'));
    }
    
    public function markOne($id)
    {
        $notification=Notification::where('is_read',false)->where('is_admin',true)->latest()->where('id',$id)->first();
        $notification->is_read=1;
        $notification->save();
        return back()->with('success','notification is mark as read');
    }
    public function markAll()
    {
        $notifications=Notification::where('is_read',false)->where('is_admin',true)->latest()->get();
        foreach($notifications as $n)
        {
            $n->is_read=1;
            $n->save();
        }
        return back()->with('success','all notifications mark as read');
    }
    public function create()
    {
        return view('admin.notification.create');
    }
    public function notifications(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'message'=>'required',
        ]);
        $users=User::get();
        foreach($users as $user)
        {
            $notification=new Notification();
            $notification->generated_by='admin';
            $notification->user_id=$user->id;
            $notification->name=$request->name;
            $notification->message=$request->message;
            $notification->generated_by='admin';
            $notification->save();

        }
        return back()->with('success','notification sent to all users.');
    }
    public function forUser()
    {
        $notifications=Notification::where('generated_by','admin')->select('name','message','created_at')->distinct()->simplePaginate(25);
        return view('admin.notification.generatedForUser',compact('notifications'));
    }
}
