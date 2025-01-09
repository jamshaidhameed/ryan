<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Session;
use URL;
use Redirect;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        // $this->middleware('auth')->only('logout');
    }

     protected function authenticated(Request $request, $user)
    {
        $last_word = explode('/',$request->url());
        $last_word = end($last_word);

        if ($user->status == 0) {
            Auth::logout();
            return redirect()->back()->with('error' , 'Account disabled!');
        }

        $user_role = $user->role;

        // session( [ "user_role" => $user_role ] );

       if ( $user_role == 'admin' ) {
            return redirect()->intended( route( "admin.dashboard" ) );

        } else if ( $user_role == 'landlord' ) {
            return redirect()->intended( route( "landlord.dashboard" ) );

        } else if ( $user_role == 'tenant' ) {
            if(Session::get('url.intended')){

                $url = Session::get('url.intended');
                Session::forget('url.intended');
                return Redirect::to($url)->with('success','Successfully logged in');
            }       
            return redirect()->intended( route("tenant.dashboard") );
        }else if ( $user_role == 'technision' ) {
            return redirect()->intended( route("technision.dashboard") );
        }

        Auth::logout();
    }
}
