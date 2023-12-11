<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Withdraw;
use App\Models\OrderDetail;
use App\Models\Notification;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    public function index($withdraw = null)
    {
        // return $withdraw;
        $withdraws = Withdraw::with('user')->where('status', $withdraw)->latest()->get();
        return view('admin.withdraw.index', compact('withdraws', 'withdraw'));
    }

    //  public function viewWithdraw ($withdraw)
    // {
    //     // return $withdraw;
    //    $withdraws=Withdraw::with(['user'])->where('id', $withdraw)->latest()->first();

    //     return view('admin.withdraw.singleOrder',compact('withdraws'));
    // }
    public function changewithdrawstatus($withdraw)
    {
        // return $withdraw;
        $withdraws = Withdraw::with(['user'])->where('id', $withdraw)->latest()->first();

        return view('admin.withdraw.changeOrderStatus', compact('withdraws'));
    }
    public function markAs(Request $request)
    {
        // return $withdraw;
        $withdraws = Withdraw::findOrFail($request->id);
        $withdraws->message = $request->message;
        $withdraws->status = $request->status;
        $withdraws->save();


        $noti = new Notification();
        $noti->user_id = $withdraws->user_id;
        $noti->name = "Withdraw Status";
        $noti->message =  $request->message;
        $noti->save();
        return redirect()->route('admin.withdraws.index', ['withdraws' => 'pending'])->with('success', 'withdraw status has been changed successfull!');
    }
}
