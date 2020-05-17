<?php

namespace App\Repositories\Implementations;

use App\Attribute;
use App\AttributeValue;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Repositories\Contracts\AttributeRepositoryInterface;



class AttributeRepository implements AttributeRepositoryInterface {


    public function getAll() {
        return Attribute::paginate(10);

    }

    public function getById() {

    }

    public function add(Request $request) {

        $data['name'] = $request->name;        
        
        
        return Attribute::create($data)->id;

    }


    public function addAttributeValue(Attribute $attribute,Request $request) {

        $data['attribute_value'] = $request->attribute_value;
        $data['attribute_id']    = $attribute->id;
        
        return AttributeValue::create($data)->id;

    }

    public function update(Request $request, $id) {

        $data['name'] = $request->name;
        
       
        return Attribute::find($id)->update($data);

    }

    public function updateAttributeValue(Request $request, $id) {

        $data['attribute_value'] = $request->attribute_value;
        
        return AttributeValue::find($id)->update($data);

    }

    public function delete(Attribute $attribute) {
        return $attribute->delete();
    }


    public function deleteAttributeValue(AttributeValue $attributevalue) {
        return $attributevalue->delete();
    }


    public function attributeOptions() {
        $options = ['' => 'select an option'];
        $result = Attribute::pluck('name', 'id');
        if($result->count())
            $options += $result->toArray();
        return $options;
    }

    public function attributeValueOptions( $attributeId, $withSelect = true) {
        $options = $withSelect ? ['' => 'select an option'] : [];
        $result = AttributeValue::where('attribute_id', $attributeId)
                                  ->pluck('attribute_value', 'id');
        if($result->count())
            $options += $result->toArray();
        return $options;
    }

    public function getAttributeValues(Attribute $attribute) {
       
        return AttributeValue::where('attribute_id', $attribute->id)
                ->paginate(10);
                             
    }


}