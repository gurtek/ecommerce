<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function customerOrder() {
        
        $orders = Order::where('user_id', auth()->user()->id)
            ->orderBy('id', 'desc')
            ->with('orderItems')
            ->get();
        
        return view('front.order.index', compact('orders'));
    }

    public function allOrders() {
        
        $orders = Order::orderBy('id', 'desc')
                ->with('orderItems')
                ->with('user')
                ->paginate(10);
        
        return view('admin.order.index', compact('orders'));
    }

    public function changeStatus(Request $request) {
        $this->validate($request, [
            'order_id' => 'required',
            'status' => 'required'
        ]);

        $order = Order::where('id', $request->order_id)->first();
        if($order == null) {
            return response()->json([
                'status' => 400,
                'message' => 'Order not found.'
            ]);
        }

        $order->status = $request->status;
        $order->save();

        return response()->json([
            'status' => 200,
            'message' => 'The status has been changed of the order.'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
