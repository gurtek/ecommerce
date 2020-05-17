<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    public $timestamps = false;
    protected $table = 'product_attributes';
    protected $fillable = ['product_id', 'attribute_value_id', 'quantity', 'price'];
}
