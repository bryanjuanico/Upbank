<?php

namespace MHBank\BBMS\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    public function profile(){
    	return view('profile', array('users' => Auth::user()));
    }

    public function update_avatar(Request $request){
    	
    }
}
