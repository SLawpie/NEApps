<?php 

namespace App\Http\Controllers\PlasmaCosts;

use App\Http\Controllers\Controller;

class PlasmaCostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('plasma-costs.index');
    }

    public function settingsFormShow()
    {
        return view('plasma-costs.settings');
    }

}