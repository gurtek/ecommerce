<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderItem;
use App\Transaction;
use App\UserAddress;
use PayPal\Api\Item;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Payment;
use PayPal\Api\ItemList;
use Illuminate\Http\Request;

use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use Illuminate\Support\Facades\DB;
use PayPal\Auth\OAuthTokenCredential;

class CheckoutController extends Controller
{
	 
	
	public function index() {
		$cart = \Cart::getContent();
		$cartTotal = \Cart::getTotal();
		$addresses = UserAddress::where('user_id', auth()->user()->id)->get();
		return view('front.checkout.index', compact('cart', 'cartTotal', 'addresses'));
	}

	public function executePayment(Request $request) {
		if(!$request->ajax()) {
			abort(404);
		}

		$this->validate($request, [
			'address_id' => 'required',
			'transaction_id' => 'required',
			'amount' => 'required'
		]);
		
		DB::beginTransaction();
		try {
			$orderId = $this->_addOrder($request);
			if($this->_addItem($orderId)) {
				$this->_addTransaction($request, $orderId);
			}
			DB::commit();
			return response()->json([
				'status' => 200
			]);

		}catch(\Exception $ex) {
			DB::rollback();
			// save failed transaction history for refund code will be here
			return response()->json([
                'status' => 500,
                'message' => $ex->getMessage()
            ]);
		}
		// save order first
		
	} 

	private function _addOrder($request) {
		$order = new Order();
		$order->user_id = auth()->user()->id;
		$order->order_no = $this->_generateOrderNumber();
		$order->total_amount = \Cart::getTotal();
		$order->address_id = $request->address_id;
		$order->save();
		return $order->id;
	}

	private function _addTransaction($request, $orderId) {
		$transaction = new Transaction();
		$transaction->order_id = $orderId; 
		$transaction->amount = $request->amount; 
		$transaction->transaction_id = $request->transaction_id; 
		$transaction->save();
		\Cart::clear();
	}

	private function _addItem($orderId) {
		$cartItems = \Cart::getContent();
		$data = [];
		if($cartItems->count()) {
			foreach($cartItems as $item) {
				$data[] = [
					'order_id' => $orderId,
					'product_id' => $item->attributes->product_id,
					'product_price' => $item->price,
					'total_price' => $item->price * $item->quantity,
					'quantity' => $item->quantity,
					'attributes' => $item->attributes->options
				];
			}

			(new OrderItem)->saveMultiple($data);
			return true;
		}
		return false;
	}

	private function _generateOrderNumber() {
		$order = Order::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->first();
		if($order == null) {
			$id = 1;
		}
		else {
			$id = (int) $order->id + 1;
		}
		return 'ORD_' . sprintf('%06d', $id);
	}

	public function orderSuccess() {
		dd('success page');
	}
}
