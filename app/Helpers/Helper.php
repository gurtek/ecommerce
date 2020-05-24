<?php 

use App\Brand;

function menus() {
    return App\Category::where('parent_id', null)
            ->with('children')
            ->get();
}

function getTotalQuantity() {
    return \Cart::getTotalQuantity();
}

function getBrands() {
    return Brand::with('products')->get();
}