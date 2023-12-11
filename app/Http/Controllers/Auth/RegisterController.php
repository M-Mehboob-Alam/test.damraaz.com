<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use App\Models\{Commission,Notification};
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    public function referralRegister($username){

        $user = User::where('username',$username)->latest()->first();

        if(!blank($user)){
              $user = $user->username;
              return view('auth.register', compact('user'));
        }

        // return redirect()->route('register')->with('error', 'Sponsor name is not exits');

    }
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'phone' => ['required', 'unique:users','max:11', 'min:11'],
            'username' => ['required', 'max:255', 'unique:users'],
            'refer_by' => ['nullable', 'exists:users,username'],
            'password' => ['required', 'string'],
            // 'business' => ['nullable', 'string'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $commission=sendCommission($data['refer_by']);
     return  $user= User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'username' => $data['username'],
            'refer_by' => $data['refer_by'],
            // 'business' => $data['business'],
            'password' => Hash::make($data['password']),
        ]);

    }


    public function userCheck(Request $request)
    {

        $data = $request->all(); // This will get all the request data.
        if (isset($data['email'])) {
            $user = User::where('email', $data['email'])->first();
            if (!blank($user)) {
                return response()->json(['msg' => true]);
            } else {
                return response()->json(['msg' => false]);
            }
        } elseif (isset($data['username'])) {
          return  $user = User::where('username', $data['username'])->first();
            if (!blank($user)) {
                return response()->json(['msg' => true]);
            } else {
                return response()->json(['msg' => false]);
            }
        }elseif (isset($data['phone'])) {
            $user = User::where('phone', $data['phone'])->first();
            if (!blank($user)) {
                return response()->json(['msg' => true]);
            } else {
                return response()->json(['msg' => false]);
            }
        }
        $user = User::where('username', $data['refer_by'])->first();
        if (!blank($user)) {
            return response()->json(['msg' => true]);
        } else {
            return response()->json(['msg' => false]);
        }
    }
    public function otherUserSearching(Request $request)
    {
      if($request->ajax()){
        $username = $request->username;
        $users = User::where('username', $username)->where('id', '!=', auth()->user()->id)->first();
        if (!blank($users)) {
            return response()->json(['username' => $users->username]);
        } else {
            return response()->json(['username' => 'none']);
        }
      }
    }
   
}

function sendCommission($refer_by)
{
    if(!blank($refer_by))
    {

        $user=User::where('username',$refer_by)->first();
        $getReferralCounter = User::where('refer_by', $user->username)->count();

        $countPrevious30DaysUser =User::where('refer_by',$user->username)->where('created_at','>', Carbon::now()->subDays(30))->count();
        $commission=new Commission();
        $commission->user_id=$user->id;
        if($getReferralCounter == 0){
            $commission->amount=($countPrevious30DaysUser<=375)?20:0;
        }else{
            $commission->amount=($countPrevious30DaysUser<=375)?2:0;
        }
        $commission->isAssign=1;
        $commission->status='clear';
        $commission->name='referral';
        $commission->save();

        $notification=new notification;
        $notification->user_id=$user->id;
        $notification->name='Referral';
        $notification->message='A new member joined using your username.';
        $notification->save();
    }

}
