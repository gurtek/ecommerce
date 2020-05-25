<?php

namespace App;

use App\ProductCategory;
use App\ProductAttribute;
use App\ProductAttachement;
use App\ProductCategoryView;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
  use SoftDeletes;

   protected $fillable = [
     'product_name', 'product_slug', 
     'product_description',
     'product_price', 'quantity', 'brand_id'
   ];

     public function attachements() {
        return $this->hasMany(ProductAttachement::class);    
     }

     public function productCategories() {
      return $this->hasMany(ProductCategoryView::class);    
    }
}
