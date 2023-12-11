<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Share;
use Illuminate\Support\Arr;
use App\Models\ReturnDetail;
use Illuminate\Http\Request;
// use App\Models\CircleCommission;
use Illuminate\Support\Facades\Hash;
use App\Models\{CircleCommission, Order, OrderDetail, User, Commission, Follower, Withdraw, Notification, Product, Marquee, MembershipCard, PaymentType, ReferralCommission, Shop, ShopOrder};
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Crypt;

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

     public function purchasedMembershipCardNow( Request $request){
        $request->validate([
            'amount' => "required",
            'purchased_with' => 'required',
            'package' => 'required',
        ]);
        // return $request;
        $amount = Crypt::decrypt($request->amount);
        $package = $request->package;
        $client = new Client();
        $res = $client->request('GET', 'https://admin.dreameronlinestore.com/api/get/packages/'.$package);
        $packages = $res->getBody();
        $packages= json_decode($packages);
        $packages = $packages->packages;
        $user = Auth()->user();
        // return $request;
        if($amount < 1000){
            return redirect()->back()->with('error', 'you can not buy membership because your balance is less than 1000 ');
        }
        $checkFirstWithdraw = Withdraw::where('user_id', $user->id)->where('status','completed')->where('withdrawOf','Card')->first();
        if(!blank($checkFirstWithdraw)){
            return redirect()->back()->with('error', 'you already purchased a membership card ');
        }
        if($request->purchased_with == 'Sale'){

            $sale_com = 0;
            $sale_referral_com = 0;
            $sale_com = Commission::where('user_id', $user->id)->where('name', 'order')->where('isAssign', true)->where('status', 'clear')->where('order_id', '!=', null)->sum('amount');
            $sale_referral_com = ReferralCommission::where('user_id', $user->id)->where('isAssign', true)->sum('amount');
            $sale_com += $sale_referral_com;
            $with_sale_com = Withdraw::where('user_id', $user->id)->where('withdrawOf','Sale')->where('status', '!=','cancelled')->sum('amount');
            $sale_com = $sale_com -  $with_sale_com ;
            $checkAmountDetails = $sale_com - $amount;
            if($checkAmountDetails >=0 ){
                getCallPurchasedMembershipCard($user, $amount, $request, $packages);
            }else{
                return redirect()->back()->with('error', 'you do not have enough amount to withdraw!');
            }
        }
        if($request->purchased_with == 'Circle'){
            $circle_com = 0;
            $circle_com = CircleCommission::where('user_id', $user->id)->where('isAssign', true)->sum('amount');
            $with_circle_com = Withdraw::where('user_id', $user->id)->where('withdrawOf','Circle')->where('status', '!=','cancelled')->sum('amount');
            $circle_com =  $circle_com -  $with_circle_com;
            $checkAmountDetails = $circle_com - $amount;
            if($checkAmountDetails >=0 ){
                getCallPurchasedMembershipCard($user, $amount, $request, $packages);
            }else{
                return redirect()->back()->with('error', 'you do not have enough amount to withdraw!');
            }
        }
        if($request->purchased_with == 'Marketing'){
            $marketing_com = 0;
            $marketing_com = Commission::where('user_id', $user->id)->where('name', 'referral')->where('isAssign', true)->where('status', 'clear')->sum('amount');
            $with_marketing_com = Withdraw::where('user_id', $user->id)->where('withdrawOf','Marketing')->where('status', '!=','cancelled')->sum('amount');
            $marketing_com = $marketing_com -  $with_marketing_com;
            $checkAmountDetails = $marketing_com - $amount;
            if($checkAmountDetails >=0 ){
                getCallPurchasedMembershipCard($user, $amount, $request, $packages);
            }else{
                return redirect()->back()->with('error', 'you do not have enough amount to withdraw!');
            }
        }

        return redirect('https://beeagle.youngmillionaires.com.pk/damraaz/use/membership/card/'.$user->username)->with('success', 'you have purchased membership card successful!');
     }
    public function purchasedMembershipCard($purchasedWith, $amount)
    {

        // return redirect('/')->with('error', 'we are working on it');

        $isPurchasedMembershipCard = MembershipCard::where('user_id', auth()->user()->id)->first();
        if(!blank($isPurchasedMembershipCard)){
            return redirect()->back()->with('error', 'You Already Purchased Membership Card');
        }
        $client = new Client();
        $res = $client->request('GET', 'https://admin.dreameronlinestore.com/api/get/all/packages');
        $packages = $res->getBody();
        $packages= json_decode($packages);
        $packages = $packages->packages;

        return view('user.shop.purchaseMembershipCard', compact('packages','purchasedWith','amount'));
    }
    public function index()
    {
        // return redirect('/')->with('error', 'we are working on it');

        $isJoinedDreamerWebsite = false;
        if (!auth()->user()->isJoinedDreamer) {
            $client = new Client();
            $res = $client->request('GET', 'https://beeagle.youngmillionaires.com.pk/api/check/already/joined/damraaz/'.auth()->user()->email);
            $packages = $res->getBody();
            $packages= json_decode($packages);
            $isSubscribed = $packages->isJoined;
            if($isSubscribed){
                $upJoinedUserDreamer = User::findOrFail(auth()->user()->id);
                if(!blank($upJoinedUserDreamer)){
                    $upJoinedUserDreamer->isJoinedDreamer = true;
                    $upJoinedUserDreamer->save();
                }
                $isJoinedDreamerWebsite = true;
            }else{
                $isJoinedDreamerWebsite = false;
            }
        }else{
            $isJoinedDreamerWebsite = true;
        }

        $isPurchasedMembershipCard = false;
        $isUsedPurchasedMembershipCard = false;
        $checkPurchasedMembershipCard = MembershipCard::where('user_id', auth()->user()->id)->first();
        $packages = null;
        if(!blank($checkPurchasedMembershipCard)){
            $isPurchasedMembershipCard = true;
            if($checkPurchasedMembershipCard->isUsed){
                $isUsedPurchasedMembershipCard = true;
            }else{
                $client = new Client();
                $res = $client->request('GET', 'https://beeagle.youngmillionaires.com.pk/api/check/user/joined/'.auth()->user()->id);
                $packages = $res->getBody();
                $packages= json_decode($packages);
                $isSubscribed = $packages->isJoined;
                if($isSubscribed){
                    $checkPurchasedMembershipCard->isUsed = true;
                    $checkPurchasedMembershipCard->save();
                    $isUsedPurchasedMembershipCard = true;
                    $upJoinedUserDreamer = User::findOrFail(auth()->user()->id);
                    if(!blank($upJoinedUserDreamer)){
                        $upJoinedUserDreamer->isJoinedDreamer = true;
                        $upJoinedUserDreamer->save();
                    }
                }
            }
        }else{
            $client = new Client();
            $res = $client->request('GET', 'https://admin.dreameronlinestore.com/api/get/all/packages');
            $packages = $res->getBody();
            $packages= json_decode($packages);
            $packages = $packages->packages;
        }

        $user = Auth()->user();
        $referralCommission = ReferralCommission::where('user_id', $user->id)->where('isAssign', true)->sum('amount');
        $amount = Commission::where('user_id', $user->id)->where('isAssign', 1)->sum('amount');

        $myPaidProfits = Commission::with('order')->where('user_id', $user->id)->where('name', 'order')->where('isAssign', 1)->get();
        $myPendingProfits = Commission::with('order')->where('user_id', $user->id)->where('name', 'order')->where('isAssign', 0)->get();
        $sale_commission = CircleCommission::where('user_id', $user->id)->where('isAssign', 1)->sum('amount');
        $amount =$amount + $sale_commission + $referralCommission;
        $withdraws = Withdraw::where('user_id', $user->id)->where('status','!=','cancelled')->latest()->get();

        $orders = Order::with('user', 'ordersDetail')->where('user_id', $user->id)->paginate(30);
        $countCompletedOrders = Order::where('user_id', $user->id)->whereStatus('delivered')->count();
        $notifications = Notification::where('user_id', $user->id)->latest()->get();

        $products = Product::where('user_id', $user->id)->paginate(20);

        $referrals = User::where('refer_by', $user->username)->latest()->get();

        $followeds = Follower::with('shop')->where('user_id', $user->id)->where('active', true)->get();

        $shares = Share::with('product')->where('user_id', $user->id)->with('product')->paginate(20);

        $paymentType = PaymentType::where('user_id', $user->id)->first();
        $isShop = Shop::where('user_id', auth()->user()->id)->first();

        $inProgressOrders = Order::whereIn('status', ['processing', 'cancelled', 'pendding', 'confirm', 'on-the-way'])->where('user_id', $user->id)->get();
        $deliveredOrders = Order::where('status', 'delivered')->where('user_id', $user->id)->get();
        $returnedOrders = Order::where('status', 'return')->where('user_id', $user->id)->get();
        $total_sales = Order::withSum('ordersDetail', 'amount')->where('user_id', $user->id)->where('status', 'delivered')->get();



        $marketing_com = 0;
        $with_marketing_com = Withdraw::where('user_id', $user->id)->where('withdrawOf','Marketing')->where('status', '!=','cancelled')->sum('amount');
        $marketing_com = Commission::where('user_id', $user->id)->where('name', 'referral')->where('isAssign', true)->where('status', 'clear')->sum('amount');
        $marketing_com = $marketing_com -  $with_marketing_com;

        $sale_com = 0;
        $sale_referral_com = 0;
        $with_sale_com = Withdraw::where('user_id', $user->id)->where('withdrawOf','Sale')->where('status', '!=','cancelled')->sum('amount');
        $sale_com = Commission::where('user_id', $user->id)->where('name', 'order')->where('isAssign', true)->where('status', 'clear')->where('order_id', '!=', null)->sum('amount');
        $sale_referral_com = ReferralCommission::where('user_id', $user->id)->where('isAssign', true)->sum('amount');
        $sale_com += $sale_referral_com;
        $sale_com = $sale_com -  $with_sale_com ;

        $circle_com = 0;
        $with_circle_com = Withdraw::where('user_id', $user->id)->where('withdrawOf','Circle')->where('status', '!=','cancelled')->sum('amount');
        $circle_com = CircleCommission::where('user_id', $user->id)->where('isAssign', true)->sum('amount');
        $circle_com =  $circle_com -  $with_circle_com;
        $shop_com = 0;
        $shop_com = OrderDetail::where('shop_id', $user->id)->where('status', 'delivered')->sum('amount');
        $getShopCharges = $shop_com * (12/100);
        $shop_com = $shop_com - $getShopCharges;

        $checkFirstWithdraw = false;
        $checkLast10Days = Carbon::now()->subDays(10)->startOfDay();
        $checkNextWithdraw = false;
        $checkShopWithdraw = Withdraw::where('user_id', $user->id)->where('withdrawOf', 'Shop')->where('status','!=', 'cancelled')->sum('amount');
        if (!blank($checkShopWithdraw)) {
            $checkFirstWithdraw = true;
            $shop_com = $shop_com - $checkShopWithdraw;
            $getNextShopWithdraw = Withdraw::where('user_id', $user->id)->where('withdrawOf', 'Shop')->where('status', '!=', 'cancelled')->whereDate('created_at','>=',$checkLast10Days)->get();
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


        $pending_sale_com = 0 ;
        $pending_sale_com = Commission::where('user_id', $user->id)->where('name', 'order')->where('isAssign', false)->where('order_id', '!=', null)->sum('amount');
        $pending_circle_com = 0 ;
        $pending_circle_com =  CircleCommission::where('user_id', $user->id)->where('isAssign', false)->sum('amount');
        $pending_referral_sale_com = 0 ;
        $pending_referral_sale_com = ReferralCommission::where('user_id', $user->id)->where('isAssign', false)->sum('amount');


        $pending_com = 0;
        $pending_com = $pending_sale_com + $pending_circle_com + $pending_referral_sale_com;





        $pending_withdraw = 0;
        $pending_withdraw = Withdraw::where('user_id', $user->id)->where('status', 'pending')->sum('amount');
        $completed_withdraw = 0;
        $completed_withdraw = Withdraw::where('user_id', $user->id)->where('status', 'completed')->sum('amount');
        $all_withdraw = 0;
        $all_withdraw = $pending_withdraw + $completed_withdraw;

        if($isPurchasedMembershipCard){
            if ($checkPurchasedMembershipCard->purchased_with == 'Sale') {
               $sale_com = $sale_com - $checkPurchasedMembershipCard->price ;
            } elseif ($checkPurchasedMembershipCard->purchased_with == 'Circle') {
                $circle_com = $circle_com - $checkPurchasedMembershipCard->price ;
            } elseif ($checkPurchasedMembershipCard->purchased_with == 'Marketing') {
                $marketing_com = $marketing_com - $checkPurchasedMembershipCard->price ;
            }
        }
        $total_com = 0;
        $total_com = $marketing_com + $sale_com + $circle_com ;

        $saving_com = 0;
        $with_saving_com = Withdraw::where('user_id', $user->id)->where('withdrawOf','Saving')->where('status', '!=','cancelled')->sum('amount');
        $saving_com = $total_com * (20/100);
        $saving_com = $saving_com - $with_saving_com;

        $current_com = 0 ;
        $current_com = $total_com * (80/100);
        $current_com = $current_com - $all_withdraw;

        $withdrawOf = Withdraw::where('user_id', $user->id)->where('status', '!=','cancelled')->get();
        $withdraws = Withdraw::where('user_id', $user->id)->latest()->get();

        return view('home', compact('isJoinedDreamerWebsite','getShopCharges','checkNextWithdraw','isPurchasedMembershipCard','isUsedPurchasedMembershipCard','packages','withdrawOf','marketing_com', 'sale_com', 'circle_com', 'shop_com', 'pending_com','total_com','saving_com', 'all_withdraw','pending_withdraw','current_com',
            'total_sales','isShop','sale_commission','orders', 'inProgressOrders', 'returnedOrders', 'deliveredOrders', 'myPendingProfits', 'myPaidProfits', 'countCompletedOrders', 'amount',  'withdraws', 'products', 'referrals', 'followeds', 'shares', 'paymentType'));
    }
    public function allMarketingCommission(){
        $user = auth()->user();
        $marketing_com = 0;
        $marketing_com = Commission::where('user_id', $user->id)->where('name', 'referral')->where('isAssign', true)->where('status', 'clear')->latest()->paginate(10);
        $users = User::where('refer_by', $user->username)->latest()->latest()->paginate(10);
        return view('user.commission.marketing', compact('marketing_com', 'users'));
    }
    public function allCircleCommission(){
        $user = auth()->user();
        $circle_com = CircleCommission::where('user_id', $user->id)->where('isAssign', true)->latest()->paginate(10);
        return view('user.commission.circle', compact('circle_com'));
    }
    public function allSaleCommission(){
        $user = auth()->user();
        $sale_com = Commission::with('order_details.order')->where('user_id', $user->id)->where('name', 'order')->where('isAssign', true)->where('status', 'clear')->where('order_id', '!=', null)->latest()->paginate(10);
        $sale_referral_com = ReferralCommission::with('order_details.order')->where('user_id', $user->id)->where('isAssign', true)->latest()->paginate(10);
        return view('user.commission.sale', compact('sale_com','sale_referral_com' ));
    }
    public function allShopSAlesCommission(){
        $user = auth()->user();
        $id = $user->id;
        $shopSales = OrderDetail::with('order')->where('shop_id', $id)->where('status', 'delivered')->latest()->get();
        return view('user.commission.shopSale', compact('shopSales' ));
    }
    public function allPendingCommission(){
        $user = auth()->user();
        $id = $user->id;

        $pending_sale_com = Commission::where('user_id', $user->id)->where('name', 'order')->where('isAssign', false)->where('order_id', '!=', null)->latest()->get();

        $pending_circle_com =  CircleCommission::where('user_id', $user->id)->where('isAssign', false)->latest()->get();

        $pending_referral_sale_com = ReferralCommission::where('user_id', $user->id)->where('isAssign', false)->latest()->get();

        return view('user.commission.allPendingCommission', compact('pending_sale_com','pending_circle_com','pending_referral_sale_com'));

    }
    public function allWithdrawDetail($status){
        $user = auth()->user();
        $id = $user->id;
        $withdraws = Withdraw::where('user_id', $user->id)->where('status', $status)->latest()->get();
        return view('user.commission.withdraws', compact('withdraws'));

    }
    public function orders(Request $request)
    {
        // return $request;
        $user = Auth()->user();
        if (!blank($request->days)) {
            $now = Carbon::now()->subDays($request->days);
            // $orders = Order::with('user', 'ordersDetail')->where('created_at', '>=', $now)->where('user_id', $user->id)->latest()->paginate(30);

            $inProgressOrders = Order::with('user', 'ordersDetail','ordersDetail.product')->where('created_at', '>=', $now)->whereIn('status', ['processing', 'cancelled', 'pendding', 'confirm', 'on-the-way'])->where('user_id', $user->id)->get();
            $deliveredOrders = Order::with('user', 'ordersDetail')->where('created_at', '>=', $now)->where('status', 'delivered')->where('user_id', $user->id)->get();
            $returnedOrders = Order::with('user', 'ordersDetail')->where('created_at', '>=', $now)->where('status', 'return')->where('user_id', $user->id)->get();
        } else {
            // $orders = Order::with('user', 'ordersDetail')->where('user_id', $user->id)->latest()->paginate(30);
            $inProgressOrders = Order::with('ordersDetail')->whereIn('status', ['processing', 'cancelled', 'pendding', 'confirm', 'on-the-way'])->where('user_id', $user->id)->get();
            $deliveredOrders = Order::with('user', 'ordersDetail')->where('status', 'delivered')->where('user_id', $user->id)->get();
            $returnedOrders = Order::with('user', 'ordersDetail')->where('status', 'return')->where('user_id', $user->id)->get();
        }
        return view('frontend.order.index', compact('returnedOrders','inProgressOrders', 'deliveredOrders', 'deliveredOrders'));
    }
    public function returnOrder(Request $request, $id)
    {
        // return $request;
        $validator = $request->validate([
            'name' => 'required',
            'whatsapp' => 'required',
            'reason' => 'required',
            'images' => 'required',
            'images.*' => 'image',
        ]);
        $user = Auth()->user();
        $order = ReturnDetail::where('order_id', $id)->first();
        if (blank($order)) {

            $detail = new ReturnDetail();
            $detail->order_id = $id;
            $detail->name = $request->name;
            $detail->whatsapp = $request->whatsapp;
            $detail->reason = $request->reason;
            if ($request->hasfile('images')) {
                $data = [];
                foreach ($request->file('images') as $file) {
                    $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('images/return-detail'), $filename);
                    $data[] = 'images/return-detail/' . $filename;
                }
                $detail->images = json_encode($data);
            }
            // return $detail;
            $detail->save();

            $noti = new Notification();
            $noti->user_id = $user->id;
            $noti->is_admin = true;
            $noti->name = 'Return Order';
            $noti->message = "$user->username mark  order as returned";
            $noti->save();

            return back()->with('success', 'Return request submitted. We will contact you soon.');
        }
        return back()->with('warning', 'Already request is in progress');
    }
    public function orderDetail($id)
    {

        $user_id = Auth()->id();
        $order = Order::with('user', 'ordersDetail', 'ordersDetail.product', 'returnDetail')->where('user_id', $user_id)->findOrFail($id);
        return view('frontend.order.userOrder', compact('order'));
    }
    public function trackOrder(Request $request)
    {
        $user_id = Auth()->id();
        $id = $request->order_id;
        $ordersList = Order::where('user_id', $user_id)->get();
        $orders = Order::filterOrderId($id)->with('ordersDetail', 'ordersDetail.product')->where('user_id', $user_id)->whereStatus('pendding')->get();
        $processings = Order::filterOrderId($id)->with('ordersDetail', 'ordersDetail.product')->where('user_id', $user_id)->whereStatus('processing')->get();
        $delivereds = Order::filterOrderId($id)->with('ordersDetail', 'ordersDetail.product')->where('user_id', $user_id)->whereStatus('delivered')->get();
        return view('frontend.order.trackOrder', compact('orders', 'ordersList', 'processings', 'delivereds'));
    }
    public function productDetail($id)
    {

        $user_id = Auth()->id();
        $product = Product::where('user_id', $user_id)->where('id', $id)->first();
        return view('frontend.userProduct.show', compact('product'));
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
    public function updateUser(Request $request)
    {
        $request->validate([
            'business' => 'required',
        ]);
        $user = Auth()->user();
        $user->business = $request->business;
        $user->save();
        return back()->with('success', 'Business Name Updated');
    }
}


function getCallPurchasedMembershipCard($user, $amount, $request,$packages)
{
    $withdraw = new Withdraw();
    $withdraw->user_id = $user->id;
    $withdraw->withdrawOf = 'Card';
    $withdraw->status = "completed";
    $withdraw->amount = $packages->price ;
    $withdraw->message = 'You have Purchased Membership Card Of Rs.' . $packages->price ;

    $withdraw->save();

    $membershipCard = new MembershipCard();
    $membershipCard->user_id = $user->id;
    $membershipCard->card_name = $packages->name;
    $membershipCard->card_id = $packages->id;
    $membershipCard->withdraw_id = $withdraw->id;
    $membershipCard->points = $packages->price / 100;
    $membershipCard->price = $packages->price ;
    $membershipCard->purchased_with = $request->purchased_with;
    $membershipCard->isUsed = false;
    $membershipCard->code = rand(100000,999999);
    $membershipCard->save();

    $notification = new Notification;
    $notification->user_id = $user->id;
    $notification->is_admin = 1;
    $notification->name = "Purchased Membership Card";
    $notification->message = "Purchased Membership Card  by ". $user->username;
    $notification->save();
    // print_r($withdraw);
    // print_r($membershipCard);
    // print_r($notification);
    // return ;
}
