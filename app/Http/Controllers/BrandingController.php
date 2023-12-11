<?php

namespace App\Http\Controllers;

use App\Models\Branding;
use App\Models\BrandingPaymentType;
use App\Models\BrandingWithdraw;
use App\Models\Category;
use App\Models\OrderDetail;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BrandingController extends Controller
{
    public function deleteWithdrawBrandingPayment($id)  {
        $brandingWithdraw = BrandingWithdraw::findOrFail($id);
        $brandingWithdraw->delete();
        return redirect()->back()->with('success', 'branding withdraw has been deleted successful!');
    }
    public function withdrawBrandingPayment(Request $request) {
        $id = $request->branding_id;
        if ($request->amount < 5000) {
            return redirect()->back()->with('error', 'amount must be Rs.5000 or greater ');
        }
        $branding = Branding::findOrFail($id);
        $checkBrandingWithdraw = BrandingPaymentType::where('branding_id', $branding->id)->first();
        $brandingWithdraws = BrandingWithdraw::where('branding_id',$branding->id)->latest()->get();
        $nextWithdraw = false;

        if (!blank($branding)) {
            $products = Product::where('branding_id', $branding->id)->latest()->get();
            $orderDetails = OrderDetail::whereIn('product_id', $products->pluck('id'))->get();
        }
        $getLast15Days = Carbon::now()->startOfDay()->subDays(15);
        $totalSales = $orderDetails->where('status', 'delivered')->sum('amount') - $brandingWithdraws->where('status', 'completed')->sum('amount');

        $getLast15DayWithdraw = BrandingWithdraw::where('branding_id', $branding->id)->where('status', 'completed')->whereDate('updated_at', '>=', $getLast15Days)->sum('amount');
        $checkFirstWithdraw = BrandingWithdraw::where('branding_id', $branding->id)->get();
        $getTotalWithdrawAmount = BrandingWithdraw::where('branding_id', $id)->where('status', 'completed')->sum('amount');
        $checkAfterWithdrawAmountRemaining = $totalSales - $request->amount;
        if (blank($getLast15DayWithdraw)) {
            if($totalSales > 5000){
                $nextWithdraw = true;
            }
        }
        if (blank($checkFirstWithdraw)) {
            if($totalSales > 5000){
                $nextWithdraw = true;
            }
        }
        if($nextWithdraw){
            if(blank($checkBrandingWithdraw)){
                return redirect()->back()->with('error', 'please add payment method first');
            }else{
                if ($checkAfterWithdrawAmountRemaining >=0) {
                    $newBrandingWithdraw = new BrandingWithdraw();
                    $newBrandingWithdraw->branding_id = $checkBrandingWithdraw->id;
                    $newBrandingWithdraw->account_title = $checkBrandingWithdraw->account_title ;
                    $newBrandingWithdraw->account_no = $checkBrandingWithdraw->account_no ;
                    $newBrandingWithdraw->amount = $request->amount ;
                    $newBrandingWithdraw->payment_type = $checkBrandingWithdraw->payment_type ;
                    $newBrandingWithdraw->bank_name = $checkBrandingWithdraw->bank_name ;
                    $newBrandingWithdraw->status = 'completed' ;
                    $newBrandingWithdraw->message = 'Withdraws has been completed successful!';
                    $newBrandingWithdraw->save();
                    return redirect()->back()->with('success', 'withdraw has been completed successful');
                }
            }

        }else{
            return redirect()->back()->with('error', 'you can not withdraw due to Days limit or amount less than 5000');
        }
        return $request;
    }
    public function updateWithdrawBrandingPayment(Request $request) {
        $newBrandingWithdraw =  BrandingWithdraw::findOrFail($request->id);
        $newBrandingWithdraw->account_title = $request->account_title ;
        $newBrandingWithdraw->account_no = $request->account_no ;
        $newBrandingWithdraw->amount = $request->amount ;
        $newBrandingWithdraw->payment_type = $request->payment_type ;
        $newBrandingWithdraw->bank_name = $request->bank_name ;
        $newBrandingWithdraw->status = 'completed' ;
        $newBrandingWithdraw->message = 'Withdraws has been updated successful!';
        $newBrandingWithdraw->save();
        return redirect()->back()->with('success', 'withdraw has been updated successful');
    }

    public function addBrandingPaymentType(Request $request) {
        $request->validate([
            'branding_id' => 'required',
        ]);
        $brandingWithdraw = new BrandingPaymentType();
        $brandingWithdraw->branding_id = $request->branding_id;
        $brandingWithdraw->account_title = $request->account_title;
        $brandingWithdraw->account_no = $request->account_no;
        $brandingWithdraw->payment_type = $request->payment_type;
        $brandingWithdraw->bank_name = $request->bank_name;
        $brandingWithdraw->save();
        return redirect()->back()->with('success', 'payment method added');
    }
    public function createNewProduct() {
        $branding = Branding::get();
        $category = Category::get();
        return view('admin.branding.createNewProduct', compact('branding','category'));
    }
    public function view($id) {
        $branding = Branding::findOrFail($id);
        $checkBrandingWithdraw = BrandingPaymentType::where('branding_id', $branding->id)->first();
        $brandingWithdraws = BrandingWithdraw::where('branding_id',$branding->id)->latest()->get();
        $nextWithdraw = false;

        if (!blank($branding)) {
            $products = Product::where('branding_id', $branding->id)->latest()->get();
            $orderDetails = OrderDetail::whereIn('product_id', $products->pluck('id'))->get();
        }
        $getLast15Days = Carbon::now()->startOfDay()->subDays(15);
        $totalSales = $orderDetails->where('status', 'delivered')->sum('amount') - $brandingWithdraws->where('status', 'completed')->sum('amount');
        $getLast15DayWithdraw = 0;
        $getLast15DayWithdraw = BrandingWithdraw::where('branding_id', $branding->id)->where('status', 'completed')->whereDate('updated_at', '>=', $getLast15DayWithdraw)->sum('amount');
        $checkFirstWithdraw = BrandingWithdraw::where('branding_id', $branding->id)->get();
        if (blank($getLast15DayWithdraw)) {
            if($totalSales > 5000){
                $nextWithdraw = true;
            }
        }
        if (blank($checkFirstWithdraw)) {
            if($totalSales > 5000){
                $nextWithdraw = true;
            }
        }

        return view('admin.branding.view', compact('nextWithdraw','branding', 'products', 'orderDetails','brandingWithdraws','checkBrandingWithdraw'));
    }
    public function create() {
        return view('admin.branding.create');
    }
    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
        ]);
        $branding = new Branding();
        $branding->name = $request->name;
        $branding->phone = $request->phone;
        $branding->email = $request->email;
        $branding->address = $request->address;
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/branding'), $filename);
            $branding['image'] = 'images/branding/' . $filename;
        }
        $branding->save();
        return back()->with('success', 'Branding added');
    }
    public function update(Request $request) {
        $request->validate([
            'name' => 'required',
        ]);
        $branding = Branding::findOrFail($request->id);
        $branding->name = $request->name;
        $branding->phone = $request->phone;
        $branding->email = $request->email;
        $branding->address = $request->address;
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/branding'), $filename);
            $branding['image'] = 'images/branding/' . $filename;
        }
        $branding->save();
        return back()->with('success', 'Branding updated');
    }
    public function index()
    {
        $categories = Branding::get();
        return view('admin.branding.index', compact('categories'));
    }
    public function edit($id)
    {
        $branding = Branding::findOrFail($id);
        return view('admin.branding.edit', compact('branding'));
    }
    public function storeNewProduct( Request $request) {
        $request->validate([
            'name' => 'required',
            'category' => 'required|exists:categories,id',
            'branding' => 'required|exists:brandings,id',
            'images' => 'required|array',
            'images.*' => 'image',
            'price' => 'required',
            'purchased_price' => 'required',

            'image' => 'required',

            'delivery_days' => 'required',
            'delivery_charges' => 'required',
            'info' => 'required',
            'detail' => 'required',
        ]);
        // return $request;
        $product=new Product();
        $product->name=$request->name;
        if($request->offer!='')
        {
            $product->offer=$request->offer;
        }
        if($request->offer!='')
        {
            $product->deal=$request->deal;
        }
        $product->user_id='58';
        $product->status='accepted';
        $product->isActive=true;
        $product->category_id=$request->category;
        $product->branding_id=$request->branding;
        if (is_null($request->discount_price)) {
            $product->discount_price=$request->price;
        }else{
            $product->discount_price=$request->discount_price;
        }
        $product->purchased_price=$request->purchased_price;
        $product->price=$request->price;
        $product->delivery_charges=$request->delivery_charges;
        $product->delivery_days=$request->delivery_days;
        $product->info=$request->info;
        $product->detail=$request->detail;
        if($request->hasfile('images'))
        {
           foreach($request->file('images') as $file)
           {
               $filename = uniqid().'.'. $file->getClientOriginalExtension();
               $file->move(public_path('images/product'), $filename);
               $data[] ='images/product/'. $filename;
           }
           $product->images=json_encode($data);
        }
        if($request->hasfile('image'))
        {
           $file = $request->image;

               $filename = uniqid().'.'. $file->getClientOriginalExtension();
               $file->move(public_path('images/product'), $filename);
               $data ='images/product/'. $filename;

                $product->image=$data;
        }
        $product->save();
        return back()->with('success','product added');
    }

}
