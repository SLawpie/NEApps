<?php

namespace App\Http\Controllers\MedicalReports;

use App\Http\Controllers\Controller;

use View;

class MRBaseController extends Controller
{
    public $test_variable = "";

    public function __construct()
    {
        View::share ('test_variable', $this->test_variable);
    }
}