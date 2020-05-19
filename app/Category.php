<?php

namespace App;

use App\Product;
use App\ProductCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'category_name', 
        'category_slug',
        'parent_id',
        'image'
    ];

    public function children() {
        return $this->hasMany('App\Category', 'parent_id', 'id') ;
    }

    public function productCategories() {
        return $this->hasMany(ProductCategory::class);
    }
}
