<?php

namespace App\Http\Controllers;

use App\Product;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use App\ProductAttributeView;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = \Cart::getContent();
        $cartTotal = \Cart::getTotal();
		return view('front.cart.index', compact('cart', 'cartTotal'));
    }

    public function addToCart(Request $request) {

        $this->validate($request, [
            'product_id' => 'required|numeric',
            'quantity' => 'required|numeric|min:1'
        ]);

        
        $product = Product::where('id', $request->product_id)->with('attachements')
                            ->firstOrFail();

        $totalPrice = floatVal($product->product_price);
        $options = array();
        if($request->has('attribute_values')) {
            $options = $this->_sanitizeAttributeValues($request->attribute_values, 
            $request->product_id);
            if($options != null) {
                $prices = array_column($options->toArray(), 'attribute_price');
                if(count($prices)) {
                    $totalPrice+= array_sum($prices);
                }
            }
        }

        $serialized = $this->_serializeOptions($options);
        #implement cart in session
        $this->_addToBasket($request, $product, $serialized);
        
        return redirect()->back()->with('message', 'Item added to cart successfully.');
    }

    private function _addToBasket($request, $product, $serialized) {
        $image = null;
        $key = $serialized != null ? (string) md5($product->id . '_' . $serialized) : 
                                (string) md5($product->id);
        if(optional($product->attachements) && count($product->attachements)) {
            $image = $product->attachements->first()->file_path;
        }
        if(\Cart::isEmpty()) {
            \Cart::add([
                'id' => $key,
                'name' => $product->product_name,
                'price' => floatVal($product->product_price),
                'quantity' => (int) $request->quantity,
                'attributes' => [
                    'image' => $image,
                    'options' => $serialized,
                    'product_id' => $product->id
                ]
            ]);
        } else {
           
           if($this->_alreadyInCart($key)) {
                \Cart::update($key, array(
                    'quantity' => (int) $request->quantity, 
                ));
           } else {
                \Cart::add([
                    'id' => $key,
                    'name' => $product->product_name,
                    'price' => floatVal($product->product_price),
                    'quantity' => (int) $request->quantity,
                    'attributes' => [
                        'image' => $image,
                        'options' => $serialized,
                        'product_id' => $product->id
                    ]
                ]);
           }
        }
        return redirect()->back()->with('message', 'The item has been added in the cart.');
    }

    private function _alreadyInCart($key) {
        $content = \Cart::getContent();
        $flag = false;
        if($content->count()) {
            foreach($content as $c) {
                if ($c['id'] == $key) {
                    $flag = true;
                    break;
                }
            }
        }
        return $flag;
    }

    private function _serializeOptions($options) {
        if($options) {
            $data = array();
            foreach($options as $key => $row) {
                $data[$key]['attribute_name'] = $row->attribute_name;
                $data[$key]['attribute_value'] = $row->attribute_value;
                $data[$key]['attribute_price'] = $row->attribute_price;
            }

           return serialize($data);
        }
        return null;
    }

    private function _sanitizeAttributeValues($attributeValues, $productId) {
        $values = array_filter($attributeValues);
        if( count($values) ) {
            return  ProductAttributeView::where('id', $productId)->whereIn('attribute_value_id', $values)
                                ->get(['attribute_name', 'attribute_value', 'attribute_price']);
            
        }
        return null;
    }

    public function removeItem(Request $request) {
        if(!$request->ajax()) {
            abort(404);
        }

        $id = $request->get('id');
        $cartItem = \Cart::get($id);
        if($cartItem != null) {
            \Cart::remove($id);
        }

        return response()->json([
            'status' => 200,
            'message' => 'The Item removed from the cart.'
        ]);
    }

    public function updateItem(Request $request) {
        if(!$request->ajax()) {
            abort(404);
        }

        $this->validate($request, [
            'id' => 'required',
            'quantity' => 'required'
        ]);

        $id = $request->get('id');
        $cartItem = \Cart::get($id);
        if($cartItem != null) {
            \Cart::update($id, array(
                'quantity' => [
                    'relative' => false,
                    'value' => (int) $request->quantity
                ],
            ));
        }

        return response()->json([
            'status' => 200,
            'message' => 'The Item has been updated.'
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
