<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.back.dashboard');
    }

    public function index2(Request $request)
    {
        return view('pages.back.dashboard');
    }
}