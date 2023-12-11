<?php

namespace App\Http\Controllers;

use App\Models\PaymentType;
use Illuminate\Http\Request;
use App\Models\{CircleCommission, Withdraw, Commission, MembershipCard, Notification, OrderDetail, ReferralCommission, SaleCommission};
use Carbon\Carbon;

class WithdrawController extends Controller
{
    public function create()
    {
        $user = Auth()->user();
        $paymentType = PaymentType::where('user_id', $user->id)->first();
        return view('frontend.withdraw.create', compact('paymentType'));
    }
    public function store(Request $request)
    {

        $request->validate([
            'amount' => "required|numeric",
            'payment_type' => 'required',
            'withdrawOf' => 'required',

        ]);
        // return $request;
        $user = Auth()->user();
        $deductMembershipCard = 0;
        $checkMembership = MembershipCard::where('user_id', auth()->user()->id)->first();
        if (!blank($checkMembership)) {
            $deductMembershipCard = $checkMembership->price;
        }

        if($request->amount < 1000){
            return redirect()->back()->with('error', 'minimum amount to withdraw is 1000 ');

        }
        $paymentType = PaymentType::where('user_id', $user->id)->first();
        if (blank($paymentType)) {
            return redirect(route('home'))->with('warning', 'First Enter Your Payment method in Dashboard');
        }
        $checkFirstWithdraw = Withdraw::where('user_id', $user->id)->where('status','completed')->first();
        if(blank($checkFirstWithdraw)){
            return redirect()->back()->with('error', 'you can not withdraw first amount only placed order or purchase membership card ');
        }
        if($request->withdrawOf == 'Sale'){
            $sale_com = 0;
            $sale_referral_com = 0;
            $sale_com = Commission::where('user_id', $user->id)->where('name', 'order')->where('isAssign', true)->where('status', 'clear')->where('order_id', '!=', null)->sum('amount');
            $sale_referral_com = ReferralCommission::where('user_id', $user->id)->where('isAssign', true)->sum('amount');
            $sale_com += $sale_referral_com;
            $with_sale_com = Withdraw::where('user_id', $user->id)->where('withdrawOf','Sale')->where('status', '!=','cancelled')->sum('amount');
            $sale_com = $sale_com -  $with_sale_com ;
            $checkAmountDetails = $sale_com - $request->amount;
            if($checkMembership->purchased_with == 'Sale'){
                $checkAmountDetails =  $checkAmountDetails - $deductMembershipCard;
            }
            if($checkAmountDetails >=0 ){
                getCallWithdraw($user, $paymentType, $request);
            }else{
                return redirect()->back()->with('error', 'you do not have enough amount to withdraw!');
            }
        }
        if($request->withdrawOf == 'Shop'){
            $shop_com = 0;
            $shop_com = OrderDetail::where('shop_id', $user->id)->where('status', 'delivered')->sum('amount');
            $getShopCharges = $shop_com * (12/100);
            $shop_com = $shop_com - $getShopCharges;


            $checkFirstWithdraw = false;
            $checkLast10Days = Carbon::now()->subDays(10);
            $checkNextWithdraw = false;
            $checkShopWithdraw = Withdraw::where('user_id', $user->id)->where('withdrawOf', 'Shop')->where('status','!=', 'cancelled')->sum('amount');
            if (!blank($checkShopWithdraw)) {
                $checkFirstWithdraw = true;
                $shop_com = $shop_com - $checkShopWithdraw;
                $getNextShopWithdraw = Withdraw::where('user_id', $user->id)->where('withdrawOf', 'Shop')->where('status', '!=', 'cancelled')->whereDate('created_at',$checkLast10Days)->first();
                if(blank($getNextShopWithdraw)){
                    $checkNextWithdraw = true;
                }else{
                    $checkNextWithdraw = false;
                }
            }else{
                if($shop_com >= 1500){
                    $checkNextWithdraw = true;
                }
            }

            if($request->amount < 1500){
                return redirect()->back()->with('error', 'Minimum Withdrawal Limit is Rs.1500 within 10 Days');
            }
            if(!$checkNextWithdraw){
                return redirect()->back()->with('error', 'for now you can not withdraw due to Low Shop Sale Or Left Gap of 10 Days!');
            }
            $checkAmountDetails = $shop_com - $request->amount;
            if($checkAmountDetails >=0 ){
                getCallWithdraw($user, $paymentType, $request);
            }else{
                return redirect()->back()->with('error', 'you do not have enough amount to withdraw!');
            }
        }
        if($request->withdrawOf == 'Circle'){
            $circle_com = 0;
            $circle_com = CircleCommission::where('user_id', $user->id)->where('isAssign', true)->sum('amount');
            $with_circle_com = Withdraw::where('user_id', $user->id)->where('withdrawOf','Circle')->where('status', '!=','cancelled')->sum('amount');
            $circle_com =  $circle_com -  $with_circle_com;
            $checkAmountDetails = $circle_com - $request->amount;
            if($checkMembership->purchased_with == 'Circle'){
                $checkAmountDetails =  $checkAmountDetails - $deductMembershipCard;
            }
            if($checkAmountDetails >=0 ){
                getCallWithdraw($user, $paymentType, $request);
            }else{
                return redirect()->back()->with('error', 'you do not have enough amount to withdraw!');
            }
        }
        if($request->withdrawOf == 'Marketing'){
            $marketing_com = 0;
            $marketing_com = Commission::where('user_id', $user->id)->where('name', 'referral')->where('isAssign', true)->where('status', 'clear')->sum('amount');
            $with_marketing_com = Withdraw::where('user_id', $user->id)->where('withdrawOf','Marketing')->where('status', '!=','cancelled')->sum('amount');
            $marketing_com = $marketing_com -  $with_marketing_com;
            $checkAmountDetails = $marketing_com - $request->amount;
            if($checkMembership->purchased_with == 'Marketing'){
                $checkAmountDetails =  $checkAmountDetails - $deductMembershipCard;
            }
            if($checkAmountDetails >=0 ){
                getCallWithdraw($user, $paymentType, $request);
            }else{
                return redirect()->back()->with('error', 'you do not have enough amount to withdraw!');
            }
        }
        if($request->withdrawOf == 'Saving'){
            $marketing_com = 0;
            $marketing_com = Commission::where('user_id', $user->id)->where('name', 'referral')->where('isAssign', true)->where('status', 'clear')->sum('amount');
            $sale_com = 0;
            $sale_referral_com = 0;
            $sale_com = Commission::where('user_id', $user->id)->where('name', 'order')->where('isAssign', true)->where('status', 'clear')->where('order_id', '!=', null)->sum('amount');
            $sale_referral_com = ReferralCommission::where('user_id', $user->id)->where('isAssign', true)->sum('amount');
            $sale_com += $sale_referral_com;
            $circle_com = 0;
            $circle_com = CircleCommission::where('user_id', $user->id)->where('isAssign', true)->sum('amount');
            $total_com = 0;
            $total_com = $marketing_com + $sale_com + $circle_com ;
            $with_saving_com = Withdraw::where('user_id', $user->id)->where('withdrawOf','Saving')->where('status', '!=','cancelled')->sum('amount');
            $saving_com = 0;
            $saving_com = $total_com * (20/100);
            $saving_com = $saving_com - $with_saving_com;
            if($saving_com < 10000){
                return redirect()->back()->with('error', 'you can not withdraw because your saving commission is less 10,000');
            }
            $checkAmountDetails = $saving_com - $request->amount;
            if($checkAmountDetails >=0 ){
                getCallWithdraw($user, $paymentType, $request);
            }else{
                return redirect()->back()->with('error', 'you do not have enough amount to withdraw!');
            }
        }
        // return $request;

        return redirect(route('home'))->with('success', 'Withdraw request sent successfully');
    }
}

function getCallWithdraw($user, $paymentType, $request)
{
    $withdraw = new Withdraw();
    $withdraw->user_id = $user->id;
    $withdraw->account_title = $paymentType->account_title;
    $withdraw->account_no = $paymentType->account_no;
    $withdraw->amount = $request->amount;
    $withdraw->payment_type = $paymentType->payment_type;
    if($paymentType->payment_type == 'bank'){
        $withdraw->bank_name = $paymentType->bank_name;
    }else{
        $withdraw->bank_name = null;
    }
    $withdraw->withdrawOf = $request->withdrawOf;
    // return $withdraw;
    $withdraw->save();

    $notification = new Notification;
    $notification->user_id = $user->id;
    $notification->is_admin = 1;
    $notification->name = "Withdraw Request";
    $notification->message = "Withdraw request made  by $user->username";
    // return   $notification;
    $notification->save();
}
