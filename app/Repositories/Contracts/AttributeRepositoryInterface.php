<?php

namespace App\Repositories\Contracts;

use App\Attribute;
use App\AttributeValue;
use Illuminate\Http\Request;

interface AttributeRepositoryInterface {

    public function getAll();
    public function getById();
    public function add(Request $request);
    public function update(Request $request, $id);
    public function delete(Attribute $attribute);
    public function getAttributeValues(Attribute $attribute);
    public function addAttributeValue(Attribute $attribute,Request $request);
    public function updateAttributeValue(Request $request, $id);
    public function deleteAttributeValue(AttributeValue $attributevalue);

}