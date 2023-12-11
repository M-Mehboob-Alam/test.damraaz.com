<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Rating;
use Illuminate\Http\Request;
use App\Models\{Product, Category, Follower, OrderDetail, Order, Marquee, Newsletter, Share, Shop, Slider};

class UserController extends Controller
{
    public function subscribeNewsLetter (Request $request)
    {
        $request->validate([
            'email'=> 'required',
        ]);

        $existingEmail = Newsletter::where('email', $request->email)->get();
        if(blank($existingEmail)){
            $news = new Newsletter();
            $news->email = $request->email;
            $news->save();
            return redirect()->back()->with('success', 'Newsletter subscribed successful!');
        }else{
            return redirect()->back()->with('error', 'you already subscribed to Newsletter!');
        }

    }
    public function index(Request $request)
    {
        // $user=Auth()->user();
        $products = Product::where('status', 'accepted')->where('isActive', true)->inRandomOrder()->limit(20)->get();
        $categories = Category::with(['parent','children','descendants'])->where('parent_id', null)->get();
        // $tabCategories=Category::has('products')->limit(4)->get();
        // $tabCategories = Category::with(['products' => function ($q) {
        //     $q->where('status', '=', 'accepted')->orWhereNull('status');
        // }])->limit(4)->get();
        // $topProducts = OrderDetail::with('product')->select('product_id')->distinct()->limit(30)->get();
        // $tops = OrderDetail::with('product')->select('product_id')->inRandomOrder()->distinct()->limit(3)->get();
        $newProducts = Product::where('status', 'accepted')->where('isActive', true)->inRandomOrder()->latest()->paginate(12);
        // $offerProducts=DB::table('products')->where('offer','!=',NULL)->select()->distinct()->get();
        $offerProducts = Product::where('status', 'accepted')->where('isActive', true)->where('offer', '!=', NULL)->select('offer')->distinct()->pluck('offer');
        //  Product::whereIn('offer',$offerProducts->all())->get();
        $dealProducts = Product::where('status', 'accepted')->where('isActive', true)->where('deal', '!=', NULL)->inRandomOrder()->latest()->paginate(12);

        $marquee = Marquee::first();

        $sliders = Slider::get();
        // if($user)
        // {
        //     $countCompletedOrders = Order::where('user_id', $user->id)->whereStatus('delivered')->count();

        // }else{
        //     $countCompletedOrders=0;
        // }

        // return view('frontend.index', compact('products','countCompletedOrders', 'tops', 'categories','tabCategories', 'topProducts', 'newProducts', 'offerProducts', 'dealProducts', 'marquee', 'sliders'));
        return view('frontend.index', compact('products', 'categories',  'newProducts', 'offerProducts', 'dealProducts', 'marquee', 'sliders'));
    }
    public function offer($offer)
    {
        $offers = Product::where('offer', $offer)->get();
        return view('frontend.product.offer', compact('offers'));
    }

    public function product($id)
    {
        $product = Product::with('branding','category', 'ratings')->where('slug',$id)->first();
        if(is_null($product)){
            $product = Product::with('category', 'ratings')->where('id',$id)->first();
        }
        $shop = Shop::where('user_id', $product->user_id)->where('status', 'approved')->latest()->first();
        $relatedProducts = Product::with('category')->where('category_id', $product->category_id)->where('id', '!=', $product->id)->get();
        return view('frontend.product.show', compact('product', 'relatedProducts', 'shop'));
    }
    public function share($product_id)
    {
        $user=Auth()->user();
        if($user)
        {
            $share=new Share();
            $share->user_id=$user->id;
            $share->product_id=$product_id;
            $share->save();
        }
        return back();
    }

    public function follow($id)
    {
        // return $id;
        $follower = Follower::where('shop_id', $id)->where('user_id', Auth()->id())->where('active', true)->first();
        $unfollow = Follower::where('shop_id', $id)->where('user_id', Auth()->id())->where('active', false)->first();

        if ($follower) {
            $follower->active = false;
            $follower->save();
            return back()->with('success', 'unfollow shop');
        }
        if ($unfollow) {
            $unfollow->active = true;
            $unfollow->save();
            return back()->with('success', 'Followed shop');
        }
        $follow = new Follower;
        $follow->user_id = Auth()->id();
        $follow->shop_id = $id;
        $follow->save();
        return back()->with('success', 'Followed shop');
    }

    public function viewtopProduct()
    {
        $tops = OrderDetail::with('product')->select('product_id')->inRandomOrder()->distinct()->paginate(30);
        return view('frontend.product.viewTopProduct', compact('tops'));
    }
    public function viewNewProduct()
    {
        $newProducts = Product::where('status', 'accepted')->orWhereNull('status')->inRandomOrder()->latest()->paginate(30);
        return view('frontend.product.newProduct', compact('newProducts'));
    }
}
