<?php

namespace App;

use App\User;
use App\Product;
use App\OrderItem;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_no',
        'total_amount',
        'address_id',
        'status'
    ];

    protected $dates = [
        'created_at'
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function orderItems() {
        return $this->hasMany(OrderItem::class);
    }
}
