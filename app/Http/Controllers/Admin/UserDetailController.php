<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use App\Models\Notification;
use App\Models\User;
use App\Models\Order;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use App\Models\CircleCommission;
use Illuminate\Support\Facades\Hash;
use App\Mail\BlockUserMail;
use App\Models\CircleCounter;
use App\Models\Follower;
use App\Models\OrderDetail;
use App\Models\PaymentGateway;
use App\Models\PaymentType;
use App\Models\Product;
use App\Models\Rating;
use App\Models\ReferralCommission;
use App\Models\ReturnDetail;
use App\Models\Share;
use App\Models\Shop;
use App\Models\ShopOrder;
use App\Models\TrackOrder;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Mail;
use DB;

class UserDetailController extends Controller
{
    public function changePaymentGateway($id)
    {
        $accounts = PaymentGateway::findOrFail($id);
        $accounts->isHide = !($accounts->isHide);
        $accounts->save();
        return redirect()->back()->with('success', 'status changed successful!');
    }
    public function paymentGateway()
    {
        $accounts = PaymentGateway::get();
        return view('admin.accounts.method', compact('accounts'));
    }
    public function adminDeleteUser(Request $request)
    {
        set_time_limit(0);
        $user = User::findOrFail($request->id);
        if ($user->username == $request->username) {
            $rcommission = ReferralCommission::where('user_id', $user->id)->get();
            if (!blank($rcommission)) {
                foreach ($rcommission as $key => $rc) {
                    $rc->delete();
                }
            }

            $follower = Follower::where('user_id', $user->id)->get();
            if (!blank($follower)) {
                foreach ($follower as $key => $follo) {
                    $follo->delete();
                }
            }

            $notification = Notification::where('user_id', $user->id)->get();
            if (!blank($notification)) {
                foreach ($notification as $key => $noti) {
                    $noti->delete();
                }
            }

            $paymenttype = PaymentType::where('user_id', $user->id)->get();
            if (!blank($paymenttype)) {
                foreach ($paymenttype as $key => $pt) {
                    $pt->delete();
                }
            }


            $ratting = Rating::where('user_id', $user->id)->get();
            if (!blank($ratting)) {
                foreach ($ratting as $key => $r) {
                    $r->delete();
                }
            }

            $shares = Share::where('user_id', $user->id)->get();
            if (!blank($shares)) {
                foreach ($shares as $key => $shar) {
                    $shar->delete();
                }
            }

            $whishlist = Wishlist::where('user_id', $user->id)->get();
            if (!blank($whishlist)) {
                foreach ($whishlist as $key => $wish) {
                    $wish->delete();
                }
            }
            $withdraw = Withdraw::where('user_id', $user->id)->get();
            if (!blank($withdraw)) {
                foreach ($withdraw as $key => $w) {
                    $w->delete();
                }
            }

            $order = Order::where('user_id', $user->id)->get();
            if (!blank($order)) {
                foreach ($order as $key => $item) {
                    $orderDetails = OrderDetail::where('order_id', $item->id);
                    if (!blank($orderDetails)) {
                        foreach ($orderDetails as $key => $od) {
                            $shopOrder = ShopOrder::where('user_id', $user->id)->get();
                            if (!blank($shopOrder)) {
                                foreach ($shopOrder as $key => $so) {
                                    $so->delete();
                                }
                            }
                            $yourShopOrder = ShopOrder::where('shop_id', $user->id)->get();
                            if (!blank($yourShopOrder)) {
                                foreach ($yourShopOrder as $key => $yso) {
                                    $yso->delete();
                                }
                            }
                            $od->delete();
                        }
                    }
                    $returnDetail = ReturnDetail::where('order_id', $item->id)->get();
                    if (!blank($returnDetail)) {
                        foreach ($returnDetail as $key => $returnDet) {
                            $returnDet->delete();
                        }
                    }
                    $trackOrder = TrackOrder::where('order_id', $item->id)->get();
                    if (!blank($trackOrder)) {
                        foreach ($trackOrder as $key => $to) {
                            $to->delete();
                        }
                    }
                    $item->delete();
                }
            }
            $products = Product::where('user_id', $user->id)->get();
            if (!blank($products)) {
                foreach ($products as $key => $pr) {
                    $pr->delete();
                }
            }
            $shop = Shop::where('user_id', $user->id)->first();
            if (!blank($shop)) {
                $shop->delete();
            }
            $cc = CircleCommission::where('user_id', $user->id)->get();
            if (!blank($cc)) {
                foreach ($cc as $key => $circleCom) {
                    $circleCom->delete();
                }
            }
            $ccounter = CircleCounter::where('user_id', $user->id)->get();
            if (!blank($ccounter)) {
                foreach ($ccounter as $key => $circleCount) {
                    $circleCount->delete();
                }
            }
            $commission = Commission::where('user_id', $user->id)->get();
            if (!blank($commission)) {
                foreach ($commission as $key => $cmn) {
                    $cmn->delete();
                }
            }
            $user->forceDelete();
            return redirect('admin/dashboard')->with('success', $request->username . ' deleted successful!');
        } else {
            return redirect()->back()->with('error', 'you entered wrong username');
        }
    }
    public function userWithdraw($id)
    {
        $user = User::findOrFail($id);
        $withdraw = Withdraw::where('user_id', $user->id)->latest()->get();
        return view('admin.user.userWithdraw', compact('withdraw', 'user'));
    }
    public function userSaleCommission($id)
    {
        $user = User::findOrFail($id);
        $sale_commission = CircleCommission::where('user_id', $user->id)->latest()->get();
        return view('admin.user.userSaleCommission', compact('sale_commission', 'user'));
    }
    public function userCommission($id)
    {
        $user = User::findOrFail($id);
        $commission = Commission::where('user_id', $user->id)->latest()->get();
        return view('admin.user.userCommission', compact('commission', 'user'));
    }
    public function userReferralCommission($id)
    {
        $user = User::findOrFail($id);
        $referralCom = ReferralCommission::where('user_id', $user->id)->latest()->get();
        return view('admin.user.referralCommission', compact('referralCom','user'));
    }
    public function userReferralTeam($id)
    {
        $user = User::findOrFail($id);
        $referrals = User::where('refer_by', $user->username)->get();
        return view('admin.user.referralTeam', compact('referrals'));
    }
    public function userOrders($id)
    {
        $orders = Order::with(['order_detail', 'user'])->where('user_id', $id)->latest()->get();
        return view('admin.user.order', compact('orders'));
    }
    public function userPersonalDetail($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.profile', compact('user'));
    }
    public function search_data(Request $request)
    {


        $output = "";
        $search = trim($request->search);
        if ($search != '') {
                $users= DB::table('users')->orWhere('username', 'LIKE', '%' . $search . "%")->orWhere('name', 'LIKE', '%' . $search . "%")
                ->orWhere('phone', 'LIKE', '%' . $search . "%")
                ->orWhere('business', 'LIKE', '%' . $search . "%")
                ->orWhere('created_at', 'LIKE', '%' . $search . "%")
                ->orWhere('email', 'LIKE', '%' . $search . "%")->get();

               $products = DB::table('products')->where('name', 'LIKE', '%'.$search . '%')->get();
               if (!blank($products)) {
                foreach ($products as $key => $product) {

                    $url = route('admin.product.show', $product->id);
                    $output .= '<a href="' . $url . '" id="searc_user_id">' . $product->name . ' </a> <br>';
                }
                 }

               $branding = DB::table('brandings')->where('name', 'LIKE', '%'.$search . '%')->get();
               if (!blank($branding)) {
                foreach ($branding as $key => $product) {
                    $url = route('admin.branding.view', $product->id);
                    $output .= '<a href="' . $url . '" id="searc_user_id">' . $product->name . ' </a> <br>';
                }
               }

            if (!blank($users)) {
                foreach ($users as $key => $product) {
                    $url = route('admin.user.detail', ['user' => $product->id]);
                    $output .= '<a href="' . $url . '" id="searc_user_id">' . $product->business . ' ' . $product->username . '  ' . $product->name . ' ' . $product->email . '</a> <br>';
                }
            }
            if(blank($output)){
                $output = '<h1 class="text-white" >  No Data Found</h1>';
                return Response($output);
            }else{

                return Response($output);
            }
        } else {
            $output = '<h1 class="text-white" >  No Data Found</h1>';
            return Response($output);
        }
    }
    public function userDetails($user)
    {


        $user = User::findOrFail($user);
        $shop = Shop::where('user_id', $user->id)->latest()->first();
        $referralCom = ReferralCommission::where('user_id', $user->id)->latest()->get();
        $commission = Commission::where('user_id', $user->id)->latest()->get();
        $commission_count = Commission::where('user_id', $user->id)->where('isAssign', true)->sum('amount');
        $sale_commission = CircleCommission::where('user_id', $user->id)->latest()->get();
        $sale_commission_count = CircleCommission::where('user_id', $user->id)->where('isAssign', true)->sum('amount');
        $withdraw = Withdraw::where('user_id', $user->id)->latest()->get();
        $withdraw_count = Withdraw::where('user_id', $user->id)->where('status', 'completed')->sum('amount');
        $withdraw_pending = Withdraw::where('user_id', $user->id)->where('status', 'pending')->sum('amount');
        $orders = Order::with(['order_detail', 'user'])->where('user_id', $user->id)->latest()->get();
        $referrals = User::where('refer_by', $user->username)->get();
        return view('admin.user.detail', compact('shop', 'referralCom', 'orders', 'referrals', 'user', 'commission', 'commission_count', 'withdraw_pending', 'withdraw_count', 'withdraw', 'sale_commission', 'sale_commission_count'));
    }
    public function usersBonus()
    {

        $commissions = Commission::with('user')->where('name', 'ten orders bonus')->latest()->get();
        return view('admin.user.bonus', compact('commissions'));
    }
    public function deleted_at($user_id)
    {
        $user = User::withTrashed()->findOrFail($user_id);
        if ($user->deleted_at) {
            $user->restore();
            return back()->with('success', 'User Un-blocked.');
        }
        $user->delete();
        Mail::to($user->email)->send(new BlockUserMail($user));
        return back()->with('success', 'User blocked. Email sent to user');
    }
    public function changeUserPassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required',
        ]);
        $user = User::findOrFail($id);
        $user->password = Hash::make($request->password);
        $user->save();
        return back()->with('success', 'User Password Changed!');
    }

    public function user(Request $request)
    {
        $users = User::withTrashed()->filterName($request->name)->get();
        return view('admin.user.index', compact('users'));
    }
    public function checkUsername(Request $request)
    {
        $data = $request->data;
        $user = User::where('username', $data)->first();
        if (blank($user)) {
            return response()->json(['yes' => true]);
        } else {
            return response()->json(['yes' => false]);
        }
    }
    public function checkPhone(Request $request)
    {
        $data = $request->data;
        $user = User::where('phone', $data)->first();
        if (blank($user)) {
            return response()->json(['yes' => true]);
        } else {
            return response()->json(['yes' => false]);
        }
    }
    public function checkEmail(Request $request)
    {
        $data = $request->data;
        $user = User::where('email', $data)->first();
        if (blank($user)) {
            return response()->json(['yes' => true]);
        } else {
            return response()->json(['yes' => false]);
        }
    }
    public function updateUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'business' => "required",
        ]);
        $user = User::find($request->user_id);
        $name = $request->name;
        $business = $request->business;
        $user->name = $name;
        if ($business) {
            $user->business = $business;
        }
        $user->save();
        return back()->with('success', 'Updated');
    }
    public function updateUsername(Request $request)
    {
        // return $request;
        $user = User::findOrFail($request->user_id);
        $user->username = $request->username;
        $user->save();
        return back()->with('success', 'Updated');
    }
    public function updatePhone(Request $request)
    {
        // return $request;
        $user = User::findOrFail($request->user_id);
        $user->phone = $request->phone;
        $user->save();
        return back()->with('success', 'Updated');
    }
    public function updateEmail(Request $request)
    {
        // return $request;
        $user = User::findOrFail($request->user_id);
        $user->email = $request->email;
        $user->save();
        return back()->with('success', 'Updated');
    }
    public function addCommission(Request $request)
    {
        // return $request;
        $user = User::findOrFail($request->user_id);
        $comm = new Commission();
        $comm->user_id = $user->id;
        $comm->amount = $request->amount;
        $comm->name = $request->name;
        $comm->isAssign = true;
        $comm->save();
        $noti = new Notification();
        $noti->user_id = $user->id;
        $noti->name = $request->name;
        $noti->message = $request->name . ' Commission Has been rewarded you !';
        $noti->save();
        return redirect()->back()->with('success', 'commission has been added');
    }
    public function changeCommission(Request $request)
    {
        // return $request;
        $user = User::findOrFail($request->user_id);
        $comm = Commission::findOrFail($request->id);
        $comm->user_id = $user->id;
        $comm->amount = $request->amount;
        $comm->name = $request->name;
        $comm->isAssign = $request->isAssign;
        $comm->save();
        $noti = new Notification();
        $noti->user_id = $user->id;
        $noti->name = $request->name;
        $noti->message = $request->message;
        $noti->save();
        return redirect()->back()->with('success', 'commission has been updated');
    }
    public function changeReferralCommission(Request $request)
    {
        // return $request;
        $user = User::findOrFail($request->user_id);
        $comm = ReferralCommission::findOrFail($request->id);
        $comm->amount = $request->amount;
        $comm->updateMessage = $request->message;
        $comm->isAssign = $request->isAssign;
        $comm->save();
        $noti = new Notification();
        $noti->user_id = $user->id;
        $noti->name = 'Sponsor Referral Commission';
        $noti->message = $request->message;
        $noti->save();
        return redirect()->back()->with('success', 'refferral commission has been updated');
    }
    public function changeCircleCommission(Request $request)
    {
        // return $request;
        $user = User::findOrFail($request->user_id);
        $comm = CircleCommission::findOrFail($request->id);
        $comm->user_id = $user->id;
        $comm->amount = $request->amount;
        $comm->name = $request->name;
        $comm->isAssign = $request->isAssign;
        $comm->save();
        $noti = new Notification();
        $noti->user_id = $user->id;
        $noti->name = $request->name;
        $noti->message = $request->message;
        $noti->save();
        return redirect()->back()->with('success', 'Sale commission has been updated');
    }
    public function deleteCommission($commission)
    {
        // return $request;
        $comm = Commission::findOrFail($commission);

        $noti = new Notification();
        $noti->user_id = $comm->user_id;
        $noti->name = 'Delete Commission';
        $noti->message =  'Your Commission Has been deleted  !';
        $noti->save();
        $comm->delete();
        return redirect()->back()->with('success', 'commission has been deleted');
    }
    public function deleteReferralCommission($commission)
    {
        // return $request;
        $comm = ReferralCommission::findOrFail($commission);

        $noti = new Notification();
        $noti->user_id = $comm->user_id;
        $noti->name = 'Delete Commission';
        $noti->message =  'Your Referral Commission Has been deleted  !';
        $noti->save();
        $comm->delete();
        return redirect()->back()->with('success', 'referral commission has been deleted');
    }
    public function deleteCircleCommission($commission)
    {
        // return $request;
        $comm = CircleCommission::findOrFail($commission);

        $noti = new Notification();
        $noti->user_id = $comm->user_id;
        $noti->name = 'Delete Commission';
        $noti->message =  'Your Sale Commission Has been deleted  !';
        $noti->save();
        $comm->delete();
        return redirect()->back()->with('success', 'sale commission has been deleted');
    }
}
