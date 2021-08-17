<?php

namespace App\Http\Controllers\WSF;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('homewsf');
    }
}
