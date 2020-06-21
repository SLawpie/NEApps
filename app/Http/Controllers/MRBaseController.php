<?php

namespace App\Http\Controllers;

use View;

class MRBaseController extends Controller
{
    public $test_variable = "";

    public function __construct()
    {
        View::share ('test_variable', $this->test_variable);
    }
}