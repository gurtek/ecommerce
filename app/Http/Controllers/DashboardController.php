<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index() {

        $orders = Order::with('orderItems')
            ->with('user')->limit(10)->get();

        return view('admin.dashboard.index', compact('orders'));
    }
}
