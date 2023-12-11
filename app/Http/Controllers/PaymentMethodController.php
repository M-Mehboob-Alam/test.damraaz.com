<?php



namespace App\Http\Controllers;

use App\Models\BundlePaymerntMethod;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function store_bundle(Request $request)
    {
        $accounts = BundlePaymerntMethod::findOrFail($request->id);
        $accounts->account_title = $request->account_title;
        $accounts->account_no = $request->account_no;
        if($request->account_type =='Bank'){
            $accounts->bank = $request->bank;
        }
        $accounts->save();

        return redirect()->back()->with('success', 'account '.$request->account_type.' details has been changed');

    }
    public function view_accounts_bundle(){
        $accounts = BundlePaymerntMethod::latest()->get();
        return view('admin.accounts.indexBundle',compact('accounts'));
    }

    public function toggle_bundle($id)
    {
        $item = BundlePaymerntMethod::find($id);
        $item->status = !$item->status;
        $item->save();
        return redirect()->back();
    }
    public function store(Request $request)
    {
        $accounts = PaymentMethod::findOrFail($request->id);
        $accounts->account_title = $request->account_title;
        $accounts->account_no = $request->account_no;
        if($request->account_type =='Bank'){
            $accounts->bank = $request->bank;
        }
        $accounts->save();

        return redirect()->back()->with('success', 'account '.$request->account_type.' details has been changed');

    }
    public function view_accounts(){
        $accounts = PaymentMethod::latest()->get();
        return view('admin.accounts.index',compact('accounts'));
    }

    public function toggle($id)
    {
        $item = PaymentMethod::find($id);
        $item->status = !$item->status;
        $item->save();
        return redirect()->back();
    }

}


// namespace App\Http\Controllers;

// use App\Models\PaymentMethod;
// use Illuminate\Http\Request;

// class PaymentMethodController extends Controller
// {
//     public function store(Request $request)
//     {
//         // return $request;
//         $request->validate([
//             'account_title' => 'required',
//             'account_no' => 'required',
//             'account_type' => 'required',
//             'bank_name' => 'required_if:payment_type,==,bank',
//         ]);
//         // return $request;
//         $payment_method = new PaymentMethod();
//         $payment_method->account_title = $request->account_title;
//         $payment_method->account_no = $request->account_no;
//         $payment_method->account_type = $request->account_type;
//         $payment_method->bank_name = $request->bank_name;
//         // return $payment_method;
//         $payment_method->save();
//         return redirect()->back()->with('success', 'Payment Method added successfully');
//     }

//     // User Functions

// }


