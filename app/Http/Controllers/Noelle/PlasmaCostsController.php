<?php 

namespace App\Http\Controllers\Noelle;

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


}