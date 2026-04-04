<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class HomeController extends AllController
{
    //
    public function index()
    {
        return view('web.home.index');
    }
}
