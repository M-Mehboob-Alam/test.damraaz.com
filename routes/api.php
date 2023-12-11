<?php

use App\Models\MembershipCard;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/check/username', function(Request $request){
    $username = $request->username;
    $checkUsername = User::where('username', $username)->first();
    if(blank($checkUsername)){
        return response()->json(['isFound'=>'no']);
    }else{
        return response()->json(['isFound'=>'yes']);
    }
});
Route::get('/check/phone', function(Request $request){
    $phone = $request->phone;
    $checkPhone = User::where('phone', $phone)->first();
    if(blank($checkPhone)){
        return response()->json(['isFound'=>'no']);
    }else{
        return response()->json(['isFound'=>'yes']);
    }
});
Route::get('/all/users/count', function(){
    $damraazUsers = User::count();
    return response()->json(['users'=>$damraazUsers]);
});
Route::get('/get/user/details/{username}',function($username){
    $user = User::where('username', $username)->first();
    $refer_by = null;
    $membership = null;
    if (!blank($user)) {
        $membership = MembershipCard::where('user_id', $user->id)->first();
        if (!is_null($user->refer_by)) {
            $refer_by = User::where('username', $user->refer_by)->first();
        }
    }
    return response()->json(['user'=>$user, 'refer_by'=>$refer_by, 'membership'=>$membership]);
});
