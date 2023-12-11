<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

        $ads = FreeListing::where('status','pending')->get();
        return view('admin.freeListing.newListing',compact('ads'));
        // return FreeListing::all();
    }

    public function searchAds(Request $request)
    {
        $searchQuery = $request->input('search');
        // dd($searchQuery);
        
        $ads = FreeListing::where('item_title', 'like', '%' . $searchQuery . '%')
                        ->orWhere('item_description', 'like', '%' . $searchQuery . '%')
                        // ->orWhere('user_id', 'like', '%' . $searchQuery . '%')
                        ->get();

                        return view('admin.freeListing.newListing',compact('ads'));
    }
    public function adApprove(Request $request)
    {
        $oldData = FreeListing::findOrfail($request->id);
        // dd($oldData);
        // dd($request->all());
        if($oldData){
            $oldData->update([
                'item_title'=>$request->item_title,
                'address'=>$request->address,
                'city'=>$request->city,
                'status'=>$request->status
            ]);
        }
        return redirect()->back()->with('success','Status Updated Successfully');
    }

    public function approvedAdLists(){
        $ads = FreeListing::where('status','approved')->get();
        return view('admin.freeListing.approvedListing',compact('ads'));
        // dd($ads);
    }

    public function cancelAdLists(){
        $ads = FreeListing::where('status','cancelled')->get();
        // dd($ads);
        return view('admin.freeListing.canceledListing',compact('ads'));
    }

    public function completedAdLists(){
        $ads = FreeListing::where('status','completed')->get();
        return view('admin.freeListing.completedListing',compact('ads'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy(FreeListing $ad)
    {
        $ad->delete();

        return redirect()->back()->with('success','Data Deleted Successfully');
    }
}
