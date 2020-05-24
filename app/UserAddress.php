<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $table = 'user_address';

    public $timestamps = false;

    protected $fillable = [
        'name', 'user_id', 'city', 'state', 'country', 
        'pincode', 'address', 'land_mark', 'is_default', 'address_type'
    ];

    public function store($data, $id = null) {
        if($id != null) {
            return $this->fin($id)->update($data);
        }
        return $this->create($data)->id;
    }
}
