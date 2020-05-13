<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class AdminController extends Controller
{
    //
    public function index(Request $request) {

        if($request->isMethod('post')) {
            $data = $request->input();
            
            $this->validate($request,[
                'email'     => 'required',
                'password'  => 'required'
            ]);
            
			if(Auth::attempt(['email'=>$data['email'],"password"=>$data['password'],"type"=>"ADM"])) {
				return redirect('/admin/dashboard');
			} else {
				return redirect('/admin')->with('flash_message_error',"Invalid  credentails input.");
			}
			
		}

        return view('admin.admin.index');
    }
}
