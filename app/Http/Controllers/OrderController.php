<?php
namespace App\Http\Controllers;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use App\Models\{Order, OrderDetail, User, Commission, CircleCommission, CircleCounter, Notification, PaymentMethod, Product, ReferralCommission, ShopOrder, TrackOrder};
use Carbon\Carbon;
class OrderController extends Controller
{
    public static $result = array();
    public static $resultCounter = array();
    public static $resultCounterProduct = array();
    public function checkout()
    {
        $cart = session()->get('cart');
        $total = 0;
        foreach ($cart as $id => $value) {
            // echo "<pre>";
            // print_r($value);
            $total += $value['shop_charges'];
            foreach ($value['products'] as $key => $item) {
                $total += ($item['discount_price']  * $item['quantity']) +  ($item['profit'] * $item['quantity']);
            }
        }
        // echo $total;
        // return 'wait';
        if(is_null($cart)) {
            return redirect()->route('/')->with('error', 'please first add to cart items ');
        }
        if($total <= 300){
            return redirect()->back()->with('error', 'order upto Rs. 300 ');
        }
        $orders['orders'] = Order::where('user_id', Auth()->id())->get();
        $accounts = PaymentMethod::where('status',1)->get();
        return view('frontend.order.create', $orders)->with('accounts',$accounts);
    }
    public function orderPlacedSuccessful()
    {
        $order = Order::where('user_id', auth()->user()->id)->where('status', 'pending')->latest()->first();
        return view('frontend.order.orderPlacedSuccessful',compact('order'));
    }
    public function show($id)
    {
        // return $id;
        # return to the chackout to show address
        $order = Order::select('name', 'address', 'phone', 'city', 'province', 'area', 'nearest', 'house', 'street')->where('user_id', Auth()->id())->findOrFail($id);
        return response()->json($order);
    }
    public function cancelFromUser(Request $request, $id)
    {
        // return $request;
        $request->validate([
            'message' => 'required',
        ]);
        $order = Order::findOrFail($id);
        if ($order->status != 'cancelled') {
            $order->status = "cancelled";
            $order->message = $request->message;
            // return $order;
            $order->save();
            $withdraws = Withdraw::where('order_id', $order->id)->get();
            if(!blank($withdraws)){
                foreach ($withdraws as $key => $with) {
                    $with->status = 'cancelled';
                    $with->save();
                }
            }
            $circleCounter = CircleCounter::where('order_id',$order->id )->first();
            if(!blank($circleCounter)){
                $circleCounter->isAssign = false;
                $circleCounter->save();
                $circle_com = CircleCommission::where('circle_counter_id', $circleCounter->id)->first();
                if(!blank($circle_com)){
                    $circle_com->delete();
                }
            }
            $shop_orders = ShopOrder::where('orderId', $order->orderId)->get();
            if(!blank($shop_orders)){
                foreach ($shop_orders as $key => $so) {
                    $so->status = 'cancelled';
                    $so->changed_status = 'Customer';
                    $so->message = $request->message;
                    $so->save();
                    $order_details = OrderDetail::where('shop_order_id', $so->id)->get();
                    if(!blank($order_details)){
                        foreach ($order_details as $key => $od) {
                            $od->status = 'cancelled';
                            $od->message = $request->message;
                            $od->changed_status = 'Customer';
                            $od->save();
                            $referallCommission = ReferralCommission::where('rewardOn', $od->id)->get();
                            if(!blank($referallCommission)){
                                foreach ($referallCommission as $key => $rc) {
                                   $rc->isAssign = false;
                                   $rc->updateMessage = $request->message;
                                   $rc->save();
                                }
                            }
                            $com = Commission::where('order_id', $od)->get();
                            if(!blank($com)){
                                foreach ($com as $key => $value) {
                                    $value->isAssign = false;
                                    $value->status = 'pending';
                                    $value->save();
                                }
                            }
                        }
                    }
                }
            }
            $notification = new Notification();
            $notification->name = 'Order Cancel by user';
            $notification->message = $request->message;
            $notification->user_id = Auth()->id();
            $notification->is_admin = true;
            $notification->save();
            // return $notification;
            return back()->with('success', 'Order Cancelled');
        }
        return back()->with('warning', 'order already cancelled');
    }
    public function store(Request $request)
    {
        $user = auth()->user();
        $checkLast15DayOrder = false;
        $getCurrentDay  = date("j");
        if($getCurrentDay > 15){
            $getCurrentDay = date("Y-m") . '-16';
        }else{
            $getCurrentDay = Carbon::now()->firstOfMonth();
        }
        // return $getCurrentDay;
        $orders = Order::where('user_id', $user->id)->where('status', 'delivered')->whereDate('updated_at',$getCurrentDay)->get();
        if(!blank($orders)){
            $checkLast15DayOrder = true;
        }
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
        $sale_referral_com =  $total_com;
        $level_one = false;
        $level_one_username = null ;
        $level_two_username = null;
        $level_two = false;
        $order  = null;
        $new_withdraw  = null;
        $refer_by = auth()->user()->refer_by;
        if(!is_null($refer_by)){
            $level_one = true;
            $level_one_username = $refer_by;
            $second_level_username = User::where('username', $level_one_username)->first();
            if(!is_null($second_level_username)){
                $second_level_username = $second_level_username->refer_by;
                if(!is_null($second_level_username)){
                    $level_two_username = $second_level_username;
                    $level_two = true;
                }
            }
        }
        $request->validate([
            'name' => "required",
            'address' => "required",
            'city' => "required",
            'province' => "required",
            'phone' => "required|min:11|max:11",
            // 'payment_method'=>'required',
        ]);
        $total = 0;
        $delivery_charges = 0;
        $profit = 0;
        if (session('cart')) {
            foreach (session('cart') as $cart) {
                $delivery_charges += $cart['shop_charges'];
                foreach ($cart['products'] as  $value) {
                    $total += $value['discount_price'] * $value['quantity'];
                    $profit += $value['profit'] * $value['quantity'];
                }
            }
            // $total = $total + $profit + $delivery_charges;
            // $total = $total + $profit + $delivery_charges;
            // return $delivery_charges;
            $items = count((array) session('cart'));
            $user_id = Auth()->id();
            $user = Auth()->user();
            $order = new Order();
            $order->user_id = $user_id;
            $order->orderId = uniqid('DM');
            $user->business = $request->business;
            $user->save();
            $total_amount = $delivery_charges + $total + $profit;
            $order->total_amount = $total_amount;
            $order->user_profit = $profit;
            $order->total_items = $items;
            $order->name = $request->name;
            $order->address = $request->address;
            $order->phone = $request->phone;
            $order->province = $request->province;
            $order->city = $request->city;
            $order->status = 'pending';
            $order->area = $request->area;
            $order->house = $request->house;
            $order->street = $request->street;
            $order->nearest = $request->nearest;
            $order->acc_type = $request->account_type;
            $order->amount_paid = $request->paid;
            // dd($request->paid);
            if($request->payment_method == 'cod' || 'advance'){
                if ($request->hasFile('image')) {
                    $file = $request->file('image') ;
                    $orgname = $file->getClientOriginalName() ;
                    $imageName = $orgname.'_'.time() . '.' . $file->getClientOriginalExtension();
                    // dd($orgname);
                    // $fileName = $file->getClientOriginalName() ;
                    $destinationPath = public_path().'/payment_ss' ;
                    $file->move($destinationPath,$imageName);
                    $order->screenshot = $imageName;
                }
                $order->payment_method = $request->payment_method;
            }
            if ($request->payment_method == 'profit') {
                $amount = Commission::where('user_id', $user->id)->where('isAssign', 1)->sum('amount');
                $sale_comm = CircleCommission::where('user_id', $user->id)->where('isAssign', 1)->sum('amount');
                $amount += $sale_comm;
                $amount = $amount * 80/100;
                $withdraws = Withdraw::where('user_id', $user->id)->where('status', '!=','cancelled')->sum('amount');
                $income = $amount - $withdraws;
                if ($income >= $total_amount) {
                    $order->payment_method = 'profit';
                    $new_withdraw = new Withdraw();
                    $new_withdraw->user_id = $user->id;
                    $new_withdraw->payment_type = NULL;
                    $new_withdraw->amount = $total_amount;
                    $new_withdraw->account_title = 'Order Withdraw';
                    $new_withdraw->account_no = NULL;
                    $new_withdraw->status = 'completed';
                    $new_withdraw->message = 'Your withdrawal request accepted for placing order.';
                    // return $new_withdraw;
                } else {
                    return back()->with('warning', "You don't have sufficient profit");
                }
            }
            // return $order;
            $order->save();
            $trackOrder = new TrackOrder();
            $trackOrder->order_id = $order->id;
            $trackOrder->status = $order->status;
            $trackOrder->message = 'Your order is in processing';
            $trackOrder->save();
            if ($request->payment_method == 'profit') {
                $new_withdraw->order_id = $order->id;
                $new_withdraw->save();
            }
            $new_circle_counter = new CircleCounter();
            $new_circle_counter->user_id = $order->user_id;
            $new_circle_counter->order_id = $order->id;
            $new_circle_counter->isAssign = false;
            $new_circle_counter->save();
            $get_user_circle_counter =  CircleCounter::where('user_id', auth()->user()->id)->whereDate('created_at', Carbon::now()->firstOfMonth())->where('isAssign', true)->count();
            if( $get_user_circle_counter != 0  ){
                if($get_user_circle_counter % 10 == 0){
                    $check_circle_commission = CircleCommission::where('user_id', auth()->user()->id)->latest()->first();
                    if(blank($check_circle_commission)){
                        $newCircleCommission = new CircleCommission();
                        $newCircleCommission->user_id = auth()->user()->id;
                        $getLatestCircleCounter =  CircleCounter::where('user_id', auth()->user()->id)->where('isAssign', true)->latest()->first();
                        $newCircleCommission->circle_counter_id =$getLatestCircleCounter->id;
                        $newCircleCommission->name ="Circle Income";
                        $newCircleCommission->isAssign =false;
                        $newCircleCommission->next_counter_divisible_by = 20;
                        $newCircleCommission->save();
                    }else{
                        $check_circle_commission = CircleCommission::where('user_id', auth()->user()->id)->latest()->first();
                        if($get_user_circle_counter / $check_circle_commission->next_counter_divisible_by == 1){
                            $newCircleCommission = new CircleCommission();
                            $newCircleCommission->user_id = auth()->user()->id;
                            $getLatestCircleCounter =  CircleCounter::where('user_id', auth()->user()->id)->where('isAssign', true)->latest()->first();
                            $newCircleCommission->circle_counter_id =$getLatestCircleCounter->id;
                            $newCircleCommission->name ="Circle Income";
                            $newCircleCommission->isAssign =false;
                            $newCircleCommission->next_counter_divisible_by = $check_circle_commission->next_counter_divisible_by + 10;
                            $newCircleCommission->save();
                        }
                    }
                }
            }

            $checkPrice = $total;

            if (session('cart')) {
                foreach (session('cart') as $id => $carts) {
                    $new_shop_order = new ShopOrder();
                    $new_shop_order->user_id = auth()->user()->id;
                    $new_shop_order->orderId = $order->orderId;
                    $new_shop_order->shop_id = $carts['shop_id'];
                    $new_shop_order->shop_name = $carts['shop_name'];
                    $new_shop_order->shop_charges = $carts['shop_charges'];
                    $new_shop_order->status = 'pending';
                    $new_shop_order->message = 'Thank you for placing Order! Your order is in review';
                    $new_shop_order->save();
                    foreach($carts['products'] as $cart){
                        $product_Details = Product::with('shop')->where('slug', $cart['slug'])->first();
                        if(!blank($product_Details)){
                            $order_detail = new OrderDetail();
                            $order_detail->status = 'pending';
                            $order_detail->order_id = $order->id;
                            $order_detail->product_id = $product_Details->id;
                            $order_detail->shop_id = $product_Details->user_id;
                            $order_detail->shop_order_id = $new_shop_order->id;
                            $order_detail->quantity = $cart['quantity'];
                            $order_detail->price = $cart['price'];
                            $order_detail->discount_price = $cart['discount_price'];
                            $order_detail->profit = $cart['profit'];
                            $order_detail->amount = $cart['discount_price'] * $cart['quantity'];
                            $order_detail->delivery_days = $cart['delivery_days'];
                            $order_detail->delivery_charges = $new_shop_order->shop_charges;
                            $order_detail->product_name = $product_Details->name ;
                            $order_detail->product_images = $product_Details->images ;
                            $order_detail->product_image = $product_Details->image ;
                            $order_detail->shop_name = $product_Details->shop->name ;
                            $order_detail->shop_image = $product_Details->shop->image ;
                            $order_detail->shop_city = $product_Details->shop->city  ;
                            $order_detail->shop_province = $product_Details->shop->province  ;
                            $order_detail->shop_mobile = $product_Details->shop->mobile  ;
                            $order_detail->shop_address = $product_Details->shop->address  ;
                            $order_detail->save();
                            $get_username = null;
                            if($checkLast15DayOrder){
                                if(is_null($product_Details->branding_id) && !($product_Details->isMegaSale)){
                                        if($level_one && $order_detail->profit > 0 && $order_detail->shop_id =='58'){
                                            $user_level_one =User::where('username', $level_one_username)->first();
                                            $referallCommission = new ReferralCommission();
                                            $referallCommission->user_id =$user_level_one->id;
                                            $referallCommission->level = 1;
                                            $referallCommission->rewardOn =  $order_detail->id;
                                            $referallCommission->updateMessage = 'Your order is in processing'	;
                                            $giveReward = 0 ;
                                            if($sale_referral_com <= 50000){
                                                $giveReward = (  ($order_detail->profit * $order_detail->quantity)*( 15/100));
                                            }elseif($sale_referral_com <= 100000){
                                                $giveReward = (  ($order_detail->profit * $order_detail->quantity)*( 10/100));
                                            }elseif($sale_referral_com <= 150000){
                                                $giveReward = (  ($order_detail->profit * $order_detail->quantity)*( 5/100));
                                            }elseif($sale_referral_com <= 200000){
                                                $giveReward = (  ($order_detail->profit * $order_detail->quantity)*( 4/100));
                                            }else{
                                                $giveReward = (  ($order_detail->profit * $order_detail->quantity)*( 4/100));
                                            }
                                            $referallCommission->amount =  $giveReward;
                                            $referallCommission->isAssign = false;
                                            $referallCommission->referMe = $user_level_one->refer_by;
                                            $get_username = User::findOrFail( auth()->user()->id);
                                            $referallCommission->level_user_name =$get_username->username;
                                            $referallCommission->save();
                                        }
                                        if($level_two && $order_detail->profit > 0 && $order_detail->shop_id =='58'){
                                            $user_level_two =User::where('username', $level_two_username)->first();
                                            $referallCommission = new ReferralCommission();
                                            $referallCommission->user_id =$user_level_two->id;
                                            $referallCommission->level = 2;
                                            $referallCommission->rewardOn =  $order_detail->id;
                                            $referallCommission->updateMessage = 'Your order is in processing'	;
                                            $giveReward = 0 ;
                                            if($sale_referral_com <= 50000){
                                                $giveReward = (  ($order_detail->profit *$order_detail->quantity) *( 5/100));
                                            }elseif($sale_referral_com <= 100000){
                                                $giveReward = (  ($order_detail->profit *$order_detail->quantity) *( 4/100));
                                            }elseif($sale_referral_com <= 150000){
                                                $giveReward = (  ($order_detail->profit *$order_detail->quantity) *( 3/100));
                                            }elseif($sale_referral_com <= 200000){
                                                $giveReward = (  ($order_detail->profit *$order_detail->quantity) *( 2/100));
                                            }else{
                                                $giveReward = (  ($order_detail->profit *$order_detail->quantity) *( 2/100));
                                            }
                                            $referallCommission->amount =$giveReward;
                                            $referallCommission->isAssign = false;
                                            $referallCommission->referMe = $user_level_two->refer_by;
                                            $get_username = User::findOrFail(  $get_username->id);
                                            $referallCommission->level_user_name =$get_username->username;
                                            $referallCommission->save();
                                        }

                              }
                            }
                            $commission = new Commission();
                            $commission->user_id = auth()->user()->id;
                            $commission->order_id =  $order_detail->id;
                            $commission->amount = $cart['profit'] *  $cart['quantity'];
                            $commission->isAssign = 0;
                            $commission->name = 'order';
                            $commission->status = 'pending';
                            $commission->save();
                        }
                    }
                }
                session()->forget('cart');
            }
            $notification = new Notification() ;
            $notification->user_id = auth()->user()->id;
            $notification->is_admin = 1;
            $notification->name = "new order";
            $notification->message = "new order place by username: ".  auth()->user()->username;
            //return   $notification;
            $notification->save();
            return redirect()->route('orderPlacedSuccessful')->with('success', 'Order placed successfully');
        }
        return  redirect('/')->with('warning', 'First Add to cart product');
    }
    public function storeDirectPlaceOrder(Request $request)
    {
        $user = auth()->user();
        $checkLast15DayOrder = false;
        $getCurrentDay  = date("j");
        if($getCurrentDay > 15){
            $getCurrentDay = date("Y-m") . '-16';
        }else{
            $getCurrentDay = Carbon::now()->firstOfMonth();
        }
        // return $getCurrentDay;
        $orders = Order::where('user_id', $user->id)->where('status', 'delivered')->whereDate('updated_at',$getCurrentDay)->get();
        if(!blank($orders)){
            $checkLast15DayOrder = true;
        }
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
        $sale_referral_com =  $total_com;
        $level_one = false;
        $level_one_username = null ;
        $level_two_username = null;
        $level_two = false;
        $order  = null;
        $new_withdraw  = null;
        $refer_by = auth()->user()->refer_by;
        if(!is_null($refer_by)){
            $level_one = true;
            $level_one_username = $refer_by;
            $second_level_username = User::where('username', $level_one_username)->first();
            if(!is_null($second_level_username)){
                $second_level_username = $second_level_username->refer_by;
                if(!is_null($second_level_username)){
                    $level_two_username = $second_level_username;
                    $level_two = true;
                }
            }
        }
        $request->validate([
            'name' => "required",
            'address' => "required",
            'city' => "required",
            'province' => "required",
            'phone' => "required|min:11|max:11",
            // 'payment_method'=>'required',
        ]);
        $total = 0;
        $delivery_charges = 0;
        $profit = 0;
        if (session('cart')) {
            foreach (session('cart') as $cart) {
                $delivery_charges += $cart['shop_charges'];
                foreach ($cart['products'] as  $value) {
                    $total += $value['discount_price'] * $value['quantity'];
                    $profit += $value['profit'] * $value['quantity'];
                }
            }
            // $total = $total + $profit + $delivery_charges;
            // $total = $total + $profit + $delivery_charges;
            // return $delivery_charges;
            $items = count((array) session('cart'));
            $user_id = Auth()->id();
            $user = Auth()->user();
            $order = new Order();
            $order->user_id = $user_id;
            $order->orderId = uniqid('DM');
            $user->business = $request->business;
            $user->save();
            $total_amount = $delivery_charges + $total + $profit;
            $order->total_amount = $total_amount;
            $order->user_profit = $profit;
            $order->total_items = $items;
            $order->name = $request->name;
            $order->address = $request->address;
            $order->phone = $request->phone;
            $order->province = $request->province;
            $order->city = $request->city;
            $order->status = 'pending';
            $order->area = $request->area;
            $order->house = $request->house;
            $order->street = $request->street;
            $order->nearest = $request->nearest;
            $order->acc_type = $request->account_type;
            $order->amount_paid = $request->paid;
            // dd($request->paid);
            if($request->payment_method == 'cod' || 'advance'){
                if ($request->hasFile('image')) {
                    $file = $request->file('image') ;
                    $orgname = $file->getClientOriginalName() ;
                    $imageName = $orgname.'_'.time() . '.' . $file->getClientOriginalExtension();
                    // dd($orgname);
                    // $fileName = $file->getClientOriginalName() ;
                    $destinationPath = public_path().'/payment_ss' ;
                    $file->move($destinationPath,$imageName);
                    $order->screenshot = $imageName;
                }
                $order->payment_method = $request->payment_method;
            }
            if ($request->payment_method == 'profit') {
                $amount = Commission::where('user_id', $user->id)->where('isAssign', 1)->sum('amount');
                $sale_comm = CircleCommission::where('user_id', $user->id)->where('isAssign', 1)->sum('amount');
                $amount += $sale_comm;
                $amount = $amount * 80/100;
                $withdraws = Withdraw::where('user_id', $user->id)->where('status', '!=','cancelled')->sum('amount');
                $income = $amount - $withdraws;
                if ($income >= $total_amount) {
                    $order->payment_method = 'profit';
                    $new_withdraw = new Withdraw();
                    $new_withdraw->user_id = $user->id;
                    $new_withdraw->payment_type = NULL;
                    $new_withdraw->amount = $total_amount;
                    $new_withdraw->account_title = 'Order Withdraw';
                    $new_withdraw->account_no = NULL;
                    $new_withdraw->status = 'completed';
                    $new_withdraw->message = 'Your withdrawal request accepted for placing order.';
                    // return $new_withdraw;
                } else {
                    return back()->with('warning', "You don't have sufficient profit");
                }
            }
            // return $order;
            $order->save();
            if ($request->payment_method == 'profit') {
                $new_withdraw->order_id = $order->id;
                $new_withdraw->save();
            }
            $new_circle_counter = new CircleCounter();
            $new_circle_counter->user_id = $order->user_id;
            $new_circle_counter->order_id = $order->id;
            $new_circle_counter->isAssign = false;
            $new_circle_counter->save();
            $get_user_circle_counter =  CircleCounter::where('user_id', auth()->user()->id)->where('isAssign', true)->whereDate('created_at', Carbon::now()->firstOfMonth())->count();
            if( $get_user_circle_counter != 0  ){
                if($get_user_circle_counter % 10 == 0){
                    $check_circle_commission = CircleCommission::where('user_id', auth()->user()->id)->latest()->first();
                    if(blank($check_circle_commission)){
                        $newCircleCommission = new CircleCommission();
                        $newCircleCommission->user_id = auth()->user()->id;
                        $getLatestCircleCounter =  CircleCounter::where('user_id', auth()->user()->id)->where('isAssign', true)->latest()->first();
                        $newCircleCommission->circle_counter_id =$getLatestCircleCounter->id;
                        $newCircleCommission->name ="Circle Income";
                        $newCircleCommission->isAssign =false;
                        $newCircleCommission->next_counter_divisible_by = 20;
                        $newCircleCommission->save();
                    }else{
                        $check_circle_commission = CircleCommission::where('user_id', auth()->user()->id)->latest()->first();
                        if($get_user_circle_counter / $check_circle_commission->next_counter_divisible_by == 1){
                            $newCircleCommission = new CircleCommission();
                            $newCircleCommission->user_id = auth()->user()->id;
                            $getLatestCircleCounter =  CircleCounter::where('user_id', auth()->user()->id)->where('isAssign', true)->latest()->first();
                            $newCircleCommission->circle_counter_id =$getLatestCircleCounter->id;
                            $newCircleCommission->name ="Circle Income";
                            $newCircleCommission->isAssign =false;
                            $newCircleCommission->next_counter_divisible_by = $check_circle_commission->next_counter_divisible_by + 10;
                            $newCircleCommission->save();
                        }
                    }
                }
            }
            // if ($checkPrice == 2000 || $checkPrice > 2000) {
            //     // return 'sale commission';
            //     $sale_commission = new CircleCommission();
            //     $sale_commission->user_id = $user_id;
            //     $sale_commission->order_id = $order->id;
            //     $sale_commission->amount = ($checkPrice == 2000) ? 300 : 700;
            //     $sale_commission->save();
            // }
            // +$profit
            // return gettype($total);
            $checkPrice = $total;
            // return 'out side sale commission';
            if (session('cart')) {
                foreach (session('cart') as $id => $carts) {
                    $new_shop_order = new ShopOrder();
                    $new_shop_order->user_id = auth()->user()->id;
                    $new_shop_order->orderId = $order->orderId;
                    $new_shop_order->shop_id = $carts['shop_id'];
                    $new_shop_order->shop_name = $carts['shop_name'];
                    $new_shop_order->shop_charges = $carts['shop_charges'];
                    $new_shop_order->status = 'pending';
                    $new_shop_order->message = 'Thank you for placing Order! Your order is in review';
                    $new_shop_order->save();
                    foreach($carts['products'] as $cart){
                        $product_Details = Product::with('shop')->where('slug', $cart['slug'])->first();
                        if(!blank($product_Details)){
                            $order_detail = new OrderDetail();
                            $order_detail->status = 'pending';
                            $order_detail->order_id = $order->id;
                            $order_detail->product_id = $product_Details->id;
                            $order_detail->shop_id = $product_Details->user_id;
                            $order_detail->shop_order_id = $new_shop_order->id;
                            $order_detail->quantity = $cart['quantity'];
                            $order_detail->price = $cart['price'];
                            $order_detail->discount_price = $cart['discount_price'];
                            $order_detail->profit = $cart['profit'];
                            $order_detail->amount = $cart['discount_price'] * $cart['quantity'];
                            $order_detail->delivery_days = $cart['delivery_days'];
                            $order_detail->delivery_charges = $new_shop_order->shop_charges;
                            $order_detail->product_name = $product_Details->name ;
                            $order_detail->product_images = $product_Details->images ;
                            $order_detail->product_image = $product_Details->image ;
                            $order_detail->shop_name = $product_Details->shop->name ;
                            $order_detail->shop_image = $product_Details->shop->image ;
                            $order_detail->shop_city = $product_Details->shop->city  ;
                            $order_detail->shop_province = $product_Details->shop->province  ;
                            $order_detail->shop_mobile = $product_Details->shop->mobile  ;
                            $order_detail->shop_address = $product_Details->shop->address  ;
                            $order_detail->save();
                            $get_username = null;
                            if($checkLast15DayOrder){
                                if (is_null($product_Details->branding_id) && !($product_Details->isMegaSale)) {


                                if($level_one && $order_detail->profit > 0 && $order_detail->shop_id =='58'){
                                $user_level_one =User::where('username', $level_one_username)->first();
                                $referallCommission = new ReferralCommission();
                                $referallCommission->user_id =$user_level_one->id;
                                $referallCommission->level = 1;
                                $referallCommission->rewardOn =  $order_detail->id;
                                $referallCommission->updateMessage = 'Your order is in processing'	;
                                $giveReward = 0 ;
                                if($sale_referral_com <= 50000){
                                    $giveReward = (  $order_detail->profit *( 15/100));
                                }elseif($sale_referral_com <= 100000){
                                    $giveReward = (  $order_detail->profit *( 10/100));
                                }elseif($sale_referral_com <= 150000){
                                    $giveReward = (  $order_detail->profit *( 5/100));
                                }elseif($sale_referral_com <= 200000){
                                    $giveReward = (  $order_detail->profit *( 4/100));
                                }else{
                                    $giveReward = (  $order_detail->profit *( 4/100));
                                }
                                $referallCommission->amount =  $giveReward;
                                $referallCommission->isAssign = false;
                                $referallCommission->referMe = $user_level_one->refer_by;
                                $get_username = User::findOrFail( auth()->user()->id);
                                $referallCommission->level_user_name =$get_username->username;
                                $referallCommission->save();
                            }
                            if($level_two && $order_detail->profit > 0 && $order_detail->shop_id =='58'){
                                $user_level_two =User::where('username', $level_two_username)->first();
                                $referallCommission = new ReferralCommission();
                                $referallCommission->user_id =$user_level_two->id;
                                $referallCommission->level = 2;
                                $referallCommission->rewardOn =  $order_detail->id;
                                $referallCommission->updateMessage = 'Your order is in processing'	;
                                $giveReward = 0 ;
                                if($sale_referral_com <= 50000){
                                    $giveReward = (  $order_detail->profit *( 5/100));
                                }elseif($sale_referral_com <= 100000){
                                    $giveReward = (  $order_detail->profit *( 4/100));
                                }elseif($sale_referral_com <= 150000){
                                    $giveReward = (  $order_detail->profit *( 3/100));
                                }elseif($sale_referral_com <= 200000){
                                    $giveReward = (  $order_detail->profit *( 2/100));
                                }else{
                                    $giveReward = (  $order_detail->profit *( 2/100));
                                }
                                $referallCommission->amount =$giveReward;
                                $referallCommission->isAssign = false;
                                $referallCommission->referMe = $user_level_two->refer_by;
                                $get_username = User::findOrFail(  $get_username->id);
                                $referallCommission->level_user_name =$get_username->username;
                                $referallCommission->save();
                            }
                          }
                        }
                            $commission = new Commission();
                            $commission->user_id = auth()->user()->id;
                            $commission->order_id =  $order_detail->id;
                            $commission->amount = $cart['profit'] *  $cart['quantity'];
                            $commission->isAssign = 0;
                            $commission->name = 'order';
                            $commission->status = 'pending';
                            $commission->save();
                        }
                    }
                }
                session()->forget('cart');
            }
            $notification = new Notification() ;
            $notification->user_id = auth()->user()->id;
            $notification->is_admin = 1;
            $notification->name = "new order";
            $notification->message = "new order place by username: ".  auth()->user()->username;
            //return   $notification;
            $notification->save();
            return redirect()->route('orderPlacedSuccessful')->with('success', 'Order placed successfully');
        }
        return  redirect('/')->with('warning', 'First Add to cart product');
    }
    public function delivered()
    {
        $user = Auth()->user();
        $duplicators = Order::with(['shop_orders.shop','track_order', 'shop_orders.order_details'])->where('user_id', $user->id)->where('status', 'delivered')->get();

        return view('frontend.order.delivered', compact('duplicators'));
    }
    public function returned()
    {
        $user = Auth()->user();
        $duplicators = Order::with(['shop_orders.shop', 'shop_orders.order_details'])->where('user_id', $user->id)->whereIn('status', ['return', 'refund'])->latest()->get();

        return view('frontend.order.returned', compact('duplicators'));
    }
    public function inProgress()
    {
        $user = Auth()->user();
        $duplicators = Order::with(['shop_orders.shop', 'track_order' ,'shop_orders.order_details'])->where('user_id', $user->id)->whereIn('status', ['processing','pending','onDelivery'])->latest()->get();

              return view('frontend.order.inProgress', compact('duplicators'));
    }
}
function check_duplicator($items, $order_id, $order)
{
    $getSameShopPro = array();
    $getSameProducts = array();
    $getDiffProducts = array();
    $total_amount = 0;
    $item_ids = OrderDetail::whereIn('id', $items->pluck('id'))->distinct('shop_id')->pluck('shop_id');
    //    echo "<pre>";
    //      print_r($item_ids->all());
    foreach ($item_ids as $it) {
        $getSameProducts = [];
        foreach ($items as $sh) {
            if ($it == $sh->shop_id) {
                $total_amount += $sh->amount;
                $getSameProducts[] = [
                    'product_id' => $sh->product_id,
                    'product_name' => $sh->product->name,
                    'profit' => $sh->profit * $sh->quantity,
                    'images' => $sh->product->images,
                    'supplier' => $sh->product->user->business
                ];
            }
        }
        OrderController::$resultCounterProduct[] = [
            'order_id' => $order_id,
            'status' => $order->status,
            'amount' => $total_amount,
            'orderId' => $order->orderId,
            'name' => $order->name,
            'phone' => $order->phone,
            'house' => $order->house,
            'street' => $order->street,
            'city' => $order->city,
            'nearest' => $order->nearest,
            'created_at' => $order->created_at,
            'updated_at' => $order->updated_at,
            'shop_id' => $it,
            'products' => $getSameProducts,
        ];
    }

}
