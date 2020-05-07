<?php

namespace App\Http\Controllers\Auth;

Use Alert;
use DB;
use Session;
use View;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Controllers\HomeController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use ThrottlesLogins;
use Purifier;

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

        if (auth()->user()->user_type == 'candidato') {
            
            return '/candidato/inscricao';
        }

        if (auth()->user()->user_type == 'coordenador') {
            
            return '/coordenador';
        }

        return '/home';
    }

    protected function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }
        
        $request->merge([
            'email' => Purifier::clean(trim(strtolower($request->email))),
        ]);

        if ($this->attemptLogin($request)) {
            
            if (Session::has('locale')) {

                $user = User::find(Auth::user()->usuario_id);

                $user->update(['locale' => Session::get('locale')]);
            }

            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
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
