<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function allCustomers() {
        $customers = User::where('type', 'CUS')->orderBy('id', 'desc')->paginate(10);
        return view('admin.customer.index', compact('customers'));
    }
}
