<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LendController extends LmsController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('lms.lends');
    }
}
