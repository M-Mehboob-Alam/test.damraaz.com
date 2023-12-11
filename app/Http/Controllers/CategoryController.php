<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories=Category::with(['parent','children','descendants'])->where('parent_id', null)->paginate(7);
        return view('frontend.category.index',compact('categories'));
    }
    public function show(Request $request, $id)
    {
        // return $request;
        $category = Category::with('products')->filterProductName($request->name)->where('slug',$id)->first();
        $products = $category->products()->where(function ($query) {
            $query->where('status', 'accepted')
                ->where('isActive', true)
                ->orWhereNull('status');
        })->paginate(20);
        return view('frontend.category.show', compact('category', 'products'));
    }
}
