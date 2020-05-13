<?php

namespace App\Repositories\Implementations;
use App\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Repositories\Contracts\ProductRepositoryInterface;


class ProductReAttributepository implements ProductRepositoryInterface {
    public function getAll() {
        return Product::paginate(10);
    }
    public function getById($id) {

    }

    public function add(Request $request) {
       
    }

    public function update(Request $request, $id) {
        
    }

    public function delete(Product $Product)
    {
        return $Product->delete();
    }


}