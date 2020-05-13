<?php

namespace App\Repositories\Contracts;

use App\Brand;
use Illuminate\Http\Request;

interface BrandRepositoryInterface {
    public function getAll();
    public function getById();
    public function add(Request $request);
    public function update(Request $request, $id);
    public function delete(Brand $brand);
}