<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Notification;
use App\Models\ReferralCommission;
use App\Models\ReturnDetail;
use App\Models\CircleCommission;
use App\Models\CircleCounter;
use App\Models\ShopOrder;
use App\Models\TrackOrder;
use App\Models\Withdraw;
use Response;

class OrderController extends Controller
{
    public function returnOrder($order = null)
    {
        // return $order;
        $orders = ReturnDetail::with(['order', 'order.user'])->where('status', $order)->latest()->get();
        return view('admin.order.returnOrder', compact('orders', 'order'));
    }
    public function index($order = null)
    {
        // return $order;
        $orders = Order::with(['order_detail', 'user'])->where('status', $order)->latest()->get();
        return view('admin.order.index', compact('orders', 'order'));
    }

    public function viewOrder($order)
    {
        // return $order;
        $orders = Order::with([ 'user','shop_orders.shop','shop_orders.order_details'])->where('id', $order)->latest()->first();
        // $delivery_charges = OrderDetail::where('order_id', $order)->sum('delivery_charges');
        return view('admin.order.singleOrder', compact('orders'));
    }

    public function view_receipt($filename){
        $filePath = public_path('payment_ss') . '/' . $filename;

        if (!file_exists($filePath)) {
            return response()->json(['error' => 'File not found.'], 404);
        }
        // return response()->download($filePath, $filename);
        $fileContent = file_get_contents($filePath);
        $mimeType = mime_content_type($filePath);

        return response($fileContent)
            ->header('Content-Type', $mimeType);
    }
    public function viewReturnOrder($order)
    {
        // return $order;
        $orders = Order::with(['order_detail', 'user', 'order_detail.product'])->where('id', $order)->latest()->first();
        $delivery_charges = OrderDetail::where('order_id', $order)->sum('delivery_charges');
        $returnOrder = ReturnDetail::with(['order.user', 'order'])->where('order_id', $order)->latest()->first();

        return view('admin.order.singleReturnOrder', compact('orders', 'returnOrder', 'delivery_charges'));
    }
    public function changeOrderStatus($order)
    {
        // return $order;
        $orders = Order::with(['order_detail', 'user', 'order_detail.product'])->where('id', $order)->latest()->first();

        return view('admin.order.changeOrderStatus', compact('orders'));
    }
    public function changeReturnStatus($order)
    {
        // return $order;
        $orders = ReturnDetail::with(['order.user', 'order'])->where('id', $order)->latest()->first();

        return view('admin.order.changeReturnStatus', compact('orders'));
    }
    public function markAsReturnOrder(Request $request)
    {
        // return $order;
        $returnDetail = ReturnDetail::with('order')->findOrFail($request->id);
        $returnDetail->message = $request->message;
        $returnDetail->status = $request->status;
        $returnDetail->save();

        if ($request->status == 'returned') {
            $ord = Order::findOrFail($returnDetail->order_id);
            $ord->status = 'return';
            $ord->message = $request->message;
            $ord->save();

            $track = new TrackOrder();
            $track->order_id = $ord->id;
            $track->status =$ord->status;
            $track->message = $ord->message;
            $track->save();

            if ($request->status == 'cancelled' || $request->status == 'returned' || $request->status == 'refund') {
                if($request->status == 'refund'){
                    $withdraws = Withdraw::where('order_id', $ord->id)->get();
                    if(!blank($withdraws)){
                        foreach ($withdraws as $key => $with) {
                            $with->status = 'cancelled';
                            $with->save();
                        }
                    }
                }

                $circleCounter = CircleCounter::where('order_id',$ord->id )->first();
                if(!blank($circleCounter)){
                    $circleCounter->isAssign = false;
                    $circleCounter->save();
                    $circle_com = CircleCommission::where('circle_counter_id', $circleCounter->id)->first();
                    if(!blank($circle_com)){
                        $circle_com->delete();
                    }
                }
                $shop_orders = ShopOrder::where('orderId', $ord->orderId)->get();
                if(!blank($shop_orders)){
                    foreach ($shop_orders as $key => $so) {
                        $so->status = ($request->status == 'returned'?'return': $request->status) ;
                        $so->changed_status = 'Admin';
                        $so->message = $request->message;
                        $so->save();
                        $order_details = OrderDetail::where('shop_order_id', $so->id)->get();
                        if(!blank($order_details)){
                            foreach ($order_details as $key => $od) {
                                $od->status = ($request->status == 'returned'?'return': $request->status) ;
                                $od->message = $request->message;
                                $od->changed_status = 'Admin';
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

            }
        }
        $noti = new Notification();
        $noti->user_id = $returnDetail->order->user_id;
        $noti->name = "Return Order Status";
        $noti->message =  $request->message;
        $noti->save();
        return redirect()->route('admin.orders.returnOrder', ['order' => 'pending'])->with('success', 'Return Order Status Changed!');
    }
    public function markAs(Request $request)
    {
        // return $request;
        // return $request->id;
        $orders = Order::findOrFail($request->id);
        $withdraw = Withdraw::where('user_id', $orders->user_id)->where('account_title', 'Order Withdraw')->where('amount', $orders->total_amount)->first();

        $orders->message = $request->message;
        $orders->status = $request->status;
        $orders->save();

        $track = new TrackOrder();
        $track->order_id = $orders->id;
        $track->status = $orders->status;
        $track->message = $orders->message;
        $track->save();
        if($request->status == 'processing'){

            $circleCounter = CircleCounter::where('order_id',$orders->id )->first();
            if(!blank($circleCounter)){
                $circleCounter->isAssign = false;
                $circleCounter->save();
                $circle_com = CircleCommission::where('circle_counter_id', $circleCounter->id)->first();
                if(!blank($circle_com)){
                    $circle_com->delete();
                }
            }
            $shop_orders = ShopOrder::where('orderId', $orders->orderId)->get();
            if(!blank($shop_orders)){
                foreach ($shop_orders as $key => $so) {
                    $order_details = OrderDetail::where('shop_order_id', $so->id)->get();
                    if(!blank($order_details)){
                        foreach ($order_details as $key => $od) {

                            $referallCommission = ReferralCommission::where('rewardOn', $od->id)->get();
                            if(!blank($referallCommission)){
                                foreach ($referallCommission as $key => $rc) {
                                    if($orders->payment_method == 'advance' && $od->shop_id == '58'){
                                        $rc->isAssign = true;
                                    }else{
                                        $rc->isAssign = false;
                                    }
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

        }
        if($request->status == 'pending'){

            $circleCounter = CircleCounter::where('order_id',$orders->id )->first();
            if(!blank($circleCounter)){
                $circleCounter->isAssign = false;
                $circleCounter->save();
                $circle_com = CircleCommission::where('circle_counter_id', $circleCounter->id)->first();
                if(!blank($circle_com)){
                    $circle_com->delete();
                }
            }
            $shop_orders = ShopOrder::where('orderId', $orders->orderId)->get();
            if(!blank($shop_orders)){
                foreach ($shop_orders as $key => $so) {
                    $so->status = $request->status;
                    $so->changed_status = 'Admin';
                    $so->message = $request->message;
                    $so->save();
                    $order_details = OrderDetail::where('shop_order_id', $so->id)->get();
                    if(!blank($order_details)){
                        foreach ($order_details as $key => $od) {
                            $od->status = $request->status;
                            $od->message = $request->message;
                            $od->changed_status = 'Admin';
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

        }
        if ($request->status == 'delivered') {
            $shop_orders = ShopOrder::where('orderId', $orders->orderId)->get();
            if(!blank($shop_orders)){
                foreach ($shop_orders as $key => $so) {

                    $order_details = OrderDetail::where('shop_order_id', $so->id)->get();
                    if(!blank($order_details)){
                        foreach ($order_details as $key => $od) {

                            $referallCommission = ReferralCommission::where('rewardOn', $od->id)->get();
                            if(!blank($referallCommission)){
                                foreach ($referallCommission as $key => $rc) {
                                   $rc->isAssign = true;
                                   $rc->updateMessage = $request->message;
                                   $rc->save();
                                }
                            }

                            $com = Commission::where('order_id', $od)->get();
                            if(!blank($com)){
                                foreach ($com as $key => $value) {
                                    $value->isAssign = true;
                                    $value->status = 'clear';
                                    $value->save();
                                }
                            }

                        }
                    }
                }
            }
            $withdraws = Withdraw::where('order_id', $orders->id)->get();
            if(!blank($withdraws)){
                foreach ($withdraws as $key => $with) {
                    $with->status = 'completed';
                    $with->save();
                }
            }

            $circleCounter = CircleCounter::where('order_id',$orders->id )->first();
            if(!blank($circleCounter)){
                $circleCounter->isAssign = true;
                $circleCounter->save();

                $get_user_circle_counter =  CircleCounter::where('user_id', $orders->user_id)->where('isAssign', true)->count();
                if( $get_user_circle_counter != 0  ){
                    if($get_user_circle_counter % 10 == 0){
                        $check_circle_commission = CircleCommission::where('user_id', $orders->user_id)->latest()->first();
                        if(blank($check_circle_commission)){
                            $newCircleCommission = new CircleCommission();
                            $newCircleCommission->user_id = $orders->user_id;
                            $getLatestCircleCounter =  CircleCounter::where('user_id',$orders->user_id)->where('isAssign', true)->latest()->first();
                            $newCircleCommission->circle_counter_id =$getLatestCircleCounter->id;
                            $newCircleCommission->name ="Circle Income";
                            $newCircleCommission->isAssign =false;
                            $newCircleCommission->next_counter_divisible_by = 20;
                            $newCircleCommission->save();
                        }else{
                            $check_circle_commission = CircleCommission::where('user_id', $orders->user_id)->latest()->first();
                            if($get_user_circle_counter / $check_circle_commission->next_counter_divisible_by == 1){

                                $newCircleCommission = new CircleCommission();
                                $newCircleCommission->user_id = $orders->user_id;
                                $getLatestCircleCounter =  CircleCounter::where('user_id', $orders->user_id)->where('isAssign', true)->latest()->first();
                                $newCircleCommission->circle_counter_id =$getLatestCircleCounter->id;
                                $newCircleCommission->name ="Circle Income";
                                $newCircleCommission->isAssign =false;
                                $newCircleCommission->next_counter_divisible_by = $check_circle_commission->next_counter_divisible_by + 10;
                                $newCircleCommission->save();
                            }
                        }
                    }
                }
            }
        } else {

            if ($request->status == 'cancelled' || $request->status == 'return' || $request->status == 'refund') {
                if($request->status == 'refund'){
                    $withdraws = Withdraw::where('order_id', $orders->id)->get();
                    if(!blank($withdraws)){
                        foreach ($withdraws as $key => $with) {
                            $with->status = 'cancelled';
                            $with->save();
                        }
                    }
                }

                $circleCounter = CircleCounter::where('order_id',$orders->id )->first();
                if(!blank($circleCounter)){
                    $circleCounter->isAssign = false;
                    $circleCounter->save();
                    $circle_com = CircleCommission::where('circle_counter_id', $circleCounter->id)->first();
                    if(!blank($circle_com)){
                        $circle_com->delete();
                    }
                }
                $shop_orders = ShopOrder::where('orderId', $orders->orderId)->get();
                if(!blank($shop_orders)){
                    foreach ($shop_orders as $key => $so) {
                        $so->status = $request->status;
                        $so->changed_status = 'Admin';
                        $so->message = $request->message;
                        $so->save();
                        $order_details = OrderDetail::where('shop_order_id', $so->id)->get();
                        if(!blank($order_details)){
                            foreach ($order_details as $key => $od) {
                                $od->status = $request->status;
                                $od->message = $request->message;
                                $od->changed_status = 'Admin';
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

            }

        }
        $noti = new Notification();
        $noti->user_id = $orders->user_id;
        $noti->name = "Order Status";
        $noti->message =  $request->message;
        $noti->save();
        return redirect()->route('admin.orders.index', ['orders' => 'processing'])->with('success', 'order status has been changed successfull!');
    }
}
