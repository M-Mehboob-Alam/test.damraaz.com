<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Shop;
use App\Models\ShopOrder;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function profile()
    {
        $user=Auth()->user();
        return view('admin.profile',compact('user'));
    }
    public function viewShopDetail($shop)
    {
        $shops = Shop::with('user')->where('user_id', $shop)->latest()->latest()->first();
        $products = Product::with('category')->where('user_id', $shop)->get();
        $shop_orders = ShopOrder::with(['orders.user', 'order_details'])->where('shop_id', $shops->user_id)->latest()->get();
        // $shopOrders = ShopOrder::with(['orders','orders.order_detail'])->where('shop_id', $shops->user_id)->latest()->get();
        // $orderDetails = OrderDetail::with('order')->where('shop_id', $shop)->get();
        return view('admin.shop.shopDetail',compact('shops', 'shop','products', 'shop_orders'));
    }
    public function changeMegaSaleStatus($id)
    {
        $shops = Shop::findOrFail($id);
        $shops->isAllowedMegaSale = !($shops->isAllowedMegaSale);
        $shops->save();
        return redirect()->back()->with('success', 'Mega Sales Status Updated');
    }
    public function allShops($shop)
    {
        $shops = Shop::with('user')->where('status', $shop)->latest()->get();
        return view('admin.shop.allShop',compact('shops', 'shop'));
    }
    public function newShop()
    {
        $shops = Shop::with('user')->where('status', 'pending')->latest()->get();
        return view('admin.shop.newShop',compact('shops'));
    }
    public function approvedNewShop(Request $request)
    {
        $shop = Shop::findOrFail( $request->id);
        if(!blank($shop)){
            if($request->status == 'pending' || $request->status == 'inActive' || $request->status == 'blocked'){
                $products = Product::where('user_id', $shop->user_id)->get();
                if(!blank($products)){
                    foreach ($products as  $pro) {
                        $pro->isActive = false;
                        $pro->message = 'your all products status has been In-Active due to change your shop status to '.$request->status;
                        $pro->save();
                    }
                }
            }else{
                $products = Product::where('user_id', $shop->user_id)->get();
                if(!blank($products)){
                    foreach ($products as  $pro) {
                        $pro->isActive = true;
                        $pro->message = 'your all products status has been Active due to change your shop status to '.$request->status;
                        $pro->save();
                    }
                }
            }
                $shop->status = $request->status;
                $shop->message = $request->message;
                $shop->name = $request->name;
                $shop->mobile = $request->mobile;
                $shop->whatsapp = $request->whatsapp;
                $shop->wholesale = $request->wholesale;
                $shop->address = $request->address;
                $shop->city = $request->city;
                $shop->province = $request->province;
                $shop->save();

                $notification = new Notification();
                $notification->user_id = $shop->user_id;
                $notification->name = "Shop Notification";
                $notification->message = $shop->message;
                $notification->save();

        }
        return back()->with('success', 'shop status changed');
    }
    public function password_change(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed'
        ]);
        $id = Auth()->id();
        $user = Auth()->user();
        if (!\Hash::check($request->old_password, $user->password)) {
            return back()->with('error', 'You have entered wrong password');
        }
        $user->password = Hash::make($request->password);
        $user->save();
        return back()->with('success', 'password Updated');
    }
}
