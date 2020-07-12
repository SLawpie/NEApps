<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use Jenssegers\Agent\Agent;

use App\User;
use App\LoginAttempt;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showChangePasswordForm()
    {
        return view('auth.changepassword');
    }

    public function changePassword(Request $request)
    {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()
                ->withInput()
                ->withErrors([
                    "current-password" => "Niepoprawne aktualne hasło."
                ]);
        }
        

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()
                ->withInput()
                ->withErrors([
                    "new-password" => "Nowe hasło nie może być takie samo jak aktualne."
                ]);
        }


        // $validatedData = $request->validate([
        //     'current-password' => 'required',
        //     'new-password' => 'required|string|min:6|confirmed',
        // ]);


        $validatedData = $request->validate([
            'current-password' => ['required'],
            'new-password' => ['required','min:6'],
            'new-password-confirm' => ['same:new-password'],
        ]);


        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->back()->with("success", "Hasło zostało zmienione.");
    }

    public function showUserSettings()
    {
        //$users = User::all();
        //$user = Auth::user();

        //return view('user.settings')->with('user',$user);
        return view('user.settings');
    }

    
    public function showUserHistory()
    {
        $user = Auth::user();
        $loginAttempts = array();

        //foreach (LoginAttempt::where('user_name','<>','')
        foreach (LoginAttempt::where('user_name',$user->username)
            ->orderBy('created_at', 'desc')
            ->limit(20)
            ->get() 
            as $loginAttempt)
        {
            if (($loginAttempt->ip == '::1') || ($loginAttempt->ip == '127.0.0.1'))
            {
                $time_zone = "Europe/Warsaw";
                $ip = 'localhost';
            } else {
                $ip = $loginAttempt->ip;
                $ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
                $ipInfo = json_decode($ipInfo);
                $time_zone = $ipInfo->timezone;
            }

            $date = new Carbon($loginAttempt->created_at);
            $date->setTimezone($time_zone);
            

            $diffDays = $date->diffInDays();
            $dateNow = now()->setTimezone($time_zone)->locale('pl_PL');

            $myDate = $date->locale('pl_PL')->isoFormat('DD. MMM YYYY, HH:mm');;
            
            if ($diffDays == 0)
                if ($date->day == $dateNow->day)
                    if (($dateNow->hour - $date->hour) < 1)
                        $myDate = "Przed chwilą";
                    else
                        $myDate = "Dzisiaj, " . $date->isoFormat('HH:mm');
                else
                    $myDate = "Wczoraj, " . $date->isoFormat('HH:mm');
            elseif ($diffDays == 1)
                if ($date->day == ($dateNow->day - 1))
                    $myDate = "Wczoraj, " . $date->isoFormat('HH:mm');

            $agent = new Agent();
            $agent->setUserAgent($loginAttempt->user_agent); 
            //$browser = $agent->browser() . '/' . substr($agent->version($agent->browser()), 0, strpos($agent->version($agent->browser()), "."));
            $browser = $agent->browser() . ' ' . $agent->version($agent->browser());
            $system = $agent->platform() . ' ' . $agent->version($agent->platform());

            $loginAttempts[] = [           
                    'ip' => $ip,
                    'date' => $loginAttempt->created_at->toDateTimeString(),
                    'myDate' => $myDate,
                    'diffDays' => $diffDays,
                    'browser' => $browser,
                    'system' => $system,
                    'success' => $loginAttempt->success,
            ];
        };
        return view('user.history')->with('loginAttempts', $loginAttempts);
    }
}