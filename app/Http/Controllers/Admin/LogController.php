<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

use App\User;
use App\LoginAttempt;

class LogController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }



    public function showUsersHistory()
    {
        $user = Auth::user();
        $loginAttempts = array();

        //foreach (LoginAttempt::where('user_name',$user->username)
        foreach (LoginAttempt::where('user_name','LIKE','%')
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
                $ip = $request->ip();
                $ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
                $ipInfo = json_decode($ipInfo);
                $time_zone = $ipInfo->timezone;
            }

            $date = new Carbon($loginAttempt->created_at);
            $date->setTimezone($time_zone);
            

            $diffDays = $date->diffInDays();
            $dateNow = now()->setTimezone($time_zone)->locale('pl_PL');

            $date->locale('pl_PL')->isoFormat('DD. MMM YYYY, HH:mm');
            $myDate = $date;
            
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
                    'userName' => $loginAttempt->user_name,
                    'date' => $loginAttempt->created_at->toDateTimeString(),
                    'myDate' => $myDate,
                    'diffDays' => $diffDays,
                    'browser' => $browser,
                    'system' => $system,
                    'success' => $loginAttempt->success,
            ];
        };
//dd($loginAttempts);
        return view('admin.history')->with('loginAttempts', $loginAttempts);
    }

}