<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\User;

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
 
    public function messages()
    {
        return [
            'same' => 'A title is required',
            'body.required'  => 'A message is required',
        ];
    }

    
}