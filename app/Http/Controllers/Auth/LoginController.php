<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
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
    }
    public function username()
    {
        return 'username';
    }
    // public function login(Request $request){
    //     $request->validate([
    //         'username' =>'required',
    //         'password' =>'required'
    //     ]);
    //         $username = $request->username;
    //         $password = $request->password;
    //     $user = User::where('username',$username)->first();
    //     if($user){
    //         if(Hash::check($password,$user->password)){
    //             $request->session()->put('name',$user->name);
    //             return redirect('form');
    //         }else{
    //             return back()->with('error','Invalid username or password');
    //         }
    //     }else{
    //         return back()->with('error','Invalid username or password');
    //     }
    // }


}
