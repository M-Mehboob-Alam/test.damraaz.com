<?php

namespace App\Http\Controllers;

use App\Models\FreeListing;
use Illuminate\Http\Request;

class FreeListingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd('all ads');
        $ads = FreeListing::where('status','approved')->get();
        // dump($ads);
        // die;
        return view('user.freeListing.index',compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('user.freeListing.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $all =$request->all();
        // dd($all);
        $request->validate([
            'item_title' => 'required',
            'item_price' => 'required',
            'item_description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validation rules for single image
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation rules for multiple images
            'city' => 'required',
            'address' => 'required',
        ]);
    
        $user = auth()->user();
        $listData = new FreeListing();
        $listData->item_title = $request->item_title;
        $listData->item_price = $request->item_price;
        $listData->item_description = $request->item_description;
        $listData->city = $request->city;
        $listData->address = $request->address;
        $listData->user_id = $user->id;
    
        // Handle single image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image'); // Get the uploaded file
            $filename = uniqid() . '.' . $image->getClientOriginalExtension(); // Generate a unique filename
            $image->move('images/listing', $filename); // Move the file to the specified directory
            $listData->image = $filename; // Store the filename in the 'image' property of $listData
        }
        
    
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move('images/listing', $filename);
                $data[] = $filename;
            }

            $listData->images = json_encode($data);
        }

            $listData->save();
    
        return redirect()->back()->with('success', "Data Uploaded Successfully!");
    }
    
    public function searchAds(Request $request)
    {
        $searchQuery = $request->input('search');
        // dd($searchQuery);
        
        $ads = FreeListing::where('item_title', 'like', '%' . $searchQuery . '%')
                        ->orWhere('item_description', 'like', '%' . $searchQuery . '%')
                        ->get();

            return view('user.freeListing.index',compact('ads'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(FreeListing $ad)
    {
        return view('user.freeListing.listAd',compact('ad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
