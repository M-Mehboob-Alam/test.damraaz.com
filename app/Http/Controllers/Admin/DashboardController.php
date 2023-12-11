<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\{BuyProductBundle, Product, User,Commission, CircleCommission, StoreInformation, Whatsapp, Withdraw};
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function viewStoreInformation(){
        $store = StoreInformation::where('id', '!=', null)->first();
        return view('admin.store.index',compact('store'));
    }
    public function viewStoreWhatsapp(){
        $store = Whatsapp::where('id', '!=', null)->first();
        return view('admin.whatsapp.index',compact('store'));
    }
    public function uploadStoreWhatsapp(Request $request){
        $store = Whatsapp::findOrFail($request->id);
        $store->whatsapp = $request->whatsapp;
        $store->message = $request->message;

        $store->save();
        return redirect()->back()->with('success', 'whatsapp updated!');
    }
    public function uploadStoreInformation(Request $request){
        $store = StoreInformation::findOrFail($request->id);
        $store->email = $request->email;
        $store->phone = $request->phone;
        $store->location = $request->location;
        $store->save();
        return redirect()->back()->with('success', 'store information updated!');
    }
    public function dashboard()
    {
        $categories = Category::count();
        $adminProducts = Product::withSum('ordersDetail', 'amount')->withSum('ordersDetail', 'profit')->withSum('ordersDetail', 'delivery_charges')->where('status',NUll)->get();
        $userProducts = Product::withSum('ordersDetail', 'amount')->withSum('ordersDetail', 'profit')->withSum('ordersDetail', 'delivery_charges')->where('status','!=', NUll)->get();
        $users = User::count();
        $referrals=Commission::where('name','referral')->sum('amount');
        $withdraws=Withdraw::select('amount','status')->get();
        $pendingBonus=Commission::where('name','ten orders bonus')->where('isAssign',false)->sum('amount');
        $pendingSaleComm=CircleCommission::where('isAssign',false)->sum('amount');
        $pendingBonus+=$pendingSaleComm;
        $assignedBonus=Commission::where('name','ten orders bonus')->where('isAssign',true)->sum('amount');
        $assignedSaleComm=CircleCommission::where('isAssign',true)->sum('amount');
        $assignedBonus+=$assignedSaleComm;
        $bundleOrders = BuyProductBundle::where('status', 'pending')->count();
        return view('admin.dashboard', compact('bundleOrders','categories', 'adminProducts','userProducts', 'users','referrals','withdraws','pendingBonus','assignedBonus'));

    }
    public function create(Request $request)
    {
        //
    }
}
