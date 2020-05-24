<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductAttributeView extends Model
{
    protected $table = 'product_attribute_view';
    protected $fillable = [
        'id',
        'product_name',
        'product_slug',
        'product_description',	
        'product_price',	
        'quantity',
        'attribute_name',
        'attribute_id',
        'attribute_value',
        'attribute_price'
    ];
}
