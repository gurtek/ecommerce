<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Contact;

class ContactController extends Controller
{
    //

    public function index() {

        return view('front.contact.index');
    }

    public function store(Request $request) {
		
		 $this->validate($request, [
            'name' 			=> ['required', 'max:50'],
            'email' 		=> ['required', 'max:50'],
            'subject' 		=> ['required', 'max:150'],
            'message' 		=> ['required', 'max:250'],
        ]);
		
		$data['name'] 		= $request->name;
        $data['email'] 		= $request->email;
        $data['subject'] 	= $request->subject;
        $data['message'] 	= $request->message;
        
        
        Contact::create($data)->id;
        
		return      back()
                    ->with('message', 'Inquiry submitted successfully.');
		
    }


}
