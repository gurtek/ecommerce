<?php 
namespace App\Repositories\Contracts;

use App\Category;
use Illuminate\Http\Request;

interface CategoryRepositoryInterface {
    public function getAll();
    public function getById($id);
    public function options();
    public function add(Request $request);
    public function update(Request $request, $id);
    public function delete(Category $cateogry);

}