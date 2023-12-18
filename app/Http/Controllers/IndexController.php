<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        // dd( Auth::user() );
        return inertia('Index/Index');
    }

    public function show()
    {
        return inertia('Index/Show');
    }
}
