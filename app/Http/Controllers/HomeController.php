<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index(Request $request)
    public function index()
    {
        // $request->session()->flash('success', 'testing success flash message');
        // $request->session()->flash('warning', 'testing warning flash message');
        // $request->session()->flash('error', 'testing error flash message');
        
        return view('home');
    }
    
    public function showChangePasswordForm()
    {
        return view('auth.changepassword');
    }


    public function messages()
{
    return [
        'same' => 'A title is required',
        'body.required'  => 'A message is required',
    ];
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
        return view('user.settings');
    }
}