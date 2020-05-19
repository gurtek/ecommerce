<?php

namespace App;

use App\ProductAttachement;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['product_name', 'product_slug', 'product_description',
     'product_price', 'quantity'];

     public function attachements() {
        return $this->hasMany(ProductAttachement::class);    
     }
}
