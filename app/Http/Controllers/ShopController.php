<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Commission;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ReferralCommission;
use App\Models\Shop;
use App\Models\ShopOrder;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function setAllProductDeliveryCharges(Request $request) {
        $user = auth()->user()->id;
        $shop = Shop::where('user_id', $user)->first();
        $products = Product::where('user_id', $shop->user_id)->get();
        if(!blank($products)){
            foreach ($products as $pro) {
              $pro->delivery_charges = $request->delivery_charges;
              $pro->save();
            }
        }
        return redirect()->back()->with('success', 'Delivery Charges updated');
    }
    public function changeShopOrderStatus(Request $request){
        // return $request;
        $request->validate([
            'id' => 'required',
            'message' => 'required',
        ]);
        $id = (int) $request->id;
        $user_id = auth()->user()->id;
        $order = ShopOrder::where('shop_id', $user_id)->where('id', $id)->first();
        $order_details = OrderDetail::where('shop_order_id', $order->id)->get();
        $commissions = Commission::whereIn('order_id',$order_details->pluck('id')->all())->get();
        $referralCommission = ReferralCommission::whereIn('rewardOn', $order_details->pluck('id')->all())->get();
        if($request->status == 'delivered'){
            if(!blank($order_details)){
                foreach($order_details as $od){
                    if($od->status == 'delivered'){
                        $com = Commission::where('order_id', $od->id)->where('status', 'delivered')->first();
                        if(!blank($com)){
                            $com->isAssign = true;
                            $com->status ='clear';
                            $com->save();
                        }
                        $rc = ReferralCommission::where('rewardOn', $od->id)->first();
                        if(!blank($rc)){
                            $rc->isAssign = true;
                            $rc->updateMessage = $request->message;
                            $rc->save();
                        }
                    }
                }
            }
        }
        if(!blank($order)){
            $order->status = $request->status;
            $order->message = $request->message;
            $order->changed_status = 'Seller';
            $order->save();
            if($request->status == 'cancelled'){
                if(!blank( $referralCommission)){
                    foreach( $referralCommission as $rc){
                        $rc->isAssign = false;
                        $rc->updateMessage = $request->message;
                        $rc->save();
                    }
                }
                if(!blank($commissions)){

                    foreach($commissions as $commission){
                        $commission->isAssign = false;
                        $commission->status ='pending';
                        $commission->save();
                    }
                }
                if(!blank($order_details)){

                    foreach($order_details as $dt){
                      $dt->status = 'cancelled';
                      $dt->changed_status = 'Seller';
                      $dt->message = $request->message;
                      $dt->save();
                    }
                }
            }
        }else{
            return redirect()->back()->with('error', 'you are not authorized to change this item status');
        }
        return redirect()->back()->with('success', 'status has been changed successful!');
    }
    public function changeOrderStatus(Request $request){
        // return $request;
        $request->validate([
            'id' => 'required',
            'message' => 'required',
        ]);
        $id = (int) $request->id;
        $user_id = auth()->user()->id;
        $order = OrderDetail::where('shop_id', $user_id)->where('id', $id)->first();
        $commission = Commission::where('order_id',$order->id)->first();
        if($request->status == 'delivered'){
            if(!blank($commission)){
                $commission->isAssign = true;
                $commission->status ='clear';
                $commission->save();
            }
        }else{
            if(!blank($commission)){
                $commission->isAssign = false;
                $commission->status ='pending';
                $commission->save();
            }
        }
        if(!blank($order)){
            $order->status = $request->status;
            $order->message = $request->message;
            $order->changed_status = 'Seller';
            $order->save();
        }else{
            return redirect()->back()->with('error', 'you are not authorized to change this item status');
        }
        return redirect()->back()->with('success', 'status has been changed successful!');
    }
    public function shopDetails(){
        $shop = Shop::where('user_id', auth()->user()->id)->first();
        $shop_orders = ShopOrder::with(['orders', 'orders.order_details'])->where('shop_id', $shop->user_id)->latest()->get();
        // $shop_orders = OrderDetail::with('order')->where('shop_id', $shop->user_id)->latest()->get();
        return view('user.shop.index', compact('shop', 'shop_orders'));
    }
    public function deleteUserProduct($product){


        $products = Product::where('user_id', auth()->user()->id)->where('id', $product)->first();
        if(!blank($products)){
            $products->delete();
            return redirect()->back()->with('success', 'your product has been deleted!');
        }else{
            return redirect()->back()->with('error', 'your not authorized to delete this product!');

        }
        return redirect()->back();
    }
    public function deleteProductImage($product,$image){

        $data = array();
        $products = Product::where('user_id', auth()->user()->id)->where('id', $product)->first();
        if(!blank($products)){
            if(!blank($products->images)){
                foreach(json_decode($products->images) as $img){
                    if("images/product/".$image == $img ){
                        if (file_exists($img)){
                            unlink($img);
                        }
                    }else{
                        $data[] = $img;
                    }

                }
            }

            $products->images = $data;
            $products->save();
            return redirect()->back()->with('success', 'your product image deleted!');
        }else{
            return redirect()->back()->with('error', 'you are not authorized to delete this image !');

        }
        return redirect()->back();
    }
    public function editUserProduct($product){
        $categories = Category::latest()->get();
        $products = Product::with('category')->where('user_id', auth()->user()->id)->where('id', $product)->first();
        $shop = Shop::where('user_id', auth()->user()->id)->first();
        if(!blank($products)){

            return view('user.shop.editProduct', compact('products', 'categories', 'shop'));
            // return redirect()->back()->with('success', 'your product has been deleted!');
        }else{
            return redirect()->back()->with('error', 'your not authorized to edit this product!');

        }
        return redirect()->back();
    }
    public function userChangeMegaSale($product){

        $products = Product::with('category')->where('user_id', auth()->user()->id)->where('id', $product)->first();
        $shop = Shop::where('user_id', auth()->user()->id)->first();
        if(!blank($products) && !blank($shop) ){
            if($shop->user_id == $products->user_id){
                $products->isMegaSale = !($products->isMegaSale);
                $products->save();
                return redirect()->back()->with('success', 'Mega Sale Status Updated!');
            }else{
                return redirect()->back()->with('error', 'your not authorized to edit this product!');
            }

        }else{
            return redirect()->back()->with('error', 'your not authorized to edit this product!');

        }
        return redirect()->back();
    }
    public function userUploadedProducts($product){
        $shop = Shop::where('user_id', auth()->user()->id)->first();
        $products = Product::with('category')->where('user_id', auth()->user()->id)->where('status', $product)->latest()->get();
        return view('user.shop.products', compact('shop', 'products', 'product'));
    }
    public function userAllProducts (){

        $shop = Shop::where('user_id', auth()->user()->id)->first();
        $product= 'All Products';
        $products = Product::with('category')->where('user_id', auth()->user()->id)->latest()->get();
        return view('user.shop.products', compact('shop', 'products', 'product'));
    }
    public function newShopRequest(){
        $findShop = Shop::where('user_id', auth()->user()->id)->first();

        if(blank($findShop)){
            return view('user.shop.create');
        }else{
            if($findShop->status == 'pending'){
                return redirect('/')->with('error', 'your shop is in review');
            }elseif($findShop->status == 'blocked'){
                return redirect('/')->with('error', 'your shop is suspended');
            }else{

            }
        }

        return redirect()->route('shopDetails')->with('error', 'you have already opened your shop');
    }
    public function userUpdateProduct(Request $request){
        // return 'testing';
        // return $request;
        $user=Auth()->user();
         $request->validate([
            'name' => 'required',
            'image' => 'image',
            'category' => 'required|exists:categories,id',
            'images' => '|array',
            'images.*' => 'image',
            'price' => 'required',
            'discount_price' => 'required',
            'delivery_days' => 'required',
            'delivery_charges' => 'required',
            'info' => 'required',
            'detail' => 'required',
        ]);
        // return $request;
        $product= Product::where('user_id', auth()->user()->id)->where('id', $request->id)->first();
        $product->name=$request->name;
        $product->quantity=$request->quantity;
        if($request->offer!='')
        {
            $product->offer=$request->offer;
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
        $notification=new Notification();
        $notification->user_id=$user->id;
        $notification->is_admin=1;
        $notification->name="Edit Product";
        $notification->message="Product  has been Edit by $user->username";
        //return   $notification;
        $notification->save();
        return back()->with('success','product edited');
    }
    public function uploadNewShopRequest(Request $request){

        $request->validate([

            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|unique:shops,name|min:6',
            'mobile' => 'required|unique:shops,mobile|min:11|max:11',
            'whatsapp' => 'required|unique:shops,whatsapp|min:11|max:11',
            'province' => 'required|min:6',
            'city' => 'required|min:6',
            'address' => 'required|min:6',
        ]);

        $imageName = uniqid().".".$request->image->extension();
        $request->image->move(public_path('images/shop/'), $imageName);
        $findShop = Shop::where('user_id', auth()->user()->id)->get();
        if(blank($findShop)){
            $shop = new Shop();
            $shop->user_id = auth()->user()->id;
            $shop->name = $request->name ;
            $shop->mobile = $request->mobile ;
            $shop->whatsapp = $request->whatsapp ;
            $shop->wholesale = $request->wholesale ;
            $shop->province = $request->province ;
            $shop->city = $request->city ;
            $shop->address = $request->address ;
            $shop->image = "images/shop/".$imageName ;
            $shop->save();
            return redirect('/')->with('success', 'we have received your new shop registeration request. we will contact you soon!');
        }else{
            return redirect('/')->with('error', 'you can not register new shop');
        }
    }
    public function updateShopRequest(Request $request){
        // return $request;
        $request->validate([

            'name' => 'required|unique:shops,name|min:6',
            'province' => 'required|min:6',
            'city' => 'required|min:6',
            'address' => 'required|min:6',
        ]);
        $shop = Shop::where('user_id', auth()->user()->id)->where('id', $request->id)->first();
        if(!blank($shop)){
            $shop->name = $request->name ;
            $shop->province = $request->province ;
            $shop->city = $request->city ;
            $shop->address = $request->address ;
            $shop->status = 'pending';
            if ($request->hasFile('image')) {
                $imageName = uniqid().".".$request->image->extension();
                $request->image->move(public_path('images/shop/'), $imageName);
                $shop->image = "images/shop/".$imageName ;
            }
            $shop->save();
            return redirect('/')->with('success', 'we have received your new shop update request. we will contact you soon!');
        }else{
            return redirect('/')->with('error', 'you can not update new shop');
        }
    }
}
