<?php

namespace App;

use App\AttributeValue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name'
    ];

    public function values() {
        return $this->hasMany(AttributeValue::class);
    }

}
