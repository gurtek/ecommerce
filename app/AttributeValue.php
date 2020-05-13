<?php

namespace App;

use App\Attribute;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    protected $fillable = [
        'attribute_id',
        'attribute_value',
        'attribute_image'
    ];

    public $timstamps = false;

    public function attribute() {
        return $this->belongsTo(Attribute::class);
    }

    public function setUpdatedAt($value)
    {
      return NULL;
    }

    public function setCreatedAt($value)
    {
      return NULL;
    }
}
