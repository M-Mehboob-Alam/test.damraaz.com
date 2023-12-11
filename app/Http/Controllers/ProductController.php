<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Arr;

class ProductController extends Controller
{
    public function product(Request $request)
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
    }
    public function megaSale(Request $request)
    {
        // return 'megaSale';
        $min=(int)$request->min_price;
        $max=(int)$request->max_price;
        $sort=$request->sort;
        // return gettype($sort);
        // return $request;
        $isMegaSale = 'Mega Sales';
        if($sort=='lowToHigh')
        {
            $products=Product::where('status', 'accepted')->where('isMegaSale', true)->where('isActive', true)->filterPriceBetween($min,$max)->filterName($request->name)->get()->sortBy('discount_price',SORT_ASC);
            return view('frontend.product.all_products',compact('products','isMegaSale'));

        }
        $products=Product::where('status', 'accepted')->where('isMegaSale', true)->where('isActive', true)->filterPriceBetween($min,$max)->filterName($request->name)->get()->sortByDesc('discount_price',SORT_DESC);
        return view('frontend.product.all_products',compact('products','isMegaSale'));
    }
    public function cart()
    {
        $cart = session()->get('cart');
        if(empty($cart)){
            return redirect('/')->with('error', 'your cart is empty. first add item into cart');
        }
        // return redirect()->back()->with('error', 'Sorry, we are working on it ');
        return view('frontend.product.cart');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function addToCart(Request $request, $id)
    {
        // echo $id;
        // return $request;
        $quantity = $request->quantity;
        $quantity = (int) $quantity;
        // return $quantity;
        $discount_price = 0;
        $price = 0;
        $product = Product::with('shop')->where('slug',$id)->first();
        if(is_null($product->discount_price)){
            $discount_price= (int) $product->price;
            $price = (int) $product->price;
        }else{
            if ($product->discount_price >= $product->price) {
                $discount_price= (int) $product->price;
                $price = (int) $product->price;
            } else {
                $discount_price= (int) $product->discount_price;
                $price = (int) $product->price;
            }
        }

         $cart = session()->get('cart');

         if(is_null($cart)) {
            // $productArray = array();
            // $productArray[$product->id] =  [
            //     "id" => $product->id,
            //     "name" => $product->name,
            //     "slug" => $product->slug,
            //     "quantity" => $quantity,
            //     "price" => $product->price,
            //     "discount_price" =>$discount_price,
            //     "images" => $product->image,
            //     "delivery_days" => $product->delivery_days,
            //     "delivery_charges" =>  $product->delivery_charges ,
            //     'profit'=>0,
            // ];
            $cart = [ $product->user_id =>[
                        'shop_id' => $product->user_id,
                        'shop_name' => $product->shop->name,
                        'shop_charges' =>   $product->delivery_charges ,
                        'products' => [$product->id =>  [
                            "id" => $product->id,
                            "name" => $product->name,
                            "slug" => $product->slug,
                            "quantity" => $quantity,
                            "price" => $price,
                            "discount_price" =>$discount_price,
                            "images" => $product->image,
                            "delivery_days" => $product->delivery_days,
                            "delivery_charges" =>  $product->delivery_charges ,
                            'profit'=>0,
                        ],
                     ],
                    ],
            ];
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }


        if(isset($cart[$product->user_id])) {
            $is_already_item_found = false;
            $get_old_products_array = array() ;
            $get_old_product_update_array = Array();

            foreach($cart[$product->user_id]['products']  as $key => $item){
                    // return $item;
                    if(  $item['id'] == $product->id){
                           $cart[$product->user_id]['products'][$product->id] =  [
                            "id" => $product->id,
                            "name" => $product->name,
                            "slug" => $product->slug,
                            "quantity" =>  $item['quantity'] + $quantity,
                            "price" => $price,
                            "discount_price" =>$discount_price,
                            "images" => $product->image,
                            "delivery_days" => $product->delivery_days,
                            "delivery_charges" =>  $product->delivery_charges ,
                            'profit'=>0,
                        ];
                        $is_already_item_found = true;
                    }else{
                        // $get_old_products_array[] = $item;
                    }

            }
            // if($is_already_item_found){
            //     // $get_old_products_array[] =$cart[$product->user_id]['products'];
            //     // $get_old_products_array[] =$get_old_product_update_array;

            //     $cart[$product->user_id]['products'] = $get_old_products_array;
            // }
            if(!$is_already_item_found){


                $productArray = array();
                $get_old_products = array();
                $get_old_products = $cart[$product->user_id]['products'];
                $cart[$product->user_id]['products'][$product->id] =  [
                    "id" => $product->id,
                    "name" => $product->name,
                    "slug" => $product->slug,
                    "quantity" => $quantity,
                    "price" => $price,
                    "discount_price" =>$discount_price,
                    "images" => $product->image,
                    "delivery_days" => $product->delivery_days,
                    "delivery_charges" =>  $product->delivery_charges ,
                    'profit'=>0,
                ];
                // $cart[$product->user_id]['products'] = $get_old_products;
                // array_push($cart[$product->user_id]['products'], $productArray);
            }


        } else {


            $qty=$request->quantity;
            $discount_price= $discount_price;
            $profit=0;
            // $productArray = array();
            // $productArray[ $product->id] =  [
            //     "id" => $product->id,
            //     "name" => $product->name,
            //     "slug" => $product->slug,
            //     "quantity" => $quantity,
            //     "price" => $product->price,
            //     "discount_price" =>$discount_price,
            //     "images" => $product->image,
            //     "delivery_days" => $product->delivery_days,
            //     "delivery_charges" =>  $product->delivery_charges ,
            //     'profit'=>0,
            // ];
            $cart[$product->user_id]=[
                'shop_id' => $product->user_id,
                'shop_name' => $product->shop->name,
                // 'shop_items_count' =>  1 ,
                // 'shop_items' => $product->name ,
                'shop_charges' =>   $product->delivery_charges ,
                'products' => [$product->id => [
                        "id" => $product->id,
                        "name" => $product->name,
                        "slug" => $product->slug,
                        "quantity" => $quantity,
                        "price" => $price,
                        "discount_price" =>$discount_price,
                        "images" => $product->image,
                        "delivery_days" => $product->delivery_days,
                        "delivery_charges" =>  $product->delivery_charges ,
                        'profit'=>0,
                    ],
                ],
            ];


        }
        //  return $cart;
        session()->put('cart', $cart);
        // return   $cart = session()->get('cart', []);
        if($request->checkout=='yes')
        {
            return redirect(route('cart'))->with('success', 'Product added to cart successfully.');
        }
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    public function directPlaceOrder(Request $request)
    {
        // echo $id;
        // return $request;
        $quantity = (int) $request->quantity;
        $profit = (int) $request->profit;
        // return $quantity;
        $product = Product::with('shop')->where('id',$request->id)->first();

        $discount_price = 0;
        $price = 0;

        if(is_null($product->discount_price)){
            $discount_price= (int) $product->price;
            $price = (int) $product->price;
        }else{
            if ($product->discount_price >= $product->price) {
                $discount_price= (int) $product->price;
                $price = (int) $product->price;
            } else {
                $discount_price= (int) $product->discount_price;
                $price = (int) $product->price;
            }
        }
        // $discount_price= (int) $product->discount_price;

         $cart = array();

         $qty= (int)$product->quantity;
        //  $discount_price= (int)$product->discount_price;
         $fortyPer=(40/100)*$discount_price;
         $profit=(int) $request->profit;
         if($profit>$fortyPer)
         {
             return redirect()->back()->with('error',"profit must be less than 40%(Rs. $fortyPer)");
         }

         $total = 0;


        $total = ($quantity * $discount_price ) + $profit;
        if($total <= 300){
            return redirect()->back()->with('error', 'order upto Rs. 300 ');
        }
                $cart = [ $product->user_id =>[
                    'shop_id' => $product->user_id,
                    'shop_name' => $product->shop->name,
                    'shop_charges' =>   $product->delivery_charges ,
                    'products' => [$product->id =>  [
                        "id" => $product->id,
                        "name" => $product->name,
                        "slug" => $product->slug,
                        "quantity" => $quantity,
                        "price" => $price,
                        "discount_price" =>$discount_price,
                        "images" => $product->image,
                        "delivery_days" => $product->delivery_days,
                        "delivery_charges" =>  $product->delivery_charges ,
                        'profit'=>$profit,
                    ],
                ],
                ],
        ];
        session()->put('cart', $cart);
        $orders['orders'] = Order::where('user_id', Auth()->id())->get();
        $accounts = PaymentMethod::where('status',1)->get();

        return view('frontend.order.create', $orders)->with('accounts',$accounts);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    // public function addToCart(Request $request, $id)
    // {
    //     // echo $id;
    //     // return $request;
    //     $quantity = $request->quantity;
    //     $quantity = (int) $quantity;
    //     // return $quantity;
    //     $product = Product::with('shop')->where('slug',$id)->first();
    //     // if($product->quantity == 0 ){
    //     //     return redirect()->back()->with('error', 'stock is not available');
    //     // }
    //     // if($request->quantity > $product->quantity ){
    //     //     return redirect()->back()->with('error', 'stock is not available');
    //     // }
    //      $cart = session()->get('cart', []);

    //         // return $cart;
    //     //  echo $isMultiItemFound;
    //     //  return ' wait ';
    //     if(array_key_exists($id,$cart)) {

    //         $cart[$id]['quantity'] = $cart[$id]['quantity'] + $quantity;
    //     } else {
    //             $multi_shop_items = array() ;
    //             $get_items_count  = 0;
    //             $isMultiItemFound = false;
    //             $delivery_charges = 0;
    //             // return $cart;
    //             foreach($cart as $id => $details){
    //                 if($details['shop_id'] == $product->user_id){
    //                     // echo "<pre>";
    //                     // print_r($details);
    //                     $multi_shop_items[] = $details['name'];

    //                     $get_items_count =(int) $details['shop_items_count'] ;

    //                     $delivery_charges = $details['delivery_charges'];
    //                     $isMultiItemFound = true;

    //                 }
    //             }

    //             $get_items_count =  $get_items_count  + 1 ;
    //             $multi_shop_items[] = $product->name;



    //         $qty=$request->quantity;
    //         $discount_price=$product->discount_price;
    //         $profit=0;

    //          $cart[$id] = [
    //             "name" => $id,
    //             "quantity" => $quantity,
    //             "price" => $product->price,

    //             "discount_price" =>$discount_price,
    //             "images" => $product->image,
    //             "delivery_days" => $product->delivery_days,
    //             "delivery_charges" => ( $isMultiItemFound  ?   $delivery_charges : $product->delivery_charges ) ,
    //             // "delivery_charges" =>  $product->delivery_charges  ,
    //             'profit'=>$profit,
    //             'shop_id' => $product->user_id,
    //             'shop_name' => $product->shop->name,
    //             // 'shop_items_count' =>  1 ,
    //             // 'shop_items' => $product->name ,
    //             'shop_items_count' => ( $isMultiItemFound  ?   $get_items_count : 1 ),
    //             'shop_items' => ( $isMultiItemFound  ?   $multi_shop_items : $multi_shop_items[]= $product->name ),
    //         ];

    //     }
    //     //  return $cart;
    //     session()->put('cart', $cart);
    //     // return   $cart = session()->get('cart', []);
    //     if($request->checkout=='yes')
    //     {
    //         return redirect(route('cart'))->with('success', 'Product added to cart successfully.');
    //     }
    //     return redirect()->back()->with('success', 'Product added to cart successfully!');
    // }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function update(Request $request)
    {
        // return $request;
        $id=Product::where('slug', $request->id)->first();
        $id=$id->id;
        $get_old_products = array();
        if($id && $request->quantity){

            if($request->quantity){
                if($request->quantity == "0"){
                    return redirect()->back()->with('error', 'quantity must be greater than 1');
                }
            }
            $quantity = 0 ;
            $cart = session()->get('cart');

            if($request->update){
                if ($request->update == 'minus') {
                    $quantity = (int) $request->quantity;
                    $quantity = $quantity - 1;
                } else {
                    $quantity = (int) $request->quantity;
                    $quantity = $quantity + 1;
                }

                // $cart[$id]["quantity"] = $quantity;
                foreach($cart as $key=> $items){
                    foreach($items['products'] as $pro_id => $details){
                        if($details['id']== $id){
                           $cart[$key]['products'][$pro_id] = [
                                "id" => $details['id'],
                                "name" => $details['name'],
                                "slug" => $details['slug'],
                                "quantity" => $quantity,
                                "price" => $details['price'],
                                "discount_price" =>$details['discount_price'],
                                "images" => $details['images'],
                                "delivery_days" => $details['delivery_days'],
                                "delivery_charges" =>  $details['delivery_charges'] ,
                                'profit'=>$details['profit'],
                            ];
                        }
                    }
                    // $cart[$key]['products'] = $get_old_products;
                }
                // $cart[$id]["quantity"] = $request->quantity;
                session()->put('cart', $cart);
                // return $quantity;
                session()->flash('success', 'Cart updated successfully');
                return redirect()->back()->with('success', 'Cart updated successfully');
            }else
            {

                // $cart[$id]["quantity"] = $request->quantity;
                $quantity = (int) $request->quantity;
                foreach($cart as $key=> $items){
                    foreach($items['products'] as $pro_id => $details){

                        if($pro_id == $id){


                            $cart[$key]['products'][$pro_id]= [
                                "id" => $details['id'],
                                "name" => $details['name'],
                                "slug" => $details['slug'],
                                "quantity" => $quantity,
                                "price" => $details['price'],
                                "discount_price" =>$details['discount_price'],
                                "images" => $details['images'],
                                "delivery_days" => $details['delivery_days'],
                                "delivery_charges" =>  $details['delivery_charges'] ,
                                'profit'=>$details['profit'],
                            ];
                        }else{
                        //  $get_old_products[ $pro_id]= $details;
                        }

                    }
                    // $cart[$key]['products'] = $get_old_products;
                }
                session()->put('cart', $cart);
                session()->flash('success', 'Cart updated successfully');
                return redirect()->back()->with('success', 'Cart updated successfully');
            }

        }
        if($id && $request->profit){

            if($request->profit){
                if($request->profit == "0"){
                    return redirect()->back()->with('error', 'profit must be greater than 0');
                }
            }
            // return 'profi';
            $product = Product::findOrFail($id);
           $cart = session()->get('cart');
           $get_old_products = array();
           $discount_price = 0;
           $price = 0;

           if(is_null($product->discount_price)){
               $discount_price= (int) $product->price;
               $price = (int) $product->price;
           }else{
               if ($product->discount_price >= $product->price) {
                   $discount_price= (int) $product->price;
                   $price = (int) $product->price;
               } else {
                   $discount_price= (int) $product->discount_price;
                   $price = (int) $product->price;
               }
           }

           foreach($cart[$product->user_id]['products'] as $key=> $items){
            // return $items['id'];
                // foreach($items as  $pro_id => $details){
                    if($items['id'] == $id){
                        // return 'profit';
                        $qty= (int)$product->quantity;
                        // $discount_price= (int)$product->discount_price;
                        $total_price=$qty*$discount_price;
                        $fortyPer=(40/100)*$discount_price;
                        $profit=(int) $request->profit;
                        if($profit>$fortyPer)
                        {
                            return redirect()->back()->with('error',"profit must be less than 40%(Rs. $fortyPer)");
                        }
                        // $cart[$id]["profit"] = $request->profit;
                        $cart[$product->user_id]['products'][$product->id] = [
                            "id" => $items['id'],
                            "name" => $items['name'],
                            "slug" => $items['slug'],
                            "quantity" => $items['quantity'],
                            "price" => $items['price'],
                            "discount_price" =>$items['discount_price'],
                            "images" => $items['images'],
                            "delivery_days" => $items['delivery_days'],
                            "delivery_charges" =>  $items['delivery_charges'] ,
                            'profit'=> (int)$request->profit,
                        ];
                    }
                // }
            }


            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Profit updated successfully');
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove(Request $request)
    {
        // return $request;

        $product= Product::where('slug', $request->id)->first();
        $id = $product->id;
        $get_old_products = array();
        if($request->id) {
// return $request;
            $cart = session()->get('cart');
            unset($cart[$product->user_id]['products'][$id]);
            $product_counter = 0 ;

            foreach ($cart[$product->user_id]['products'] as  $value) {
                echo "<pre>";
                print_r($value);
                $product_counter++;
            }
            // echo $product_counter;
            if($product_counter == 0 ){
                echo '<pre>';
                print_r( $cart);
                unset($cart[$product->user_id ]);
            //    return $cart;
            }
            // return 'wait';

            // foreach($cart as $key=> $items){
            //     foreach($items['products'] as $pro_id => $details){

            //         if($pro_id == $id){
            //             return 'from unset';
            //             unset($cart[$key]['products'][$pro_id]);
            //         }


            //     }
            //     // $cart[$key]['products'] = $get_old_products;
            // }
            // if(isset($cart[$request->id])) {
            //     unset($cart[$request->id]);

                session()->put('cart', $cart);
            // }
            session()->flash('success', 'Product removed successfully');
        }
        return redirect()->back()->with('success', 'Product removed successfully');
    }
    public function wishlist()
    {
        return view('frontend.product.wishlist');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function addToWishlist($id)
    {
        $product = Product::where('slug',$id)->first();

        $wishlist = session()->get('wishlist', []);

        if(isset($wishlist[$id])) {
           return redirect()->back()->with('warning', 'This Product already exist in wishlist!');
        } else {
             $wishlist[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "discount_price" => $product->discount_price,
                "images" => $product->image,
                "delivery_days" => $product->delivery_days,
                "delivery_charges" => $product->delivery_charges,
            ];

        }

        session()->put('wishlist', $wishlist);
        return redirect()->back()->with('success', 'Product added to wishlist successfully!');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function removeWishlist(Request $request)
    {
        if($request->id) {
            $wishlist = session()->get('wishlist');
            if(isset($wishlist[$request->id])) {
                unset($wishlist[$request->id]);
                session()->put('wishlist', $wishlist);
            }
            session()->flash('success', 'Product removed from wishlist successfully');
        }
    }

     public function compare()
    {
        return view('frontend.product.compare');
    }
    public function addToCompare($id)
    {
        $product = Product::findOrFail($id);

        $compare = session()->get('compare', []);

        if(isset($compare[$id])) {
           return redirect()->back()->with('warning', 'This Product already in compare list!');
        } else {
             $compare[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "discount_price" => $product->discount_price,
                "images" => $product->images,
                "delivery_days" => $product->delivery_days,
                "delivery_charges" => $product->delivery_charges,
            ];

        }

        session()->put('compare', $compare);
        return redirect()->back()->with('success', 'Product added to compare list successfully!');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function removeCompare(Request $request)
    {
        if($request->id) {
            $compare = session()->get('compare');
            if(isset($compare[$request->id])) {
                unset($compare[$request->id]);
                session()->put('compare', $compare);
            }
            session()->flash('danger', 'Product removed from compare list successfully');
        }
    }
    public function search(Request $request)
    {
        $query = $request->get('query');
        if ($request->ajax()) {
            $data = Product::where('name', 'LIKE', $query . '%')->where('isActive', true)->where('status', 'accepted')
                ->limit(10)
                ->get();
            $output = '';
            if (count($data) > 0) {
                $output = '<ul class="list-group">';

                foreach ($data as $row) {
                    $urlMaker = route('product.show', ['id'=>$row->slug]);
                    $output .= '<li class="list-group-item"><a href="'.$urlMaker.'">' . $row->name . '</a></li>';
                }
                $output .= '</ul>';
            } else {
                $output .= '<li class="list-group-item">' . 'No results' . '</li>';
            }
            return $output;
        }
        $products = Product::where('name', 'LIKE', '%' . $query . '%')
            ->simplePaginate(10);
        return view('welcome', compact('products'));
    }
}
