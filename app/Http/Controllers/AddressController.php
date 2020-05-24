<?php

namespace App\Http\Controllers;

use Validator;
use App\UserAddress;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function store(Request $request) {
        
        if(!$request->ajax()) {
            abort(404);
        }
        $requestData = $request->all();        
        $data=  array();
        parse_str($requestData['formdata'], $data);


        $validator = Validator::make($data, [
            'name' => 'required|min:3|max:50',
            'city' => 'required|min:3|max:50',
            'state' => 'required|min:3|max:50',
            'country' => 'required|min:3|max:50',
            'pincode' => 'required|digits:6',
            'address' => 'required|max:255',
            'landmark' => 'nullable|max:50',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $this->_renderErrorMessages($validator->errors())
            ], 200);
        }

        $data['user_id'] = auth()->user()->id;
        (new UserAddress)->store($data);
        

        return response()->json([
            'status' => 200,
            'message' => 'Address has been added.'
        ]);
    }

    private function _renderErrorMessages($errors) {
        $messages = [];
        if($errors->any()) {
            foreach($errors->all() as $error) {
                $messages[] = $error;
            }
        }
        return $messages;
    }

    public function getDetail(Request $request) {
        if(!$request->ajax()) {
            abort(404);
        }
        $id = $request->get('id');

        if($id == null) {
            return response()->json([
                'status' => 422
            ]);
        }

        $address = UserAddress::where('id' , $id)->where('user_id', auth()->user()->id)->first();

        if($address == null) {
            return response()->json([
                'status' => 422
            ]);
        }
        
        return response()->json([
            'status' => 200,
            'data' => $address
        ]);
    }
}
