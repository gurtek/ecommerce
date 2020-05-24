<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';
    public $timestamp = false;

    protected $fillable = [
        'product_id',
        'order_id',
        'product_price',
        'quantity',
        'total_price',
        'attributes'
    ];

    public function saveMultiple($data) {
        return $this->insert($data);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
