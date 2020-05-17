<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['product_name', 'product_slug', 'product_description',
     'product_price', 'quantity'];
}
