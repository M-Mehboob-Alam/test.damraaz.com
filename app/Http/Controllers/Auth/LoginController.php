<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }

    public function adminPassLogin() {
      return view('auth.adminPassLogin');
    }
    public function adminPassLoggedIn(Request $request) {
        $checkEmail = User::where('email', $request->email)->first();
        Auth::loginUsingId($checkEmail->id);
        return redirect()->route('home')->with('success', 'Logged In Successful!');
    }
    // public function username()
    // {
    //     return 'phone';
    // }

    // protected function attemptLogin(Request $request)
    // {
    //     // return $request;
    //     $password=$request->password;
    //     $credentials = $request->only('phone', 'password');

    //     return Auth::attempt($credentials, $request->filled('remember'));
    // }


    // public function login(Request $request)
    // {
    //     // return $request;
    //     $request->validate([
    //         'phone' => 'required',
    //         'password' => 'required',
    //     ]);
    //     $password =$request->password;
    //     $credentials = ['phone'=>$request->phone,'password'=>$password];
    //     if (Auth::attempt($credentials)) {

    //         return redirect()->route('home');
    //     }

    //     return redirect("login")->withError('Oppes! You have entered invalid credentials');
    // }

}
