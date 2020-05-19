<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'product_categories';
    protected $fillable = ['product_id', 'category_id'];
    public $timestamps = false;

    public function product() {
        return $this->belongsToMany(Product::class);
    }
}
