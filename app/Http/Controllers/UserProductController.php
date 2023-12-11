<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Product,Category,Notification, Shop};
class UserProductController extends Controller
{
    public function shop(Request $request)
    {
        $min=(int)$request->min_price;
        $max=(int)$request->max_price;
        $sort=$request->sort;
        // return gettype($sort);
        // return $request;

        if($sort=='lowToHigh')
        {
            $products=Product::where('status', 'accepted')->where('isActive', true)->filterPriceBetween($min,$max)->filterName($request->name)->get()->sortBy('discount_price',SORT_ASC);
            return view('frontend.product.all_products',compact('products'));

        }
        $products=Product::where('status', 'accepted')->where('isActive', true)->filterPriceBetween($min,$max)->filterName($request->name)->get()->sortByDesc('discount_price',SORT_DESC);
        return view('frontend.product.all_products',compact('products'));
        // return 'shop';
        // if($user_id)
        // {
        //     $products=Product::where('user_id',$user_id)->where('status','accepted')->get();
        // }else
        // {
        //     $products=Product::where('user_id',$user_id)->get();
        // }
        // return view('frontend.userProduct.shop',compact('products'));
    }
    public function create()
    {
        $shop = Shop::where('user_id', auth()->user()->id)->where('status',  'approved')->first();
        if(blank($shop)){
            return redirect()->back()->with('error', "you don't have active shop");
        }
        $categories=Category::get();
        return view('frontend.product.create',compact('categories', 'shop'));
    }
    public function store(Request $request)
    {
        // return 'testing';
        // return $request;
        $user=Auth()->user();
         $request->validate([
            'name' => 'required',
            'image' => 'required|image',
            'category' => 'required|exists:categories,id',
            'images' => 'required|array',
            'images.*' => 'image',
            'price' => 'required',
            'discount_price' => 'required',
            'delivery_days' => 'required',
            'delivery_charges' => 'required',
            'info' => 'required',
            'detail' => 'required',
        ]);
        // return $request;
        $product=new Product();
        $product->name=$request->name;
        $product->quantity=$request->quantity;
        if($request->offer!='')
        {
            $product->offer=$request->offer;
        }
        if($request->isAllowedMegaSale!= null)
        {
            $product->isMegaSale=$request->isAllowedMegaSale;
        }
        if($request->offer!='')
        {
            $product->deal=$request->deal;
        }
        $product->category_id=$request->category;
        $product->user_id=$user->id;
        $product->status='pending';
        $product->isActive=false;
        $product->message='your product is in process we will contact you soon';
        $product->discount_price=$request->discount_price;
        $product->price=$request->price;
        $product->delivery_charges=$request->delivery_charges;
        $product->delivery_days=$request->delivery_days;
        $product->info=$request->info;
        $product->detail=$request->detail;
        if($request->hasfile('image'))
        {

               $filename = uniqid().'.'. ($request->image)->getClientOriginalExtension();
               ($request->image)->move(public_path('images/product'), $filename);
               $image ='images/product/'. $filename;

           $product->image=$image;
        }
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
        //  $product;
        $product->save();
        $notification=new Notification;
        $notification->user_id=$user->id;
        $notification->is_admin=1;
        $notification->name="New Product";
        $notification->message="New Product has been added by $user->username";
        //return   $notification;
        $notification->save();
        return redirect()->route('shopDetails')->with('success','product added');
    }
}
