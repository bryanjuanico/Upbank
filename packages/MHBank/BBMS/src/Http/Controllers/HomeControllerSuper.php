<?php

namespace MHBank\BBMS\Http\Controllers;

use Illuminate\Http\Request;

class HomeControllerSuper extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home-2');
    }

    public function index2()
    {
        return view('homepage');
    }

    public function index3()
    {
        return view('home');
    }
}
