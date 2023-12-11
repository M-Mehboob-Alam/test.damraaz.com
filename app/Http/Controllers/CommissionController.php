<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use App\Models\Notification;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    public function tenOrderBonus()
    {
         $user=Auth()->user();
        $bonus=Commission::where('user_id',$user->id)->where('name','ten orders bonus')->first();
        if(!$bonus)
        {
            $commission=new Commission();
            $commission->user_id=$user->id;
            $commission->name='ten orders bonus';
            $commission->amount=0;
            //return $commission;
            $commission->save();

            $notification=new Notification();
            $notification->user_id=$user->id;
            $notification->is_admin=true;
            $notification->name='ten order bonus';
            $notification->message="ten order bonus claimed by $user->name";
            $notification->save();

            return back()->with('success','Bonus claimed.');
        }
        return back()->with('warning','Bonus already claimed.');
    }
}
