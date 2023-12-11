<?php

namespace App\Http\Controllers;

use App\Models\BundleCircleCommission;
use App\Models\BundleCircleCounter;
use App\Models\BundleLevel;
use App\Models\BundlePaymentType;
use App\Models\BundlePaymerntMethod;
use App\Models\BundleSendPoint;
use App\Models\BundleStoppedPayment;
use App\Models\BundleWithdraw;
use App\Models\BuyProductBundle;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderProductBundle;
use App\Models\ProductBundle;
use App\Models\ProductBundleDetail;
use App\Models\ReferralBundle;
use App\Models\StopBundleReferralEarning;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductBundleController extends Controller
{
    public static $team_member_count = 0;
    public static $team_member_ids = [];
    public static $reward_on;
    public static $reward_on_sub;
    public static $packageLevels = 1;
    public static $team_member_finder = [];
    public static $team_member_ranks = [];
    public static $allRankOfTheTeam = array();
    public static $topRankOfTheCurrentLevel = array();
    public static $incrementorTwoPercent = 0;
    public static $BuyWithOrder = false;
    public static $junior_rank;
    public static $starting_level = 0;
    public static $first_rank = 0;
    public static $last_rank = 1;
    public static $junior_ranker = [];
    public static $senior_rank = [];

    public function home() {
      
        $getToDate = Carbon::now()->subDays(10);
        $user = auth()->user();
        $id = $user->id;
        $levels = ReferralBundle::where('user_id', $id)->where('isActive', true)->latest()->get();
        $bundleOrders = BuyProductBundle::with('product_bundle')->where('user_id', $id)->latest()->get();
        $getCircleCommission = BundleCircleCommission::where('user_id', $id)->where('isActive', true)->where('isAssign', true)->sum('amount');
        $getCompletedPendingWithdraws = BundleWithdraw::where('user_id',$id)->where('status', '!=','cancelled')->sum('amount');
        $totalCommission =  $levels->sum('commission') + $getCircleCommission;
        $isActiveMember = false;
        $paidOrders = BuyProductBundle::with('product_bundle')->where('user_id', $id )->where('status', 'approved')->count();
        $getPaidOrders = BuyProductBundle::with('product_bundle')->where('user_id', $id )->whereDate('created_at','>=', $getToDate)->where('status', 'approved')->where('isOrdered',false)->latest()->get();
        $getCancelledOrders = BuyProductBundle::with('product_bundle')->where('user_id', $id )->where('status', 'cancelled')->latest()->get();
        $getDeliveryBundles = OrderProductBundle::with('buy_product_bundle', 'product_bundle')->where('user_id', $id)->latest()->get();
        $getCancelledDeliveryBundles = OrderProductBundle::with('buy_product_bundle', 'product_bundle')->where('status','cancelled')->where('user_id', $id)->latest()->get();
        $paymentType = BundlePaymentType::where('user_id', $id)->first();
        $withdraws = BundleWithdraw::where('user_id', $id)->latest()->get();
        if($paidOrders > 0 ){
            $isActiveMember = true;
        }
        $getReceivedPoints = BundleSendPoint::where('receiver_id', $id)->sum('points');
        $getSentPoints = BundleSendPoint::where('user_id', $id)->sum('points');
        $getFirstDateOfMonth = Carbon::now()->startOfMonth();
        $getCircleCounter = BundleCircleCounter::where('user_id', $id)->where('isActive', true)->whereDate('created_at', '>=', $getFirstDateOfMonth)->count();
        $unAssignedCircleCommission = BundleCircleCommission::where('user_id', $id)->where('isActive', true)->where('isAssign', false)->count();
        $getStoppedReferralEarning = StopBundleReferralEarning::where('user_id', $id)->where('isStopped', true)->latest()->get();
        return view('user.bundle.home', compact('getStoppedReferralEarning','getSentPoints','getReceivedPoints','getCompletedPendingWithdraws','unAssignedCircleCommission','getCircleCounter','withdraws','paymentType','getCancelledDeliveryBundles','getDeliveryBundles','getPaidOrders','paidOrders','getCancelledOrders','isActiveMember','user', 'levels', 'bundleOrders', 'totalCommission'));
    }

    public function repaymentProductBundle($id) {
        $bundles = BuyProductBundle::with('product_bundle')->findOrFail($id);
        $bundleOrder = $bundles;
        $bundles = ProductBundle::with('levels')->findOrFail($bundles->product_bundle_id);
        $accounts = BundlePaymerntMethod::where('status', true)->get();
        return view('frontend.product.repaymentBundle', compact('bundles', 'accounts','bundleOrder'));
    }
   
    public function stopReferralPayment($id) {
        $bundles = StopBundleReferralEarning::findOrFail($id);
        $accounts = BundlePaymerntMethod::where('status', true)->get();
        return view('frontend.product.stopReferralBundlePayment', compact('bundles', 'accounts'));
    }
    public function repaymentDeliveryChargesProductBundle($id) {
        $bundles = OrderProductBundle::with('buy_product_bundle','product_bundle')->findOrFail($id);
        $bundleOrder = $bundles->buy_product_bundle;
       
        $accounts = BundlePaymerntMethod::where('status', true)->get();
        return view('frontend.product.repaymentDeliveryBundle', compact('bundles', 'accounts','bundleOrder'));
    }
    public function orderNowProductBundle($id) {
        $bundles = BuyProductBundle::with('user','product_bundle')->findOrFail($id);
        $accounts = BundlePaymerntMethod::where('status', true)->get();
        return view('frontend.product.orderBundleNow', compact('bundles','accounts'));
    }
    public function changeBundleOrdersStatus(Request $request){

        $orders = Order::findOrFail($request->orderId);

        $orders->status = $request->status;

        $orders->message = $request->message;

        $orders->save();



        $noti = new Notification();

        $noti->user_id = $orders->user_id;

        $noti->payment = 1;

        $noti->message = $orders->message;

        $noti->save();





        return redirect('admin/bundle/orders/pending')->with('success','order status has been changed successfull!');

    }

    public function viewBundleOrders($orderId){

        $orders = Order::with(['user','bundle','package','product_package','product_package.product_package_detail'])->where('orderId', $orderId)->first();

        return view('admin.bundle.viewBundleOrder', compact('orders'));

    }

    public function changeBundleOrders($orderId){

        $orders = Order::with(['user','bundle'])->where('orderId', $orderId)->first();

        return view('admin.bundle.changeOrder', compact('orders'));

    }

    public function deleteBundleOrders($orderId){

        $orders = Order::findOrFail($orderId);

        $orders->delete();

      return redirect()->back()->with('success', 'bundle Order has been deleted successfully!');

    }

    public function stoppedBundlePayments($order){

        $orders = BundleStoppedPayment::with(['user'])->where('status', $order)->latest()->get();

        return view('admin.order.stoppedBundlePayments', compact('orders','order'));

    }
    public function getBundleOrder($order){

        $orders = OrderProductBundle::with(['user','product_bundle', 'buy_product_bundle'])->where('status', $order)->latest()->get();

        return view('admin.order.orderBundle', compact('orders','order'));

    }
    public function bundleOrderView($order)
    {
        // return $order;
        $orders = BuyProductBundle::with([ 'user','product_bundle'])->where('id', $order)->latest()->first();
        // $delivery_charges = OrderDetail::where('order_id', $order)->sum('delivery_charges');
        return view('admin.order.singleBundle', compact('orders'));
    }
    public function getBundleOrderView($order)
    {
        // return $order;
        $orders = OrderProductBundle::with([ 'user','product_bundle','buy_product_bundle'])->where('id', $order)->latest()->first();
        // $delivery_charges = OrderDetail::where('order_id', $order)->sum('delivery_charges');
        return view('admin.order.getSingleBundle', compact('orders'));
    }
    public function bundleOrderStatus($order)
    {
        // return $order;
        $orders = BuyProductBundle::with(['user', 'product_bundle'])->where('id', $order)->latest()->first();

        return view('admin.order.changeBundleStatus', compact('orders'));
    }
    public function getBundleOrderStatus($order)
    {
        // return $order;
        $orders = OrderProductBundle::with([ 'user','product_bundle','buy_product_bundle'])->where('id', $order)->latest()->first();

        return view('admin.order.getChangeBundleStatus', compact('orders'));
    }
    public function changeStatusStoppedBundlePayments($order)
    {
        // return $order;
        $orders = BundleStoppedPayment::with([ 'user'])->where('id', $order)->latest()->first();

        return view('admin.order.changeStatusStoppedBundlePayments', compact('orders'));
    }
    public function bundleMarked(Request $request)
    {
        $level = 1;

    //    return $request;
       $buy_product_bundles = BuyProductBundle::findOrFail($request->id);
       $getOldStatus = $buy_product_bundles->status;
       $buy_product_bundles->status = $request->status;
       $buy_product_bundles->message = $request->message;
       $buy_product_bundles->save();
       $user = User::findOrFail($buy_product_bundles->user_id);
       ProductBundleController::$reward_on_sub = $buy_product_bundles->product_bundle_id;
       $allLevels = ProductBundle::findOrFail($buy_product_bundles->product_bundle_id);
       ProductBundleController::$packageLevels = $allLevels->level ;
       $checkRewardDistributed = ReferralBundle::where('rewardOn', $user->username)->first();
       if(blank($checkRewardDistributed)){
           if($buy_product_bundles->status == 'approved'){
            if ($buy_product_bundles->refer_by != null) {
                // return $buy_product_bundles->refer_by;
                $check_level_no1 = check_level($user, $level, $buy_product_bundles);
                // echo '<pre>';
                // print_r(ProductBundleController::$team_member_finder);
                // echo '<br>';
                // print_r(count(ProductBundleController::$team_member_finder));

                // return redirect('/home')->with('success', 'your profile is activated and the order will deliver you soon Thanks !');
            }
           }
       }
       if ($buy_product_bundles->status == 'cancelled') {
            if($buy_product_bundles->payment_method == 'Wallet'){
                $getWithdraw = BundleWithdraw::where('buy_product_bundle_id', $buy_product_bundles->id)->first();
                if (!blank($getWithdraw)) {
                    $getWithdraw->status = 'cancelled';
                    $getWithdraw->save();
                }
            }
       }
       if ($buy_product_bundles->status == 'approved') {
            if($buy_product_bundles->payment_method == 'Wallet'){
                $getWithdraw = BundleWithdraw::where('buy_product_bundle_id', $buy_product_bundles->id)->first();
                if (!blank($getWithdraw)) {
                    $getWithdraw->status = 'completed';
                    $getWithdraw->save();
                }
            }
       }
       return redirect()->route('admin.bundleOrder', ['status' => $getOldStatus])->with('success', 'status updated');
    }
    public function getBundleMarked(Request $request)
    {
       
       $buy_product_bundles = OrderProductBundle::findOrFail($request->id);
       $getOldStatus = $buy_product_bundles->status;
       $buy_product_bundles->status = $request->status;
       $buy_product_bundles->message = $request->message;
       $buy_product_bundles->save();
    
       return redirect()->route('admin.getBundleOrder', ['status' => $getOldStatus])->with('success', 'status updated');
    }
    public function getStoppedBundlePaymentMarked(Request $request)
    {
       
       $buy_product_bundles = BundleStoppedPayment::findOrFail($request->id);
       $getOldStatus = $buy_product_bundles->status;
       $buy_product_bundles->status = $request->status;
       $buy_product_bundles->message = $request->message;
       $buy_product_bundles->save();
       if($buy_product_bundles->status == 'approved'){
        $getStopEeaning = StopBundleReferralEarning::findOrFail($buy_product_bundles->stop_bundle_referral_earning_id);
        if (!blank($getStopEeaning)) {
            $getStopEeaning->isStopped = false;
            $getStopEeaning->payment_slip = $buy_product_bundles->slip;
            $getStopEeaning->payment_method = $buy_product_bundles->payment_type;
            $getStopEeaning->save();

            $user = User::findOrFail($getStopEeaning->user_id);
            $user->isStopped = false;
            $user->save();
        }
    }
    
       return redirect()->route('admin.orders.stoppedBundlePayments', ['status' => $getOldStatus])->with('success', 'status updated');
    }

   public function create()

    {

        return view('admin.bundle.create');

    }

    public function index()

    {

        $bundles = ProductBundle::latest()->get();

        return view('admin.bundle.index', compact('bundles'));

    }
    public function viewAllCommission()

    {

        $bundles = ReferralBundle::with('product_bundle')->where('user_id', auth()->user()->id)->where('isActive', true)->latest()->get();

        return view('user.bundle.allCommission', compact('bundles'));

    }
    public function sendUserPoint(Request $request)
    {
        $points = $request->points;

        if ($points <  1000) {
            return redirect()->back()->with('error', 'you p-wallet must be greater than 1000');
        }
        return view('user.bundle.sendUserPoint', compact('points'));
    }
    public function sendUserPointToUser(Request $request){
        $request->validate([
            'username'=> 'required',
            'points'=> 'required',
            'confirmation'=> 'required',
        ]);
        // return $request;
        $getSender = User::where('username', $request->username)->first();
        if(blank($getSender)){
            return redirect()->back()->with('error', 'send is not found');
        }else{
            $new = new BundleSendPoint();
            $new->user_id = auth()->user()->id;
            $new->receiver_id = $getSender->id;
            $new->points = $request->points;
            $new->save();
            return redirect()->route('bundles.home')->with('success', 'points has been sent successful!');

        }
    }
    public function otherUserSearching(Request $request)
    {
      if($request->ajax()){
        $username = $request->username;
        $users = User::where('username', $username)->where('id', '!=', auth()->user()->id)->first();
        if (!blank($users)) {
            return response()->json(['username' => $users->username]);
        } else {
            return response()->json(['username' => 'none']);
        }
      }
    }
    public function viewAllCircleCommission()

    {

        $bundles = BundleCircleCommission::where('user_id', auth()->user()->id)->where('isActive', true)->latest()->get();

        return view('user.bundle.allCircleCommission', compact('bundles'));

    }
    public function claimedNowCircleCommission(Request $request)

    {
        $request->validate([
            'id'=>'required'
        ]);

        $claim = BundleCircleCommission::where('user_id', auth()->user()->id)->where('id', $request->id)->first();
       if (blank($claim)) {
        return redirect()->back()->with('error', 'you are not authorized to claim this ');
         } else {
        $claim->isAssign = true;
        $claim->save();
        return redirect()->route('bundles.home')->with('success', 'you have claimed circle commission');
       }
       return redirect()->route('bundles.home')->with('success', 'claimed circle commission');
       
       
    }



      public function store(Request $request)

    {
        // return $request;

        $request->validate([

            'photo'=>'required|image',
            'name'=> 'required',
            'price'=> 'required',
            'points'=> 'required',
            'level'=> 'required',
            'commission'=> 'required',
            'delivery_charges'=> 'required',
            'delivery_days'=> 'required',
            ]);



        $package = new ProductBundle();

        $package->name = $request->name ;

        $package->price = $request->price ;
        $package->commission = $request->commission ;
        $package->level = $request->level ;
        $package->delivery_charges = $request->delivery_charges ;
        $package->delivery_days = $request->delivery_days ;
        $package->points = $request->points ;


         if ($request->hasFile('photo')) {

         $image = $request->file('photo');

         $filename = uniqid(). '.'. $image->getClientOriginalExtension();

         $path = $request->photo->move('images/bundle/', $filename);

          $package->photo = $path ;

         }
        $package->save();

        return redirect()->route('admin.allProductBundle')->with('success', 'A new product bundle has been added successfully!');

    }
      public function orderNowProductBundleDetail (Request $request)

    {
        $request->validate([
            'image'=>'required|image',
            'city'=> 'required',
            'state'=> 'required',
            'phone'=> 'required|min:11|max:11',
            'address'=> 'required',
            'name'=> 'required',
            'delivery_charges'=> 'required',            
            'product_bundle_id'=> 'required',            
            ]);
            $checkAuthorization = BuyProductBundle::where('id',$request->product_bundle_id)->where('user_id', auth()->user()->id)->first();
            if (blank($checkAuthorization)) {
                return redirect()->back()->with('error', ' you are not authorized to order this bundle');
            }
            $package = new OrderProductBundle();
        $package->user_id = auth()->user()->id ;
        $package->name = $request->name ;
        $package->buy_product_bundle_id = $request->product_bundle_id ;
        $package->product_bundle_id = $checkAuthorization->product_bundle_id ;
        $package->city = $request->city ;
        $package->state = $request->state ;
        $package->phone = $request->phone ;
        $package->delivery_charges = $request->delivery_charges ;
        $package->address = $request->address ;
        $package->notes = $request->notes ;
         if ($request->hasFile('image')) {
         $image = $request->file('image');
         $filename = uniqid(). '.'. $image->getClientOriginalExtension();
         $path = $request->image->move('images/bundle/order/slip/', $filename);
         $package->image = $path ;
         }
        $package->save();
        $buy_product_bundles = BuyProductBundle::findOrFail($package->buy_product_bundle_id);
        $buy_product_bundles->isOrdered = true;
        $buy_product_bundles->save();

        return redirect()->route('bundles.home')->with('success', 'we received your order request successfully!');

    }

      public function editBundle(Request $request)

    {

        $request->validate([

            'photo'=>'image',
            'name'=> 'required',
            'price'=> 'required',
            'points'=> 'required',
            'level'=> 'required',
            'commission'=> 'required',
            'delivery_charges'=> 'required',
            'delivery_days'=> 'required',

            ]);



        $package = ProductBundle::findOrFail($request->id);
        $package->name = $request->name ;

        $package->price = $request->price ;
        $package->commission = $request->commission ;
        $package->level = $request->level ;
        $package->delivery_charges = $request->delivery_charges ;
        $package->delivery_days = $request->delivery_days ;
        $package->points = $request->points ;

         if ($request->hasFile('photo')) {

         $image = $request->file('photo');

         $filename = uniqid(). '.'. $image->getClientOriginalExtension();

         $path = $request->photo->move('images/bundle/', $filename);

          $package->photo = $path ;

         }
        $package->save();

        return redirect()->route('admin.allProductBundle')->with('success', 'bundle has been updated successfully!');

    }

      public function storeNewProductPackage(Request $request)

    {



        // $request->validate([

        //     'photo'=>'image',

        //     ]);



        $package = new ProductBundleDetail();



        $package->name = $request->name ;

        $package->product_bundle_id = $request->id ;

        //  if ($request->hasFile('photo')) {

        //  $image = $request->file('photo');

        //  $filename = uniqid(). $image->getClientOriginalExtension();

        //  $path = $request->photo->move('images/bundle/', $filename);

        //   $package->photo = $path ;

        //  }



        $package->save();

        return redirect()->back()->with('success', 'A new package has been added successfully!');

    }

      public function editPackage(Request $request)

    {



        // $request->validate([

        //     'photo'=>'image',

        //     ]);



        $package =  ProductBundleDetail::findOrFail($request->id);



        $package->name = $request->name ;



        $package->save();

        return redirect()->back()->with('success', 'A new package has been edited successfully!');

    }

      public function storeNewProduct(Request $request)

    {



        $request->validate([

            'photo'=>'required|image',
            'name'=>'required',

            ]);



        $package = new ProductBundleDetail();



        $package->name = $request->name ;

        $package->product_bundle_id = $request->id ;

         if ($request->hasFile('photo')) {

         $image = $request->file('photo');

         $filename = uniqid(). '.'. $image->getClientOriginalExtension();

         $path = $request->photo->move('images/bundle/', $filename);

          $package->photo = $path ;

         }

        $package->save();

        return redirect()->back()->with('success', 'A new product has been added successfully!');

    }

      public function editSubProductDetail(Request $request)

    {



        $request->validate([

            'photo'=>'image',

            ]);



        $package =  ProductBundleDetail::findOrFail($request->id);

        $package->name = $request->name ;

        // $package->product_bundle_id = $request->product_package_id ;



         if ($request->hasFile('photo')) {

         $image = $request->file('photo');

         $filename = uniqid(). '.'. $image->getClientOriginalExtension();

         $path = $request->photo->move('images/bundle/', $filename);

          $package->photo = $path ;

         }



        $package->save();

        return redirect()->back()->with('success', 'product has been updated successfully!');

    }

     public function viewProductBundle($bundle_id)

    {

          $bundle = ProductBundle::with(['product_bundle_detail', 'levels'])->findOrFail($bundle_id);
        // return $bundle->levels;
        return view('admin.bundle.view', compact('bundle'));

    }

     public function hideProductPackage($product_id)

    {

        $package = ProductBundle::findOrFail($product_id);

        $package->isHide =!($package->isHide);

        $package->save();



        return redirect()->back()->with('success', 'product package status changed successfully!');

    }
    public function productBundles(Request $request)
    {

        $bundles=ProductBundle::where('isHide', false)->get()->sortByDesc('price',SORT_ASC);
        return view('frontend.product.bundles',compact('bundles'));
    }
    public function productBundleDetail($id)
    {

        $bundles=ProductBundle::with('product_bundle_detail','levels')->findOrFail($id);
        return view('frontend.product.bundleDetail',compact('bundles'));
    }
    public function buyNowProductBundle($pid)
    {
        $totalBalance = 0;
        $id = auth()->user()->id;
        $getWithdraw = BundleWithdraw::where('user_id',$id)->where('status', '!=', 'cancelled')->sum('amount');
        $getCircleCommission = BundleCircleCommission::where('user_id',$id)->where('isAssign', true)->where('isActive',true)->sum('amount');
        $getReceivedPoints = BundleSendPoint::where('receiver_id', $id)->sum('points');
        $getSentPoints = BundleSendPoint::where('user_id', $id)->sum('points');
        $getReferralReward = ReferralBundle::where('user_id', $id)->where('isActive', true)->sum('commission');
        $totalBalance = $getCircleCommission + $getReferralReward ;
        $totalBalance = $totalBalance * 90/100 ;
        $totalBalance = ($totalBalance + $getReceivedPoints ) - ($getWithdraw + $getSentPoints) ;
        $totalBalance = $totalBalance - 1000;
        $accounts = BundlePaymerntMethod::where('status', true)->get();
        $bundles=ProductBundle::with('product_bundle_detail','levels')->findOrFail($pid);
        return view('frontend.product.bundleBuyNOw',compact('bundles', 'accounts','totalBalance'));
    }
    public function paymentNowProductBundle(Request $request)  {
        // return $request;
        $request->validate([
            'amount'=> 'required',
            'product_bundle_id_'=> 'required',
            'account_type'=> 'required',
            'image'=> 'image',
        ]);
        $buy_product_bundles = new BuyProductBundle();
        $buy_product_bundles->user_id = auth()->user()->id;
        $bundle = ProductBundle::findOrFail($request->product_bundle_id_);
        $buy_product_bundles->product_bundle_id = $bundle->id;
        $buy_product_bundles->amount = $request->amount;
        $buy_product_bundles->points = $bundle->points;
        $buy_product_bundles->commission = $bundle->commission;
        $buy_product_bundles->level = $bundle->level;

        if ($request->hasFile('image')) {

        $image = $request->file('image');

        $filename = uniqid(). '.'. $image->getClientOriginalExtension();

        $path = $request->image->move('images/payments/', $filename);

            $buy_product_bundles->slip = $path ;
        }
        if($request->refer_by !=''){
            $buy_product_bundles->refer_by = $request->refer_by;
        }else{
            if(!is_null(auth()->user()->refer_by)){

                $buy_product_bundles->refer_by = auth()->user()->refer_by;
            }
        }
        $buy_product_bundles->payment_method = $request->account_type;
        $buy_product_bundles->save();
        if($request->account_type == 'Wallet'){
            $withdraw = new BundleWithdraw();
            $withdraw->user_id = auth()->user()->id;
            $withdraw->buy_product_bundle_id =  $buy_product_bundles->id;
            $withdraw->amount =  $buy_product_bundles->amount;
            $withdraw->status =  'completed';
            $withdraw->message =  'you have paid this amount for the product bundler name : '.$bundle->name ;
            $withdraw->save();
        }
        return redirect()->route('bundles.home')->with('success', 'your payment is in review');

    }
    public function repaymentNowProductBundle(Request $request)  {
        // return $request;
        $request->validate([
            'amount'=> 'required',
            'product_bundle_id_'=> 'required',
            'buy_bundle_product_id'=> 'required',
            'account_type'=> 'required',
            'image'=> 'image',
        ]);
        $buy_product_bundles =  BuyProductBundle::findOrFail($request->buy_bundle_product_id);
        $buy_product_bundles->user_id = auth()->user()->id;
        $bundle = ProductBundle::findOrFail($request->product_bundle_id_);
        $buy_product_bundles->product_bundle_id = $bundle->id;
        $buy_product_bundles->amount = $request->amount;
        $buy_product_bundles->points = $bundle->points;
        $buy_product_bundles->commission = $bundle->commission;
        $buy_product_bundles->level = $bundle->level;

        if ($request->hasFile('image')) {

        $image = $request->file('image');

        $filename = uniqid(). '.'. $image->getClientOriginalExtension();

        $path = $request->image->move('images/payments/', $filename);

            $buy_product_bundles->slip = $path ;
        }
        if($request->refer_by !=''){
            $buy_product_bundles->refer_by = $request->refer_by;
        }else{
            if(!is_null(auth()->user()->refer_by)){

                $buy_product_bundles->refer_by = auth()->user()->refer_by;
            }
        }
        $buy_product_bundles->status ='pending';
        $buy_product_bundles->message ='Your repayment is in review';
        $buy_product_bundles->payment_method = $request->account_type;
        $buy_product_bundles->save();
        return redirect()->route('bundles.home')->with('success', 'your payment is in review');

    }
    public function stoppedReferralEarningPayment(Request $request)  {
        // return $request;
        $request->validate([
            'id'=> 'required',
            'account_type'=> 'required',
            'image'=> 'image',
        ]);
        $checkAlreadyPaid = BundleStoppedPayment::where('stop_bundle_referral_earning_id', $request->id)->first();
        if(!blank($checkAlreadyPaid)){
            return redirect()->route('bundles.home')->with('error', 'you already submitted still is in review');        }
        $buy_product_bundles = new BundleStoppedPayment();
        $buy_product_bundles->user_id = auth()->user()->id;      
        $buy_product_bundles->stop_bundle_referral_earning_id  = $request->id;
        $buy_product_bundles->amount = 2500;       

        if ($request->hasFile('image')) {

        $image = $request->file('image');

        $filename = uniqid(). '.'. $image->getClientOriginalExtension();

        $path = $request->image->move('images/payments/', $filename);

            $buy_product_bundles->slip = $path ;
        }
      
        $buy_product_bundles->status ='pending';
        $buy_product_bundles->message ='Your payment is in review';
        $buy_product_bundles->payment_type = $request->account_type;
        $buy_product_bundles->save();
        return redirect()->route('bundles.home')->with('success', 'your payment is in review');

    }
    public function repaymentProductBundleOrderDetail(Request $request)  {
        $request->validate([
            'image'=>'required|image',
            'city'=> 'required',
            'id'=> 'required',
            'state'=> 'required',
            'phone'=> 'required|min:11|max:11',
            'address'=> 'required',
            'name'=> 'required',
            'delivery_charges'=> 'required',            
            'product_bundle_id'=> 'required',            
            ]);
         
        $package =  OrderProductBundle::findOrFail($request->id);
        $package->user_id = auth()->user()->id ;
        $package->name = $request->name ;
        $package->buy_product_bundle_id = $request->product_bundle_id ;
        // $package->product_bundle_id = $checkAuthorization->product_bundle_id ;
        $package->city = $request->city ;
        $package->status = "pending" ;
        $package->message = "your repayment is in review" ;
        $package->state = $request->state ;
        $package->phone = $request->phone ;
        $package->delivery_charges = $request->delivery_charges ;
        $package->address = $request->address ;
        $package->notes = $request->notes ;
         if ($request->hasFile('image')) {
         $image = $request->file('image');
         $filename = uniqid(). '.'. $image->getClientOriginalExtension();
         $path = $request->image->move('images/bundle/order/slip/', $filename);
         $package->image = $path ;
         }
        $package->save();
        return redirect()->route('bundles.home')->with('success', 'your re-payment is in review');

    }
     public function deleteSubProduct($id)

    {
        $package = ProductBundleDetail::findOrFail($id);
        if (blank($package)) {
            return redirect()->back()->with('error', 'product not found!');

        } else {

            $package->delete();
        }

        return redirect()->back()->with('success', 'product deleted successfully!');

    }
     public function hideSubProductPackage($product_id)

    {

        $package = ProductBundleDetail::findOrFail($product_id);

        $package->isHide =!($package->isHide);

        $package->save();



        return redirect()->back()->with('success', 'sub product status changed successfully!');

    }
    public function checkBundleSponsor(Request $request)
    {
        if($request->ajax()){
            $user = User::where('username', strtolower($request->refer_by) )->first();
            if (!blank($user)) {
                return response()->json(['msg' => true]);
            } else {
                return response()->json(['msg' => false]);
            }
        }

    }
    public function levelCommissionBundle() {
        $levels = BundleLevel::orderBy('level')->get();
        return view('admin.accounts.indexLevelCommission', compact('levels'));
    }
    public function newLevelCommissionBundle(Request $request) {
        $request->validate([
            'level'=>'required',
            'commission'=>'required',
            'product_bundle_id'=>'required',
        ]);
        $new = new BundleLevel();
        $new->level = $request->level;
        $new->product_bundle_id = $request->product_bundle_id;
        $new->commission = $request->commission;
        $new->save();
        return redirect()->back()->with('success', 'new level added');
    }
    public function editLevelCommissionBundle(Request $request) {
        $request->validate([
            'level'=>'required',
            'commission'=>'required',
            'id'=>'required'
        ]);
        $new =  BundleLevel::findOrFail($request->id);
        $new->level = $request->level;
        $new->commission = $request->commission;
        $new->save();
        return redirect()->back()->with('success', ' level updated');
    }
    public function deleteLevelCommissionBundle($id) {

        $new =  BundleLevel::findOrFail($id);

        $new->delete();
        return redirect()->back()->with('success', ' level deleted');
    }

     public function hideProduct($product_id)

    {

        $package = ProductBundleDetail::findOrFail($product_id);

        $package->isHide =!($package->isHide);

        $package->save();

        return redirect()->back()->with('success', 'product status changed successfully!');

    }

     public function hide($bundle_id)

    {

        $package = ProductBundle::findOrFail($bundle_id);

        $package->isHide =!($package->isHide);

        $package->save();

        return redirect()->route('admin.all.bundles.view')->with('success', 'product bundle status updated successfully!');

    }
}

function check_level($user, $level, $subscribed_package = null)
{
    $level = $level;
    $user = $user;
    $user_package_sub = 0;
    $user_package = 0;
    $getLevelCommission = 0;
    $subscribed_package = $subscribed_package;
    if ($level >  ProductBundleController::$packageLevels) {
        return 'bundle level reached';
    }

    if($level == 1 ){
        $getLevelCommission =  $subscribed_package->commission;
    
    }else{
        $getLevelCommission = BundleLevel::where('product_bundle_id', $subscribed_package->product_bundle_id)->where('level', $level)->first();
        $getLevelCommission = $getLevelCommission->commission;
    }

    $refer_by = null;

     // new purchased package
    $newReferrar = new ReferralBundle(); // inserting referal record to reward
    $newUserNotification = new Notification(); // New User Notification
    if(is_null($subscribed_package->refer_by)){
        return 'no sponsor found';
    }
    $directReward = User::where('username', $subscribed_package->refer_by)->first(); // who refer directly


    if (!blank($directReward) ) {
        $user_package_sub = BuyProductBundle::where('user_id', $directReward->id)
            ->where('status', 'approved')
            ->latest()
            ->first(); // check referer package level

            if(!blank($user_package_sub)){

               $user_package = ProductBundle::findOrFail($user_package_sub->product_bundle_id); // max package level
            }else{
                return 'sponsor is not purchased any bundle';
            }
        if ($level <=  ProductBundleController::$packageLevels) {

            //comparing level
            $newReferrar->user_id = $directReward->id; // put refer id
            $newReferrar->user_refer_by = $user_package_sub->refer_by; // who referrer to refer direct
            // who referrer to refer direct
            $newReferrar->level_user_name = $user->username; //
            $newReferrar->product_bundle_id = ProductBundleController::$reward_on_sub; //
            $newReferrar->level_no = $level;
            $newReferrar->refer_product_bundle_id = $user_package_sub->product_bundle_id;
            $newReferrar->points = $user_package->points;
            if ($level == 1) {
                ProductBundleController::$reward_on = $user->username;
                directCircleCommission($directReward->id, $subscribed_package->id);
                $newReferrar->commission =  $subscribed_package->commission;
            }else{

                $newReferrar->commission =  $getLevelCommission;
            }
            $newReferrar->rewardOn = ProductBundleController::$reward_on;

            $checkSponsorApprovedProductBundle = BuyProductBundle::where('user_id', $user_package_sub->user_id)->where('status', 'approved')->first();
            if(!blank($checkSponsorApprovedProductBundle)){
                $newReferrar->isActive = 1;
                if($level > $checkSponsorApprovedProductBundle->level){
                    $newReferrar->isActive = 0;
                }
            }else{
                $newReferrar->isActive = 0;
            }
            if($level > 1){
                $checkStoppedIndirect = checkStoppedIndirect($directReward->id);
                if($checkStoppedIndirect){
                   $newReferrar->isActive = 0;
                }
            }
            $newReferrar->save();
            if($level > 1){
                 checkIndirectEarning($directReward->id, $subscribed_package->id);                
            }


                $newUserNotification->user_id = $directReward->id;
                $newUserNotification->name = 'Junior Product Bundle Commission';
                $newUserNotification->message = 'Congratulations! A Junior Member: ' . $user->username . ' Purchased Product Bundle';
                $newUserNotification->save();

            $level = $level + 1;
            $refer_by =  $newReferrar->user_refer_by; // next level id finder


            if ($refer_by != null) {
                $user = User::where('username', $refer_by)->first();

                if (!blank($user)) {
                    check_level($user, $level, $user_package_sub);
                }
            }
        }
    }
}

function directCircleCommission($id ,$buy_product_bundle_id) {
      $firstDateOfMonth = Carbon::now()->startOfMonth();
      $storeNewCounter = new BundleCircleCounter();
      $storeNewCounter->user_id = $id;
      $storeNewCounter->isActive = true;
      $storeNewCounter->isStop = false;
      $storeNewCounter->buy_product_bundle_id = $buy_product_bundle_id;
      $storeNewCounter->save();

      $getCircleCounter = BundleCircleCounter::where('user_id', $id)->where('isActive', true)->whereDate('updated_at','>=', $firstDateOfMonth)->count();
      
        if ($getCircleCounter > 0 ) {
            if ($getCircleCounter % 10  == 0) {
                $new = new BundleCircleCommission();
                $new->user_id = $id;
                $new->bundle_circle_counter_id = $storeNewCounter->id;
                $new->isActive = true;
                $new->isStop = false;
                $new->isAssign = false;
                $new->amount = 10000;
                $new->save();
            }
        }
      
}
function checkStoppedIndirect($id){
    $getLastStoppedIndirectAmount = StopBundleReferralEarning::where('user_id', $id)->where('isStopped', true)->latest()->first();   
    if(blank($getLastStoppedIndirectAmount)){
        return false;
    }else{
        return true;
    }
}
function checkIndirectEarning($id,$buy_product_bundle_id){
    $getLastStoppedIndirectAmount = StopBundleReferralEarning::where('user_id', $id)->latest()->first();   
    $indirectReferralAmount = ReferralBundle::where('user_id', $id)->where('isActive', true)->where('level_no', '!=','1')->sum('commission');
        if ($indirectReferralAmount > 0 ) {
            if ((blank($getLastStoppedIndirectAmount) && $indirectReferralAmount >= 50000)) {
                $new = new StopBundleReferralEarning();
                $new->user_id = $id;
                $new->buy_product_bundle_id = $buy_product_bundle_id;
                $new->onStop = $indirectReferralAmount;
                $new->isStopped = true;
                $new->save();
                $getUser = User::findOrFail($id);
                $getUser->isStopped = true;
                $getUser->stop_bundle_referral_earning_id = $new->id;
                $getUser->save();
            }
            $getLastStoppedIndirectAmount = $getLastStoppedIndirectAmount->onStop + 50000;
            if($indirectReferralAmount >= $getLastStoppedIndirectAmount ){
                $new = new StopBundleReferralEarning();
                $new->user_id = $id;
                $new->buy_product_bundle_id = $buy_product_bundle_id;
                $new->onStop = $indirectReferralAmount;
                $new->isStopped = true;
                $new->save();
                $getUser = User::findOrFail($id);
                $getUser->isStopped = true;
                $getUser->stop_bundle_referral_earning_id = $new->id;
                $getUser->save();
            }
        }
    }