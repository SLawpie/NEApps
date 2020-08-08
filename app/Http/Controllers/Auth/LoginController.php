<?php

namespace App\Http\Controllers\Auth;

use Config;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
//use Jenssegers\Agent\Agent;

use App\Models\User\LoginAttempt;

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
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectTo()
    {
        if (Auth::user()->hasRole('admin')){
            $this->redirectTo = route('admin.users.index');
            //return $this->redirectTo;
            return redirect()->route('admin.users.index');
           
        }
        $this->redirectTo = route('home');
        //return $this->redirectTo;
        return redirect()->route('home');
    }

    public function login(Request $request)
    {   

        $input = $request->all();

        //
        // Przyda się do zrobienia view
        // Do zapisania powinno starczyć: ip, user, userAgent
        //
        
        // $agent = new Agent();
        
        //$agent->setUserAgent($request->userAgent());    

        // if ($agent->isMobile())
        //     $deviceType = "Mobile";
        // elseif ($agent->isTablet())
        //     $deviceType = "Tablet";
        // else
        //     $deviceType = "Desktop";

        // if (($request->ip() == '::1') || ($request->ip() == '127.0.0.1'))
        //     $ip = 'localhost';
        // else
        //     $ip = $request->ip();

        // $login_attempt = [
        //     'username' => $input['username'],
        //     'ip' => $ip,
        //     'time' => now()->toDateTimeString(),
        //     'timeFull' => now(), 
        //     'userAgent' => $request->userAgent(),
        //     'browser' => $agent->browser(),
        //     'browserVersion' => $agent->version($agent->browser()),
        //     'platform' => $agent->platform(),
        //     'platformVersion' => $agent->version($agent->platform()),
        //     'device' => $agent->device(),
        //     'deviceType' => $deviceType,
        // ];
        // dd($login_attempt);


        $loginAttempt = LoginAttempt::create([
            'ip' => $request->ip(),
            'user_name' => $request->username,
            'user_agent' => $request->userAgent(),
        ]);
        

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);
  
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if(auth()->attempt(array($fieldType => $input['username'], 'password' => $input['password'])))
        {

            $timezone = [
                'timezone' => $request->timezone // timezone
            ];
            //Config::write('neapps', $timezone);
            config()->set('neapps.timezone', $timezone);

            $loginAttempt->success = true;       //logged in
            $loginAttempt->save();
            //return redirect()->route('home');
            return LoginController::redirectTo();
        }else{
            $loginAttempt->success = false;       //failed log in
            $loginAttempt->save();   
            // return redirect()->route('login')->with('username','Email-Address And Password Are Wrong.');
            return redirect()->back()
            ->withInput()
            ->withErrors([
                'username' => trans('auth.failed'),
            ]);
        }
          
    }
}
