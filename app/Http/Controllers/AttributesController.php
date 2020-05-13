<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\AttributeValue;
use Illuminate\Http\Request;
use App\Repositories\Contracts\AttributeRepositoryInterface;

class AttributesController extends Controller
{

    private $_attribute;

    public function __construct( AttributeRepositoryInterface $attribute ) {

        $this->_attribute = $attribute;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes = $this->_attribute->getAll();
        return view('admin.attribute.index', compact('attributes'));
    }
	
	
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function valueindex( Attribute $attribute )
    {
		
        $attributes = $this->_attribute->getAttributeValues($attribute);        
        return view('admin.attribute.valueindex', compact('attribute','attributes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.attribute.create');
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => ['required', 'max:50', 'unique:attributes,name']
        ]);

        $attribute = $this->_attribute->add($request);
		return      back()
                    ->with('message', 'The attribute has been added successfully.');
    }
	
	
	/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function valuecreate(Attribute $attribute)
    {
        //
        return view('admin.attribute.valuecreate',compact('attribute'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function valuestore(Attribute $attribute,Request $request)
    {
        //
        $this->validate($request, [
            'attribute_value' => ['required', 'max:50']
        ]);

        $attribute = $this->_attribute->addAttributeValue( $attribute,$request);
		return      back()
                    ->with('message', 'The attribute has been added successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Attribute $attribute)
    {
        return view('admin.attribute.edit', compact('attribute'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function valueedit(Attribute $attribute,AttributeValue $attributevalue)
    {        
        return view('admin.attribute.valueedit', compact('attribute','attributevalue'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attribute $attribute)
    {
        $this->validate($request, [
            'name' => ['required', 'max:50', 'unique:attributes,name,' . $attribute->id]
        ]);

        $attributes = $this->_attribute->update($request,$attribute->id);
		
		return      back()
                    ->with('message', 'The attribute has been updated successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function valueupdate(Attribute $attribute,AttributeValue $attributevalue,Request $request)
    {
        $this->validate($request, [
            'attribute_value' => ['required', 'max:50']
        ]);

        $attributes = $this->_attribute->updateAttributeValue($request,$attributevalue->id);
		
		return      back()
                    ->with('message', 'The attribute has been updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attribute $attribute)
    {
        //
        $this->_attribute->delete($attribute);
		
		return      back()
                    ->with('message', 'The attribute has been deleted successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function valuedestroy(Attribute $attribute)
    {
        //
        $this->_attribute->delete($attribute);
		
		return      back()
                    ->with('message', 'The attribute has been deleted successfully.');
    }
}
