<?php

namespace App\Http\Controllers;

use App\Models\BundlePaymentType;
use App\Models\BundleWithdraw;
use App\Models\PaymentType;
use Illuminate\Http\Request;

class PaymentTypeController extends Controller
{
    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'account_title' => 'required',
            'account_no' => 'required',
            'payment_type' => 'required',
            'bank_name' => 'required_if:payment_type,==,bank',
        ]);
        // return $request;
        $user = Auth()->user();
        $paymentType = new PaymentType();
        $paymentType->user_id = $user->id;
        $paymentType->account_title = $request->account_title;
        $paymentType->account_no = $request->account_no;
        $paymentType->payment_type = $request->payment_type;
        $paymentType->bank_name = $request->bank_name;
        // return $paymentType;
        $paymentType->save();
        return redirect(route('home'))->with('success', 'Withdraw Method added successfully');
    }
    public function storeBundlePayment(Request $request)
    {
        // return $request;
        $request->validate([
            'account_title' => 'required',
            'account_no' => 'required',
            'payment_type' => 'required',
            'bank_name' => 'required_if:payment_type,==,bank',
        ]);
        // return $request;
        $user = Auth()->user();
        $paymentType = new BundlePaymentType();
        $paymentType->user_id = $user->id;
        $paymentType->account_title = $request->account_title;
        $paymentType->account_no = $request->account_no;
        $paymentType->payment_type = $request->payment_type;
        $paymentType->bank_name = $request->bank_name;
        // return $paymentType;
        $paymentType->save();
        return redirect(route('bundles.home'))->with('success', 'Withdraw Method added successfully');
    }
    public function withdrawBundlePayment(Request $request)
    {
        // return $request;
        $request->validate([
            'amount' => 'required',
        ]);
        // return $request;
        if($request->amount < 1000){
            return redirect()->back()->with('error', 'minimum amount greater than Rs.1000');
        }
        
        $user = Auth()->user();
        $id = Auth()->user()->id;
        $getBundlePaymentMethod = BundlePaymentType::where('user_id', $id)->first();
        $paymentType = new BundleWithdraw();
        $paymentType->user_id = $user->id;
        $paymentType->account_title = $getBundlePaymentMethod->account_title;
        $paymentType->amount = $request->amount;
        $paymentType->account_no = $getBundlePaymentMethod->account_no;
        $paymentType->payment_type = $getBundlePaymentMethod->payment_type;
        if ($getBundlePaymentMethod->payment_type == 'bank') {
            $paymentType->bank_name = $getBundlePaymentMethod->bank_name;
        }
        $paymentType->status = 'pending';
        $paymentType->message = 'you withdraw request is in review!';
        // return $paymentType;
        $paymentType->save();
        return redirect(route('bundles.home'))->with('success', 'we received Withdraw request successfully');
    }
}
