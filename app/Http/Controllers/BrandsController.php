<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;
use App\Repositories\Contracts\BrandRepositoryInterface;


class BrandsController extends Controller
{


    private $_brand;


    public function __construct( BrandRepositoryInterface $brand ) {
        $this->_brand = $brand;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $brands = $this->_brand->getAll();
        return view('admin.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.brand.create');
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
            'brand_name' => ['required', 'max:50', 'unique:brands,brand_name']
        ]);

        $brand = $this->_brand->add($request);
        return      back()
                    ->with('message', 'The Band has been created successfully.');
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
    public function edit(Brand $brand)
    {
        //
        return view('admin.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        //

        $this->validate($request, [
            'brand_name' => ['required', 'max:50', 'unique:brands,brand_name,' . $brand->id]
        ]);

        $brands = $this->_brand->update($request,$brand->id);

        return      back()
                    ->with('message', 'The brand has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        //
        $this->_brand->delete($brand);
		
		return      back()
                    ->with('message', 'The brand has been deleted successfully.');
    }
}
