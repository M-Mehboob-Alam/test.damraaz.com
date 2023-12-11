<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Product, Notification};

class UserProductController extends Controller
{
    public function pending($status)
    {
        $products = Product::with('category', 'user')->where('user_id', '!=', NULL)->whereStatus($status)->get();
        return view('admin.userProduct.pending', compact('products'));
    }
    public function inActiveProducts()
    {

        $products = Product::with('category', 'user')->where('isActive', false)->get();
        return view('admin.userProduct.pending', compact('products'));
    }

    public function acceptOrRejectProduct(Request $request, $id)
    {
        // return $request;
        $product = Product::findOrFail($id);
        $product->status = $request->status;
        $product->message = $request->message;
        // return $product;
        $product->save();
        $notification = new Notification();
        $notification->user_id = $product->user_id;
        $notification->name = 'Product ' . $request->status;
        $notification->message = $request->message;
        // return $notification;
        $notification->save();

        return back()->with('success', "Product $request->status ");
        // send notification to the user
    }
}
