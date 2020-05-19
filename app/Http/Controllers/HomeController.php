<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::with('attachements')->get();

        // getting some categories

        // $categories = Category::where('id', 2)->limit(5)->with('productCategories')
        //                         ->with('productCategories.product')
        //                         ->first();

        // dd($categories->productCategories);

        
        return view('front.home.index', compact('products'));
    }
}
