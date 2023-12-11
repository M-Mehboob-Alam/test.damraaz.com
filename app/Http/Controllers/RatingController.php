<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request, $id)
    {
        // return $id;
        // return $request;
        // $request->validate([
        //     'price_rating' => 'required',
        //     'quality_rating' => 'required',
        // ]);
        $ratingExist = Rating::where('order_id', $id)->first();
        if (!$ratingExist) {
            $orders = OrderDetail::where('order_id', $id)->get();
            $user = Auth()->user();
            foreach ($orders as $order) {
                $rating = new Rating;
                $rating->user_id = $user->id;
                $rating->quality_rating = $request->quality_rating;
                $rating->price_rating = $request->price_rating;
                $rating->review = $request->review;
                $rating->product_id = $order->product_id;
                $rating->order_id = $id;
                $rating->save();
            }
            return back()->with('success', 'Rating/Feedback Submitted!');
        }else if(blank($ratingExist->price_rating) || blank($ratingExist->price_rating) ||blank($ratingExist->review))
        {
            // return $ratingExist;
            if(blank($ratingExist->quality_rating))
            {
                $ratingExist->quality_rating = $request->quality_rating;
            }
            if(blank($ratingExist->price_rating))
            {
                $ratingExist->price_rating = $request->price_rating;
            }
            if(blank($ratingExist->review))
            {
                $ratingExist->review = $request->review; 
            }
            $ratingExist->save();
            return back()->with('success', 'Rating/Feedback Submitted!');
        }
        return back()->with('warning', 'Rating/Feedback for this order already submitted.');
    }
}
