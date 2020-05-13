<?php

namespace App\Repositories\Contracts;

use App\Product;
use Illuminate\Http\Request;

interface ProductRepositoryInterface {
    public function getAll();
    public function getById();
    public function add(Request $request);
    public function update(Request $request, $id);
    public function delete(Product $product);
}