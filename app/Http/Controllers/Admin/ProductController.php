<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;

use App\Http\Controllers\Controller;
use App\Models\Branding;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::with('category')->whereUserId(NULL)->get();
        return view('admin.product.index',compact('products'));
    }
    public function allMegaSalesProducts()
    {
        $products=Product::with('category')->where('isMegaSale', true)->get();
        return view('admin.product.index',compact('products'));
    }
    public function deleteProductImage($product,$image){

        $data = array();
        $products = Product::findOrFail( $product);
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
        }
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::get();
        return view('admin.product.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
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
        if($request->offer!='')
        {
            $product->offer=$request->offer;
        }
        if($request->offer!='')
        {
            $product->deal=$request->deal;
        }
        $product->category_id=$request->category;
        $product->discount_price=$request->discount_price;
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
        // return $product;
        $product->save();
        return back()->with('success','product added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product=Product::with('category')->findOrfail($id);
        $shop = Shop::where('user_id', $product->user_id)->latest()->first();
        return view('admin.product.show',compact('product', 'shop'));
    }
    public function adminAddRemoveToMegaSale($id)
    {
        $product=Product::findOrfail($id);
        if (!blank($product)) {
            $product->isMegaSale = !($product->isMegaSale);
            $product->save();
        }
        return redirect()->back()->with('success', 'Mega Sale Status Updated');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product=Product::with('branding')->findOrfail($id);
        $categories=Category::get();
        $branding = Branding::get();
        return view('admin.product.edit',compact('product','categories', 'branding'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required|exists:categories,id',
            'images' => 'array',
            'images.*' => 'image',
            'image' => 'image',
            'price' => 'required',
            'quantity' => 'required',
            'status' => 'required',
            'message' => 'required',
            'isActive' => 'required',
            'discount_price' => 'required',
            'delivery_days' => 'required',
            'delivery_charges' => 'required',
            'info' => 'required',
            'detail' => 'required',
        ]);
        // return $request;
        $product=Product::find($id);
        $oldStatus = $product->status;
        $product->name=$request->name;
        if($request->offer!='')
        {
            $product->offer=$request->offer;
        }
        if($request->offer!='')
        {
            $product->deal=$request->deal;
        }
        $product->category_id=$request->category;
        $product->discount_price=$request->discount_price;
        $product->price=$request->price;
        $product->quantity=$request->quantity;
        $product->isActive=$request->isActive;
        $product->status=$request->status;
        $product->message=$request->message;
        $product->delivery_charges=$request->delivery_charges;
        $product->delivery_days=$request->delivery_days;
        $product->info=$request->info;
        if (!is_null($request->branding)) {
            $product->branding_id=$request->branding;
        }
        if (!is_null($request->purchased_price)) {
            $product->purchased_price=$request->purchased_price;
        }
        $product->detail=$request->detail;
        if($request->hasfile('images'))
        {
            $images = json_decode($product->images);
            if($product->images!=''&&$product->images!=null)
            {
                foreach($images as $image)
                {
                    unlink($image);
                }
            }
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

               $filename = uniqid().'.'. ($request->image)->getClientOriginalExtension();
               $request->image->move(public_path('images/product'), $filename);
               $dataFile='images/product/'. $filename;

           $product->image=$dataFile;
        }
        // return $product;
        $product->save();
        if($oldStatus == 'pending'){
            return redirect()->route('admin.userProduct.index', ['status'=>'pending'])->with('success', 'product status updated successful');
        }

        return back()->with('success','product updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::find($id);

        $images = json_decode($product->images);
        if($product->images!=''&&$product->images!=null)
        {
            foreach($images as $image)
            {
                unlink($image);
            }
        }
        $product->delete();
        return redirect(route('admin.product.index'))->with('success','Product Deleted');
    }
}
