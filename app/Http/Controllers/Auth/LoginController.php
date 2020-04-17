<?php

namespace App\Http\Controllers\Auth;

Use Alert;
use DB;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use ThrottlesLogins;

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

    protected $maxAttempts = 5;

    protected $decayMinutes = 5;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/';
    // 
    
    protected function redirectTo()
    {
        if (auth()->user()->user_type == 'admin') {
            return '/admin';
        }
        return '/home';
    }

    protected function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        Alert::info('Logout', 'Você saiu da sua conta!')->autoclose(1500);

        return $this->loggedOut($request) ?: redirect('/');
    }
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
