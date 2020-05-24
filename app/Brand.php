<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'brand_name', 
        'brand_slug',        
        'image'
    ];

    public function products() {
        return $this->hasMany(Product::class);
    }
}
